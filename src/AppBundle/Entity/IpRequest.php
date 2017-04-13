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
     * @var int
     *
     * @ORM\Column(name="accesses", type="integer")
     * @Assert\Type("integer")
     */
    private $accesses;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->dateRequest = new \DateTime();
        $this->accesses = 0;
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

    public function getDateRequest(): \DateTime
    {
        return $this->dateRequest;
    }

    public function countAccesses(): int
    {
        return $this->accesses;
    }

    public function recordAccess(): IpRequest
    {
        ++$this->accesses;

        return $this;
    }
}
