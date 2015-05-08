<?php

require __DIR__.'/../vendor/autoload.php';

use SatisGen\Application\GenerateApplication;
use SatisGen\Command\GenerateCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Filesystem\Filesystem;

$application = new GenerateApplication(new Filesystem());
$application->run();
