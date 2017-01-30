<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Playlist
 *
 * @ORM\Entity
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
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var Channel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Channel", inversedBy="playlists", cascade={"persist"})
     */
    private $channel;

    /**
     * @var Network
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Network", inversedBy="playlists", cascade={"persist"})
     */
    private $network;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="playlists", cascade={"persist"})
     */
    private $account;

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

    public function getChannel(): Channel
    {
        return $this->channel;
    }

    public function setChannel(Channel $channel): Playlist
    {
        $this->channel = $channel;

        return $this;
    }

    public function getNetwork(): Network
    {
        return $this->network;
    }

    public function setNetwork(Network $network): Playlist
    {
        $this->network = $network;

        return $this;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setCreatedBy(Account $account): Playlist
    {
        $this->account = $account;

        return $this;
    }
}
