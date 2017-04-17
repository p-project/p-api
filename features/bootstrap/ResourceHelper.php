<?php

use Behatch\HttpCall\Request;

abstract class ResourceHelper implements ResourceHelperInterface
{
    /**
     * @var Behatch\HttpCall\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function returnId($route, $body)
    {
        $this->setHeader();

        $response = $this->request->send(
            'POST',
            $route,
            [],
            [],
            $body
        );

        $responseData = json_decode($response->getContent(), true);
        return $responseData['@id'];
    }

    abstract public function createResource();

    private function putData($route, $body)
    {
        $this->setHeader();

        return $this->request->send(
            'PUT',
            $route,
            [],
            [],
            $body
        );
    }

    private function setHeader()
    {
        $this->request->setHttpHeader('Content-Type', 'application/ld+json');
        if (FeatureContext::getToken() != NULL) {
            $this->request->setHttpHeader('Authorization', sprintf('Bearer %s', FeatureContext::getToken()));
        }
    }

    public function createRelationWith(string $id1, string $resource2, string $id2)
    {
        $body =<<<EOF
    {
       "$resource2": [ "$id2" ]
    }        
EOF;
        return $this->putData($id1, $body);
    }
}
