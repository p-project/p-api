<?php

use AppBundle\Entity\Review;
use Doctrine\ORM\EntityManager;

class ReviewHelper extends ResourceHelper
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


        $review = new Review();
        $review->setVideo($video)->setAuthor($account)->setContent('string')->setDateReview(new \DateTime());


        return $review;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Account') {
            return parent::createRelationWith($resource, 'Author', $resource2);
        }
        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Account') {
            return parent::relationExists($resource, 'Author', $resource2);
        }
        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
