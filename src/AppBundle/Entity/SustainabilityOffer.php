<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * SustainabilityOffer
 *
 * @ORM\Entity
 * @ApiResource
 */
class SustainabilityOffer
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="sustainabilityOffers", cascade={"persist"})
     */
    private $account;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="sustainabilityOffers", cascade={"persist"})
     */
    private $channel;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): SustainabilityOffer
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): SustainabilityOffer
    {
        $this->name = $name;
        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): SustainabilityOffer
    {
        $this->duration = $duration;
        return $this;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount($account): SustainabilityOffer
    {
        $this->account = $account;
        return $this;
    }

    public function getChannel(): Channel
    {
        return $this->channel;
    }

    public function setChannel($channel): SustainabilityOffer
    {
        $this->channel = $channel;
        return $this;
    }
}
