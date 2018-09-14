<?php

namespace Bonnier\SiteManager\Tests\Unit\Repositories;

use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
use Bonnier\SiteManager\Tests\Unit\RepositoryTestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;

class BrandRepositoryTest extends RepositoryTestCase
{
    protected $repoClass = BrandRepository::class;

    public function testCanGetAll()
    {
        $response = [
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
            Generators::generateBrand(),
        ];

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response))
        ]);

        /** @var BrandRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->getAll());
    }

    public function testCanGetById()
    {
        $response = Generators::generateBrand();

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($response))
        ]);

        /** @var BrandRepository $repo */
        $repo = $this->getRepository($mockHandler);

        $this->assertEquals($response, $repo->findById($response->id));
    }
}
