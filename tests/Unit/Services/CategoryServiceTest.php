<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Category;
use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Services\CategoryService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class CategoryServiceTest extends ServiceTestCase
{
    protected $repoClass = CategoryRepository::class;
    protected $serviceClass = CategoryService::class;

    public function testCanGetAll()
    {
        $expectedCategories = [
            Generators::generateCategory(),
            Generators::generateCategory(),
            Generators::generateCategory(['parent' => Generators::generateCategory()]),
            Generators::generateCategory(),
            Generators::generateCategory(),
            Generators::generateCategory(['parent' => Generators::generateCategory()]),
            Generators::generateCategory(),
            Generators::generateCategory(),
            Generators::generateCategory(),
        ];
        $responseOne = [
            'data' => [
                $expectedCategories[0],
                $expectedCategories[1],
                $expectedCategories[2]
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedCategories[3],
                $expectedCategories[4],
                $expectedCategories[5]
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedCategories[6],
                $expectedCategories[7],
                $expectedCategories[8]
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var CategoryService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $categories = $service->getAll();

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals('/api/v1/categories', $request->getUri()->getPath());
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $categories);
        $this->assertCount(count($expectedCategories), $categories);
        $categories->each(function (Category $category, int $index) use ($expectedCategories) {
            Asserts::assertCategory($category, $expectedCategories[$index]);
        });
    }

    public function testCanGetById()
    {
        $response = Generators::generateCategory();

        /** @var CategoryService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $category = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/categories/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertCategory($category, $response);
    }

    public function testCanGetByContenthubId()
    {
        $response = Generators::generateCategory();

        /** @var CategoryService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $category = $service->getByContenthubId($response->content_hub_ids->da);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals(
            '/api/v1/categories/content-hub-id/' . $response->content_hub_ids->da,
            $request->getUri()->getPath()
        );
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertCategory($category, $response);
    }

    public function testCanGetByBrandId()
    {
        $brandConfig = [
            'brand_id' => 1,
            'brand_name' => 'Test Brand',
            'brand_code' => 'TEST_BRAND',
        ];
        $expectedCategories = [
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
            Generators::generateCategory($brandConfig),
        ];
        $responseOne = [
            'data' => [
                $expectedCategories[0],
                $expectedCategories[1],
                $expectedCategories[2]
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedCategories[3],
                $expectedCategories[4],
                $expectedCategories[5]
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedCategories[6],
                $expectedCategories[7],
                $expectedCategories[8]
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var CategoryService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $categories = $service->getByBrandId($brandConfig['brand_id']);

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals('/api/v1/categories/brand/' . $brandConfig['brand_id'], $request->getUri()->getPath());
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $categories);
        $this->assertCount(count($expectedCategories), $categories);

        $categories->each(function (Category $category, int $index) use ($expectedCategories) {
            Asserts::assertCategory($category, $expectedCategories[$index]);
        });
    }
}
