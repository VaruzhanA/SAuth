<?php

namespace App\Providers;

use App\Services\Access\Access;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

/**
 * Class AccessServiceProvider.
 */
class AccessServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method.
     */
    public function boot()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAccess();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerAccess()
    {
        $this->app->bind('access', function ($app) {
            return new Access($app);
        });
    }

    /**
     * Register the blade extender to use new blade sections.
     */
    protected function registerBladeExtensions()
    {
        /*
         * Role based blade extensions
         * Accepts either string of Role Name or Role ID
         */
        Blade::directive('role', function ($role) {
            return "<?php if (app('access')->hasRole({$role})): ?>";
        });

        /*
         * Accepts array of names or id's
         */
        Blade::directive('roles', function ($roles) {
            return "<?php if (app('access')->hasRoles({$roles})): ?>";
        });

        Blade::directive('needsroles', function ($roles) {
            return '<?php if (app("access")->hasRoles('.$roles.', true)): ?>';
        });

        /*
         * Permission based blade extensions
         * Accepts wither string of Permission Name or Permission ID
         */
        Blade::directive('permission', function ($permission) {
            return "<?php if (app('access')->allow({$permission})): ?>";
        });

        /*
         * Accepts array of names or id's
         */
        Blade::directive('permissions', function ($permissions) {
            return "<?php if (app('access')->allowMultiple({$permissions})): ?>";
        });

        Blade::directive('needspermissions', function ($permissions) {
            return '<?php if (app("access")->allowMultiple('.$permissions.', true)): ?>';
        });

        /*
         * Generic if closer to not interfere with built in blade
         */
        Blade::directive('endauth', function () {
            return '<?php endif; ?>';
        });
    }
}
