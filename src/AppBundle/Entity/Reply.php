<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reply
 *
 * @ORM\Entity
 * @ApiResource
 */
class Reply
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
     * @ORM\Column(name="contents", type="string")
     * @Assert\NotBlank
     *
     */
    private $content;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Review", inversedBy="replies")
     */
    private $review;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="replies")
     */
    private $repliedBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_comment", type="datetime")
     * @Assert\NotBlank
     */
    private $dateReply;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Reply
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Reply
    {
        $this->content = $content;

        return $this;
    }

    public function getReview(): Video
    {
        return $this->review;
    }

    public function setReview(Video $review): Reply
    {
        $this->review = $review;

        return $this;
    }

    public function getCommentedBy(): Account
    {
        return $this->commentedBy;
    }

    public function setCommentedBy($repliedBy): Reply
    {
        $this->repliedBy = $repliedBy;

        return $this;
    }

    public function getDateReply(): \DateTime
    {
        return $this->dateReply;
    }

    public function setDateReply(\DateTime $dateReply): Reply
    {
        $this->dateReply = $dateReply;

        return $this;
    }
}
