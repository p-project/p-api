<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class AccessListener
{
    private $entityManager;

    const AGGREGATION_DELAY = 5;
    const NUMBER_REQUESTS = 15;

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

        $ipRequest = $this->entityManager->getRepository('AppBundle:IpRequest')
            ->findLastIpRequest($ip, (new \DateTime())->modify('-' . static::AGGREGATION_DELAY . ' second'));

        if ($ipRequest === null) {
            $this->createNewIpRequest($ip);
        } else {
            $this->ipIsAlreadyInDb($ipRequest, $ip);
        }
    }

    private function ipIsAlreadyInDb($ipRequest, $ip)
    {
        if ($ipRequest->getDateRequest()->modify('+' . static::AGGREGATION_DELAY . ' second') < new \DateTime()) {
            $this->createNewIpRequest($ip);
        } else {
            if ($ipRequest->getCount() > static::NUMBER_REQUESTS) {
                $response = new Response();
                $response->setStatusCode(Response::HTTP_TOO_MANY_REQUESTS)->setContent("Too Many Request");
                $response->send();
            } else {
                $ipRequest->setCount($ipRequest->getCount() + 1);
                $this->persistIpRequest($ipRequest);
            }
        }
    }

    private function createNewIpRequest(string $ip)
    {
        $ipRequest = new IpRequest($ip, new \DateTime(), 1);
        $this->persistIpRequest($ipRequest);
    }

    private function persistIpRequest(IpRequest $ipRequest)
    {
        $this->entityManager->persist($ipRequest);
        $this->entityManager->flush();
    }
}
