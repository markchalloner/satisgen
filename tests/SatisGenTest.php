<?php

namespace SatisGen\Tests;

use SatisGen\Application\GenerateApplication;
use SatisGen\Config\ConfigInputReader;
use Symfony\Component\Filesystem\Filesystem;


abstract class SatisGenTest extends \PHPUnit_Framework_TestCase
{

    protected $filesystem;
    protected $application;

    public function setUp()
    {
        // Filesystem
        $this->filesystem = new Filesystem();

        // ConfigInputReader
        $this->configInputReader = new ConfigInputReader();

        // GenerateApplication
        $application = new GenerateApplication($this->filesystem, $this->configInputReader);
        $application->setAutoExit(false);
        $this->application = $application;
    }

}
