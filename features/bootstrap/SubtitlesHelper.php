<?php

use AppBundle\Entity\Subtitles;
use Doctrine\ORM\EntityManager;

class SubtitlesHelper extends ResourceHelper
{
    /**
     * @var VideoHelper
     */
    private $videoHelper;

    public function __construct(EntityManager $em, VideoHelper $videoHelper)
    {
        parent::__construct($em);
        $this->videoHelper = $videoHelper;
    }

    public function createResource()
    {
        $video = $this->videoHelper->persistResource();

        $subtitles = new Subtitles();
        $subtitles->setBegin(new \DateTime('1879-03-14'))->setEnd(new \DateTime('1879-03-14'))
            ->setPath('string')->setVideo($video);

        return $subtitles;
    }
}
