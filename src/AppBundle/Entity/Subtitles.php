<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Subtitles
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
     * @var \DateTime Time when the subtitle should be displayed
     *
     * @ORM\Column(type="datetime", name="begin_time")
     * @Assert\Type("datetime")
     */
    private $begin;

    /**
     * @var \DateTime Time when the subtitle should be hidden
     *
     * @ORM\Column(type="datetime", name="end_time")
     * @Assert\NotBlank
     * @Assert\Type("datetime")
     */
    private $end;

    /**
     * @var string The path of the Subtitle file
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $path;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="subtitles", cascade={"persist"})
     */
    private $video;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getBegin(): \DateTime
    {
        return $this->begin;
    }

    public function setBegin(\DateTime $begin)
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    public function setEnd(\DateTime $end)
    {
        $this->end = $end;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo(Video $video): Subtitles
    {
        $this->video = $video;

        return $this;
    }
}
