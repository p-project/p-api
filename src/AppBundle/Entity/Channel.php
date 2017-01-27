<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annotation
 *
 * @ORM\Entity
 * @ApiResource
 */
class Channel
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
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="array")
     */
    private $tags;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="video", cascade={"persist"})
     */
    private $video;

    /**
     * @var Network
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Network", mappedBy="network", cascade={"persist"})
     */
    private $network;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Channel
     */
    public function setId(int $id): Channel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Channel
     */
    public function setName(string $name): Channel
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return Channel
     */
    public function setTags(array $tags): Channel
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return Video
     */
    public function getVideo(): Video
    {
        return $this->video;
    }

    /**
     * @param Video $video
     * @return Channel
     */
    public function setVideo(Video $video): Channel
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return Network
     */
    public function getNetwork(): Network
    {
        return $this->network;
    }

    /**
     * @param Network $network
     * @return Channel
     */
    public function setNetwork(Network $network): Channel
    {
        $this->network = $network;
        return $this;
    }




}