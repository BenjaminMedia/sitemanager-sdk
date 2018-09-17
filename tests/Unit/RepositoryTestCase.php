<?php

namespace Bonnier\SiteManager\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;

class RepositoryTestCase extends TestCase
{
    protected $repoClass;
    protected $historyContainer = [];

    public function testCanBeInstantiated()
    {
        $client = new Client();
        $repo = new $this->repoClass($client);

        $this->assertInstanceOf($this->repoClass, $repo);
    }

    protected function getRepository(array $responses)
    {
        $mockHandler = new MockHandler($responses);
        $handler = HandlerStack::create($mockHandler);

        $history = Middleware::history($this->historyContainer);

        $handler->push($history);

        $client = new Client(['handler' => $handler]);

        return new $this->repoClass($client);
    }
}
