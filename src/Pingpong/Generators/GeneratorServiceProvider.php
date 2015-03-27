<?php

namespace Pingpong\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorServiceProvider extends ServiceProvider {

	/**
	 * The array of consoles.
	 * 
	 * @var array
	 */
	protected $consoles = [
		'Model',
		'Controller',
		'Console',
		'View',
	];

	/**
	 * Register the service provider.
	 * 
	 * @return void
	 */
	public function register()
	{
		foreach ($this->consoles as $console)
		{
			$this->commands('Pingpong\Generators\Console\\'.$console.'Command');
		}
	}

}