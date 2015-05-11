<?php

namespace SatisGen\Tests\Application;

use SatisGen\Application\GenerateApplication;
use SatisGen\Tests\SatisGenTest;
use Symfony\Component\Console\Tester\ApplicationTester;

class GenerateApplicationTest extends SatisGenTest
{

    public function testCommandName() {
        $applicationTester = new ApplicationTester($this->application);
        $applicationTester->run(array('--help'));

        $this->assertRegExp('/generate/', $applicationTester->getDisplay());
    }

}
