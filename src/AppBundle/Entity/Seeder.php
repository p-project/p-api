<?php

namespace AppBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource
 */
class Seeder
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
     * @ORM\Column(name="platform", type="string")
     * @Assert\NotBlank
     * */
    private $platform;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Seed", mappedBy="seeder", cascade={"persist"})
     */
    private $seeds;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="seeders", cascade={"persist"})
     */
    private $account;

    public function getId() : int
    {
        return $this->id;
    }

    public function setId(int $id) : Seeder
    {
        $this->id = $id;

        return $this;
    }

    public function getPlatform() : string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform) : Seeder
    {
        $this->platform = $platform;

        return $this;
    }

    public function getAccount()
    {
        return $this->account;
    }

    public function setAccount(ArrayCollection $account) : Seeder
    {
        $this->account = $account;

        return $this;
    }

    public function getSeeds()
    {
        return $this->seeds;
    }

    public function setSeeds($seeds) : Seeder
    {
        $this->seeds = $seeds;

        return $this;
    }
}
