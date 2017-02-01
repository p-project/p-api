<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Review
 *
 * @ORM\Entity
 * @ApiResource
 */
class Review
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="reviews")
     */
    private $video;


    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="reviews")
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_comment", type="datetime")
     * @Assert\NotBlank
     */
    private $dateReview;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reply", mappedBy="review", cascade={"persist"})
     */
    private $replies;

    public function __construct()
    {
        $this->replies = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Review
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Review
    {
        $this->content = $content;

        return $this;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo(Video $video): Review
    {
        $this->video = $video;

        return $this;
    }

    public function getDateReview(): \DateTime
    {
        return $this->dateReview;
    }

    public function setDateReview(\DateTime $dateReview): Review
    {
        $this->dateReview = $dateReview;

        return $this;
    }

    public function getReplies()
    {
        return $this->replies;
    }

    public function setReplies($replies): Review
    {
        $this->replies = $replies;

        return $this;
    }

    public function getAuthor(): Account
    {
        return $this->author;
    }

    public function setAuthor(Account $author): Review
    {
        $this->author = $author;

        return $this;
    }
}
