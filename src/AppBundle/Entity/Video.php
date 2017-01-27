<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Entity
 * @ApiResource
 */
class Video
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Annotation", mappedBy="video", cascade={"persist"})
     */
    private $annotations;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Channel", mappedBy="video", cascade={"persist"})
     */
    private $channels;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="video", cascade={"persist"})
     */
    private $comments;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
        $this->annotations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription(string $description) : Video
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAnnotations()
    {
        return $this->annotations;
    }

    public function setAnnotations($annotations): Video
    {
        $this->annotations = $annotations;
        return $this;
    }

    public function getChannels()
    {
        return $this->channels;
    }

    public function setChannels($channels): Video
    {
        $this->channels = $channels;
        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments): Video
    {
        $this->comments = $comments;
        return $this;
    }

}

