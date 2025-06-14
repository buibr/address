<?php


namespace Bi\Address;


use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class AddressProvider extends ServiceProvider
{

    /**
     * @param \Illuminate\Filesystem\Filesystem $filesystem
     */
    public function boot(Filesystem $filesystem)
    {
        if (function_exists('config_path')) {
            $this->publishes([
                __DIR__ . '/../config/addresses.php' => config_path('addresses.php')
            ], 'config');

            $this->publishes([
                __DIR__ . '/../migrations/2020_05_20_012233_create_addresses_table.php' => database_path('/migrations/2020_05_20_012233_create_addresses_table'),
            ], 'migrations');
        }

        $this->loadMigrationsFrom(__DIR__ . '/Migrations/');

    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/addresses.php',
            'addresses'
        );
    }
}
