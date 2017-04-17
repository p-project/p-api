<?php

use Behatch\HttpCall\Request;

class ChannelHelper extends ResourceHelper
{
    private static $numberChannel = 0;

    private $accountHelper;

    public function __construct(Request $request, AccountHelper $accountHelper)
    {
        parent::__construct($request);
        $this->accountHelper = $accountHelper;
    }

    public function createResource()
    {
        $idUser = $this->accountHelper->createResource();

        $name = 'string' . self::$numberChannel;
        $body =<<<EOF
    {
      "account": "$idUser",
      "name": "$name",
      "tags": [
         "string"
      ]
    }
EOF;

        ++self::$numberChannel;

        return $this->returnId('/channels', $body);
    }

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {
        
    }
}
