<?php 
namespace Languara\Laravel\Commands;

use Illuminate\Console\Command;
use Languara\Laravel\Wrapper\LanguaraWrapper;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LanguaraConnect extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'languara:connect';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $languara = LanguaraWrapper::get_instance();
        $this->description = $languara->get_message_text('notice_connect_command_info');
        
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{        
        $languara = LanguaraWrapper::get_instance();
        
        $private_api_key = $this->argument('private_api_key');

		if (! $private_api_key  ) {
            return $languara->print_message('error_invalid_private_key', 'FAILURE');
        }
        
        echo PHP_EOL;
        $languara->print_message('notice_start_connect', 'SUCCESS');
        echo PHP_EOL;
        
        try
        {
            $languara->connect($private_api_key, $languara->platform);
        } 
        catch (\Exception $ex) 
        {
            echo PHP_EOL;
            ($languara->print_message($ex->getMessage(), 'FAILURE'));
            echo PHP_EOL;
            return;
        }
        
        echo PHP_EOL;
        $languara->print_message('success_connected', 'SUCCESS');
        echo PHP_EOL . PHP_EOL;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		$languara = LanguaraWrapper::get_instance();

		return array(
			array('private_api_key', InputArgument::OPTIONAL),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}