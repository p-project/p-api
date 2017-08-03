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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 * @ApiResource(attributes={"filters" = {"account.search"}, "normalization_context" = {"groups" = {"account"}}})
 */
class Account implements UserInterface
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
     * @var Profile
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Profile", inversedBy="account", cascade={"persist"})
     */
    private $profile;

    public function getUsername(): string
    {
        return $this->profile->getUsername();
    }

    public function setUsername($username)
    {
        $this->profile->setUsername($username);

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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Account
    {
        $this->id = $id;

        return $this;
    }

    public function getProfile(): Account
    {
        return $this->profile;
    }

    public function setProfile(Account $profile): Account
    {
        $this->profile = $profile;

        return $this;
    }
}
