<?php
define('BP', getcwd());
define('DS', DIRECTORY_SEPARATOR);

require 'app' . DS . 'autoload.php';

final class Sohan
{
    private static $_registry;

    private static $_app;

    /**
     * Main entry point
     */
    public static function run()
    {
        self::$_app = new Sohan_Core_Model_App();
        self::app()->init();
    }

    /**
     * Get class as singleton
     *
     * @param  string $className
     * @return mixed
     */
    public static function getSingleton($className)
    {
        if (self::registry($className) === null) {
            self::register($className, new $className());
        }

        return self::registry($className);
    }

    /**
     * Get clone of class if it is exists
     *
     * @param  string $className
     * @return object
     */
    public static function getClone($className)
    {
        if (self::registry($className) === null) {
            self::register($className, $obj = new $className());
        } else {
            $obj = clone self::registry($className);
        }

        return $obj;
    }

    /**
     * @param $key
     * @param $value
     */
    public static function register($key, $value)
    {
        self::$_registry[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function registry($key)
    {
        return self::$_registry[$key];
    }

    /**
     * @param $key
     */
    public static function unregister($key)
    {
        unset(self::$_registry[$key]);
    }

    /**
     * Get class as factory
     *
     * @param $className
     * @return mixed
     */
    public static function getFactory($className)
    {
        if (self::registry($className) !== null) {
            self::unregister($className);
        }
        self::register($className, new $className());

        return self::registry($className);
    }

    /**
     * @param string $alias - class alias
     * @return mixed
     */
    public static function getModel($alias)
    {
        return self::getSingleton(self::getClassByAlias($alias, 'model'));
    }

    /**
     * @param string $alias - class alias
     * @return mixed
     */
    public static function getHelper($alias)
    {
        return self::getClone(self::getClassByAlias($alias, 'helper'));
    }

    /**
     * @param string $alias - class alias
     * @return mixed
     */
    public static function getController($alias)
    {
        return self::getClone(self::getClassByAlias($alias, 'view'));
    }

    /**
     * @param $path
     * @return mixed
     */
    public static function getConfigByPath($path)
    {
        return self::app()->config()->getConfigByPath($path);
    }

    /**
     * @return mixed
     */
    public static function app()
    {
        return self::$_app;
    }

    /**
     * @param string $className
     * @param string $objectType
     * @return string Transformed alias to proper class name
     * @throws Exception
     */
    protected static function getClassByAlias($className, $objectType)
    {
        list($module, $modelName) = explode('-', $className);
        if (!$module = self::getConfigByPath('alias/' . $module)) {
            throw new SohanException('Alias does not exist!');
        }

        return ucfirst($module) . '_' . ucfirst($objectType) . '_' . ucfirst($modelName) . ucfirst($objectType);
    }
}