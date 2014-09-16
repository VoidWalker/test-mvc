<?php

require 'app/autoload.php';

final class Dad
{
    const BP = 'test-mvc.local';

    private static $_singletone = array();

    private static $_registry;

    private static $_app;

    public static function run()
    {
        self::$_app = new Sohan_Core_Model_App();
    }

    public static function getSingleton($className)
    {
        if (!(self::$_singletone[$className] instanceof $className)) {
            self::$_singletone[$className] = new $className;
        }
        return self::$_singletone[$className];
    }

    public static function getRegistry()
    {
        if (!(self::$_registry instanceof Sohan_Core_Model_Registry)) {
            self::$_registry = new Sohan_Core_Model_Registry();
        }
        return self::$_registry;
    }
}