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

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Channel') {
            return parent::createRelationWith($resource, 'Channels', $resource2);
        }
        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Channel') {
            return parent::relationExists($resource, 'Channels', $resource2);
        }
        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
