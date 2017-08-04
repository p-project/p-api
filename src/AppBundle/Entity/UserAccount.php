<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User's account.
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserAccountRepository")
 * @ApiResource
 */
class UserAccount implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"account"})
     * @Assert\Type("integer")
     */
    private $id;

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
     * @var string The salt of  the user
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $salt;

    /**
     * @var string password of  the user
     *
     * @ORM\Column(type="string")
     *
     * @Groups({"account"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $password;

    /**
     * @var UserProfile
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\UserProfile", mappedBy="userAccount", cascade={"persist"})
     */
    private $userProfile;

    public function getUsername(): string
    {
        return $this->email;
    }

    public function setUsername(string $username): UserAccount
    {
        $this->email = $username;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): UserAccount
    {
        $this->email = $email;

        return $this;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): UserAccount
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

    public function setPassword(string $password): UserAccount
    {
        $this->password = $password;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): UserAccount
    {
        $this->id = $id;

        return $this;
    }

    public function getUserProfile(): ?UserProfile
    {
        return $this->userProfile;
    }

    public function setUserProfile(UserProfile $userProfile): UserAccount
    {
        $this->userProfile = $userProfile;

        return $this;
    }
}
