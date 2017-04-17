<?php

use Behatch\HttpCall\Request;

class CategoryHelper extends ResourceHelper
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {

    }

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {
        
    }
}
