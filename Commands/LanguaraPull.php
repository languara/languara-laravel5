<?php 
namespace Languara\Laravel\Commands;

use Illuminate\Console\Command;
use Languara\Laravel\Wrapper\LanguaraWrapper;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LanguaraPull extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'languara:pull';

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
        $this->description = $languara->get_message_text('notice_pull_command_info');
        
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
        
        echo PHP_EOL;
        $languara->print_message('notice_starting_download', 'SUCCESS');
        echo PHP_EOL;
        
        try
        {
            $languara->download_and_process();            
        } 
        catch (\Exception $ex) 
        {
            echo PHP_EOL;
            $languara->print_message($ex->getMessage(), 'FAILURE');
            echo PHP_EOL;
            return;
        }
        
        echo PHP_EOL;
        $languara->print_message('success_download_successful', 'SUCCESS');
        echo PHP_EOL . PHP_EOL;
	}

}
