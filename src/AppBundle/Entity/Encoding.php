<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Encoding
 *
 * @ORM\Entity
 * @ApiResource
 */
class Encoding
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
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     * @Assert\NotBlank
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     * @Assert\NotBlank
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string")
     * @Assert\NotBlank
     */
    private $format;


    /**
     * @var Video
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Video")
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     */
    private $video;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Encoding
    {
        $this->id = $id;

        return $this;
    }

    public function getHeight() : int
    {
        return $this->height;
    }

    public function setHeight(int $height) : Encoding
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth() : int
    {
        return $this->width;
    }

    public function setWidth(int $width) : Encoding
    {
        $this->width = $width;

        return $this;
    }

    public function getFormat() : string
    {
        return $this->format;
    }

    public function setFormat(string $format) : Encoding
    {
        $this->format = $format;

        return $this;
    }

    public function getVideo() : Video
    {
        return $this->video;
    }

    public function setVideo($video) : Encoding
    {
        $this->video = $video;

        return $this;
    }
}
