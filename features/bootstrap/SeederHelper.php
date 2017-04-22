<?php

use AppBundle\Entity\Seeder;
use Doctrine\ORM\EntityManager;

class SeederHelper extends ResourceHelper
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

        $seeder = new Seeder();
        $seeder->setPlatform('string')->setIp('127.0.0.1')->setAccount($account)->setVideo($video);

        return $seeder;
    }
}
