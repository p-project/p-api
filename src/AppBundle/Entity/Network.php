<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Network.
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
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Profile", inversedBy="networks", cascade={"persist"})
     */
    private $peoples;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Channel", inversedBy="networks", cascade={"persist"})
     */
    private $channels;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Playlist", mappedBy="network", cascade={"persist"})
     */
    private $playlists;

    public function __construct()
    {
        $this->peoples = new ArrayCollection();
        $this->channels = new ArrayCollection();
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

    public function getChannels()
    {
        return $this->channels;
    }

    public function setChannels($channels): Network
    {
        $this->channels = $channels;

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

    public function setPlaylists($playlists): Network
    {
        $this->playlists = $playlists;

        return $this;
    }
}
