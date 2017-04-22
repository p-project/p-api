<?php

use AppBundle\Entity\Video;
use AppBundle\Entity\Metadata;
use Doctrine\ORM\EntityManager;

class VideoHelper extends ResourceHelper
{
    /**
     * @var ChannelHelper
     */
    private $channelHelper;

    public function __construct(EntityManager $em, ChannelHelper $channelHelper)
    {
        parent::__construct($em);
        $this->channelHelper = $channelHelper;
    }

    public function createResource()
    {
        $channel = $this->channelHelper->createResource();

        $metaData = new Metadata();
        $metaData->setHeight(100)->setWidth(100)->setFormat('mp3');

        $video = new Video();
        $video->setTitle('string')->setDescription('string')
            ->setUploadDate(new DateTime())->setNumberView('120')
            ->setChannel($channel)->setHash('et')->setMagnet('et');

        return $video;
    }
}
