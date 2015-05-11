<?php

namespace SatisGen\Tests\Config;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Config\ConfigInputReader;
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

        $configInputReader = new ConfigInputReader();
        $configInputReader->setInput($commandTester->getInput());
        $configInputReader->setOutput($commandTester->getOutput());
        $configInputReader->setHelper($helper);

        // Read from input
        $this->assertEquals(999, $configInputReader->getEnv('CONFIG_READER_INT', 'the test integer', FILTER_VALIDATE_INT));
        // Read from cache
        $this->assertEquals(999, $configInputReader->getEnv('CONFIG_READER_INT', 'the test integer', FILTER_VALIDATE_INT));
    }

    protected function getInputStream($input)
    {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);
        return $stream;
    }

}
/*
<?php

namespace SatisGen\Tests\Command;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Application\GenerateApplication;
use SatisGen\Command\GenerateCommand;
use SatisGen\Tests\SatisGenTest;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

class GenerateCommandTest extends SatisGenTest
{

    private $inputFile;
    private $outputFile;

    public function setUp()
    {
        parent::setUp();

        // VFS
        $root = vfsStream::setup();
        $this->inputFile = vfsStream::newFile('satis.php')
                                     ->withContent('<?php echo \'test\';')
                                     ->at($root);
        $this->outputFile = vfsStream::newFile('satis.json')
                                     ->at($root);
    }

    public function testExecute()
    {
        $command = $this->application->find('generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'input_file' => $this->inputFile->url(),
            'output_file' => $this->outputFile->url()
        ));

        $this->assertRegExp('/Generating... OK/', $commandTester->getDisplay());
        $this->assertEquals('test', $this->outputFile->getContent());
    }

    public function testExecuteInputNotFound()
    {
        $inputFile = 'doesnotexist.php';

        $command = $this->application->find('generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'input_file' => $inputFile,
            'output_file' => $this->outputFile->url()
        ));

        $this->assertRegExp('/Error: '.$inputFile.' not found/', $commandTester->getDisplay());

    }

}
*/
