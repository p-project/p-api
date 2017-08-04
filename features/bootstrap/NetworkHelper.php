<?php

use AppBundle\Entity\Network;
use Doctrine\ORM\EntityManager;

class NetworkHelper extends ResourceHelper
{
    public function __construct(EntityManager $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {
        $network = new Network();
        $network->setName('name');

        return $network;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'UserProfile') {
            return parent::createRelationWith($resource, 'Peoples', $resource2);
        }

        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'UserProfile') {
            return parent::relationExists($resource, 'Peoples', $resource2);
        }

        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
