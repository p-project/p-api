<?php

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
     * @var int
     *
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $id;

    /**
     * @var UserProfile
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\UserProfile", inversedBy="views", cascade={"persist"})
     */
    private $userProfile;

    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Video", inversedBy="views", cascade={"persist"})
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

    public function getUserProfile(): UserProfile
    {
        return $this->userProfile;
    }

    public function setUserProfile(UserProfile $userProfile)
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    public function getVideo(): Video
    {
        return $this->video;
    }

    public function setVideo(Video $video)
    {
        $this->video = $video;

        return $this;
    }
}
