<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Services\AppService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class AppServiceTest extends ServiceTestCase
{
    protected $repoClass = AppRepository::class;
    protected $serviceClass = AppService::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
            Generators::generateApp(),
        ];
        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var AppService $service */
        $service = $this->getService($mockHandler);

        $apps = $service->getAll();

        $this->assertInstanceOf(Collection::class, $apps);
        $this->assertCount(count($response), $apps);
        $apps->each(function (App $app, int $index) use ($response) {
            Asserts::assertApp($app, $response[$index]);
        });
    }

    public function testCanGetById()
    {
        $response = Generators::generateApp();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var AppService $service */
        $service = $this->getService($mockHandler);

        $app = $service->getById($response->id);

        $this->assertInstanceOf(App::class, $app);
        Asserts::assertApp($app, $response);
    }
}
