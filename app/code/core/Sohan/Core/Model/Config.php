<?php

class Sohan_Core_Model_Config
{
    private $_configuration = array();

    public function __construct()
    {
        $this->_configuration = parse_ini_file('app' . DS . 'config' . DS . 'config.ini', true);
        $modules_config_path = glob('app' . DS . 'code' . DS . 'local' . DS . '*' . DS . '*' . DS . 'config' . DS . 'config.ini');
        $temp_configuration = array();
        foreach ( $modules_config_path as $directory ) {
            $temp_module_config = parse_ini_file($directory, true);
            foreach ($temp_module_config as $section_name => $variables) {
                foreach ($variables as $variable => $value) {
                    if(!isset($temp_configuration[$section_name][$variable]))
                        $temp_configuration[$section_name][$variable] = $value;
                    else
                        //throw new Exception("Duplicated config in modules. Variable ($variable) in section ($section_name) from directory ($directory) !");
                        trigger_error("Duplicated config in modules. Variable ($variable) in section ($section_name) from directory ($directory) !", E_USER_WARNING);
                }
            }
        }

        foreach ($temp_configuration as $section_name => $variables) {
            foreach ($variables as $variable => $value) {
                $this->_configuration[$section_name][$variable] = $value;
            }
        }
    }

    public function getConfigByPath($path)
    {
        $elements = explode('/', $path);
        /*if (!isset($this->_configuration[$section][$parameter])) {
            throw new Exception('No such parameter.');
        }*/
        if (!isset($elements[1])) {
            return $this->_configuration[$elements[0]];
        }

        return $this->_configuration[$elements[0]][$elements[1]];
    }
}