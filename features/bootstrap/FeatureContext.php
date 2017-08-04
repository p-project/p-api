<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behatch\Context\RestContext;
use Behatch\HttpCall\Request;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\HttpKernel\Kernel;

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

        $this->helpers['UserAccount'] = new UserAccountHelper($this->manager);
        $this->helpers['UserProfile'] = new UserProfileHelper($this->manager, $this->helpers['UserAccount']);
        $this->helpers['Channel'] = new ChannelHelper($this->manager, $this->helpers['UserProfile']);
        $this->helpers['Playlist'] = new PlaylistHelper($this->manager, $this->helpers['UserProfile']);
        $this->helpers['Video'] = new VideoHelper($this->manager, $this->helpers['Channel']);
        $this->helpers['SustainabilityOffer'] = new SustainabilityOfferHelper($this->manager, $this->helpers['Channel']);
        $this->helpers['Category'] = new CategoryHelper($this->manager);
        $this->helpers['Network'] = new NetworkHelper($this->manager);
        $this->helpers['View'] = new ViewHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Video']);
        $this->helpers['Forum'] = new ForumHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Video']);
        $this->helpers['Review'] = new ReviewHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Video']);
        $this->helpers['Reply'] = new ReplyHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Review']);
        $this->helpers['Seeder'] = new SeederHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Video']);
        $this->helpers['Subtitles'] = new SubtitlesHelper($this->manager, $this->helpers['Video']);
        $this->helpers['Annotation'] = new AnnotationHelper($this->manager, $this->helpers['Video']);
        $this->helpers['Comment'] = new CommentHelper($this->manager, $this->helpers['UserProfile'], $this->helpers['Video']);
    }

    /**
     * @BeforeScenario @refreshSchema
     */
    public function refreshDatabase()
    {
        $this->schemaTool->dropSchema($this->classes);
        $this->schemaTool->createSchema($this->classes);
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
     * Sends a HTTP request after authentication.
     *
     * @Given I am connected as :login with password :password
     */
    public function iSendAnAuthenticatedRequestTo($login, $password)
    {
        $responseLogin = $this->request->send(
            'GET',
            $this->locatePath('/oauth/v2/token'),
            [
                'client_id' => '1_client_id',
                'client_secret' => 'client_secret',
                'grant_type' => 'password',
                'redirect_uri' => '127.0.0.1',
                'username' => $login,
                'password' => $password,
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
        if (self::$token != null) {
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
     * Create resource if there are not created.
     *
     * @Given Resource :resource :id exists
     */
    private function exists(string $resource, string $id, array &$resources)
    {
        $id = explode('/', $id)[2];

        $resource = $this->manager->getRepository('AppBundle:'.$resource)->findOneById($id);

        if ($resource !== null) {
            array_push($resources, $resource);
        }

        return $resource !== null;
    }

    /**
     * @Given There are :resource :id
     */
    public function thereAreResource($resource, $ids)
    {
        $resource = preg_replace('/\s/', '', ucwords($resource));
        $resources = [];

        $id = explode(',', $ids);

        foreach ($id as $eachId) {
            if (!$this->exists($resource, $eachId, $resources)) {
                array_push($resources, $this->helpers[$resource]->persistResource());
            }
        }

        return $resources;
    }

    /**
     * @Given There are :resource :id which have :resource2 :id2
     */
    public function thereAreResourceWhichHaveResource($resource, $ids, $resource2, $ids2)
    {
        $resource = preg_replace('/\s/', '', ucwords($resource));
        $resource2 = preg_replace('/\s/', '', ucwords($resource2));

        $resourcesCreated = $this->thereAreResource($resource, $ids);
        $resourcesCreated2 = $this->thereAreResource($resource2, $ids2);

        foreach ($resourcesCreated as $resourceCreated) {
            foreach ($resourcesCreated2 as $resourceCreated2) {
                if (!$this->helpers[$resource]->relationExists($resourceCreated, $resource2, $resourceCreated2)) {
                    $this->helpers[$resource]->createRelationWith($resourceCreated, $resource2, $resourceCreated2);
                }
            }
        }
    }
}
