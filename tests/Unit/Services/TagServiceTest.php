<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Services\TagService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class TagServiceTest extends ServiceTestCase
{
    protected $repoClass = TagRepository::class;
    protected $serviceClass = TagService::class;

    public function testCanGetAll()
    {
        $expectedTags = [
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
            Generators::generateTag(),
        ];
        $responseOne = [
            'data' => [
                $expectedTags[0],
                $expectedTags[1],
                $expectedTags[2]
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedTags[3],
                $expectedTags[4],
                $expectedTags[5]
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedTags[6],
                $expectedTags[7],
                $expectedTags[8]
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var TagService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $tags = $service->getAll();

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals('/api/v1/tags', $request->getUri()->getPath());
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $tags);
        $this->assertCount(count($expectedTags), $tags);
        $tags->each(function (Tag $tag, int $index) use ($expectedTags) {
            Asserts::assertTag($tag, $expectedTags[$index]);
        });
    }

    public function testCanGetAllWithEmptyResponse()
    {
        /** @var TagService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateTag();

        /** @var TagService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $tag = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/tags/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertTag($tag, $response);
    }

    public function testCanGetByIdWithEmptyResponse()
    {
        /** @var TagService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getById(1));
    }

    public function testCanGetByContenthubId()
    {
        $response = Generators::generateTag();

        /** @var TagService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $tag = $service->getByContenthubId($response->content_hub_ids->da);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals(
            '/api/v1/tags/content-hub-id/' . $response->content_hub_ids->da,
            $request->getUri()->getPath()
        );
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertTag($tag, $response);
    }

    public function testCanGetByContenthubIdWithEmptyResponse()
    {
        /** @var TagService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getByContenthubId('abc123'));
    }

    public function testCanGetByBrandId()
    {
        $brandConfig = [
            'brand_id' => 1,
            'brand_name' => 'Test Brand',
            'brand_code' => 'TEST_BRAND',
        ];
        $expectedTags = [
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
            Generators::generateTag($brandConfig),
        ];
        $responseOne = [
            'data' => [
                $expectedTags[0],
                $expectedTags[1],
                $expectedTags[2]
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedTags[3],
                $expectedTags[4],
                $expectedTags[5]
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedTags[6],
                $expectedTags[7],
                $expectedTags[8]
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var TagService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $tags = $service->getByBrandId($brandConfig['brand_id']);

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals('/api/v1/tags/brand/' . $brandConfig['brand_id'], $request->getUri()->getPath());
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $tags);
        $this->assertCount(count($expectedTags), $tags);

        $tags->each(function (Tag $tag, int $index) use ($expectedTags) {
            Asserts::assertTag($tag, $expectedTags[$index]);
        });
    }

    public function testCanGetByBrandIdWithEmptyResponse()
    {
        /** @var TagService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getByBrandId(1));
    }
}
