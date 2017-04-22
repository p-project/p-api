<?php

use AppBundle\Entity\Channel;
use Doctrine\ORM\EntityManager;

class ChannelHelper extends ResourceHelper
{
    private static $numberChannel = 0;

    private $accountHelper;

    public function __construct(EntityManager $em, AccountHelper $accountHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $accountHelper;
    }

    public function createResource()
    {
        $account = $this->accountHelper->persistResource();

        $name = 'string'.self::$numberChannel;

        $channel = new Channel();
        $channel->setAccount($account)->setName($name)->setTags(['string']);

        ++self::$numberChannel;

        return $channel;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Video') {
            return parent::createRelationWith($resource, 'Videos', $resource2);
        }

        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Video') {
            return parent::relationExists($resource, 'Videos', $resource2);
        }

        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
