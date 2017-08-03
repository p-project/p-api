<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use AppBundle\Validator\Constraints as AcmeAssert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Playlist.
 *
 * @ORM\Entity
 * @AcmeAssert\PlaylistClass
 * @ApiResource
 */
class Playlist
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $name;

    /**
     * @var Channel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="playlists", cascade={"persist"})
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id", nullable=true)
     */
    private $channel;

    /**
     * @var Network
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Network", inversedBy="playlists", cascade={"persist"})
     * @ORM\JoinColumn(name="network_id", referencedColumnName="id", nullable=true)
     */
    private $network;

    /**
     * @var Profile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profile", inversedBy="playlists", cascade={"persist"})
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id", nullable=true)
     */
    private $profile;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Playlist
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Playlist
    {
        $this->name = $name;

        return $this;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setChannel(Channel $channel): Playlist
    {
        $this->channel = $channel;

        return $this;
    }

    public function getNetwork()
    {
        return $this->network;
    }

    public function setNetwork(Network $network): Playlist
    {
        $this->network = $network;

        return $this;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): Playlist
    {
        $this->profile = $profile;

        return $this;
    }
}
