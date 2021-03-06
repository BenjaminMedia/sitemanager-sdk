<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class BrandRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = BrandRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
        ];

        /** @var BrandRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response))
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/brands', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateBrand();

        /** @var BrandRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response))
        ]);

        $this->assertEquals($response, $repo->findById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/brands/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }
}
