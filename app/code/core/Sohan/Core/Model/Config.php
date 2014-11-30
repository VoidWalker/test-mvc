<?php

class Sohan_Core_Model_Config
{
    private $_configuration = array();

    public function __construct()
    {
        $this->_configuration = parse_ini_file('app' . DS . 'config' . DS . 'config.ini', true);
        $modules_config_path = glob('app' . DS . 'code' . DS . 'local' . DS . '*' . DS . '*' . DS . 'config' . DS . 'config.ini');
        foreach ( $modules_config_path as $directory ) {
            $temp_config = parse_ini_file($directory, true);
            foreach ($temp_config as $section_name => $variables) {
                foreach ($variables as $variable => $value) {
                    if(!isset($this->_configuration[$section_name][$variable]))
                        $this->_configuration[$section_name][$variable] = $value;
                    else
                        throw new Exception("Duplicated config variable ($variable) in section ($section_name) from directory ($directory) !");
                }
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