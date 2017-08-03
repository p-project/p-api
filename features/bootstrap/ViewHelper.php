<?php

use AppBundle\Entity\View;
use Doctrine\ORM\EntityManager;

class ViewHelper extends ResourceHelper
{
    /**
     * @var ProfileHelper
     */
    private $profileHelper;

    /**
     * @var VideoHelper
     */
    private $videoHelper;

    public function __construct(EntityManager $em, ProfileHelper $profileHelper, VideoHelper $videoHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
        $this->videoHelper = $videoHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper>persistResource();
        $video = $this->videoHelper->persistResource();

        $view = new View();
        $view->setVideo($video)->setProfile($profile);

        return $view;
    }
}
