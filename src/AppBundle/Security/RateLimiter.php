<?php

namespace AppBundle\Security;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\IpRequest;
use Faker\Provider\DateTime;
use Symfony\Component\Validator\Constraints\Date;

class RateLimiter
{
    private $em;

    private $ipRequest;

    const AGGREGATION_DELAY = 5;
    const MAX_ATTEMPTS = 15;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getIpRequest(string $ip)
    {
        $this->ipRequest = $this->searchOldIpRequest($ip) ?? $this->getNewIpRequest($ip);
        return $this->updateAttempts($this->ipRequest);
    }

    private function getRateLimitRemaining(): int
    {
        $rateLimitRemaining = static::MAX_ATTEMPTS - $this->ipRequest->countAccesses();
        if ($rateLimitRemaining < 0) {
            $rateLimitRemaining = 0;
        }

        return $rateLimitRemaining;
    }

    private function getRateLimitReset(): int
    {
        $dateRequest = clone $this->ipRequest->getDateRequest();
        $interval = (new \DateTime())->diff($dateRequest);

        $secondBetweenDate = $interval->days*86400 + $interval->h*3600
            + $interval->i*60 + $interval->s;

        $rateLimitReset = static::AGGREGATION_DELAY - $secondBetweenDate;
        if ($rateLimitReset < 0) {
            $rateLimitReset = 0;
        }

        return $rateLimitReset;
    }

    public function getHeader(): array
    {
        return [
            'X-RateLimit-Limit' => static::MAX_ATTEMPTS,
            'X-RateLimit-Remaining' => $this->getRateLimitRemaining(),
            'X-RateLimit-Reset' => $this->getRateLimitReset()
        ];
    }

    public function persistIpRequest(IpRequest $ipRequest)
    {
        $this->em->persist($ipRequest);
        $this->em->flush();
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
}