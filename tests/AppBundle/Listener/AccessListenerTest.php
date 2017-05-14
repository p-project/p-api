<?php

namespace Tests\AppBundle\Listener;

use AppBundle\Listener\AccessListener;
use Faker\Provider\cs_CZ\DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

class AccessListenerTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    private $accessListener;

    /**
     * {@inheritDoc}
     */
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
        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(array('ip' => '127.0.0.1'));
        $this->assertNull($event->getResponse());
        $this->assertEquals($ipRequest->countAccesses(), 1);
    }

    public function testRequestIsBlocked()
    {
        $event = null;

        for ($i = 0; $i < AccessListener::MAX_ATTEMPTS + 2; ++$i) {
            $event = $this->getEvent();
            $this->accessListener->onKernelRequest($event);
        }

        $this->assertEquals($event->getResponse()->getStatusCode(), 429);

        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(array('ip' => '127.0.0.1'));

        $this->assertEquals($ipRequest->countAccesses(), 15);
    }

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

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }
}
