<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Video's annotation.
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
     * @ORM\Column(name="begin_time", type="datetime")
     * @Assert\NotBlank
     */
    private $begin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime")
     * @Assert\NotBlank
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="annotations", cascade={"persist"})
     * @ORM\JoinColumn(name="video_id", referencedColumnName="id")
     */
    private $video;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Annotation
    {
        $this->id = $id;

        return $this;
    }

    public function getBegin() : \DateTime
    {
        return $this->begin;
    }

    public function setBegin(\DateTime $begin) : Annotation
    {
        $this->begin = $begin;

        return $this;
    }

    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    public function setEnd(\DateTime $end) : Annotation
    {
        $this->end = $end;

        return $this;
    }

    public function getAnnotationText() : string
    {
        return $this->annotationText;
    }

    public function setAnnotationText(string $annotationText)
    {
        $this->annotationText = $annotationText;

        return $this;
    }

    public function getVideo() : Video
    {
        return $this->video;
    }

    public function setVideo($video) : Annotation
    {
        $this->video = $video;

        return $this;
    }
}
