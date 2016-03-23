<?php 
namespace Languara\Laravel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LanguaraPush extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'languara:push';

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
        $languara = \Languara\Laravel\Wrapper\LanguaraWrapper::get_instance();
        $this->description = $languara->get_message_text('notice_push_command_info');
        
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $languara = \Languara\Laravel\Wrapper\LanguaraWrapper::get_instance();
        
        echo PHP_EOL;
        $languara->print_message('notice_starting_upload', 'SUCCESS');
        echo PHP_EOL;
        
        try
        {
            $languara->upload_local_translations();            
        } 
        catch (\Exception $ex) 
        {
            echo PHP_EOL;
            ($languara->print_message($ex->getMessage(), 'FAILURE'));
            echo PHP_EOL;
            return;
        }
        
        echo PHP_EOL;
        ($languara->print_message('success_upload_successful', 'SUCCESS'));
        echo PHP_EOL . PHP_EOL;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
//			array('example', InputArgument::REQUIRED, 'An example argument.'),
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
