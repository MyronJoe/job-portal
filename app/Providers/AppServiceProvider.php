<?php

namespace App\Providers;

use App\Models\Settings;
use App\Models\tags;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function($view){
            $view->with('tags', tags::orderBy('id', 'asc')->paginate(6));

            $view->with('settings', Settings::findOrFail('1'));

        });
    }
}
