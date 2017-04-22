<?php

use Doctrine\ORM\EntityManager;

class CategoryHelper extends ResourceHelper
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
    }

    public function createResource()
    {
        $body = <<<EOF
    {
      "name": "string",
      "description": "string"
    }
EOF;
        return $this->returnId('/categories', $body);
    }

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {

    }
}
