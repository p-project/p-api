<?php

namespace Tests\AppBundle\Security;

use AppBundle\Security\RateLimiter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RateLimiterTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    protected function setUp()
    {
        self::bootKernel();

        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testNewIpRequest()
    {
        $rateLimiter = new RateLimiter($this->em);
        $ipRequest = $rateLimiter->getIpRequest('127.0.0.1');

        $this->assertEquals($ipRequest->countAccesses(), 1);

        return $rateLimiter;
    }

    /**
     * @depends testNewIpRequest
     */
    public function testSeveralIpRequest(RateLimiter $rateLimiter)
    {
        $ipRequest = $rateLimiter->getIpRequest('127.0.0.1');
        $rateLimiter->persistIpRequest($ipRequest->recordAccess());

        $this->assertEquals($ipRequest->countAccesses(), 2);
    }

    public function testGetHeader()
    {
        $rateLimiter = new RateLimiter($this->em);
        $ipRequest = $rateLimiter->getIpRequest('127.0.0.1');

        $header = $rateLimiter->getResponseHeaders();

        $this->assertEquals($header['X-RateLimit-Limit'], RateLimiter::MAX_ATTEMPTS);
        $this->assertEquals($header['X-RateLimit-Remaining'], RateLimiter::MAX_ATTEMPTS - $ipRequest->countAccesses());
        $this->assertTrue($header['X-RateLimit-Reset'] >= 0);
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->em = null;
    }
}
