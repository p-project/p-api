<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\PersistentCollection;

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

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        $getResource = 'get'.$nameResource2;

        if ($resource->{$getResource}() instanceof PersistentCollection) {
            return $resource->{$getResource}()->contains($resource2);
        }

        return $resource->{$getResource}() == $resource2;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        $getResource = 'get'.$nameResource2;
        $setResource = 'set'.$nameResource2;

        if ($resource->{$getResource}() instanceof PersistentCollection) {
            $resource->{$setResource}([$resource2]);
        } else {
            $resource->{$setResource}($resource2);
        }
        $this->em->flush();

        return $resource;
    }
}
