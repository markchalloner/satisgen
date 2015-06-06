<?php

namespace SatisGen\Tests\Config;

use \Dotenv;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Tests\SatisGenVfsTest;
use Symfony\Component\Console\Tester\CommandTester;

class ConfigReaderTest extends SatisGenVfsTest
{

    public function setUp() {
        parent::setUp();

        $command = $this->application->find('generate');
        $commandTester = new CommandTester($command);

        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream('999'));
        
        $commandTester->execute(array(
            'input_file' => $this->vfsInputFile->url(),
            'output_file' => $this->vfsOutputFile->url()
        ));
        
        $this->inputReader->setInput($commandTester->getInput());
        $this->inputReader->setOutput($commandTester->getOutput());
        $this->inputReader->setQuestionHelper($helper);
    }
    
    public function testConfigReaderGetConfigFromInput() {   
        $this->assertConfigEquals(999);
    }
    
    public function testConfigReaderGetConfigFromEnv() {
        $this->vfsEnvFile->withContent('CONFIG_READER_INT=999');
        Dotenv::load($this->vfsRoot->url());
        $this->assertConfigEquals(999);
    } 
    
    protected function assertConfigEquals($value) {
        $this->assertEquals(
            999, 
            $this->configReader->getConfig('CONFIG_READER_INT', 'the test integer', null, function($answer) {
                if (0 === preg_match('/^\d+$/', $answer)) {
                    throw new \RuntimeException(
                        'The answer should be an integer'
                    );
                }
                return $answer;
            })
        );
    }

}
