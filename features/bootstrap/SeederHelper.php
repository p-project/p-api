<?php

use AppBundle\Entity\Seeder;
use Doctrine\ORM\EntityManager;

class SeederHelper extends ResourceHelper
{
    /**
     * @var UserProfileHelper
     */
    private $profileHelper;

    /**
     * @var VideoHelper
     */
    private $videoHelper;

    public function __construct(EntityManager $em, UserProfileHelper $profileHelper, VideoHelper $videoHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
        $this->videoHelper = $videoHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper->persistResource();
        $video = $this->videoHelper->persistResource();

        $seeder = new Seeder();
        $seeder->setPlatform('string')->setIp('127.0.0.1')->setUserProfile($profile)->setVideo($video);

        return $seeder;
    }
}
