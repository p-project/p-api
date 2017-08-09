<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Metadata.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Metadata
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"video"})
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer")
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("integer")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("integer")
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string")
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("string")
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string")
     * @Assert\NotBlank
     * @Groups({"video"})
     * @Assert\Type("string")
     */
    private $location;

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Metadata
    {
        $this->id = $id;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): Metadata
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): Metadata
    {
        $this->width = $width;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): Metadata
    {
        $this->format = $format;

        return $this;
    }
}
