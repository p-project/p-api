<?php
/**
 * Created by PhpStorm.
 * User: micka
 * Date: 31/01/17
 * Time: 21:09
 */

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Video's category.
 *
 * @ORM\Entity
 * @ApiResource
 */
class Category
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
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Video", mappedBy="categories", cascade={"persist"})
     */
    private $videos;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Category
    {
        $this->id = $id;
        return $this;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : Category
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : Category
    {
        $this->description = $description;
        return $this;
    }

    public function getVideos() : ArrayCollection
    {
        return $this->videos;
    }

    public function setVideos($videos) : Category
    {
        $this->videos = $videos;

        return $this;
    }

}