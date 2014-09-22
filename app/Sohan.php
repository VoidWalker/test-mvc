<?php

define('BP', getcwd());
define('DS', DIRECTORY_SEPARATOR);

require 'app' . DS . 'autoload.php';

final class Sohan
{
    private static $_registry;

    private static $_app;

    private static $_config;

    public static function run()
    {
        self::$_app = new Sohan_Core_Model_App();
        self::app()->init();
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

    public static function getModel($alias)
    {
        list($module, $modelName) = explode('/', $alias);
        $className = ucfirst($module) . '_Model_' . ucfirst($modelName) . 'Model';

        return new $className();
    }

    public static function getHelper()
    {
    }

    public static function getController()
    {
    }

    public static function getConfigByPath($path)
    {
        return self::app()->config()->getConfigByPath($path);
    }

    public static function app()
    {
        return self::$_app;
    }
}