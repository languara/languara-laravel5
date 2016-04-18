<?php
namespace Languara\Laravel\Wrapper;

use Languara\Laravel\Driver\LaravelResourceGroupDriver;
use Languara\Library\Lib_Languara;

class LanguaraWrapper extends Lib_Languara
{
    public static function get_instance()
    {
        static $instance = null;
        if ($instance == null) {
            $instance = new static();
        }

        return $instance;
    }

    public function __construct()
    {
        parent::__construct();

        $this->language_location = (config('languara.language_location') !== null) ? base_path() . config('languara.language_location') : null;
        $this->conf = (config('languara.conf') !== null) ? config('languara.conf') : null;
        $this->endpoints = config('static_resources.endpoints');
        $this->arr_messages = config('static_resources.messages');
        $this->origin_site = config('static_resources.origin_site');
        $this->config_files = config('static_resources.config_files');
        $this->platform = config('static_resources.platform');
        $this->driver = new LaravelResourceGroupDriver();
        $this->driver->set_storage_engine($this->conf['storage_engine']);
        $this->driver->set_language_location($this->language_location);

        // change config files to have absolute paths
        if (is_array($this->config_files)) {
            foreach ($this->config_files as $config_key => $config_file) {
                $this->config_files[$config_key] = __DIR__ . '/../' . $config_file;
            }
        }
    }
}
