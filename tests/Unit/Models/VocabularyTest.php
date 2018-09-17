<?php

namespace Bonnier\SiteManager\Tests\Unit\Models;

use Bonnier\SiteManager\Models\Vocabulary;
use Bonnier\SiteManager\Tests\Unit\Helpers\Asserts;
use Bonnier\SiteManager\Tests\Unit\Helpers\Generators;
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
        $data = Generators::generateVocabulary();

        $vocabulary = new Vocabulary($data);

        Asserts::assertVocabulary($vocabulary, $data);
    }
}
