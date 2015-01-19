<?php

/**
 * Class Sohan_Core_Model_Config
 *
 * Loads config from modules and merge it with base config file
 */
class Sohan_Core_Model_Config
{
    private static $_instance = null;

    private $_configuration = array();

    /**
     * On class init call ini parser function
     */
    private function __construct()
    {
        $this->_parsConfigFiles();
    }

    public static function loadConfig()
    {
        if (self::$_instance == null) {
            self::$_instance = new Sohan_Core_Model_Config;
        }

        return self::$_instance;
    }

    /**
     * Returns config variable by path "section/name"
     *
     * @param $path
     * @return config element or false if not set
     */
    public function getConfigByPath($path)
    {
        $elements = explode('/', $path);

        return isset($this->_configuration[$elements[0]][$elements[1]]) ? $this->_configuration[$elements[0]][$elements[1]] : false;
    }

    /**
     * On class init pars *.ini files and merge them into one config array
     */
    protected function _parsConfigFiles()
    {
        $this->_configuration = parse_ini_file('app' . DS . 'config' . DS . 'config.ini', true);
        $modules_config_path = glob('app' . DS . 'code' . DS . 'local' . DS . '*' . DS . '*' . DS . 'etc' . DS . 'config.ini');

        /*
        foreach ($modules_config_path as $directory) {
            $this->_configuration = array_replace_recursive($this->_configuration, parse_ini_file($directory, true));
        }

        Profiler::endMeasure();
        */

        $temp_configuration = array();
        foreach ($modules_config_path as $directory) {
            $temp_module_config = parse_ini_file($directory, true);
            foreach ($temp_module_config as $section_name => $variables) {
                foreach ($variables as $variable => $value) {
                    if (!isset($temp_configuration[$section_name][$variable])) {
                        $temp_configuration[$section_name][$variable] = $value;
                    } else {
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
    }
}