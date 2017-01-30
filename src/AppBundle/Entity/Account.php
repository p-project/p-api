<?php


namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User's account.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Account
{
    /**
     * @var int The Id of the user
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The username of the user
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank
     */
    private $username;

    /**
     * @var string The email of the user
     *
     * @ORM\Column(type="string", unique=true)
     *
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var string The firstname of user
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     */
    private $firstName;

    /**
     * @var string The lastname of user
     *
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @var ArrayCollection The list of the channels
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Channel", mappedBy="account", cascade={"persist"})
     */
    private $channels;

    /**
     * @var ArrayCollection The list of views
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="account", cascade={"persist"})
     */
    private $views;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="commentedBy", cascade={"persist"})
     */
    private $comments;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Forum", mappedBy="createdBy", cascade={"persist"})
     */
    private $forums;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Network", inversedBy="peoples", cascade={"persist"})
     */
    private $networks;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="account", cascade={"persist"})
     */
    private $playlists;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Reply", mappedBy="repliedBy", cascade={"persist"})
     */
    private $replies;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="reviewedBy", cascade={"persist"})
     */
    private $reviews;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\SustainabilityOffer", mappedBy="account", cascade={"persist"})
     */
    private $sustainabilityOffers;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seeder", mappedBy="account", cascade={"persist"})
     */
    private $seeders;

    public function getViews()
    {
        return $this->views;
    }

    public function setViews($views)
    {
        $this->views = $views;
    }

    public function getChannels()
    {
        return $this->channels;
    }

    public function setChannels($channels)
    {
        $this->channels = $channels;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername() : string
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstName() : string
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName() : string
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments(ArrayCollection $comments) : Account
    {
        $this->comments = $comments;

        return $this;
    }

    public function getForums()
    {
        return $this->forums;
    }

    public function setForums($forums) : Account
    {
        $this->forums = $forums;

        return $this;
    }

    public function getNetworks()
    {
        return $this->networks;
    }

    public function setNetworks($networks) : Account
    {
        $this->networks = $networks;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylists($playlists) : Account
    {
        $this->playlists = $playlists;

        return $this;
    }

    public function getReplies()
    {
        return $this->replies;
    }

    public function setReplies($replies) : Account
    {
        $this->replies = $replies;

        return $this;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews) : Account
    {
        $this->reviews = $reviews;

        return $this;
    }

    public function getSustainabilityOffers()
    {
        return $this->sustainabilityOffers;
    }

    public function setSustainabilityOffers($sustainabilityOffers) : Account
    {
        $this->sustainabilityOffers = $sustainabilityOffers;

        return $this;
    }

    public function getSeeders()
    {
        return $this->seeders;
    }

    public function setSeeders($seeders) : Account
    {
        $this->seeders = $seeders;

        return $this;
    }
}
