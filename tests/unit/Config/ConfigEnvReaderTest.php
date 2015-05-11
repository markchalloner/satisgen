<?php

namespace SatisGen\Tests\Config;

//use org\bovigo\vfs\vfsStream;
//use org\bovigo\vfs\vfsStreamFile;
//use SatisGen\Application\GenerateApplication;
//use SatisGen\Command\GenerateCommand;
use SatisGen\Config\ConfigEnvReader;
use SatisGen\Tests\SatisGenTest;
//use Symfony\Component\Console\Tester\CommandTester;
//use Symfony\Component\Filesystem\Filesystem;

class ConfigEnvReaderTest extends SatisGenTest
{

    private $ConfigEnvReader;

    public function setUp()
    {
        parent::setUp();

        // Config
        $this->ConfigEnvReader = new ConfigEnvReader();
    }

    public function testConfigEnvReaderGetEnv()
    {
        $this->assertEquals(999, $this->ConfigEnvReader->getEnv('TEST_INT', 'the test integer', FILTER_VALIDATE_INT));
        $this->assertEquals(9.99, $this->ConfigEnvReader->getEnv('TEST_FLOAT', 'the test float', FILTER_VALIDATE_FLOAT));
        $this->assertEquals('foobar', $this->ConfigEnvReader->getEnv('TEST_STRING', 'the test string', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' =>'/^[a-zA-Z\s]*$/'))));
    }

}
