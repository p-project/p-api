<?php

namespace AppBundle\DataFixtures\ORM\Fixtures;

use AppBundle\Entity\UserAccount;
use AppBundle\Entity\UserProfile;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class AccountData extends ContainerAwareFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $account = new UserProfile();
        $account
            ->setFirstName('denis')
            ->setLastName('denis')
            ->setUsername('denis')
        ;

        $privateData = new UserAccount();
        $privateData
            ->setEmail('denis@denis.fr')
            ->setSalt(base_convert(uniqid(mt_rand(), true), 16, 36))
            ->setPassword($this->container->get('security.password_encoder')->encodePassword($privateData, 'password'))
            ->setProfile($account)
        ;
        $manager->persist($account);
        $manager->persist($privateData);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
