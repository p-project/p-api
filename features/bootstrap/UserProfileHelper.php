<?php

use AppBundle\Entity\UserProfile;
use Doctrine\ORM\EntityManager;

class UserProfileHelper extends ResourceHelper
{
    private static $numberAccount = 0;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function createResource()
    {
        $username = 'string'.self::$numberAccount;

        $profile = new UserProfile();
        $profile->setUsername($username)->setFirstName('string')
            ->setLastName('string');

        ++self::$numberAccount;

        return $profile;
    }
}
