<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Vocabulary;
use PHPUnit\Framework\TestCase;

class VocabularyTest extends TestCase
{
    public function testCanHandleNullData()
    {
        $vocabulary = new Vocabulary(null);

        $this->assertNull($vocabulary->getId());
        $this->assertNull($vocabulary->getName());
        $this->assertNull($vocabulary->getMachineName());
        $this->assertNull($vocabulary->getContentHubId());
        $this->assertNull($vocabulary->getBrand());
    }

    public function testCanFormatDataProperly()
    {
        $this->assertTrue(1 === 1);
    }
}
