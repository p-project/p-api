<?php

use Doctrine\ORM\EntityManager;

class NetworkHelper extends ResourceHelper
{
    public function __construct(EntityManager $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {
        $body =<<<EOF
    {
        "name": "string"
    }
EOF;
        return $this->returnId('/networks', $body);
    }
}
