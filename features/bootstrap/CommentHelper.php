<?php

use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManager;

class CommentHelper extends ResourceHelper
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

        $comment = new Comment();

        $comment->setContent('string')->setDateComment(new DateTime('1879-03-14'))
            ->setVideo($video)->setAuthor($profile);

        return $comment;
    }
}
