<?php
namespace DbFakerMask\ServiceProviders;

use Illuminate\Support\ServiceProvider;
use DbFakerMask\DbFakerMask;

class DbFakerMaskServiceProvider extends ServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../../config/db_faker_mask.php');

        if ($this->app->environment('testing')) {
            if (is_file(__DIR__ . '/../../tests/db_faker_mask.php')) {
                $source = realpath(__DIR__ . '/../../tests/db_faker_mask.php');
            }
        }

        $this->publishes([
            $source => config_path('db_faker_mask.php')
        ]);

        $this->mergeConfigFrom($source, 'db_faker_mask');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('db.fakerMask', function ($app) {
            return new DbFakerMask($app['config']['db_faker_mask']);
        });

        // Register command.
        $this->commands([
            'DbFakerMask\Commands\DbFakerMaskCommand'
        ]);
    }
}