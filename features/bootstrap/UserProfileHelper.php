<?php

use AppBundle\Entity\UserProfile;
use Doctrine\ORM\EntityManager;

class UserProfileHelper extends ResourceHelper
{
    private static $numberAccount = 0;
    private $userAccountHelper;

    public function __construct(EntityManager $em, UserAccountHelper $userAccountHelper)
    {
        parent::__construct($em);
        $this->userAccountHelper = $userAccountHelper;
    }

    public function createResource()
    {
        $account = $this->userAccountHelper->persistResource();

        $username = 'string'.self::$numberAccount;

        $profile = new UserProfile();
        $profile->setUsername($username)->setFirstName('string')
            ->setLastName('string')->setUserAccount($account);

        ++self::$numberAccount;

        return $profile;
    }
}
