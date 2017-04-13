<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
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

    public function findOneByUsername(string $username)
    {
        return $this->createQueryBuilder('a')
            ->select('a')
            ->where('a.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
