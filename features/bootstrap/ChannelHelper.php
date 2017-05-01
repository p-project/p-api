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
}
