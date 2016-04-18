<?php

namespace Languara\Laravel\Driver;

use Illuminate\Support\Facades\Lang;

class LaravelResourceGroupDriver implements ResourceGroupDriverInterface
{
    private $language_location = null;
    private $storage_engine = null;
    
    public function load($resource_group_name, $lang_name = null, $file_path = null)
    {               
        Lang::setLocale($lang_name);
        
        return Lang::get($resource_group_name);
    }

    public function save($resource_group_name, $arr_translations, $lang_name = null, $file_path = null)
    {
        $file_path = $this->language_location .'/'. $lang_name .'/'. $resource_group_name .'.php';
        $file_data = '<?php return '. var_export($arr_translations, true) .';';
        
        if (!is_dir($this->language_location .'/'. $lang_name))
        {
            if (! mkdir($this->language_location .'/'. $lang_name)) return false;
        }
        
        return (file_put_contents($file_path, $file_data) === false) ? false : true;
    }
    
    public function set_language_location($language_location)
    {
        $this->language_location = $language_location;
    }
    
    public function set_storage_engine($storage_engine)
    {
        $this->storage_engine = $storage_engine;
    }

}