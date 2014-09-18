<?php

require 'app/autoload.php';

const BP = 'test-mvc.local';

final class Sohan
{
    private static $_registry;

    private static $_app;

    public static function run()
    {
        self::$_app = new Sohan_Core_Model_App();
    }

    public static function getSingleton($className)
    {
        if (!isset(self::$_registry[$className])) {
            self::$_registry[$className] = new $className();
        }

        return self::$_registry[$className];
    }

    public static function register($key, $value)
    {
        if (isset(self::$_registry[$key])) {
            throw new  Exception('This key is already set: ' . $key);
        }
        self::$_registry[$key] = $value;
    }

    public static function registry($key)
    {
        if (!isset(self::$_registry[$key])) {
            throw new Exception('This key is not set: ' . $key);
        }

        return self::$_registry[$key];
    }

    public static function unregister($key)
    {
        if (!isset(self::$_registry[$key])) {
            throw new Exception('This key is not set: ' . $key);
        }
        unset(self::$_registry[$key]);
    }

    public static function getFactory($className)
    {
        if (isset(self::$_registry[$className])) {
            self::unregister($className);
        }
        self::register($className, new $className());

        return self::$_registry[$className];
    }

}