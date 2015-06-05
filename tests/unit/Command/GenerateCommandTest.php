<?php

namespace SatisGen\Tests\Command;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Application\GenerateApplication;
use SatisGen\Command\GenerateCommand;
use SatisGen\Tests\SatisGenVfsTest;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Filesystem;

class GenerateCommandTest extends SatisGenVfsTest
{

    protected $commandTester;

    public function setUp() {
        parent::setUp();

        // VFS
        $this->vfsInputFile->setContent('<?php echo \'test\';');

        // Command
        $command = $this->application->find('generate');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecute() {
        $this->commandTester->execute(array(
            'input_file' => $this->vfsInputFile->url(),
            'output_file' => $this->vfsOutputFile->url()
        ));

        $this->assertRegExp('/Generating\.\.\. OK/s', $this->commandTester->getDisplay());
        $this->assertEquals('test', $this->vfsOutputFile->getContent());
    }

    public function testExecuteInputNotFound() {
        $inputFile = 'doesnotexist.php';

        $this->commandTester->execute(array(
            'input_file' => $inputFile,
            'output_file' => $this->vfsOutputFile->url()
        ));

        $this->assertRegExp('/Error: '.$inputFile.' not found/', $this->commandTester->getDisplay());
    }

}
