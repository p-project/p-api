<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Seeder
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
     * @ORM\Column(name="platform", type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $platform;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $ip;

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="seeders", cascade={"persist"})
     */
    private $account;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="seeders", cascade={"persist"})
     */
    private $video;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Seeder
    {
        $this->id = $id;

        return $this;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): Seeder
    {
        $this->platform = $platform;

        return $this;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): Seeder
    {
        $this->account = $account;

        return $this;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): Seeder
    {
        $this->ip = $ip;

        return $this;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo($video): Seeder
    {
        $this->video = $video;

        return $this;
    }
}
