<?php
define('BP', getcwd());
define('DS', DIRECTORY_SEPARATOR);

require 'app' . DS . 'autoload.php';

final class Sohan
{
    private static $_alias;

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

    public static function getModel($class)
    {
        $className = self::getClassByName($class, 'model');
        if (self::registry($className) !== null) {
            return self::registry($className);
        } else {
            return new $className();
        }
    }

    public static function getHelper($class)
    {
        $className = self::getClassByName($class, 'helper');
        if (self::registry($className) !== null) {
            return self::registry($className);
        } else {
            return new $className();
        }
    }

    public static function getController($class)
    {
        $className = self::getClassByName($class, 'view');
        if (self::registry($className) !== null) {
            return self::registry($className);
        } else {
            return new $className();
        }
    }

    public static function getConfigByPath($path)
    {
        return self::app()->config()->getConfigByPath($path);
    }

    public static function app()
    {
        return self::$_app;
    }

    /**
     * @param string $className
     * @param string $objectType
     * @return string
     * @throws Exception
     */
    protected static function getClassByName($className, $objectType)
    {
        if (strpos($className, '-') !== false) {
            list($module, $modelName) = explode('-', $className);
            if (!$module = self::getConfigByPath('alias/' . $module)) {
                throw new Exception('Alias does not exist!');
            }
            $className = ucfirst($module) . '_' . ucfirst($objectType) . '_' . ucfirst($modelName) . ucfirst($objectType);
            return $className;
        }
        return $className;
    }
}