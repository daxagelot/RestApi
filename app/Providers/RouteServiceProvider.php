<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
            //--------------------FrontEnd---------------------- 
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/frontend/home.php'));

            //--------------------BackEnd---------------------- 
            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/authentication.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/dashboard.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/profile.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/company.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/location.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/users.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/catalog.php'));
                
            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/product.php'));

                Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/team.php'));

                Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/chat.php'));


            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/bestselling.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/review.php'));

            Route::prefix('jpanel')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/jpanel/contact.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
