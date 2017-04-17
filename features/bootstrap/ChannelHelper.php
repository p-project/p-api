<?php

use Behatch\HttpCall\Request;

class ChannelHelper extends ResourceHelper
{
    private static $numberChannel = 0;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function createResource()
    {
        $name = 'string' . self::$numberChannel;
        $body =<<<EOF
    {
      "account": "/accounts/1",
      "name": "$name",
      "tags": [
         "string"
      ]
    }
EOF;
        ++self::$numberChannel;

        $response = $this->request->send(
            'POST',
            '/channels',
            [],
            [],
            $body
        );
        $responseData = json_decode($response->getContent(), true);
        var_dump($responseData);
        return $responseData['@id'];
    }
}
