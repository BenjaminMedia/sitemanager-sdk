<?php

namespace Bonnier\SiteManager\Tests\Unit\Services;

use Bonnier\SiteManager\Models\Vocabulary;
use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Services\VocabularyService;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\ServiceTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;

class VocabularyServiceTest extends ServiceTestCase
{
    protected $repoClass = VocabularyRepository::class;
    protected $serviceClass = VocabularyService::class;

    public function testCanGetAll()
    {
        $expectedVocabularies = [
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
        ];

        $responseOne = [
            'data' => [
                $expectedVocabularies[0],
                $expectedVocabularies[1],
                $expectedVocabularies[2],
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedVocabularies[3],
                $expectedVocabularies[4],
                $expectedVocabularies[5],
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedVocabularies[6],
                $expectedVocabularies[7],
                $expectedVocabularies[8],
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var VocabularyService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $vocabularies = $service->getAll();

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals('/api/v1/vocabularies', $request->getUri()->getPath());
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $vocabularies);
        $this->assertCount(count($expectedVocabularies), $vocabularies);

        $vocabularies->each(function (Vocabulary $vocabulary, int $index) use ($expectedVocabularies) {
            Asserts::assertVocabulary($vocabulary, $expectedVocabularies[$index]);
        });
    }

    public function testCanGetAllWithEmptyResponse()
    {
        /** @var VocabularyService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateVocabulary();

        /** @var VocabularyService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($response)),
        ]);

        $vocabulary = $service->getById($response->id);

        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/vocabularies/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());

        Asserts::assertVocabulary($vocabulary, $response);
    }

    public function testCanGetByIdWithEmptyResponse()
    {
        /** @var VocabularyService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getById(1));
    }

    public function testCanGetByBrandId()
    {
        $brandConfig = [
            'brand_id' => 1,
            'brand_name' => 'Test Brand',
            'brand_code' => 'TEST_BRAND',
        ];
        $expectedVocabularies = [
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
            Generators::generateVocabulary($brandConfig),
        ];

        $responseOne = [
            'data' => [
                $expectedVocabularies[0],
                $expectedVocabularies[1],
                $expectedVocabularies[2],
            ],
            'meta' => Generators::generateMetaPagination(1, 3),
        ];
        $responseTwo = [
            'data' => [
                $expectedVocabularies[3],
                $expectedVocabularies[4],
                $expectedVocabularies[5],
            ],
            'meta' => Generators::generateMetaPagination(2, 3),
        ];
        $responseThree = [
            'data' => [
                $expectedVocabularies[6],
                $expectedVocabularies[7],
                $expectedVocabularies[8],
            ],
            'meta' => Generators::generateMetaPagination(3, 3),
        ];

        /** @var VocabularyService $service */
        $service = $this->getService([
            new Response(200, [], json_encode($responseOne)),
            new Response(200, [], json_encode($responseTwo)),
            new Response(200, [], json_encode($responseThree)),
        ]);

        $vocabularies = $service->getByBrandId($brandConfig['brand_id']);

        $this->assertCount(3, $this->historyContainer);
        foreach ($this->historyContainer as $index => $transaction) {
            /** @var Request $request */
            $request = $transaction['request'];
            $this->assertEquals('GET', $request->getMethod());
            $this->assertEquals(
                '/api/v1/vocabularies/brand/' . $brandConfig['brand_id'],
                $request->getUri()->getPath()
            );
            $this->assertEquals(sprintf('page=%s', $index + 1), $request->getUri()->getQuery());
        }

        $this->assertInstanceOf(Collection::class, $vocabularies);
        $this->assertCount(count($expectedVocabularies), $vocabularies);

        $vocabularies->each(function (Vocabulary $vocabulary, int $index) use ($expectedVocabularies) {
            Asserts::assertVocabulary($vocabulary, $expectedVocabularies[$index]);
        });
    }

    public function testCanGetByBrandIdWithEmptyResponse()
    {
        /** @var VocabularyService $service */
        $service = $this->getService([new Response()]);

        $this->assertNull($service->getByBrandId(1));
    }
}
