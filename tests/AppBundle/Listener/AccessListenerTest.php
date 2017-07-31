<?php

namespace Tests\AppBundle\Listener;

use AppBundle\Listener\AccessListener;
use AppBundle\Security\RateLimiter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class AccessListenerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    private function getEvent()
    {
        $request = Request::create(
            '/videos',
            'GET'
        );

        $event = $this->getMockBuilder(GetResponseEvent::class)
            ->setConstructorArgs([$this->createMock(HttpKernelInterface::class), $request, 'GET'])
            ->setMethods(['isMasterRequest'])
            ->getMock();

        $event->expects($this->any())->method('isMasterRequest')->willReturn(true);

        return $event;
    }

    private function getRateLimiter()
    {
        $rateLimiter = $this->getMockBuilder(RateLimiter::class)
            ->setConstructorArgs([$this->em])
            ->setMethods(null)->getMock();

        return $rateLimiter;
    }

    public function testRequestPassed()
    {
        $event = $this->getEvent();

        $rateLimiter = $this->getRateLimiter();

        $accessListener = new AccessListener($rateLimiter, 'unit-test');
        $accessListener->onKernelRequest($event);

        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertNull($event->getResponse());
        $this->assertEquals($ipRequest->countAccesses(), 1);

        return $accessListener;
    }

    /**
     * @depends testRequestPassed
     */
    public function testRequestIsBlocked(AccessListener $accessListener)
    {
        $event = null;

        for ($i = 0; $i < RateLimiter::MAX_ATTEMPTS + 2; ++$i) {
            $event = $this->getEvent();
            $accessListener->onKernelRequest($event);
        }

        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertEquals($event->getResponse()->getStatusCode(), Response::HTTP_TOO_MANY_REQUESTS);
        $this->assertTrue($event->getResponse()->headers->get('Retry-After') >= 0);
        $this->assertEquals($ipRequest->countAccesses(), 15);

        return $accessListener;
    }

    /**
     * @depends testRequestIsBlocked
     */
    public function testRequestPassedAgain(AccessListener $accessListener)
    {
        sleep(RateLimiter::AGGREGATION_DELAY);

        $event = $this->getEvent();

        $accessListener->onKernelRequest($event);

        $ipRequests = $this->em->getRepository('AppBundle:IpRequest')->findAll();

        $this->assertNull($event->getResponse());
        $this->assertEquals(count($ipRequests), 2);
        $this->assertEquals($ipRequests[1]->countAccesses(), 1);

        return $accessListener;
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
