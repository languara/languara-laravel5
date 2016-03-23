<?php namespace Languara\Laravel;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider {

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
		$this->package('languara/laravel');
        
        include __DIR__.'/Config/routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['languara.push'] = $this->app->share(function()
        {
            return new Commands\LanguaraPush;
        });
        $this->app['languara.pull'] = $this->app->share(function()
        {
            return new Commands\LanguaraPull;
        });
		$this->app['languara.register'] = $this->app->share(function()
        {
            return new Commands\LanguaraRegister;
        });
        $this->app['languara.translate'] = $this->app->share(function()
        {
            return new Commands\LanguaraTranslate;
        });
		$this->app['languara.connect'] = $this->app->share(function()
        {
            return new Commands\LanguaraConnect;
        });

        $this->commands(array(
            'languara.push',
            'languara.pull',
            'languara.register',
            'languara.translate',
            'languara.connect',
        ));
        
        include __DIR__.'/Config/routes.php';
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
