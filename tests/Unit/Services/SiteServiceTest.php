<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Services\SiteService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Handler\MockHandler;
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

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var SiteService $service */
        $service = $this->getService($mockHandler);

        $sites = $service->getAll();

        $this->assertInstanceOf(Collection::class, $sites);
        $this->assertCount(count($response), $sites);

        $sites->each(function (Site $site, int $index) use ($response) {
            Asserts::assertSite($site, $response[$index]);
        });
    }

    public function testCanGetById()
    {
        $response = Generators::generateSite();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var SiteService $service */
        $service = $this->getService($mockHandler);

        $site = $service->getById($response->id);

        Asserts::assertSite($site, $response);
    }
}
