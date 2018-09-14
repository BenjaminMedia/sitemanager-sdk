<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class VocabularyRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = VocabularyRepository::class;

    public function testCanGetAll()
    {
        $response = [
            $this->generateVocabulary([
                'id' => 1,
                'name' => 'First Vocab',
                'machine_name' => 'first_vocab',
                'contenthub_id' => 'FIRST_VOCAB',
                'multi_select' => true,
                'brand_id' => 1,
                'brand_name' => 'First Brand',
                'brand_code' => 'FIRST_BRAND',
            ]),
            $this->generateVocabulary([
                'id' => 2,
                'name' => 'Second Vocab',
                'machine_name' => 'second_vocab',
                'contenthub_id' => 'SECOND_VOCAB',
                'multi_select' => false,
                'brand_id' => 2,
                'brand_name' => 'Second Brand',
                'brand_code' => 'SECOND_BRAND',
            ]),
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = $this->generateVocabulary();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findById($response->id));
    }

    public function testCanGetByBrandId()
    {
        $response = [
            $this->generateVocabulary([
                'id' => 1,
                'name' => 'First Vocab',
                'machine_name' => 'first_vocab',
                'contenthub_id' => 'FIRST_VOCAB',
                'multi_select' => true,
            ]),
            $this->generateVocabulary([
                'id' => 2,
                'name' => 'Second Vocab',
                'machine_name' => 'second_vocab',
                'contenthub_id' => 'SECOND_VOCAB',
                'multi_select' => false,
            ]),
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        /** @var VocabularyRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findByBrandId($response[0]->brand->id));
    }

    private function generateVocabulary(array $config = [])
    {
        $vocabulary = new \stdClass();
        $vocabulary->id = $config['id'] ?? 1;
        $vocabulary->name = $config['name'] ?? 'Test Vocabulary';
        $vocabulary->machine_name = $config['machine_name'] ?? 'test_vocabulary';
        $vocabulary->content_hub_id = $config['contenthub_id'] ?? 'TEST_VOCABULARY';
        $vocabulary->multi_select = boolval($config['multi_select'] ?? false);
        $vocabulary->brand = new \stdClass();
        $vocabulary->brand->id = $config['brand_id'] ?? 1;
        $vocabulary->brand->name = $config['brand_name'] ?? 'Test Brand';
        $vocabulary->brand->brand_code = $config['brand_code'] ?? 'TEST_BRAND';

        return $vocabulary;
    }
}
