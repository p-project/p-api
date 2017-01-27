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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The username of the user
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     */
    private $username;


    /**
     * @var string The email of the user
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var string The firstname of user
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $firstName;

    /**
     * @var string The lastname of user
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $lastName;

    /**
     * @var array The roles of the user
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @var ArrayCollection The list of the channels
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Channel", mappedBy="account", cascade={"persist"})
     */
    private $channels;

    /**
     * @var ArrayCollection The list of views
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\View", mappedBy="user", cascade={"persist"})
     */
    private $views;

    /**
     * @return ArrayCollection
     */
    public function getViews() : ArrayCollection
    {
        return $this->views;
    }

    /**
     * @param ArrayCollection $views
     */
    public function setViews(ArrayCollection $views)
    {
        $this->views = $views;
    }


    /**
     * @return ArrayCollection
     */
    public function getChannels() : ArrayCollection
    {
        return $this->channels;
    }

    /**
     * @param ArrayCollection $channels
     */
    public function setChannels($channels)
    {
        $this->channels = $channels;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstName() : string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName() : string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return array
     */
    public function getRoles() : array
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
}
