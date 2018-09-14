<?php

namespace Bonnier\SiteManager\Tests\Unit\Helpers;

use Bonnier\SiteManager\Models\App;
use Bonnier\SiteManager\Models\Brand;
use Bonnier\SiteManager\Models\Site;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class Asserts extends TestCase
{
    public static function assertApp(App $app, $data)
    {
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
}
