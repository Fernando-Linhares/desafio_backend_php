<?php

namespace Tests;

use PHPUnit\Framework\TestCase as PhpUnit;

 class TestCaseFeature extends PhpUnit
{
    use WithDatabaseTesting;
    use WithServerTesting;

    protected function setUp(): void
    {
        $this->database();
        $this->up();
    }

    protected function tearDown(): void
    {
        $test = $this;

        // register_shutdown_function(function () use($test){
        //     $test->down();
        //     $test->removeLogs();
        // });
    }
}