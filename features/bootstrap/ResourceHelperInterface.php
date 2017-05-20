<?php

interface ResourceHelperInterface
{
    public function createResource();

    public function createRelationWith($resource, string $nameResource2, $resource2);

    public function relationExists($resource, string $nameResource2, $resource2);
}
