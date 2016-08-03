<?php

namespace Inoplate\Auth\Providers;

use Gate;
use Inoplate\Auth\Access\GateInterceptor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(GateContract $gate)
    {
        $this->loadTranslation();

        $gate->before(function ($user, $ability, $model) {
            $interceptor = new GateInterceptor($this->app['permission.store']);

            return $interceptor->check($user, $ability, $model); 
        });
    }

    public function register()
    {
        $this->app->singleton('Inoplate\Auth\Contracts\Permission\Repository',
            'Inoplate\Auth\Permission\InMemoryRepository');

        $this->app->alias('Inoplate\Auth\Contracts\Permission\Repository', 'permission.store');
    }

    /**
     * Load packages's translation
     * 
     * @return void
     */
    protected function loadTranslation()
    {
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'inoplate-auth');
    }
}