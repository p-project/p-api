<?php

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\SustainabilityOffer;

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
            ->setAccount($channel->getAccount())->setChannel($channel);

        return $sustainabilityOffer;
    }
}
