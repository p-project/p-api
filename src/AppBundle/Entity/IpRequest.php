<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IpRequest
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 */
class IpRequest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $ip;

    public function __construct($ip)
    {
        $this->ip = $ip;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): IPRequest
    {
        $this->id = $id;

        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): IPRequest
    {
        $this->ip = $ip;

        return $this;
    }
}
