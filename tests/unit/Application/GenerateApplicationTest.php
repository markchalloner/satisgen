<?php

namespace SatisGen\Tests\Application;

use SatisGen\Application\GenerateApplication;
use SatisGen\Tests\SatisGenBaseTest;
use Symfony\Component\Console\Tester\ApplicationTester;

class GenerateApplicationTest extends SatisGenBaseTest
{

    public function testCommandName() {
        $applicationTester = new ApplicationTester($this->application);
        $applicationTester->run(array('--help'));

        $this->assertRegExp('/generate/', $applicationTester->getDisplay());
    }

}
