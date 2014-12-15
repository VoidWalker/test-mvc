<?php

class Sohan_Core_Model_Config
{
    static private $_instance = null;
    private $_configuration = array();

    private function __construct()
    {
        $this->parsConfigFiles();
    }

    static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new Sohan_Core_Model_Config;
        }
        return self::$_instance;
    }

    public function getConfigByPath($path)
    {
        $elements = explode('/', $path);

        return !isset($this->_configuration[$elements[0]][$elements[1]]) ? false : $this->_configuration[$elements[0]][$elements[1]];
    }

    protected function parsConfigFiles()
    {
        $this->_configuration = parse_ini_file('app' . DS . 'config' . DS . 'config.ini', true);
        $modules_config_path = glob('app' . DS . 'code' . DS . 'local' . DS . '*' . DS . '*' . DS . 'etc' . DS . 'config.ini');
        foreach ($modules_config_path as $directory) {
            $this->_configuration = array_replace_recursive($this->_configuration, parse_ini_file($directory, true));
        }

        /*
        $temp_configuration = array();
        foreach ($modules_config_path as $directory) {
            $temp_module_config = parse_ini_file($directory, true);
            foreach ($temp_module_config as $section_name => $variables) {
                foreach ($variables as $variable => $value) {
                    if (!isset($temp_configuration[$section_name][$variable])) {
                        $temp_configuration[$section_name][$variable] = $value;
                    } else {
                        //throw new Exception("Duplicated config in modules. Variable ($variable) in section ($section_name) from directory ($directory) !");
                        trigger_error("Duplicated config in modules. Variable ($variable) in section ($section_name) from directory ($directory) !", E_USER_WARNING);
                    }
                }
            }
        }

        foreach ($temp_configuration as $section_name => $variables) {
            foreach ($variables as $variable => $value) {
                $this->_configuration[$section_name][$variable] = $value;
            }
        }
        */
    }
}