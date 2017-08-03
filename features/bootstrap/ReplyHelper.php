<?php

use AppBundle\Entity\Reply;
use Doctrine\ORM\EntityManager;

class ReplyHelper extends ResourceHelper
{
    /**
     * @var ProfileHelper
     */
    private $profileHelper;

    /**
     * @var ReviewHelper
     */
    private $reviewHelper;

    public function __construct(EntityManager $em, ProfileHelper $profileHelper, ReviewHelper $reviewHelper)
    {
        parent::__construct($em);
        $this->profileHelper = $profileHelper;
        $this->reviewHelper = $reviewHelper;
    }

    public function createResource()
    {
        $profile = $this->profileHelper->persistResource();
        $review = $this->reviewHelper->persistResource();

        $reply = new Reply();
        $reply->setReview($review)->setAuthor($profile)->setContent('string')->setDateReply(new \DateTime());

        return $reply;
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
