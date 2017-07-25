<?php

namespace Tests\AppBundle\Listener;

use AppBundle\Listener\AccessListener;
use AppBundle\Listener\ResponseListener;
use AppBundle\Security\RateLimiter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class ListenerTest extends KernelTestCase
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

    private function getResponseEvent()
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

    private function getFilterResponseEvent()
    {
        $request = Request::create(
            '/videos',
            'GET'
        );
        $dispatcher = new EventDispatcher();

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

        $response = new Response();
        $response->setContent(json_encode(
            [ 'data' => '123' ]
        ));

        $event = new FilterResponseEvent($kernel, $request, 1, $response);

        return $event;
    }

    public function testRequestPassed()
    {
        $rateLimiter = new RateLimiter($this->em);

        $accessListener = new AccessListener($rateLimiter, 'unit-test');
        $accessListener->onKernelRequest($this->getResponseEvent());

        $event = $this->getFilterResponseEvent();
        $responseListener = new ResponseListener($rateLimiter, 'unit-test');
        $responseListener->onKernelResponse($event);

        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertEquals($event->getResponse()->headers->get('X-RateLimit-Limit'), RateLimiter::MAX_ATTEMPTS);
        $this->assertEquals($ipRequest->countAccesses(), 1);

        return $rateLimiter;
    }

    /**
     * @depends testRequestPassed
     */
    public function testRequestIsBlocked(RateLimiter $rateLimiter)
    {
        $event = null;

        $accessListener = new AccessListener($rateLimiter, 'unit-test');
        $responseListener = new ResponseListener($rateLimiter, 'unit-test');

        $eventResponse = $this->getResponseEvent();
        $event = $this->getFilterResponseEvent();


        for ($i = 0; $i < RateLimiter::MAX_ATTEMPTS + 2; ++$i) {
            $accessListener->onKernelRequest($eventResponse);
            $responseListener->onKernelResponse($event);
        }

        $ipRequest = $this->em->getRepository('AppBundle:IpRequest')->findOneBy(['ip' => '127.0.0.1']);

        $this->assertEquals($eventResponse->getResponse()->getStatusCode(), Response::HTTP_TOO_MANY_REQUESTS);
        $this->assertEquals($event->getResponse()->headers->get('X-RateLimit-Remaining'), 0);

        return $rateLimiter;
    }

    /**
     * @depends testRequestIsBlocked
     */
    public function testRequestPassedAgain(RateLimiter $rateLimiter)
    {
        sleep(RateLimiter::AGGREGATION_DELAY);

        $accessListener = new AccessListener($rateLimiter, 'unit-test');
        $responseListener = new ResponseListener($rateLimiter, 'unit-test');

        $eventResponse = $this->getResponseEvent();
        $event = $this->getFilterResponseEvent();

        $accessListener->onKernelRequest($eventResponse);
        $responseListener->onKernelResponse($event);

        $ipRequests = $this->em->getRepository('AppBundle:IpRequest')->findAll();

        $this->assertEquals(count($ipRequests), 2);
        $this->assertEquals($ipRequests[1]->countAccesses(), 1);
        $this->assertEquals($event->getResponse()->headers->get('X-RateLimit-Remaining'), 14);

        return $accessListener;
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em = null;
    }
}
