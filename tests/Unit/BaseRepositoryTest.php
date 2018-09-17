<?php

namespace Bonnier\SiteManager\Tests\Unit;

use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Repositories\BaseRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class BaseRepositoryTest extends TestCase
{
    public function testCanHandleClientException()
    {
        $mockHandler = new MockHandler([
            new RequestException('Error Communicating with Server', new Request('GET', 'test')),
        ]);

        $handler = HandlerStack::create($mockHandler);

        $client = new Client(['handler' => $handler]);

        $repository = new AppRepository($client);

        $this->assertNull($repository->getAll());
    }
}
