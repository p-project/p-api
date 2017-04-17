<?php

use Behatch\HttpCall\Request;

abstract class ResourceHelper
{
    /**
     * @var Behatch\HttpCall\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    abstract protected function createResource();
}
