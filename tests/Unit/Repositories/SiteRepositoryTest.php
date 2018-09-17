<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
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

        /** @var SiteRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/sites', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateSite();

        /** @var SiteRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response))
        ]);

        $this->assertEquals($response, $repo->findById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/sites/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }
}
