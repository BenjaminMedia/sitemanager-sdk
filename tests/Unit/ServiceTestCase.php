<?php

namespace Bonnier\SiteManager\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use PHPUnit\Framework\TestCase;

class ServiceTestCase extends TestCase
{
    protected $repoClass;
    protected $serviceClass;
    protected $historyContainer = [];

    public function testCanBeInstantiated()
    {
        $client = new Client();
        $repo = new $this->repoClass($client);
        $service = new $this->serviceClass($repo);

        $this->assertInstanceOf($this->serviceClass, $service);
    }

    protected function getService(array $responses)
    {
        $mockHandler = new MockHandler($responses);
        $handler = HandlerStack::create($mockHandler);

        $history = Middleware::history($this->historyContainer);

        $handler->push($history);

        $client = new Client(['handler' => $handler]);

        $repo = new $this->repoClass($client);

        return new $this->serviceClass($repo);
    }
}
