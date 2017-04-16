<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Comment
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
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $content;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="comments")
     */
    private $video;

    /**
     * @var Account Author of the comment
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account")
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_comment", type="datetime")
     * @Assert\NotBlank
     * @Assert\Type("datetime")
     */
    private $dateComment;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Comment
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Comment
    {
        $this->content = $content;

        return $this;
    }

    public function getDateComment(): \DateTime
    {
        return $this->dateComment;
    }

    public function setDateComment(\DateTime $dateComment): Comment
    {
        $this->dateComment = $dateComment;

        return $this;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo(Video $video): Comment
    {
        $this->video = $video;

        return $this;
    }

    public function getAuthor(): Account
    {
        return $this->author;
    }

    public function setAuthor(Account $author): Comment
    {
        $this->author = $author;

        return $this;
    }
}
