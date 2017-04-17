<?php

use Behatch\HttpCall\Request;

class AccountHelper extends ResourceHelper
{
    private static $numberAccount = 0;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {
        $username = 'string' .  self::$numberAccount;
        $email = 'string' . self::$numberAccount . '@string.fr';
        $body =<<<EOF
    {
      "username": "$username",
      "email": "$email",
      "firstName": "string",
      "lastName": "string",
      "password": "password",
      "salt": "salt"
    }
EOF;

        dump($body);
        dump("toto");

        ++self::$numberAccount;

        return $this->returnId('/accounts', $body);
    }

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {

    }
}
