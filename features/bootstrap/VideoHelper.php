<?php

use Behatch\HttpCall\Request;

class VideoHelper extends ResourceHelper
{
    /**
     * @var ChannelHelper
     */
    private $channelHelper;

    public function __construct(Request $request, ChannelHelper $channelHelper)
    {
        parent::__construct($request);
        $this->channelHelper = $channelHelper;
    }

    public function createResource()
    {
        $idChannel = $this->channelHelper->createResource();

        $body =<<<EOF
    {
      "title": "string",
      "description": "string",
      "uploadDate": "2017-02-01T18:30:52.055Z",
      "numberView": 120,
      "channel": "$idChannel",
      "hash": "Abdsbfs",
      "magnet": "ssdf",
      "metadata":
      {
        "height": 100,
        "width": 100,
        "format": "mp3"
      }
    }
EOF;

        $response = $this->request->send(
            'POST',
            '/videos',
            [],
            [],
            $body
        );

        $responseData = json_decode($response->getContent(), true);
        var_dump($responseData['@id']);
        return $responseData['@id'];

    }
}
