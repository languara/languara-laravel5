<?php
namespace Languara\Laravel\Wrapper;

class LanguaraWrapper extends \Languara\Library\Lib_Languara
{
    public static function get_instance()
    {        
        static $instance = null;
        if ($instance == null) $instance = new static();
        
        return $instance;
    }
    
    public function __construct()
    {
        parent::__construct();
        
        $config = array();
        
        try
        {
            $static_resources = include_once __DIR__ .'/../Config/static_resources.php';
            $config = include_once __DIR__ .'/../Config/languara.php';
        }
        catch(\Exception $e)
        {}
        
        $this->language_location = (isset($config['language_location'])) ? app_path() . $config['language_location'] : null;
        $this->conf = (isset($config['conf'])) ? $config['conf'] : null;
        $this->endpoints = $static_resources['endpoints'];
        $this->arr_messages = $static_resources['messages'];
        $this->origin_site = $static_resources['origin_site'];
        $this->config_files = $static_resources['config_files'];
        $this->platform = $static_resources['platform'];
        $this->driver = new \Languara\Laravel\Driver\LaravelResourceGroupDriver();        
        $this->driver->set_storage_engine($this->conf['storage_engine']);
        $this->driver->set_language_location($this->language_location);
        
        // change config files to have absoluth paths
        if (is_array($this->config_files))
        {
            foreach ($this->config_files as $config_key => $config_file)
            {
                $this->config_files[$config_key] = __DIR__ .'/../'. $config_file;
            }
        }
    }
}
