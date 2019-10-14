<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Http\Controllers\VoyagerSettingsController;
use App\Http\Controllers\Admin\Core\VoyagerBaseController as LocalBaseController;
use App\Http\Controllers\Admin\Core\VoyagerSettingsController as LocalSettingsController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VoyagerBaseController::class, LocalBaseController::class);
        $this->app->bind(VoyagerSettingsController::class, LocalSettingsController::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
