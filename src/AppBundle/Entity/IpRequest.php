<?php

namespace AppBundle\Entity;

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

    /**
     * @var datetime
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

    public function __construct($ip, $dateRequest, $count)
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

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip): IPRequest
    {
        $this->ip = $ip;

        return $this;
    }

    public function getDateRequest()
    {
        return $this->dateRequest;
    }

    public function setDateRequest($dateRequest): IpRequest
    {
        $this->dateRequest = $dateRequest;

        return $this;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setCount($count): IpRequest
    {
        $this->count = $count;

        return $this;
    }

}
