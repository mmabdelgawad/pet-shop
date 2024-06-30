<?php

namespace Buckhill\BacsPayment\Tests;

use Buckhill\BacsPayment\BacsPaymentServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            BacsPaymentServiceProvider::class,
        ];
    }
}
