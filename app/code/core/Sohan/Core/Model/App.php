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

    private $_db;

    /**
     * Start point of application
     * Load config, initialize DB, processes URL
     */
    public function init()
    {
        $this->_config = Sohan_Core_Model_Config::loadConfig();
        Sohan_Core_Model_DB::DBInit();
        $this->splitURL();
        $this->route();
    }

    /**
     * Pars the URL to extract information about
     * namespace, module, controller, action, parameters
     */
    private function splitURL()
    {
        //$alias = array('test' => 'news/news');
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Get namespace
        $this->_namespace = !empty($parts[0]) ? ucfirst($parts[0]) : null;
        //Get module
        $this->_module = !empty($parts[1]) ? ucfirst($parts[1]) : null;
        //Get controller
        $this->_controller = !empty($parts[2]) ? $this->_namespace . '_' . $this->_module . '_Controller_' . ucfirst($parts[2]) . 'Controller' : 'Sohan_Core_Controller_IndexController';
        //Get action
        $this->_method = !empty($parts[3]) ? $parts[3] . 'Action' : 'indexAction';
        //Get parameters
        if (isset($parts[4])) {
            $keys = $values = array();
            for ($i = 4; $i < count($parts); $i++) {
                if ($i % 2 == 0) {
                    $keys[] = $parts[$i];
                } else {
                    $values[] = $parts[$i];
                }
            }
            $this->_parameters = array_combine($keys, $values);
        }
    }

    /**
     * Call the action of requested controller
     *
     * @throws SohanException
     */
    public function route()
    {
        if (class_exists($this->_controller)) {
            $this->_controller = new $this->_controller();
            if (method_exists($this->_controller, $this->_method)) {
                $this->_controller->{$this->_method}();
            } else {
                throw new SohanException('Method ' . $this->_method . ' does not exist!');
                //self::ErrorPage404();
            }
        } else {
            throw new SohanException('Controller ' . $this->_controller . ' does not exist!');
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