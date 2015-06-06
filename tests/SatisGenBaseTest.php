<?php

namespace SatisGen\Tests;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamFile;
use SatisGen\Application\GenerateApplication;
use SatisGen\Config\ConfigReader;
use SatisGen\Config\DotEnvWriter;
use SatisGen\Config\EnvReader;
use SatisGen\Config\InputReader;
use Symfony\Component\Filesystem\Filesystem;

abstract class SatisGenBaseTest extends \PHPUnit_Framework_TestCase
{

    protected $filesystem;
    protected $dotEnvWriter;
    protected $inputReader;
    protected $envReader;
    protected $configReader;
    protected $application;
    protected $inputStream;

    public function setUp() {
       
        // Filesystem
        $this->filesystem = new Filesystem();

        // VFS
        $this->vfsRoot = vfsStream::setup();
        $this->vfsEnvFile = vfsStream::newFile('.env')->at($this->vfsRoot);

        // Config
        $this->dotEnvWriter = new DotEnvWriter($this->filesystem, $this->vfsEnvFile->url());
        $this->inputReader  = new InputReader($this->dotEnvWriter);
        $this->envReader    = new EnvReader();
        $this->configReader = new ConfigReader($this->envReader, $this->inputReader);

        // GenerateApplication
        $this->application = new GenerateApplication($this->filesystem, $this->configReader);
        $this->application->setAutoExit(false);

    }
    
   
    protected function getInputStream($input) {
        $stream = fopen('php://memory', 'r+', false);
        fputs($stream, $input);
        rewind($stream);
        return $stream;
    }

}
