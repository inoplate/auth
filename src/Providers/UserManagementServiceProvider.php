<?php

namespace Inoplate\UserManagement\Providers;

use Gate;
use Inoplate\UserManagement\Access\GateInterceptor;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class UserManagementServiceProvider extends ServiceProvider
{
    public function boot(GateContract $gate)
    {
        $this->loadMigration();

        $gate->before(function ($user, $ability, $model) {
            $interceptor = new GateInterceptor($this->app['permission.store']);

            return $interceptor->check($user, $ability, $model); 
        });
    }

    public function register()
    {
        $this->app->singleton('Inoplate\UserManagement\Contracts\Permission\Repository',
            'Inoplate\UserManagement\Permission\InMemoryRepository');

        $this->app->alias('Inoplate\UserManagement\Contracts\Permission\Repository', 'permission.store');
    }

    /**
     * Load packages migration
     * 
     * @return void
     */
    protected function loadMigration()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}