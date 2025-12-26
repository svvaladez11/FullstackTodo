<?php

namespace App\Ship\Providers;

use App\Ship\Core\Loaders\MigrationsLoader;
use App\Ship\Parents\Providers\ServiceProviderParent;
use Illuminate\Pagination\Paginator;
//use Illuminate\Support\Facades\URL;

final class ShipServiceProvider extends ServiceProviderParent
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        if (class_exists(\Barryvdh\Debugbar\Facades\Debugbar::class)) {
            $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
        $this->loadMigrationsFrom([
            ...new MigrationsLoader()->loadMigrations(),
        ]);
    }
}
