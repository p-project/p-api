<?php

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;

class CommentHelper extends ResourceHelper
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

        $comment = new Comment();

        $comment->setContent('string')->setDateComment(new DateTime('1879-03-14'))
            ->setVideo($video)->setAuthor($account);

        return $comment;
    }
}
