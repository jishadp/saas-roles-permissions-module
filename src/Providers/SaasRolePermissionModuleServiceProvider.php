<?php

namespace Jishadp\SaasRolesPermissions\Providers;

use Illuminate\Support\ServiceProvider;

class SaasRolePermissionModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $this->mergeMenusConfig();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'roles');
        $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')],'migrations');
        $this->publishes([__DIR__.'/../datatables' => app_path('DataTables/User')],'datatables');
        $this->publishes([__DIR__.'/../assets/js' => public_path('vendor/jishadp/roles/js/')],'assets');
    }


}
