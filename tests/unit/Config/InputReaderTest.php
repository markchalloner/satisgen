<?php

namespace SatisGen\Tests\Config;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Config\InputReader;
use SatisGen\Tests\SatisGenTest;
use Symfony\Component\Console\Tester\CommandTester;

class ConfigInputReaderTest extends SatisGenTest
{

    private $inputFile;
    private $outputFile;
    private $envFile;

    public function setUp()
    {
        parent::setUp();

        // TODO - dedupe with GenerateCommandTest.php
        // VFS
        $root = vfsStream::setup();
        $this->inputFile = vfsStream::newFile('satis.php')
                                     ->withContent('<?php echo \'test\';')
                                     ->at($root);
        $this->outputFile = vfsStream::newFile('satis.json')
                                     ->at($root);
    }

    public function testConfigInputReaderGetEnv()
    {
        $application = $this->application;
        $outputFile = $this->outputFile;

        $command = $application->find('generate');
        $commandTester = new CommandTester($command);

        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream('999'));

        $commandTester->execute(array(
            'input_file' => $this->inputFile->url(),
            'output_file' => $this->outputFile->url()
        ));

        $inputReader = new InputReader();
        $inputReader->setInput($commandTester->getInput());
        $inputReader->setOutput($commandTester->getOutput());
        $inputReader->setHelper($helper);

        // Read from input
        $this->assertEquals(999, $inputReader->getEnv('CONFIG_READER_INT', 'the test integer', FILTER_VALIDATE_INT));
        // Read from cache
        $this->assertEquals(999, $inputReader->getEnv('CONFIG_READER_INT', 'the test integer', FILTER_VALIDATE_INT));
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);
        return $stream;
    }

}