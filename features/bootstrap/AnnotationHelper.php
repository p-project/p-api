<?php

use AppBundle\Entity\Annotation;
use Doctrine\ORM\EntityManager;

class AnnotationHelper extends ResourceHelper
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

        $annotation = new Annotation();
        $annotation->setBegin(0)->setEnd(0)
            ->setAnnotationText('string')->setVideo($video);

        return $annotation;
    }
}
