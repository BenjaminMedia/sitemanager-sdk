<?php

namespace Bonnier\SiteManager\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class RepositoryTestCase extends TestCase
{
    protected $repoClass;

    public function testCanBeInstantiated()
    {
        $client = new Client();
        $repo = new $this->repoClass($client);

        $this->assertInstanceOf($this->repoClass, $repo);
    }

    protected function getRepository(MockHandler $mockHandler)
    {
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        return new $this->repoClass($client);
    }
}
