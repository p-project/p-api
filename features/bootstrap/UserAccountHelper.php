<?php

use AppBundle\Entity\UserAccount;
use Doctrine\ORM\EntityManager;

class UserAccountHelper extends ResourceHelper
{
    private static $numberAccount = 0;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function createResource()
    {
        $email = 'string'.self::$numberAccount.'@example.com';

        $account = new UserAccount();
        $account->setEmail($email)->setPassword('string')->setSalt('string');

        ++self::$numberAccount;

        return $account;
    }
}
