<?php

use AppBundle\Entity\Reply;
use Doctrine\ORM\EntityManager;

class ReplyHelper extends ResourceHelper
{
    /**
     * @var AccountHelper
     */
    private $accountHelper;

    /**
     * @var ReviewHelper
     */
    private $reviewHelper;

    public function __construct(EntityManager $em, AccountHelper $accountHelper, ReviewHelper $reviewHelper)
    {
        parent::__construct($em);
        $this->accountHelper = $accountHelper;
        $this->reviewHelper = $reviewHelper;
    }

    public function createResource()
    {
        $account = $this->accountHelper->persistResource();
        $review = $this->reviewHelper->persistResource();

        $reply = new Reply();
        $reply->setReview($review)->setAuthor($account)->setContent('string')->setDateReply(new \DateTime());

        return $reply;
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
