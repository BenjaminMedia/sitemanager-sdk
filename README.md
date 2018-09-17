# SiteManager SDK [![CircleCI](https://circleci.com/gh/BenjaminMedia/sitemanager-sdk/tree/master.svg?style=svg)](https://circleci.com/gh/BenjaminMedia/sitemanager-sdk/tree/master)

## Installation
`composer require bonnier/sitemanager-sdk`

## Setup
Make sure to have the sitemanager host in your `.env`-file, or pass the SiteManager host to the SiteManager constructor:
```
SITE_MANAGER_HOST=https://site-manager.test
```
or
```php
$siteManager = new SiteManager('https://site-manager.test');
```

## Usage
First of all you'll need to instantiate the SiteManager class:
```php
use Bonnier/SiteManager/SiteManager;

$siteManager = new SiteManager();
```
Then you'll be ready to interact with SiteManager
#### Apps
```php
// Retrieve a collection of all apps in SiteManager
$siteManager->app()->getAll();

// Get a specific app from SiteManager
$siteManager->app()->getById(1);
```
#### Brands
```php
// Retrieve a collection of all brands in SiteManager
$siteManager->brand()->getAll();

// Get a specific brand from SiteManager
$siteManager->brand()->getById(1);
```
#### Categories
```php
// Retrieve a collection of all categories in SiteManager
$siteManager->category()->getAll();

// Get a specific category from SiteManager
$siteManager->category()->getById(1);

// Get a specific category by its Contenthub ID from SiteManager
$siteManager->category()->getByContenthubId('abc123');

// Get a collection of categories by a specific brand in from SiteManager
$siteManager->category()->getByBrandId(1);
```
#### Sites
```php
// Retrieve a collection of all the sites in SiteManager
$siteManager->site()->getAll();

// Get a specific site from SiteManager
$siteManager->site()->getById(1);
```
#### Tags
```php
// Retrieve a collection of all the tags in SiteManager
$siteManager->tag()->getAll();

// Get a specific tag from SiteManager
$siteManager->tag()->getById(1);

// Get a specific tag by its Contenthub ID from SiteManager
$siteManager->tag()->getByContenthubId('abc123');

// Get a collection of tags by a specific brand from SiteManager
$siteManager->tag()->getByBrandId(1);
```
#### Vocabularies
```php
// Retrieve a collection of all the vocabularies in SiteManager
$siteManager->vocabulary()->getAll();

// Get a specific vocabulary from SiteManager
$siteManager->vocabulary()->getById(1);

// Get a collection of vocabularies by a specific brand from SiteManager
$siteManager->vocabulary()->getByBrandId(1)
```
