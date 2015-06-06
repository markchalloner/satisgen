<?php

namespace SatisGen\Tests\Config;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Tests\SatisGenVfsTest;
use Symfony\Component\Console\Tester\CommandTester;

class SatisGenTest extends SatisGenVfsTest
{
    private $inputFile;
    private $outputFile;
    private $envFile;

    public function setUp()
    {
        parent::setUp();

        // VFS
        $this->vfsInputFile->withContent(file_get_contents(__DIR__.'/../fixtures/satis.php'));
    }
    
    public function testSatisGen() {
        $command = $this->application->find('generate');
        $commandTester = new CommandTester($command);

        $helper = $command->getHelper('question');
        $helper->setInputStream($this->getInputStream(
            'Test'."\n".
            'www.test.com'."\n".
            '0123456789ABCDEF'."\n"
        ));
        
        $commandTester->execute(array(
            'input_file' => $this->vfsInputFile->url(),
            'output_file' => $this->vfsOutputFile->url()
        ));
        
        $this->assertEquals(file_get_contents(__DIR__.'/../fixtures/satis.json'), $this->vfsOutputFile->getContent());

    }

}
