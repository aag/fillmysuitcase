<?php

/**
 * A Command that runs all of the available tests and outputs
 * the results to the console.
 */

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RunTests extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run all automated tests';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		passthru('vendor/bin/phpunit');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
