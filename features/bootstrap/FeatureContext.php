<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpKernel\Kernel;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Behatch\Context\RestContext;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\HttpCall\Request;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RestContext implements Context, SnippetAcceptingContext
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var \Symfony\Component\HttpKernel\Kernel
     */
    private $kernel;

    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $manager;

    /**
     * @var SchemaTool
     */
    private $schemaTool;

    /**
     * @var array
     */
    private $classes;

    /**
     * @var string
     */
    private static $token;

    /**
     * @var array
     */
    private $helpers;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct(Request $request, ManagerRegistry $doctrine, Kernel $kernel)
    {
        parent::__construct($request);
        $this->kernel = $kernel;
        $this->doctrine = $doctrine;
        $this->manager = $doctrine->getManager();
        $this->schemaTool = new SchemaTool($this->manager);
        $this->classes = $this->manager->getMetadataFactory()->getAllMetadata();
        $this->helpers['accounts'] = new AccountHelper($request);
        $this->helpers['channels'] = new ChannelHelper($request, $this->helpers['accounts']);
        $this->helpers['videos'] = new VideoHelper($request, $this->helpers['channels']);
        $this->helpers['categories'] = new CategoryHelper($request);
    }

    /**
     * @BeforeScenario @createSchema
     */
    public function createDatabase()
    {
        $this->schemaTool->createSchema($this->classes);
    }

    /**
     * @AfterScenario @dropSchema
     */
    public function dropDatabase()
    {
        $this->schemaTool->dropSchema($this->classes);
    }

    protected function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);
        $application = new Application($this->kernel);
        $application->setAutoExit(false);
        $application->run(new StringInput($command));
    }

    /**
     * @BeforeScenario @requiresOAuth
     */
    public function loadFixtures()
    {
        $this->runCommand('doctrine:database:create');
        $this->runCommand('doctrine:schema:update --force');
        $this->runCommand('doctrine:fixtures:load -n');
    }

    /**
     * Sends a HTTP request after authentication
     *
     * @Given I am connected as :login with password :password
     */
    public function iSendAnAuthenticatedRequestTo($login, $password)
    {

        $responseLogin = $this->request->send(
            'GET',
            $this->locatePath("/oauth/v2/token"),
            [
                'client_id' => '1_client_id',
                'client_secret' => 'client_secret',
                'grant_type' => 'password',
                'redirect_uri' => '127.0.0.1',
                'username' => $login,
                'password' => $password
            ],
            [],
            null,
            ['Content-Type' => 'application/ld+json']
        );
        $responseLoginData = json_decode($responseLogin->getContent(), true);

        self::$token = $responseLoginData['access_token'];

    }

    public function iSendARequestTo($method, $url, PyStringNode $body = null, $files = [])
    {
        if (self::$token != NULL) {
            $this->request->setHttpHeader('Authorization', sprintf('Bearer %s', self::$token));
        }

        return $this->request->send(
            $method,
            $this->locatePath($url),
            [],
            $files,
            $body !== null ? $body->getRaw() : null
        );
    }

    /**
     * Create resource if there are not created
     * @Given Resource :resource :id exists
     */
    private function exists(string $resource, string $id)
    {
        if (!strpos($id, $resource)) {
            return false;
        }

        $this->request->send(
            'GET',
            $id,
            [],
            [],
            null
        );

        return $this->getMinkContext()->getSession()->getStatusCode() !== 404;
    }

    /**
     * @Given There are :resource :id
     */
    public function thereAreResource($resource, $ids)
    {
        $id = explode(',', $ids);

        foreach ($id as $eachId) {
            if (!$this->exists($resource, $eachId)) {
                $this->helpers[$resource]->createResource();
            }
        }
    }

    private function relationExists(string $id1, string $resource2, string $id2)
    {
        $response = $this->request->send(
            'GET',
            $id1,
            [],
            [],
            null
        );
        $responseData = json_decode($response->getContent(), true);
        return in_array($id2, $responseData[$resource2]);
    }

    /**
     * @Given There are :resource :id which have :resource2 :id2
     */
    public function thereAreResourceWhichHaveResource($resource, $ids, $resource2, $ids2)
    {
        $this->thereAreResource($resource, $ids);
        $this->thereAreResource($resource2, $ids2);

        $id = explode(',', $ids);
        $id2 = explode(',', $ids2);

        foreach ($id as $eachId1) {
            foreach ($id2 as $eachId2) {
                if (!$this->relationExists($eachId1, $resource2, $eachId2)) {
                    $this->helpers[$resource]->createRelationWith($eachId1, $resource2, $eachId2);
                }
            }
        }
    }

    public static function getToken()
    {
        return self::$token;
    }
}
