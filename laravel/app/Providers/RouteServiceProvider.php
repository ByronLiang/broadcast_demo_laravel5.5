<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminRoutes();

        $this->mapApiRoutes();

        $this->mapCallbackRoutes();

        $this->mapEmbeddedRoutes();

        $this->mapWebRoutes();
    }

    protected function mapWebRoutes()
    {
        Route::middleware(['web', 'auth.driver:web'])
            ->namespace($this->namespace . '\Web')
            ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes()
    {
        if (request()->expectsJson()) {
            $middlewares[] = 'web';
            $middlewares[] = 'auth.driver:web';
        } else {
            $middlewares[] = 'api';
            $middlewares[] = 'auth.driver:api';
        }
        Route::prefix('api')
            ->middleware($middlewares)
            ->namespace($this->namespace . '\API')
            ->group(base_path('routes/api.php'));
    }

    protected function mapCallbackRoutes()
    {
        Route::prefix('callback')
            ->middleware('api')
            ->namespace($this->namespace . '\Callback')
            ->group(base_path('routes/callback.php'));
    }

    protected function mapEmbeddedRoutes()
    {
        Route::prefix('embedded')
            ->namespace($this->namespace . '\Embedded')
            ->group(base_path('routes/embedded.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware(['web', 'auth.driver:admin'])
            ->namespace($this->namespace . '\Admin')
            ->group(base_path('routes/admin.php'));
    }
}
