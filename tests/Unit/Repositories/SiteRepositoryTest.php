<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class SiteRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = SiteRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var SiteRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateSite();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response))
        ]);

        /** @var SiteRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findById($response->id));
    }
}
