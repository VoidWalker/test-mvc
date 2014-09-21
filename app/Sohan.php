<?php

require 'app' . DIRECTORY_SEPARATOR . 'autoload.php';

define('BP', getcwd());
define('DS', DIRECTORY_SEPARATOR);

final class Sohan
{
    private static $_registry;

    private static $_app;

    private static $_config;

    public static function run()
    {
        self::$_app = new Sohan_Core_Model_App();
        self::$_config = self::$_app->getConfig();
        self::$_app->init();
    }

    public static function getSingleton($className)
    {
        if (self::registry($className) === null) {
            self::register($className, new $className());
        }

        return self::registry($className);
    }

    public static function register($key, $value)
    {
        self::$_registry[$key] = $value;
    }

    public static function registry($key)
    {
        return self::$_registry[$key];
    }

    public static function unregister($key)
    {
        unset(self::$_registry[$key]);
    }

    public static function getFactory($className)
    {
        if (self::registry($className) !== null) {
            self::unregister($className);
        }
        self::register($className, new $className());

        return self::registry($className);
    }

    public static function getConfigByPath($path)
    {
        return self::$_config->getConfig($path);
    }
}