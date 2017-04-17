<?php

use Behatch\HttpCall\Request;

class AccountHelper extends ResourceHelper
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {
        $body =<<<EOF
    {
      "username": "string",
      "email": "string@string.fr",
      "firstName": "string",
      "lastName": "string",
      "password": "password",
      "salt": "salt"
    }
EOF;

        $response = $this->request->send(
            'POST',
            '/accounts',
            [],
            [],
            $body
        );
        $responseData = json_decode($response->getContent(), true);
        return $responseData['@id'];
    }
}
