<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class AppRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = AppRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
        ];
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var AppRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateApp();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var AppRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getById($response->id));
    }
}
