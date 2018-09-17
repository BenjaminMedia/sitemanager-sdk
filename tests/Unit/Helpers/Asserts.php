<?php

namespace Bonnier\SiteManager\Tests\Unit\Helpers;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Models\Category;
use Bonnier\SiteManager\Models\Site;
use Bonnier\SiteManager\Models\Tag;
use Bonnier\SiteManager\Models\Vocabulary;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class Asserts extends TestCase
{
    public static function assertApp(App $app, $data)
    {
        self::assertInstanceOf(App::class, $app);
        self::assertEquals($data->id, $app->getId());
        self::assertEquals($data->app_code, $app->getCode());
        self::assertEquals($data->content_hub_id, $app->getContenthubId());

        self::assertInstanceOf(\DateTime::class, $app->getCreated());
        self::assertInstanceOf(\DateTime::class, $app->getUpdated());
        self::assertInstanceOf(Collection::class, $app->getNames());
        self::assertEquals($data->created_at, $app->getCreated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->updated_at, $app->getUpdated()->format(Generators::DATE_FORMAT));
        self::assertCount(4, $app->getNames());
        foreach ($data->name as $locale => $name) {
            self::assertEquals($name, $app->getName($locale));
        }
    }

    public static function assertBrand(Brand $brand, $data)
    {
        self::assertInstanceOf(Brand::class, $brand);
        self::assertEquals($data->id, $brand->getId());
        self::assertEquals($data->brand_code, $brand->getCode());
        self::assertEquals($data->content_hub_id, $brand->getContenthubId());
        self::assertEquals($data->primary_color, $brand->getPrimaryColor());
        self::assertEquals($data->secondary_color, $brand->getSecondaryColor());
        self::assertEquals($data->tertiary_color, $brand->getTertiaryColor());
        self::assertInternalType('bool', $brand->isLogoBgColorWhite());
        self::assertEquals($data->issues_per_year, $brand->getIssuesPerYear());
        self::assertEquals($data->logo_path, $brand->getLogoPath());

        self::assertInstanceOf(\DateTime::class, $brand->getCreated());
        self::assertInstanceOf(\DateTime::class, $brand->getUpdated());
        self::assertInstanceOf(Collection::class, $brand->getNames());
        self::assertInstanceOf(Collection::class, $brand->getMailSenders());
        self::assertEquals($data->created_at, $brand->getCreated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->updated_at, $brand->getUpdated()->format(Generators::DATE_FORMAT));
        self::assertCount(4, $brand->getNames());
        self::assertCount(4, $brand->getMailSenders());

        foreach ($data->name as $locale => $name) {
            self::assertEquals($name, $brand->getName($locale));
        }

        foreach ($data->mail_from_address as $locale => $mailFromAddress) {
            self::assertEquals($mailFromAddress, $brand->getMailSender($locale));
        }
    }

    public static function assertSite(Site $site, $data)
    {
        self::assertInstanceOf(Site::class, $site);
        self::assertEquals($data->id, $site->getId());
        self::assertEquals($data->name, $site->getName());
        self::assertEquals($data->description, $site->getDescription());
        self::assertEquals($data->domain, $site->getDomain());
        self::assertEquals($data->login_domain, $site->getLoginDomain());
        self::assertEquals($data->api_domain, $site->getApiDomain());
        self::assertEquals($data->language, $site->getLanguage());
        self::assertEquals($data->locale, $site->getLocale());
        self::assertEquals($data->shell_url, $site->getShellUrl());
        self::assertEquals($data->created_at, $site->getCreated()->format('Y-m-d H:i:s'));
        self::assertEquals($data->updated_at, $site->getUpdated()->format('Y-m-d H:i:s'));
        self::assertInternalType('bool', $site->isSecure());
        self::assertEquals($data->cxense_site_id, $site->getCxenseSiteId());
        self::assertEquals($data->facebook_id, $site->getFacebookId());
        self::assertEquals($data->facebook_secret, $site->getFacebookSecret());
        self::assertEquals($data->signup_lead_permission, $site->getSignupLeadPermission());
        self::assertEquals($data->app->id, $site->getApp());
        self::assertEquals($data->brand->id, $site->getBrand());
        self::assertEquals($data->configuration, $site->getConfigurations());
        self::assertEquals($data->configuration->facebook, $site->getConfiguration('facebook'));
        self::assertEquals($data->configuration->facebook->app_id, $site->getConfiguration('facebook.app_id'));
        self::assertEquals($data->configuration->facebook->app_secret, $site->getConfiguration('facebook.app_secret'));
        self::assertEquals($data->configuration->cxense, $site->getConfiguration('cxense'));
        self::assertEquals($data->configuration->cxense->site_id, $site->getConfiguration('cxense.site_id'));
    }

    public static function assertCategory(Category $category, $data)
    {
        self::assertInstanceOf(Category::class, $category);
        self::assertEquals($data->id, $category->getId());
        self::assertEquals($data->created_at, $category->getCreated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->updated_at, $category->getUpdated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->brand->id, $category->getBrand());

        self::assertInstanceOf(Collection::class, $category->getNames());
        self::assertInstanceOf(Collection::class, $category->getDescriptions());
        self::assertInstanceOf(Collection::class, $category->getContenthubIds());
        self::assertInstanceOf(Collection::class, $category->getImages());
        self::assertInstanceOf(Collection::class, $category->getBodies());
        self::assertInstanceOf(Collection::class, $category->getMetaTitles());
        self::assertInstanceOf(Collection::class, $category->getMetaDescriptions());

        self::assertCount(4, $category->getNames());
        self::assertCount(4, $category->getDescriptions());
        self::assertCount(4, $category->getContenthubIds());
        self::assertCount(4, $category->getImages());
        self::assertCount(4, $category->getBodies());
        self::assertCount(4, $category->getMetaTitles());
        self::assertCount(4, $category->getMetaDescriptions());

        self::assertEquals($data->name->da, $category->getName('da'));
        self::assertEquals($data->description->da, $category->getDescription('da'));
        self::assertEquals($data->content_hub_ids->da, $category->getContenthubId('da'));
        self::assertEquals($data->image_url->da, $category->getImage('da'));
        self::assertEquals($data->body->da, $category->getBody('da'));
        self::assertEquals($data->meta_title->da, $category->getMetaTitle('da'));
        self::assertEquals($data->meta_description->da, $category->getMetaDescription('da'));

        if ($data->parent ?? false) {
            self::assertInstanceOf(Category::class, $category->getParent());
            self::assertCategory($category->getParent(), $data->parent);
        }
    }

    public static function assertTag(Tag $tag, $data)
    {
        self::assertInstanceOf(Tag::class, $tag);
        self::assertEquals($data->id, $tag->getId());
        self::assertEquals($data->created_at, $tag->getCreated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->updated_at, $tag->getUpdated()->format(Generators::DATE_FORMAT));
        self::assertEquals($data->brand->id, $tag->getBrand());
        self::assertEquals($data->vocabulary->id, $tag->getVocabulary());

        self::assertInstanceOf(Collection::class, $tag->getNames());
        self::assertInstanceOf(Collection::class, $tag->getContentHubIds());
        self::assertInstanceOf(Collection::class, $tag->getMetaTitles());
        self::assertInstanceOf(Collection::class, $tag->getMetaDescriptions());

        self::assertCount(4, $tag->getNames());
        self::assertCount(4, $tag->getContentHubIds());
        self::assertCount(4, $tag->getMetaTitles());
        self::assertCount(4, $tag->getMetaDescriptions());

        self::assertEquals($data->name->da, $tag->getName('da'));
        self::assertEquals($data->content_hub_ids->da, $tag->getContentHubId('da'));
        self::assertEquals($data->meta_title->da, $tag->getMetaTitle('da'));
        self::assertEquals($data->meta_description->da, $tag->getMetaDescription('da'));
    }

    public static function assertVocabulary(Vocabulary $vocabulary, $data)
    {
        self::assertInstanceOf(Vocabulary::class, $vocabulary);

        self::assertEquals($data->id, $vocabulary->getId());
        self::assertEquals($data->name, $vocabulary->getName());
        self::assertEquals($data->machine_name, $vocabulary->getMachineName());
        self::assertEquals($data->content_hub_id, $vocabulary->getContentHubId());
        self::assertEquals($data->multi_select, $vocabulary->isMultiSelect());
        self::assertEquals($data->brand->id, $vocabulary->getBrand());
    }
}
