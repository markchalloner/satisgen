<?php

namespace SatisGen\Tests\Config;

use SatisGen\Tests\SatisGenBaseTest;

class DotEnvWriterTest extends SatisGenBaseTest
{

    private $outputFile;
    private $envFile;
    private $root;
    private $writer;

    public function setUp() {
        parent::setUp();
        
        $this->vfsEnvFile->withContent('DOT_ENV_WRITER_INT=999'."\n");
    }

    public function testDotEnvWriterSetConfigs() {
        $this->dotEnvWriter->setConfigs(array(
            'DOT_ENV_WRITER_INT' => 999,
            'DOT_ENV_WRITER_FLOAT' => 9.99,
            'DOT_ENV_WRITER_STRING' => 'foobar'
        ));

        $this->dotenv->load();

        // Read from .env
        $this->assertEquals(999, getenv('DOT_ENV_WRITER_INT'));
        $this->assertEquals(9.99, getenv('DOT_ENV_WRITER_FLOAT'));
        $this->assertEquals('foobar', getenv('DOT_ENV_WRITER_STRING'));
    }

    public function testDotEnvWriterSetConfig() {
        $this->dotEnvWriter->setConfig('DOT_ENV_WRITER_STRING', 'foobar');

        $this->dotenv->load();

        // Read from .env
        $this->assertEquals('foobar', getenv('DOT_ENV_WRITER_STRING'));
    }

}