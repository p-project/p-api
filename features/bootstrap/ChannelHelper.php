<?php

use AppBundle\Entity\Channel;
use Doctrine\ORM\EntityManager;

class ChannelHelper extends ResourceHelper
{
    private static $numberChannel = 0;

    private $profileHelper;

    public function __construct(EntityManager $em, UserProfileHelper $profileHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper->persistResource();

        $name = 'string'.self::$numberChannel;

        $channel = new Channel();
        $channel->setUserProfile($profile)->setName($name)->setTags(['string']);

        ++self::$numberChannel;

        return $channel;
    }
}
