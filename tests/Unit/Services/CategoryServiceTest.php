<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Services\CategoryService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class CategoryServiceTest extends ServiceTestCase
{
    protected $repoClass = CategoryRepository::class;
    protected $serviceClass = CategoryService::class;

    public function testCanGetAll()
    {
        $response = [
            'data' => [
                Generators::generateCategory(),
                Generators::generateCategory(),
                Generators::generateCategory(['parent' => Generators::generateCategory()]),
                Generators::generateCategory(),
                Generators::generateCategory(),
                Generators::generateCategory(['parent' => Generators::generateCategory()]),
                Generators::generateCategory(),
                Generators::generateCategory(),
                Generators::generateCategory(),
                Generators::generateCategory(['parent' => Generators::generateCategory()]),
            ],
            'meta' => [
                'pagination' => [
                    'total' => 100,
                    'count' => 10,
                    'per_page' => 10,
                    'current_page' => 1,
                    'total_pages' => 10,
                    'links' => [
                        'next' => 'http://site-manager.test/api/v1/categories?page=2'
                    ]
                ]
            ]
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var CategoryService $service */
        $service = $this->getService($mockHandler);

        $this->assertInstanceOf($this->serviceClass, $service);
    }
}
