<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 26/07/17
 * Time: 18:10.
 */

namespace Tests\AppBundle\Listener;

use AppBundle\Listener\ResponseListener;
use AppBundle\Security\RateLimiter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListenerTest extends KernelTestCase
{
    private function getEvent()
    {
        $response = new Response(json_encode(
            ['data' => '123']
        ));

        $event = $this->createMock(FilterResponseEvent::class);
        $event->expects($this->any())->method('getResponse')->willReturn($response);
        $event->expects($this->once())->method('isMasterRequest')->willReturn(true);

        return $event;
    }

    private function getRateLimiter()
    {
        $headers = [
            'X-RateLimit-Limit' => RateLimiter::MAX_ATTEMPTS,
            'X-RateLimit-Remaining' => 14,
            'X-RateLimit-Reset' => 3,
        ];

        $rateLimiter = $this->createMock(RateLimiter::class);
        $rateLimiter->expects($this->once())->method('getResponseHeaders')->willReturn($headers);

        return $rateLimiter;
    }

    public function testResponseHeader()
    {
        $event = $this->getEvent();

        $rateLimiter = $this->getRateLimiter();

        $responseListener = new ResponseListener($rateLimiter, 'unit-test');
        $responseListener->onKernelResponse($event);

        $response = $event->getResponse();

        $this->assertEquals($response->headers->get('X-RateLimit-Limit'), RateLimiter::MAX_ATTEMPTS);
        $this->assertEquals($response->headers->get('X-RateLimit-Remaining'), 14);
        $this->assertEquals($response->headers->get('X-RateLimit-Reset'), 3);
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
