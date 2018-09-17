<?php

namespace Bonnier\SiteManager\Tests\Unit;

use Bonnier\SiteManager\Services\AppService;
use Bonnier\SiteManager\Services\BrandService;
use Bonnier\SiteManager\Services\CategoryService;
use Bonnier\SiteManager\Services\SiteService;
use Bonnier\SiteManager\Services\TagService;
use Bonnier\SiteManager\Services\VocabularyService;
use Bonnier\SiteManager\SiteManager;
use GuzzleHttp\Psr7\Uri;
use PHPUnit\Framework\TestCase;

class SiteManagerTest extends TestCase
{
    public function testCanCreateInstanceWithEnvSetting()
    {
        $siteManager = new SiteManager();

        $this->assertUriIsEqual(getenv('SITE_MANAGER_HOST'), $siteManager->getClient()->getConfig('base_uri'));
    }

    public function testCanCreateInstanceWithConstructorSetting()
    {
        $host = 'https://test-site-manager.test';

        $siteManager = new SiteManager($host);

        $this->assertUriIsEqual($host, $siteManager->getClient()->getConfig('base_uri'));
    }

    public function testThrowsErrorWhenSettingMissing()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Missing Site Manager Host argument!');

        putenv('SITE_MANAGER_HOST=');

        new SiteManager();
    }

    public function testThrowsErrorWhenParsingInvalidHost()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/\'.*\' is not a valid URL!/');

        new SiteManager('this is not a valid host');
    }

    private function assertUriIsEqual(string $expected, Uri $actual)
    {
        $expectedScheme = parse_url($expected, PHP_URL_SCHEME);
        $expectedHost = parse_url($expected, PHP_URL_HOST);
        $expectedPath = parse_url($expected, PHP_URL_PATH);
        $expectedQuery = parse_url($expected, PHP_URL_QUERY);

        $this->assertEquals($expectedScheme, $actual->getScheme());
        $this->assertEquals($expectedHost, $actual->getHost());
        $this->assertEquals($expectedPath, $actual->getPath());
        $this->assertEquals($expectedQuery, $actual->getQuery());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetAppService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(AppService::class, $siteManager->app());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetBrandService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(BrandService::class, $siteManager->brand());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetCategoryService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(CategoryService::class, $siteManager->category());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetSiteService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(SiteService::class, $siteManager->site());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetTagService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(TagService::class, $siteManager->tag());
    }

    /**
     * @dataProvider getSiteManager
     * @param SiteManager $siteManager
     */
    public function testCanGetVocabularyService(SiteManager $siteManager)
    {
        $this->assertInstanceOf(VocabularyService::class, $siteManager->vocabulary());
    }

    public function getSiteManager()
    {
        return [
            [new SiteManager('http://site-manager.test')],
        ];
    }
}
