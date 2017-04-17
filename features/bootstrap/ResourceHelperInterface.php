<?php

interface ResourceHelperInterface
{
    public function createResource();

    public function createRelationWith(string $id1, string $resource2, string $id2);
}
