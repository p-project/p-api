<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Network
 *
 * @ORM\Entity
 * @ApiResource
 */
class Network
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank
     */
    private $name;


    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Account", inversedBy="networks", cascade={"persist"})
     */
    private $peoples;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="networks", cascade={"persist"})
     */
    private $channel;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="network", cascade={"persist"})
     */
    private $playlists;

    public function __construct()
    {
        $this->peoples = new ArrayCollection();
        $this->channel = new ArrayCollection();
        $this->playlists = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Network
    {
        $this->id = $id;

        return $this;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Network
    {
        $this->name = $name;

        return $this;
    }

    public function getPeoples()
    {
        return $this->peoples;
    }

    public function setPeoples($peoples): Network
    {
        $this->peoples = $peoples;

        return $this;
    }

    public function getPlaylists()
    {
        return $this->playlists;
    }

    public function setPlaylists(ArrayCollection $playlists): Network
    {
        $this->playlists = $playlists;

        return $this;
    }
}
