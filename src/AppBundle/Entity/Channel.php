<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="name", type="string", unique=true)
     * @Assert\NotBlank
     *
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="array")
     */
    private $tags;

    /**
     * @var Account The owner's account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="channels", cascade={"persist"})
     */
    private $account;

    /**
     * @var Video
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Video", mappedBy="channel", cascade={"persist"})
     */
    private $videos;

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

    public function __construct()
    {
        $this->tags = [];
        $this->videos = new ArrayCollection();
        $this->networks = new ArrayCollection();
        $this->playlists =  new ArrayCollection();
        $this->sustainabilityOffers = new ArrayCollection();
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Channel
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Channel
    {
        $this->name = $name;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): Channel
    {
        $this->tags = $tags;

        return $this;
    }

    public function getVideos()
    {
        return $this->videos;
    }

    public function setVideos($videos): Channel
    {
        $this->videos = $videos;

        return $this;
    }

    public function getNetworks()
    {
        return $this->networks;
    }

    public function setNetworks($networks): Channel
    {
        $this->networks = $networks;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylists($playlists): Channel
    {
        $this->playlists = $playlists;

        return $this;
    }

    public function getSustainabilityOffers()
    {
        return $this->sustainabilityOffers;
    }

    public function setSustainabilityOffers($sustainabilityOffers): Channel
    {
        $this->sustainabilityOffers = $sustainabilityOffers;
     
        return $this;
    }
}
