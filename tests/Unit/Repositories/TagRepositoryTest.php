<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class TagRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = TagRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
        ];

        /** @var TagRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/tags', $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateTag();

        /** @var TagRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/tags/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetByBrand()
    {
        $response = [
            Generators::generateTag([
                'brand_id' => 1,
                'brand_name' => 'Test Brand',
                'brand_code' => 'TEST_BRAND'
            ]),
            Generators::generateTag([
                'brand_id' => 1,
                'brand_name' => 'Test Brand',
                'brand_code' => 'TEST_BRAND'
            ]),
            Generators::generateTag([
                'brand_id' => 1,
                'brand_name' => 'Test Brand',
                'brand_code' => 'TEST_BRAND'
            ]),
            Generators::generateTag([
                'brand_id' => 1,
                'brand_name' => 'Test Brand',
                'brand_code' => 'TEST_BRAND'
            ]),
            Generators::generateTag([
                'brand_id' => 1,
                'brand_name' => 'Test Brand',
                'brand_code' => 'TEST_BRAND'
            ]),
        ];

        /** @var TagRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/tags/brand/' . $response[0]->brand->id, $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }

    public function canGetByContenthubId()
    {
        $response = Generators::generateTag();

        /** @var TagRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findByContentHubId($response->content_hub_ids->da));
    }
}
