<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reply.
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
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="contents", type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $content;

    /**
     * @var Review
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Review", inversedBy="replies")
     */
    private $review;

    /**
     * @var UserProfile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserProfile", inversedBy="replies")
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_comment", type="datetime")
     * @Assert\NotBlank
     * @Assert\Type("datetime")
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

    public function getReview(): Review
    {
        return $this->review;
    }

    public function setReview(Review $review): Reply
    {
        $this->review = $review;

        return $this;
    }

    public function getAuthor(): UserProfile
    {
        return $this->author;
    }

    public function setAuthor(UserProfile $author): Reply
    {
        $this->author = $author;

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
