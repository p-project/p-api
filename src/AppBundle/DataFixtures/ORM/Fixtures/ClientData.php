<?php

namespace AppBundle\DataFixtures\ORM\Fixturesla;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;

class ClientData extends ContainerAwareFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $clientManager = $this->container->get('fos_oauth_server.client_manager');
        $client = $clientManager->createClient();
        $client->setAllowedGrantTypes(array('password'));
        $client->setRandomId('client_id');
        $client->setSecret('client_secret');
        $client->setRedirectUris(array('127.0.0.1'));
        $clientManager->updateClient($client);
    }

    public function getOrder()
    {
        return 1;
    }
}
