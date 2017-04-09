<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IpRequestRepository extends EntityRepository
{
    public function findLastIpRequest(string $ip, \DateTime $startingAt)
    {
        return $this->createQueryBuilder('ipr')
            ->where('ipr.ip = :ip')
            ->andWhere('ipr.dateRequest > :starting_at')
            ->setParameter('ip', $ip)
            ->setParameter('starting_at', $startingAt)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
