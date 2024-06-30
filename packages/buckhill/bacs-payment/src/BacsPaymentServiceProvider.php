<?php

namespace Buckhill\BacsPayment;

use Illuminate\Support\ServiceProvider;

class BacsPaymentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/bacs-records.php', 'bacs'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
}
