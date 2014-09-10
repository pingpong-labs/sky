<?php namespace Pingpong\Oembed;

use Embed\Embed;
use Illuminate\Support\ServiceProvider;

class OembedServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the package.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->package('pingpong/oembed');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('oembed', function ($app)
		{
			return new Oembed(new Embed, $app['cache']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('oembed');
	}

}
