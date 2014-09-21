<?php

class Sohan_Core_Model_Config
{
    private $_configuration = array();

    public function __construct()
    {
        $this->_configuration = parse_ini_file('config' . DS . 'config.ini', true);
    }

    public function getConfig($path)
    {
        list($section, $parameter) = explode('/', $path);
        if (!isset($this->_configuration[$section][$parameter])) {
            throw new Exception('No such parameter.');
        }

        return $this->_configuration[$section][$parameter];
    }
}