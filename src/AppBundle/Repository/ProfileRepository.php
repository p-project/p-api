<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProfileRepository extends EntityRepository
{
    public function findOneByEmail(string $email)
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}