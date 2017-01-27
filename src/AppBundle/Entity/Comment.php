<?php

namespace AppBundle\Entity;

/**
 * Comment
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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_comment", type="datetime")
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
}