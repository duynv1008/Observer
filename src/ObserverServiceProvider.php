<?php

namespace DNV\Observer;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider {

	protected $command = [
		'DNV\Observer\commands\CommandObserver',
	];
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot() {
		if ($this->app->runningInConsole()) {
			$this->commands($this->command);
		}
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		//
	}
}
