<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
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

        /** @var AppRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/apps', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateApp();

        /** @var AppRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/apps/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }
}
