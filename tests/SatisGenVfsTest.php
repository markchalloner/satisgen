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

abstract class SatisGenVfsTest extends SatisGenBaseTest
{

    protected $vfsInputFile;
    protected $vfsOutputFile;

    public function setUp()
    {
        parent::setUp();
        
        // VFS
        $this->vfsInputFile = vfsStream::newFile('satis.php')->at($this->vfsRoot);
        $this->vfsOutputFile = vfsStream::newFile('satis.json')->at($this->vfsRoot);
    }
    
}
