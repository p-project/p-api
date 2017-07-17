<?php

namespace Tests\AppBundle\Listener;

use AppBundle\Listener\AccessListener;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class AccessListenerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $accessListener;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->accessListener = new AccessListener($this->em, 'unit-test');
    }

    private function getEvent()
    {
        $request = Request::create(
            '/videos',
            'GET'
        );
        $dispatcher = new EventDispatcher();

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        $event = new GetResponseEvent($kernel, $request, 1);

        return $event;
    }

    public function testRequestPassed()
    {
        $event = $this->getEvent();
        $this->accessListener->onKernelRequest($event);
        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertNull($event->getResponse());
        $this->assertEquals($ipRequest->countAccesses(), 1);
    }

    /**
     * @depends testRequestPassed
     */
    public function testRequestIsBlocked()
    {
        $event = null;

        for ($i = 0; $i < AccessListener::MAX_ATTEMPTS + 2; ++$i) {
            $event = $this->getEvent();
            $this->accessListener->onKernelRequest($event);
        }
        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertEquals($event->getResponse()->getStatusCode(), Response::HTTP_TOO_MANY_REQUESTS);
        $this->assertEquals($ipRequest->countAccesses(), 15);
    }

    /**
     * @depends testRequestIsBlocked
     */
    public function testRequestPassedAgain()
    {
        sleep(AccessListener::AGGREGATION_DELAY);

        $event = $this->getEvent();

        $this->accessListener->onKernelRequest($event);

        $ipRequests = $this->em->getRepository('AppBundle:IpRequest')->findAll();

        $this->assertNull($event->getResponse());
        $this->assertEquals(count($ipRequests), 2);
        $this->assertEquals($ipRequests[1]->countAccesses(), 1);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null;
    }
}
