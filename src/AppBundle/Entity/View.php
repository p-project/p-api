<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 27/01/17
 * Time: 19:14
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource
 */
class View
{

    /**
     * @var int The id of the view
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int The user ID
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="views", cascade={"persist"})
     */
    private $user;

    /**
     * @var int The video ID
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="videos", cascade={"persist"})
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
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user)
    {
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getVideo(): int
    {
        return $this->video;
    }

    /**
     * @param int $video
     */
    public function setVideo(int $video)
    {
        $this->video = $video;
    }



}