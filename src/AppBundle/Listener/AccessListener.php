<?php

namespace AppBundle\Listener;

use AppBundle\Entity\IpRequest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class AccessListener
{
    private $entityManager;

    const TIMER = 5;
    const NUMBER_REQUEST = 15;

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

        $ipRequest = $this->entityManager->getRepository("AppBundle:IpRequest")->findLastIpRequest($ip);

        if ($ipRequest == null) {
            $this->createNewIpRequest($ip);
        } else {
            $this->ipIsAlreadyInDb($ipRequest, $ip);
        }
    }

    private function ipIsAlreadyInDb($ipRequest, $ip)
    {
        if ($ipRequest->getDateRequest()->add(new \DateInterval('PT' . self::TIMER . 'S')) < new \DateTime("now")) {

            $this->createNewIpRequest($ip);

        } else {

            if ($ipRequest->getCount() > self::NUMBER_REQUEST) {

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
        $ipRequest = new IpRequest($ip, new \DateTime("now"), 1);
        $this->persistIpRequest($ipRequest);
    }

    private function persistIpRequest(IpRequest $ipRequest)
    {
        $this->entityManager->persist($ipRequest);
        $this->entityManager->flush();
    }
}
