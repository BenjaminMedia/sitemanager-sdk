<?php

namespace Bonnier\SiteManager\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use PHPUnit\Framework\TestCase;

class ServiceTestCase extends TestCase
{
    protected $repoClass;
    protected $serviceClass;

    public function testCanBeInstantiated()
    {
        $client = new Client();
        $repo = new $this->repoClass($client);
        $service = new $this->serviceClass($repo);

        $this->assertInstanceOf($this->serviceClass, $service);
    }

    protected function getService(MockHandler $mockHandler)
    {
        $handler = HandlerStack::create($mockHandler);
        $client = new Client(['handler' => $handler]);

        $repo = new $this->repoClass($client);

        return new $this->serviceClass($repo);
    }
}
