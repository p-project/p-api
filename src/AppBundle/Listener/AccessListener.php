<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class AccessListener
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $ip = $event->getRequest()->getClientIp();
        $ipRequest = new IpRequest($ip);
        $this->entityManager->persist($ipRequest);
        $this->entityManager->flush();
    }
}
