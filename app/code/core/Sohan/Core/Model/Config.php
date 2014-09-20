<?php

class Sohan_Core_Model_Config
{
    private static $_configuration = array();

    public static function init()
    {
        self::$_configuration = parse_ini_file('config' . DS . 'config.ini', true);
    }

    public static function getConfig($path)
    {
        list($section, $parameter) = explode('/', $path);
        if (!isset(self::$_configuration[$section][$parameter])) {
            throw new Exception('No such parameter.');
        }

        return self::$_configuration[$section][$parameter];
    }
}