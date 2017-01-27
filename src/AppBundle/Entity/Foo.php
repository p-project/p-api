<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This is a dummy entity. Remove it!
 *
 * @ApiResource
 * @ORM\Entity
 */
class Foo
{
    /**
     * @var int The entity Id
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Something else
     *
     * @ORM\Column
     * @Assert\NotBlank
     */
    private $bar = '';

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Foo
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="foos")
     */
    private $video;

    public function getId()
    {
        return $this->id;
    }

    public function getBar() : string
    {
        return $this->bar;
    }

    public function setBar(string $bar) : Foo
    {
        $this->bar = $bar;

        return $this;
    }
}
