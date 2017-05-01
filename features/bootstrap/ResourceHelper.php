<?php

use Doctrine\Common\Inflector\Inflector;
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

    public function relationExists($resource, string $nameResource2, $resource2)
    {
        $getResource = 'get'.Inflector::pluralize($nameResource2);

        if (method_exists($resource, $getResource)) {
            return $resource->{$getResource}()->contains($resource2);
        }

        return $resource->{'get'.$nameResource2}() == $resource2;
    }

    public function createRelationWith($resource, string $nameResource2, $resource2)
    {
        $setResource = 'set'.Inflector::pluralize($nameResource2);

        if (method_exists($resource, $setResource)) {
            $resource->{$setResource}([$resource2]);
        } else {
            $resource->{'set'.$nameResource2}($resource2);
        }
        $this->em->flush();

        return $resource;
    }
}
