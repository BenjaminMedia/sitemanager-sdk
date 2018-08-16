<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class BaseRepository extends TestCase
{
    protected $repoClass;

    public function testCanBeInstantiated()
    {
        $client = new Client();
        $repo = new $this->repoClass($client);

        $this->assertInstanceOf($this->repoClass, $repo);
    }
}
