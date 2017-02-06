<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Video
 *
 * @ORM\Entity
 * @ApiResource(attributes={"normalization_context"={"groups"={"video"}},
 *                          "denormalization_context"={"groups"={"video"}}})
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"video"})
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     * @Groups({"video"})
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("datetime")
     */
    private $uploadDate;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Annotation", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $annotations;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="videos", cascade={"persist"})
     * @Groups({"video"})
     */
    private $channel;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $comments;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forum", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $forums;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $views;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $reviews;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Subtitles", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $subtitles;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", inversedBy="videos", cascade={"persist"})
     * @Groups({"video"})
     */
    private $categories;


    /**
     * @var Metadata
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Metadata", mappedBy="video", cascade={"persist"})
     * @Groups({"video"})
     */
    private $metadata;

    public function __construct()
    {
        $this->annotations = new ArrayCollection();
        $this->uploadDate = new \DateTime('now');
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->forums = new ArrayCollection();
        $this->views = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->subtitles = new ArrayCollection();
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setDescription(string $description): Video
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setUploadDate(\DateTime $uploadDate): Video
    {
        $this->uploadDate = $uploadDate;

        return $this;
    }

    public function getUploadDate(): \DateTime
    {
        return $this->uploadDate;
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

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel($channel): Video
    {
        $this->channel = $channel;

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

    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums): Video
    {
        $this->forums = $forums;

        return $this;
    }

    public function getViews()
    {
        return $this->views;
    }

    public function setViews($views): Video
    {
        $this->views = $views;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews): Video
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getSubtitles()
    {
        return $this->subtitles;
    }

    public function setSubtitles($subtitles): Video
    {
        $this->subtitles = $subtitles;

        return $this;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function setCategories($categories): Video
    {
        $this->categories = $categories;

        return $this;
    }

    public function getMetadata()
    {
        return $this->metadata;
    }

    public function setMetadata($metadata): Video
    {
        $this->metadata = $metadata;

        return $this;
    }
}
