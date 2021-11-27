<?php

namespace Modules\Core\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapModuleRoutes();
    }

    /**
     * Map routes from all enabled modules.
     *
     * @return void
     */
    private function mapModuleRoutes()
    {
        foreach ($this->app['modules']->allEnabled() as $module) {
            $this->groupRoutes("Modules\\{$module->getName()}\\Http\\Controllers", function () use ($module) {
                $this->mapAdminRoutes("{$module->getPath()}/Routes/admin.php");
                $this->mapPublicRoutes("{$module->getPath()}/Routes/web.php");
                $this->mapApiRoutes("{$module->getPath()}/Routes/api.php");
            });
        }
    }

    /**
     * Group routes to common prefix and middleware.
     *
     * @param string $namespace
     * @param \Closure $callback
     * @return void
     */
    private function groupRoutes($namespace, $callback)
    {
        Route::group([
            'namespace'  => $namespace,
            'prefix'     => '',
            'middleware' => ['web'],
        ], function () use ($callback) {
            $callback();
        });
    }

    /**
     * Map admin routes.
     *
     * @return void
     */
    private function mapAdminRoutes($path)
    {
        if (!file_exists($path)) {
            return;
        }

        Route::group([
            'namespace'  => 'Admin',
            'prefix'     => 'v1/admin',
            'middleware' => ['api', 'auth:sanctum', 'admin'],
        ], function () use ($path) {
            require_once $path;
        });
    }

    /**
     * Map public routes.
     *
     * @param string $path
     * @return void
     */
    private function mapPublicRoutes($path)
    {
        if (file_exists($path)) {
            require_once $path;
        }
    }

    private function mapApiRoutes($path)
    {
        if (!file_exists($path)) {
            return;
        }
        Route::group([
            'namespace'  => 'Api',
            'prefix'     => 'v1',
            'middleware' => ['api'],
        ], function () use ($path) {
            require_once $path;
        });
    }
}
