<?php 
namespace Languara\Laravel\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LanguaraTranslate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'languara:translate';

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
        $this->description = $languara->get_message_text('notice_translate_command_info');
        
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
        
        $translation_method = $this->argument('translation_method');
        
        if ($translation_method !== 'machine' && $translation_method !== 'human')
        {
            return $languara->print_message('error_invalid_translation_method', 'FAILURE');
        }
        
        echo PHP_EOL;
        $languara->print_message('notice_start_translate', 'SUCCESS');
        echo PHP_EOL;
        
        try
        {
            $languara->translate($translation_method);            
        } 
        catch (\Exception $ex) 
        {
            echo PHP_EOL;
            ($languara->print_message($ex->getMessage(), 'FAILURE'));
            echo PHP_EOL;
            return;
        }
        
        echo PHP_EOL;
        $languara->print_message('success_translate_completed', 'SUCCESS');
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
			array('translation_method', InputArgument::OPTIONAL, 'The type of translation you want to order, human|machine', 'machine'),
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