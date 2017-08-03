<?php

use AppBundle\Entity\Playlist;
use Doctrine\ORM\EntityManager;

class PlaylistHelper extends ResourceHelper
{
    /**
     * @var ChannelHelper
     */
    private $profileHelper;

    public function __construct(EntityManager $em, ProfileHelper $profileHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $profileHelper;
    }

    public function createResource()
    {
        $profileHelper = $this->profileHelper->persistResource();

        $playlist = new Playlist();
        $playlist->setProfile($profileHelper)->setName('string');

        return $playlist;
    }
}
