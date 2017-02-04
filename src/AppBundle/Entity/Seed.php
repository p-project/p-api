<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Seed
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
     * @ORM\Column(name="url", type="string")
     * @Assert\NotBlank
     */
    private $url;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Video")
     */
    private $video;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Seeder", inversedBy="seeds", cascade={"persist"})
     */
    private $seeder;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Seed
    {
        $this->id = $id;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Seed
    {
        $this->url = $url;

        return $this;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function setVideo($video): Seed
    {
        $this->video = $video;

        return $this;
    }

    public function getSeeder()
    {
        return $this->seeder;
    }

    public function setSeeder($seeder): Seed
    {
        $this->seeder = $seeder;

        return $this;
    }
}
