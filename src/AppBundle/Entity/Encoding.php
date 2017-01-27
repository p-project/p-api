<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 27/01/17
 * Time: 18:41
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annotation
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
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string")
     */
    private $format;


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
     * @return Encoding
     */
    public function setId(int $id): Encoding
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return Encoding
     */
    public function setHeight(int $height): Encoding
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return Encoding
     */
    public function setWidth(int $width): Encoding
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return Encoding
     */
    public function setFormat(string $format): Encoding
    {
        $this->format = $format;
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
     * @return Encoding
     */
    public function setVideo($video): Encoding
    {
        $this->video = $video;
        return $this;
    }
}