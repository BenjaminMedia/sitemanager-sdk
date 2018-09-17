<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class VocabularyRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = VocabularyRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
        ];

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->getAll());
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/vocabularies', $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }

    public function testCanGetById()
    {
        $response = Generators::generateVocabulary();

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findById($response->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/vocabularies/' . $response->id, $request->getUri()->getPath());
        $this->assertEmpty($request->getUri()->getQuery());
    }

    public function testCanGetByBrandId()
    {
        $response = [
            Generators::generateVocabulary(),
            Generators::generateVocabulary(),
        ];

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository([
            new Response(200, [], json_encode($response)),
        ]);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
        $this->assertCount(1, $this->historyContainer);
        /** @var Request $request */
        $request = $this->historyContainer[0]['request'];
        $this->assertEquals('GET', $request->getMethod());
        $this->assertEquals('/api/v1/vocabularies/brand/' . $response[0]->brand->id, $request->getUri()->getPath());
        $this->assertEquals('page=1', $request->getUri()->getQuery());
    }
}
