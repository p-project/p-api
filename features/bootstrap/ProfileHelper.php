<?php

use AppBundle\Entity\Profile;
use Doctrine\ORM\EntityManager;

class ProfileHelper extends ResourceHelper
{
    private static $numberAccount = 0;
    private $accountHelper;

    public function __construct(EntityManager $em, AccountHelper $accountHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $accountHelper;
    }

    public function createResource()
    {
        $account = $this->accountHelper->createResource();

        $username = 'string'.self::$numberAccount;

        $profile = new Profile();
        $profile->setUsername($username)->setFirstName('string')
            ->setLastName('string')->setAccount($account);

        ++self::$numberAccount;

        return $profile;
    }
}
