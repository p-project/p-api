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
        if (FeatureContext::getToken() != NULL) {
            $this->request->setHttpHeader('Authorization', sprintf('Bearer %s', FeatureContext::getToken()));
        }

        $response = $this->request->send(
            'POST',
            $route,
            [],
            [],
            $body
        );

        $responseData = json_decode($response->getContent(), true);
        dump($responseData['@id']);
        return $responseData['@id'];
    }

    abstract public function createResource();

    private function putData($route, $body)
    {
        if (FeatureContext::getToken() != NULL) {
            $this->request->setHttpHeader('Authorization', sprintf('Bearer %s', FeatureContext::getToken()));
        }

        return $this->request->send(
            'PUT',
            $route,
            [],
            [],
            $body
        );
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
