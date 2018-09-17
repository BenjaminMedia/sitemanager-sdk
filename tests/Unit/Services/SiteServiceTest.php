<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Services\SiteService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class SiteServiceTest extends ServiceTestCase
{
    protected $repoClass = SiteRepository::class;
    protected $serviceClass = SiteService::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
            Generators::generateSite(),
        ];
        /** @var SiteService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $sites = $service->getAll();

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/sites', $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        $this->assertInstanceOf(Collection::class, $sites);
        $this->assertCount(count($response), $sites);

        $sites->each(function (Site $site, int $index) use ($response) {
            Asserts::assertSite($site, $response[$index]);
        });
    }

    public function testCanGetAllWithEmptyResponse()
    {
        /** @var SiteService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateSite();

        /** @var SiteService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $site = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/sites/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertSite($site, $response);
    }

    public function testCanGetByIdWithEmptyResponse()
    {
        /** @var SiteService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getById(1));
    }
}
