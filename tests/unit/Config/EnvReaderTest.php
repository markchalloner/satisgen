<?php

namespace SatisGen\Tests\Config;

use \Dotenv;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Config\EnvReader;
use SatisGen\Tests\SatisGenBaseTest;

class EnvReaderTest extends SatisGenBaseTest
{

    public function setUp() {
        parent::setUp();

        // VFS
        $this->vfsEnvFile->withContent(file_get_contents(__DIR__.'/../../fixtures/.env'));

        // Dotenv
        Dotenv::load($this->vfsRoot->url());

    }

    public function testConfigEnvReaderGetConfig() {
        $this->assertEquals(999, $this->envReader->getConfig('ENV_READER_INT'));
        $this->assertEquals(9.99, $this->envReader->getConfig('ENV_READER_FLOAT'));
        $this->assertEquals('foobar', $this->envReader->getConfig('ENV_READER_STRING'));
    }

}
