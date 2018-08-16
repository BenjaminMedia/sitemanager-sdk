<?php

namespace Bonnier\SiteManager;

use Bonnier\SiteManager\Repositories\AppRepository;
use Bonnier\SiteManager\Repositories\BrandRepository;
use Bonnier\SiteManager\Repositories\CategoryRepository;
use Bonnier\SiteManager\Repositories\SiteRepository;
use Bonnier\SiteManager\Repositories\TagRepository;
use Bonnier\SiteManager\Repositories\VocabularyRepository;
use Bonnier\SiteManager\Services\AppService;
use Bonnier\SiteManager\Services\BrandService;
use Bonnier\SiteManager\Services\CategoryService;
use Bonnier\SiteManager\Services\SiteService;
use Bonnier\SiteManager\Services\TagService;
use Bonnier\SiteManager\Services\VocabularyService;
use GuzzleHttp\Client;

class SiteManager
{
    /** @var Client */
    protected $client;

    /** @var AppService */
    protected $appService;

    /** @var BrandService */
    protected $brandService;

    /** @var CategoryService */
    protected $categoryService;

    /** @var SiteService */
    protected $siteService;

    /** @var TagService */
    protected $tagService;

    /** @var VocabularyService */
    protected $vocabularyService;

    /**
     * SiteManager constructor.
     *
     * @param string|null $host
     */
    public function __construct(?string $host = null)
    {
        $baseUri = '';
        if ($host) {
            $baseUri = $host;
        } elseif ($envHost = env('SITE_MANAGER_HOST')) {
            $baseUri = $envHost;
        } else {
            throw new \InvalidArgumentException('Missing Site Manager Host argument!');
        }

        if (!filter_var($baseUri, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf('\'%s\' is not a valid URL!', $baseUri));
        }

        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return AppService
     */
    public function app()
    {
        if (!$this->appService) {
            $this->appService = new AppService(new AppRepository($this->getClient()));
        }

        return $this->appService;
    }

    /**
     * @return BrandService
     */
    public function brand()
    {
        if (!$this->brandService) {
            $this->brandService = new BrandService(new BrandRepository($this->getClient()));
        }

        return $this->brandService;
    }

    /**
     * @return CategoryService
     */
    public function category()
    {
        if (!$this->categoryService) {
            $this->categoryService = new CategoryService(new CategoryRepository($this->getClient()));
        }

        return $this->categoryService;
    }

    /**
     * @return SiteService
     */
    public function site()
    {
        if (!$this->siteService) {
            $this->siteService = new SiteService(new SiteRepository($this->getClient()));
        }

        return $this->siteService;
    }

    /**
     * @return TagService
     */
    public function tag()
    {
        if (!$this->tagService) {
            $this->tagService = new TagService(new TagRepository($this->getClient()));
        }

        return $this->tagService;
    }

    /**
     * @return VocabularyService
     */
    public function vocabulary()
    {
        if (!$this->vocabularyService) {
            $this->vocabularyService = new VocabularyService(new VocabularyRepository($this->getClient()));
        }

        return $this->vocabularyService;
    }
}
