<?php

use AppBundle\Entity\UserAccount;
use Doctrine\ORM\EntityManager;

class UserAccountHelper extends ResourceHelper
{
    private static $numberAccount = 0;
    private $profileHelper;

    public function __construct(EntityManager $em, UserProfileHelper $profileHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper->persistResource();

        $email = 'string'.self::$numberAccount.'@example.com';

        $account = new UserAccount();
        $account->setEmail($email)->setPassword('string')->setSalt('string')->setProfile($profile);

        ++self::$numberAccount;

        return $account;
    }

}