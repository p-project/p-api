<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 27/01/17
 * Time: 19:13
 */

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
     * @var int The id of the Subtitle
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var DateTime The begin of the Subtitle
     * @ORM\Column(type="datetime")
     */
    private $begin;

    /**
     * @var DateTime The end of the Subtitle
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @var string The path of the Subtitle file
     * @ORM\Column(type="string")
     */
    private $path;

    /**
     * @return int
     */
    public function getId(): int
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

    /**
     * @return DateTime
     */
    public function getBegin(): DateTime
    {
        return $this->begin;
    }

    /**
     * @param DateTime $begin
     */
    public function setBegin(DateTime $begin)
    {
        $this->begin = $begin;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }

    /**
     * @param DateTime $end
     */
    public function setEnd(DateTime $end)
    {
        $this->end = $end;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

}