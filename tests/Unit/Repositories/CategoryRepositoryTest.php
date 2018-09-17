<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class CategoryRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = CategoryRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateCategory(),
            Generators::generateCategory(),
            Generators::generateCategory(['parent' => Generators::generateCategory()]),
            Generators::generateCategory(),
            Generators::generateCategory(),
            Generators::generateCategory(['parent' => Generators::generateCategory()]),
            Generators::generateCategory(),
            Generators::generateCategory(),
        ];

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/categories', $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateCategory();

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/categories/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetByContenthubId()
    {
        $response = Generators::generateCategory();

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findByContentHubId($response->content_hub_ids->da));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals(
            '/api/v1/categories/content-hub-id/' . $response->content_hub_ids->da,
            $request->getUri()->getPath()
        );
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetByBrandId()
    {
        $response = [
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            Generators::generateCategory([
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
        ];

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/categories/brand/' . $response[0]->brand->id, $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }
}
