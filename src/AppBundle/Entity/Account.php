<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User's account.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 * @ApiResource(attributes={"filters" = {"account.search"}, "normalization_context" = {"groups" = {"account"}}})
 */
class Account implements UserInterface
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
     * @var string The email of the user
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

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
     * @var ArrayCollection The list of the channels
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Channel", mappedBy="account", cascade={"persist"})
     * @Groups({"account"})
     */
    private $channels;

    /**
     * @var ArrayCollection The list of views
     *
     * @Groups({"account"})
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="account", cascade={"persist"})
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="account", cascade={"persist"})
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SustainabilityOffer", mappedBy="account", cascade={"persist"})
     * @Groups({"account"})
     */
    private $sustainabilityOffers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seeder", mappedBy="account", cascade={"persist"})
     * @Groups({"account"})
     */
    private $seeders;

    /**
     * @var string The salt of  the user
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $salt;

    /**
     * @var string password of  the user
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $password;

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

    public function setViews($views)
    {
        $this->views = $views;

        return this;
    }

    public function getChannels()
    {
        return $this->channels;
    }

    public function setChannels($channels)
    {
        $this->channels = $channels;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums): Account
    {
        $this->forums = $forums;

        return $this;
    }

    public function getNetworks()
    {
        return $this->networks;
    }

    public function setNetworks($networks): Account
    {
        $this->networks = $networks;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylist($playlists): Account
    {
        $this->playlists = $playlists;

        return $this;
    }

    public function getReplies()
    {
        return $this->replies;
    }

    public function setReplies($replies): Account
    {
        $this->replies = $replies;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews): Account
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getSustainabilityOffers()
    {
        return $this->sustainabilityOffers;
    }

    public function setSustainabilityOffers($sustainabilityOffers): Account
    {
        $this->sustainabilityOffers = $sustainabilityOffers;

        return $this;
    }

    public function getSeeders()
    {
        return $this->seeders;
    }

    public function setSeeders($seeders): Account
    {
        $this->seeders = $seeders;

        return $this;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): Account
    {
        $this->salt = $salt;

        return $this;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): Account
    {
        $this->password = $password;

        return $this;
    }
}
