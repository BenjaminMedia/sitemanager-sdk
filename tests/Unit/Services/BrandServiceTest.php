<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Services\BrandService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class BrandServiceTest extends ServiceTestCase
{
    protected $repoClass = BrandRepository::class;
    protected $serviceClass = BrandService::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
        ];

        /** @var BrandService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $brands = $service->getAll();

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/brands', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        $this->assertInstanceOf(Collection::class, $brands);
        $this->assertCount(count($response), $brands);

        $brands->each(function (Brand $brand, int $index) use ($response) {
            Asserts::assertBrand($brand, $response[$index]);
        });
    }

    public function testCanGetAllWithEmptyResponse()
    {
        /** @var BrandService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateBrand();

        /** @var BrandService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $brand = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/brands/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        $this->assertInstanceOf(Brand::class, $brand);

        Asserts::assertBrand($brand, $response);
    }

    public function testCanGetByIdWithEmptyResponse()
    {
        /** @var BrandService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getById(1));
    }
}
