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

        $this->assertRegExp('/Generating\.\.\..*OK/s', $commandTester->getDisplay());
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
