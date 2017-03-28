<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IpRequest
 * @package AppBundle\Entity
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IpRequestRepository")
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

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_request", type="datetime")
     * @Assert\NotBlank
     * @Assert\Type("datetime")
     */
    private $dateRequest;

    /**
     * @var
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $count;

    public function __construct($ip, $dateRequest, $count = 1)
    {
        $this->ip = $ip;
        $this->dateRequest = $dateRequest;
        $this->count = $count;
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

    public function getDateRequest(): \DateTime
    {
        return $this->dateRequest;
    }

    public function setDateRequest(\DateTime $dateRequest): IpRequest
    {
        $this->dateRequest = $dateRequest;

        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): IpRequest
    {
        $this->count = $count;

        return $this;
    }
}
