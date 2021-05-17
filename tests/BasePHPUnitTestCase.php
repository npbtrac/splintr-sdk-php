<?php

namespace Splintr\PhpSdk\Tests;

use PHPUnit\Framework\TestCase;

class BasePHPUnitTestCase extends TestCase
{
    public function writeHeading($heading)
    {
        fwrite(STDOUT, "\n");
        fwrite(STDOUT, "========\n");
        fwrite(STDOUT, $heading."\n");
        fwrite(STDOUT, "========\n");
    }
}
