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
class Annotation
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
     * @var \DateTime
     *
     * @ORM\Column(name="begin", type="datetime")
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="annotation_text", type="string", length=255)
     */
    private $annotationText;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="video", cascade={"persist"})
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     */
    private $video;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Annotation
     */
    public function setId(int $id): Annotation
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBegin(): \DateTime
    {
        return $this->begin;
    }

    /**
     * @param \DateTime $begin
     * @return Annotation
     */
    public function setBegin(\DateTime $begin): Annotation
    {
        $this->begin = $begin;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEnd(): \DateTime
    {
        return $this->end;
    }

    /**
     * @param \DateTime $end
     * @return Annotation
     */
    public function setEnd(\DateTime $end): Annotation
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string
     */
    public function getAnnotationText(): string
    {
        return $this->annotationText;
    }

    /**
     * @param string $annotationText
     * @return Annotation
     */
    public function setAnnotationText(string $annotationText)
    {
        $this->annotationText = $annotationText;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideo(): Video
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Annotation
     */
    public function setVideo($video): Annotation
    {
        $this->video = $video;
        return $this;
    }



}