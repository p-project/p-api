<?php

use AppBundle\Entity\Forum;
use Doctrine\ORM\EntityManager;

class ForumHelper extends ResourceHelper
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

        $forum = new Forum();
        $forum->setVideo($video)->setCreatedBy($account)->setName('string');

        return $forum;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Account') {
            return parent::createRelationWith($resource, 'CreatedBy', $resource2);
        }

        return parent::createRelationWith($resource, $nameResource2, $resource2);
    }

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        if ($nameResource2 == 'Account') {
            return parent::relationExists($resource, 'CreatedBy', $resource2);
        }

        return parent::relationExists($resource, $nameResource2, $resource2);
    }
}
