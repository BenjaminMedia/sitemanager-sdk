<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class BaseService extends TestCase
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
}
