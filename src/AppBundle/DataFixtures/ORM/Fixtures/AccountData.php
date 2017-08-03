<?php

namespace AppBundle\DataFixtures\ORM\Fixtures;

use AppBundle\Entity\Account;
use AppBundle\Entity\Profile;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class AccountData extends ContainerAwareFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $privateData = new Account();
        $privateData->setEmail('denis@denis.fr')
                    ->setSalt(base_convert(uniqid(mt_rand(), true), 16, 36))
                    ->setPassword($this->container->get('security.password_encoder')->encodePassword($privateData, 'password'));
        $manager->persist($privateData);

        $account = new Profile();
        $account
            ->setFirstName('denis')
            ->setLastName('denis')
            ->setUsername('denis')
            ->setAccount($privateData)

        ;
        $manager->persist($account);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
