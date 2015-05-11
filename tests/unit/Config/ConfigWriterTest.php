<?php

namespace SatisGen\Tests\Config;

use \Dotenv;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
//use SatisGen\Application\GenerateApplication;
//use SatisGen\Command\GenerateCommand;
use SatisGen\Config\ConfigWriter;
use SatisGen\Tests\SatisGenTest;
use Symfony\Component\Console\Tester\CommandTester;
//use Symfony\Component\Filesystem\Filesystem;

class ConfigWriterTest extends SatisGenTest
{

    private $outputFile;
    private $envFile;
    private $root;

    public function setUp()
    {
        parent::setUp();

        // TODO - dedupe with GenerateCommandTest.php?
        // VFS
        $root = vfsStream::setup();
        $this->envFile = vfsStream::newFile('.env')
                                     ->withContent('CONFIG_WRITER_INT=0'."\n".'CONFIG_WRITER_FLOAT=9.99')
                                     ->at($root);
        $this->root = $root;
    }

    public function testConfigWriterSetEnvs()
    {
        $application = $this->application;
        $envFile = $this->envFile;
        $root = $this->root;

        $configWriter = new ConfigWriter($this->filesystem, $envFile->url());
        $configWriter->setEnvs(array(
            'CONFIG_WRITER_INT' => 999,
            'CONFIG_WRITER_STRING' => 'foobar'
        ));

        Dotenv::load($root->url());

        // Read from .env
        $this->assertEquals(999, getenv('CONFIG_WRITER_INT'));
        $this->assertEquals(9.99, getenv('CONFIG_WRITER_FLOAT'));
        $this->assertEquals('foobar', getenv('CONFIG_WRITER_STRING'));
    }

    public function testConfigWriterSetEnv() {
        $application = $this->application;
        $envFile = $this->envFile;
        $root = $this->root;

        $configWriter = new ConfigWriter($this->filesystem, $envFile->url());
        $configWriter->setEnv('CONFIG_WRITER_INT', 999);
        
        Dotenv::load($root->url());

        // Read from .env
        $this->assertEquals(999, getenv('CONFIG_WRITER_INT'));
        $this->assertEquals(9.99, getenv('CONFIG_WRITER_FLOAT'));
    }

}