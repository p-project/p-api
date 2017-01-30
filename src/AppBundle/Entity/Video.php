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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="videos", cascade={"persist"})
     */
    private $channel;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="video", cascade={"persist"})
     */
    private $comments;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forum", mappedBy="video", cascade={"persist"})
     */
    private $forums;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="video", cascade={"persist"})
     */
    private $views;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="video", cascade={"persist"})
     */
    private $reviews;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seed", mappedBy="video", cascade={"persist"})
     */
    private $seeds;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subtitles", mappedBy="video", cascade={"persist"})
     */
    private $subtitles;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
        $this->annotations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setDescription(string $description) : Video
    {
        $this->description = $description;


        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getAnnotations()
    {
        return $this->annotations;
    }

    public function setAnnotations($annotations) : Video
    {
        $this->annotations = $annotations;

        return $this;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel($channel) : Video
    {
        $this->channel = $channel;

        return $this;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments) : Video
    {
        $this->comments = $comments;

        return $this;
    }

    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums) : Video
    {
        $this->forums = $forums;

        return $this;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function setViews($views) : Video
    {
        $this->views = $views;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews) : Video
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getSeeds()
    {
        return $this->seeds;
    }

    public function setSeeds($seeds) : Video
    {
        $this->seeds = $seeds;

        return $this;
    }

    public function getSubtitles()
    {
        return $this->subtitles;
    }

    public function setSubtitles($subtitles) : Video
    {
        $this->subtitles = $subtitles;

        return $this;
    }
}
