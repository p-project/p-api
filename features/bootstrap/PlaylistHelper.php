<?php

use AppBundle\Entity\Playlist;
use Doctrine\ORM\EntityManager;

class PlaylistHelper extends ResourceHelper
{
    /**
     * @var ChannelHelper
     */
    private $profileHelper;

    public function __construct(EntityManager $em, UserProfileHelper $profileHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper->persistResource();

        $playlist = new Playlist();
        $playlist->setUserProfile($profile)->setName('string');

        return $playlist;
    }
}
