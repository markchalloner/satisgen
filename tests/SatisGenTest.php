<?php

namespace SatisGen\Tests;

use SatisGen\Application\GenerateApplication;
use Symfony\Component\Filesystem\Filesystem;

abstract class SatisGenTest extends \PHPUnit_Framework_TestCase
{

    protected $filesystem;
    protected $application;

    public function setUp()
    {
        // Filesystem
        $this->filesystem = new Filesystem();

        // GenerateApplication
        $application = new GenerateApplication($this->filesystem);
        $application->setAutoExit(false);
        $this->application = $application;
    }

}
