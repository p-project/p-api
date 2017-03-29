<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IpRequestRepository extends EntityRepository
{
    public function findLastIpRequest(string $ip, \DateTime $date)
    {
        return $this->createQueryBuilder('ipr')
            ->where('ipr.ip = :ip')
            ->andWhere('ipr.dateRequest > :date_request')
            ->setParameter('ip', $ip)
            ->setParameter('date_request', $date)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
