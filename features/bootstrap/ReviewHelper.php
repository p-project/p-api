<?php

use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManager;

class ReviewHelper extends ResourceHelper
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
        $profile = $this->profileHelper->persistResource();
        $video = $this->videoHelper->persistResource();

        $review = new Review();
        $review->setVideo($video)->setAuthor($profile)->setContent('string')->setDateReview(new \DateTime('1879-03-14T00:00:00+00:09'));

        return $review;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Profile') {
            return parent::createRelationWith($resource, 'Author', $resource2);
        }

        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Profile') {
            return parent::relationExists($resource, 'Author', $resource2);
        }

        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
