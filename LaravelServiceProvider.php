<?php namespace Languara\Laravel;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Config/routes.php';
        }

        $this->publishes([
            __DIR__ . '/Config/languara.php'         => config_path('languara.php'),
            __DIR__ . '/Config/static_resources.php' => config_path('static_resources.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('languara.push', function () {
            return new Commands\LanguaraPush;
        });
        $this->app->singleton('languara.pull', function () {
            return new Commands\LanguaraPull;
        });
        $this->app->singleton('languara.register', function () {
            return new Commands\LanguaraRegister;
        });
        $this->app->singleton('languara.translate', function () {
            return new Commands\LanguaraTranslate;
        });
        $this->app->singleton('languara.connect', function () {
            return new Commands\LanguaraConnect;
        });

        $this->commands([
            'languara.push',
            'languara.pull',
            'languara.register',
            'languara.translate',
            'languara.connect',
        ]);

        if (is_file(__DIR__ . '/Config/languara.php')) {
            $this->mergeConfigFrom(__DIR__ . '/Config/languara.php', 'languara');
        }
        $this->mergeConfigFrom(__DIR__ . '/Config/static_resources.php', 'static_resources');
    }

}
