<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Services\AppService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
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

        /** @var AppService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $apps = $service->getAll();

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/apps', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        $this->assertInstanceOf(Collection::class, $apps);
        $this->assertCount(count($response), $apps);
        $apps->each(function (App $app, int $index) use ($response) {
            Asserts::assertApp($app, $response[$index]);
        });
    }

    public function testCanGetById()
    {
        $response = Generators::generateApp();

        /** @var AppService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $app = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/apps/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        $this->assertInstanceOf(App::class, $app);
        Asserts::assertApp($app, $response);
    }
}
