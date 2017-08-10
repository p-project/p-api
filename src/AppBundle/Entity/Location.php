<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Location.
 *
 * @ORM\Entity
 */
class Location
{

    /**
     *
     *
     * @ORM\Column(type="decimal", scale="8")
     * @Assert\NotBlank()
     */
    protected $latitude;


    /**
     *
     *
     * @ORM\Column(type="decimal", scale="8")
     * @Assert\NotBlank()
     */
    protected $longitude;


    /**
     * @var Metadata
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Metadata",  mappedBy="location", cascade={"persist"})
     * @Groups({"video"})
     */
    private $metadata;

    /**
     * @return Metadata
     */
    public function getMetadata(): Metadata
    {
        return $this->metadata;
    }

    /**
     * @param Metadata $metadata
     */
    public function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

}