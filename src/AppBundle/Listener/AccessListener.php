<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use AppBundle\Security\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class AccessListener
{
    private $rateLimiter;
    private $env;

    public function __construct(RateLimiter $rateLimiter, string $env)
    {
        $this->rateLimiter = $rateLimiter;
        $this->env = $env;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest() || $this->env === 'test') {
            return;
        }

        $ip = $event->getRequest()->getClientIp();

        $this->vote($this->rateLimiter->getIpRequest($ip), $event);
    }

    private function vote(IpRequest $ipRequest, GetResponseEvent $event)
    {
        if ($ipRequest->countAccesses() >= RateLimiter::MAX_ATTEMPTS) {
            $response = new Response('Too Many Request', Response::HTTP_TOO_MANY_REQUESTS,
                $this->rateLimiter->getBlockedHeaders());
            $event->setResponse($response);
        } else {
            $this->rateLimiter->persistIpRequest($ipRequest->recordAccess());
        }
    }
}
