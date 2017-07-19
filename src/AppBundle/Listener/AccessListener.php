<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class AccessListener
{
    private $em;
    private $env;

    const AGGREGATION_DELAY = 5;
    const MAX_ATTEMPTS = 15;

    public function __construct(EntityManagerInterface $entityManager, string $env)
    {
        $this->em = $entityManager;
        $this->env = $env;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest() || $this->env === 'test') {
            return;
        }

        $ip = $event->getRequest()->getClientIp();

        $ipRequest = $this->searchOldIpRequest($ip) ?? $this->getNewIpRequest($ip);
        $ipRequest = $this->updateAttempts($ipRequest);

        $this->vote($ipRequest, $event);
    }

    private function searchOldIpRequest(string $ip)
    {
        $startingAt = (new \DateTime())->modify('-'.static::AGGREGATION_DELAY.' second');

        return $this->em->getRepository('AppBundle:IpRequest')->findLastIpRequest($ip, $startingAt);
    }

    private function getNewIpRequest(string $ip)
    {
        return new IpRequest($ip);
    }

    private function updateAttempts(IpRequest $ipRequest)
    {
        $dateRequest = clone $ipRequest->getDateRequest();
        $delay = $dateRequest->modify('+'.static::AGGREGATION_DELAY.' second');

        if ($delay < new \DateTime()) {
            $ipRequest = $this->getNewIpRequest($ipRequest->getIp());
        }

        return $ipRequest;
    }

    private function vote(IpRequest $ipRequest, GetResponseEvent $event)
    {
        if ($ipRequest->countAccesses() >= static::MAX_ATTEMPTS) {
            $event->setResponse(
                (new Response())->setStatusCode(Response::HTTP_TOO_MANY_REQUESTS)->setContent('Too Many Request')
            );
        } else {
            $this->em->persist($ipRequest->recordAccess());
            $this->em->flush();
        }
    }
}
