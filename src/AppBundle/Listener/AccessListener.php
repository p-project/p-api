<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use \DateTime;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

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

        $ipRequest = $this->entityManager->getRepository("AppBundle:IpRequest")->findBy(array('ip' => $ip));

        if ($ipRequest == null) {
            $this->createNewIpRequest($ip);
        } else {
            $this->ipIsAlreadyInDb($ipRequest, $ip, $event);
        }
    }

    private function ipIsAlreadyInDb($ipRequest, $ip, $event)
    {
        end($ipRequest);
        $key = key($ipRequest);
        $ipRequest = $ipRequest[$key];
        $time = (new DateTime("now"))->diff($ipRequest->getDateRequest());

        if ($time->s > 5 || $time->i > 0) {
            $this->createNewIpRequest($ip);
        } else {
            if ($ipRequest->getCount() > 15) {
                $response = new Response();
                $response->setStatusCode(Response::HTTP_BAD_REQUEST)
                    ->setContent("Too Many Request")->send();
            } else {
                $ipRequest->setCount($ipRequest->getCount() + 1);
                $this->persistIpRequest($ipRequest);
            }
        }
    }

    private function createNewIpRequest($ip)
    {
        $ipRequest = new IpRequest($ip, new DateTime("now"), 1);
        $this->persistIpRequest($ipRequest);
    }

    private function persistIpRequest($ipRequest)
    {
        $this->entityManager->persist($ipRequest);
        $this->entityManager->flush();
    }
}
