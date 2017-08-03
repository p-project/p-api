<?php

use AppBundle\Entity\Account;
use Doctrine\ORM\EntityManager;

class AccountHelper extends ResourceHelper
{
    private static $numberAccount = 0;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function createResource()
    {
        $email = 'string'.self::$numberAccount.'@example.com';

        $account = new Account();
        $account->setEmail($email)->setPassword('string')->setSalt('string');

        ++self::$numberAccount;

        return $account;
    }

}