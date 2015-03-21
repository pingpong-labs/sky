<?php namespace Pingpong\Oembed;

use Illuminate\Support\ServiceProvider;

/**
 * Class OembedServiceProvider
 * 
 * @package Pingpong\Oembed
 * @author  Pingpong Labs <pingpong.labs@gmail.com>
 * @author  Gravitano <gravitano16@gmail.com>
 * @license https://github.com/pingpong-labs/oembed/blob/master/LICENSE MIT
 */
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
		//
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
			return new Oembed(new Embed, $app['cache.store']);
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
