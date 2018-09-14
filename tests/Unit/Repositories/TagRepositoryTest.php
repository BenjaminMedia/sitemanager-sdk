<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var TagRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateTag();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var TagRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findById($response->id));
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var TagRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
    }

    public function canGetByContenthubId()
    {
        $response = Generators::generateTag();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var TagRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findByContentHubId($response->content_hub_ids->da));
    }
}
