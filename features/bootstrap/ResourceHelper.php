<?php

use Doctrine\ORM\EntityManager;

abstract class ResourceHelper implements ResourceHelperInterface
{
    /**
     * @var Behatch\HttpCall\Request
     */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function persistResource()
    {
        $resource = $this->createResource();
        $this->em->persist($resource);
        $this->em->flush();
        return $resource;
    }

    abstract public function createResource();

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {

    }
}
