<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 27/01/17
 * Time: 19:14
 */

namespace AppBundle\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
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

}