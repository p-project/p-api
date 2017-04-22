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
        $annotation->setBegin(new \DateTime('1879-03-14'))->setEnd(new \DateTime('1879-03-14'))
            ->setAnnotationText('string')->setVideo($video);

        return $annotation;
    }
}
