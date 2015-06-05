<?php

namespace SatisGen\Tests\Config;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Tests\SatisGenVfsTest;
use Symfony\Component\Console\Tester\CommandTester;

class InputReaderTest extends SatisGenVfsTest
{

    public function testInputReaderGetConfig()
    {
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

        // Read from input
        $this->assertEquals(
            999,
            $this->inputReader->getConfig('CONFIG_READER_INT', 'the test integer', null, function($answer) {
                if (!is_int($answer)) {
                    throw new \RuntimeException(
                        'The answer should be an integer'
                    );
                }
                return $answer;
            })
        );
        // Read from cache
        $this->assertEquals(
            999,
            $this->inputReader->getConfig('CONFIG_READER_INT', 'the test integer', null, function($answer) {
                if (!is_int($answer)) {
                    throw new \RuntimeException(
                        'The answer should be an integer'
                    );
                }
                return $answer;
            })
        );
    }

}