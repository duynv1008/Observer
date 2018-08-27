<?php

namespace DNV\Observer\commands;

use DNV\Observer\Support\Stub;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class CommandObserver extends GeneratorCommand {
	/**
	 * The name of argument being used.
	 *
	 * @var string
	 */
	protected $argumentName = 'observer';

	protected $signature = 'dnv:observer {observer} {--model=} {--log=}';
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'dnv:observer';
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate new restful observer for the specified .';
	/**
	 * Get controller name.
	 *
	 * @return string
	 */
	public function getDestinationFilePath() {
		return 'app/Observers/' . $this->getObserverName() . '.php';
	}
	/**
	 * @return string
	 */
	protected function getTemplateContents() {
		return (new Stub($this->getStubName(), [
			'NAMESPACE' => "App\Observers",
			'MODEL' => $this->option('model'),
			'MODEL_LOW' => strtolower($this->option('model')),
			'MODEL_LOG' => $this->option('log'),
			'VAR_LOG' => $this->option('log'),
			'CLASS_NAMESPACE' => $this->getClassNamespace(),
			'CLASS' => class_basename($this->getObserverName()),
		]))->render();
	}
	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return [
			['observer', InputArgument::REQUIRED, 'The name of the observer class.'],
		];
	}
	/**
	 * @return array
	 */
	protected function getOptions() {
		return [
			['model', null, InputOption::VALUE_NONE, 'Generate a model observer'],
		];
	}
	/**
	 * @return array|string
	 */
	protected function getObserverName() {
		$observer = studly_case($this->argument('observer'));
		if (str_contains(strtolower($observer), 'observer') === false) {
			$observer .= 'Observer';
		}
		return $observer;
	}
	public function getDefaultNamespace(): string {
		return "App\Observers";
	}
	/**
	 * Get the stub file name based on the plain option
	 * @return string
	 */
	private function getStubName() {
		return '/Observer.stub';
	}
}