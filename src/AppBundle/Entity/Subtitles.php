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
     */
    private $id;

    /**
     * @var \DateTime Time when the subtitle should be displayed
     *
     * @ORM\Column(type="datetime")
     */
    private $begin;

    /**
     * @var \DateTime Time when the subtitle should be hidden
     *
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @var string The path of the Subtitle file
     *
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getBegin() : \DateTime
    {
        return $this->begin;
    }

    public function setBegin(\DateTime $begin)
    {
        $this->begin = $begin;
    }

    public function getEnd() : \DateTime
    {
        return $this->end;
    }

    public function setEnd(\DateTime $end)
    {
        $this->end = $end;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }
}
