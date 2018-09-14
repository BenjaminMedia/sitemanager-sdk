<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Services\BrandService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Handler\MockHandler;
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var BrandService $service */
        $service = $this->getService($mockHandler);

        $brands = $service->getAll();

        $this->assertInstanceOf(Collection::class, $brands);
        $this->assertCount(count($response), $brands);

        $brands->each(function (Brand $brand, int $index) use ($response) {
            Asserts::assertBrand($brand, $response[$index]);
        });
    }

    public function testCanGetById()
    {
        $response = Generators::generateBrand();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var BrandService $service */
        $service = $this->getService($mockHandler);

        $brand = $service->getById($response->id);

        $this->assertInstanceOf(Brand::class, $brand);

        Asserts::assertBrand($brand, $response);
    }
}
