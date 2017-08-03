<?php

use AppBundle\Entity\SustainabilityOffer;
use Doctrine\ORM\EntityManager;

class SustainabilityOfferHelper extends ResourceHelper
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
        $channel = $this->channelHelper->persistResource();

        $sustainabilityOffer = new SustainabilityOffer();
        $sustainabilityOffer->setName('string')->setDuration(0)
            ->setProfile($channel->getProfile())->setChannel($channel);

        return $sustainabilityOffer;
    }
}
