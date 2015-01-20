<?php

/**
 * Main application class
 *
 * Class Sohan_Core_Model_App
 */
class Sohan_Core_Model_App
{
    private $_namespace = null;

    private $_module = null;

    private $_controller = null;

    private $_method = null;

    private $_parameters = array();

    private $_config;

    /**
     * Start point of application
     * Load config, initialize DB, processes URL
     */
    public function init()
    {
        $this->_config = Sohan_Core_Config::loadConfig();
        Sohan_Core_DB::DBInit();
        Sohan_Core_Request::URLparser();
        $this->callAction();
    }

    /**
     * Call the action of requested controller
     *
     * @throws SohanException
     */
    public function callAction()
    {
        $controller = Sohan_Core_Request::getGet('controller');
        $method = Sohan_Core_Request::getGet('method');
        if (class_exists($controller)) {
            $controller = new $controller();
            if (method_exists($controller, $method)) {
                $controller->{$method}();
            } else {
                throw new SohanException('Method ' . $method . ' does not exist!');
                //self::ErrorPage404();
            }
        } else {
            throw new SohanException('Controller ' . $controller . ' does not exist!');
            //self::ErrorPage404();
        }
    }

    /**
     * Redirect to 404 page
     */
    public static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'noroute');
    }

    /**
     * @return controller name
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @return action name
     */
    public function getAction()
    {
        return $this->_method;
    }

    /**
     * Array of parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->_parameters;
    }

    /**
     * Get config object
     *
     * @return mixed
     */
    public function config()
    {
        return $this->_config;
    }
}