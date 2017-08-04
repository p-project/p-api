<?php

use AppBundle\Entity\View;
use Doctrine\ORM\EntityManager;

class ViewHelper extends ResourceHelper
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

        $view = new View();
        $view->setVideo($video)->setUserProfile($profile);

        return $view;
    }
}
