<?php

use AppBundle\Entity\View;
use Doctrine\ORM\EntityManager;

class ViewHelper extends ResourceHelper
{
    /**
     * @var AccountHelper
     */
    private $accountHelper;

    /**
     * @var VideoHelper
     */
    private $videoHelper;

    public function __construct(EntityManager $em, AccountHelper $accountHelper, VideoHelper $videoHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $accountHelper;
        $this->videoHelper = $videoHelper;
    }

    public function createResource()
    {
        $account = $this->accountHelper->persistResource();
        $video = $this->videoHelper->persistResource();

        $view = new View();
        $view->setVideo($video)->setAccount($account);

        return $view;
    }
}
