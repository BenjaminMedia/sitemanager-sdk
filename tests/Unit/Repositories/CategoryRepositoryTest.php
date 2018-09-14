<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateCategory();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findById($response->id));
    }

    public function testCanGetByContenthubId()
    {
        $response = Generators::generateCategory();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findByContentHubId($response->content_hub_ids->da));
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var CategoryRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
    }
}
