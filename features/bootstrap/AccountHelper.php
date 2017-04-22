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
        $username = 'string' .  self::$numberAccount;
        $email = 'string' . self::$numberAccount . '@string.fr';

        $account = new Account();
        $account->setUsername($username)->setEmail($email)->setFirstName('string')
            ->setLastName('string')->setPassword('string')->setSalt('string');

        ++self::$numberAccount;

        return $account;
    }
}
