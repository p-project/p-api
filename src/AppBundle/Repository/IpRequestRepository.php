<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IpRequestRepository extends EntityRepository
{
    public function findLastIpRequest(string $ip)
    {
        $qb = $this->createQueryBuilder('ipr');

        $max = $qb->select($qb->expr()->max('ipr.id'))
            ->getQuery()
            ->getSingleScalarResult();

        if ($max == null) {
            return null;
        }

        return $qb
            ->select('ipr')
            ->where('ipr.ip = :ip')
            ->groupBy('ipr.id')
            ->having($qb->expr()->eq('ipr.id', $max))
            ->setParameter('ip', $ip)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
