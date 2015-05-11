<?php

namespace SatisGen\Tests\Config;

use SatisGen\Config\EnvReader;
use SatisGen\Tests\SatisGenTest;

class EnvReaderTest extends SatisGenTest
{

    private $envReader;

    public function setUp()
    {
        parent::setUp();

        // Config
        $this->envReader = new EnvReader();
    }

    public function testConfigEnvReaderGetEnv()
    {
        $envReader = $this->envReader;
        
        $this->assertEquals(999, $envReader->getEnv('TEST_INT', 'the test integer', FILTER_VALIDATE_INT));
        $this->assertEquals(9.99, $envReader->getEnv('TEST_FLOAT', 'the test float', FILTER_VALIDATE_FLOAT));
        $this->assertEquals('foobar', $envReader->getEnv('TEST_STRING', 'the test string', FILTER_VALIDATE_REGEXP, array('options' => array('regexp' =>'/^[a-zA-Z\s]*$/'))));
    }

}
