<?php

class Sohan_Core_Model_Config
{
    private $_configuration = array();

    public function __construct()
    {
        $this->_configuration = parse_ini_file('app' . DS . 'config' . DS . 'config.ini', true);
        $dirrectories = glob('app' . DS . 'code' . DS . 'local' . DS . '*' . DS . '*' . DS . 'config' . DS . 'config.ini');
        foreach ( $dirrectories as $directory ) {
            $temp_config = parse_ini_file($directory, true);
            foreach ($temp_config as $section_name => $variables) {
                foreach ($variables as $variable => $value) {
                    $this->_configuration[$section_name][$variable] = $value;
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