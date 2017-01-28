<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * User's channel.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Channel
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
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="array")
     */
    private $tags;

    /**
     * @var int The ID of owner
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="channels", cascade={"persist"})
     */
    private $account;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="channels", cascade={"persist"})
     */
    private $video;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Network", mappedBy="channel", cascade={"persist"})
     */
    private $networks;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="channel", cascade={"persist"})
     */
    private $playlists;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SustainabilityOffer", mappedBy="channel", cascade={"persist"})
     */
    private $sustainabilityOffers;

    public function getAccount() : int
    {
        return $this->account;
    }

    public function setAccount(int $account)
    {
        $this->account = $account;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Channel
    {
        $this->id = $id;

        return $this;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : Channel
    {
        $this->name = $name;

        return $this;
    }

    public function getTags() : array
    {
        return $this->tags;
    }

    public function setTags(array $tags) : Channel
    {
        $this->tags = $tags;

        return $this;
    }

    public function getVideo() : Video
    {
        return $this->video;
    }

    public function setVideo(Video $video) : Channel
    {
        $this->video = $video;

        return $this;
    }

    public function getNetworks() : ArrayCollection
    {
        return $this->networks;
    }

    public function setNetworks(ArrayCollection $networks) : Channel
    {
        $this->networks = $networks;
        return $this;
    }

    public function getPlaylists(): ArrayCollection
    {
        return $this->playlists;
    }

    public function setPlaylists(ArrayCollection $playlists): Channel
    {
        $this->playlists = $playlists;
        return $this;
    }
}
