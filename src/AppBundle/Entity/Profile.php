<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User's account.
 *
 * @ORM\Entity
 * @ApiResource(attributes={"filters" = {"account.search"}, "normalization_context" = {"groups" = {"account"}}})
 */
class Profile
{
    /**
     * @var int The Id of the user
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"account"})
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string The username of the user
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $username;

    /**
     * @var ArrayCollection The list of the channels
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Channel", mappedBy="profile", cascade={"persist"})
     * @Groups({"account"})
     */
    private $channels;

    /**
     * @var ArrayCollection The list of views
     *
     * @Groups({"account"})
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="profile", cascade={"persist"})
     */
    private $views;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forum", mappedBy="createdBy", cascade={"persist"})
     * @Groups({"account"})
     */
    private $forums;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Network", mappedBy="peoples", cascade={"persist"})
     * @Groups({"account"})
     * @ORM\JoinTable(name="accounts_networks")
     */
    private $networks;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="profile", cascade={"persist"})
     * @Groups({"account"})
     */
    private $playlists;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reply", mappedBy="author", cascade={"persist"})
     * @Groups({"account"})
     */
    private $replies;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="author", cascade={"persist"})
     * @Groups({"account"})
     */
    private $reviews;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SustainabilityOffer", mappedBy="profile", cascade={"persist"})
     * @Groups({"account"})
     */
    private $sustainabilityOffers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seeder", mappedBy="profile", cascade={"persist"})
     * @Groups({"account"})
     */
    private $seeders;

    /**
     * @var string The first name of user
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $firstName;

    /**
     * @var string The last name of user
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $lastName;

    /**
     * @var Account
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Account", mappedBy="profile", cascade={"persist"})
     */
    private $account;

    public function __construct()
    {
        $this->channels = new ArrayCollection();
        $this->views = new ArrayCollection();
        $this->forums = new ArrayCollection();
        $this->networks = new ArrayCollection();
        $this->playlists = new ArrayCollection();
        $this->replies = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->sustainabilityOffers = new ArrayCollection();
        $this->seeders = new ArrayCollection();
    }

    public function getViews()
    {
        return $this->views;
    }

    public function setViews($views): Profile
    {
        $this->views = $views;

        return this;
    }

    public function getChannels()
    {
        return $this->channels;
    }

    public function setChannels($channels): Profile
    {
        $this->channels = $channels;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): Profile
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): Profile
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): Profile
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): Profile
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums): Profile
    {
        $this->forums = $forums;

        return $this;
    }

    public function getNetworks()
    {
        return $this->networks;
    }

    public function setNetworks($networks): Profile
    {
        $this->networks = $networks;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylist($playlists): Profile
    {
        $this->playlists = $playlists;

        return $this;
    }

    public function getReplies()
    {
        return $this->replies;
    }

    public function setReplies($replies): Profile
    {
        $this->replies = $replies;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews): Profile
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getSustainabilityOffers()
    {
        return $this->sustainabilityOffers;
    }

    public function setSustainabilityOffers($sustainabilityOffers): Profile
    {
        $this->sustainabilityOffers = $sustainabilityOffers;

        return $this;
    }

    public function getSeeders()
    {
        return $this->seeders;
    }

    public function setSeeders($seeders): Profile
    {
        $this->seeders = $seeders;

        return $this;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): Profile
    {
        $this->account = $account;

        return $this;
    }

}