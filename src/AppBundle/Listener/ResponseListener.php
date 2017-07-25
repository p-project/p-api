<?php

namespace AppBundle\Listener;

use AppBundle\Security\RateLimiter;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListener
{
    private $rateLimiter;
    private $env;

    public function __construct(RateLimiter $rateLimiter, string $env)
    {
        $this->rateLimiter = $rateLimiter;
        $this->env = $env;
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->isMasterRequest() || $this->env === 'test') {
            return;
        }

        $this->addHeader($event, $this->rateLimiter->getHeader());
    }

    private function addHeader(FilterResponseEvent $event, array $header)
    {
        $event->getResponse()->headers->add($header);
    }
}
