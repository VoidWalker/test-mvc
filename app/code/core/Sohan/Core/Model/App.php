<?php

class Sohan_Core_Model_App
{
    private $_namespace = null;

    private $_module = null;

    private $_controller = null;

    private $_method = null;

    private $_parameters = array();

    private $_config;

    public function init()
    {
        $this->_config = Sohan_Core_Model_Config::getInstance();
        $this->splitURL();
        $this->route();
    }

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

    public function route()
    {
        if (class_exists($this->_controller)) {
            $this->_controller = new $this->_controller();
            if (method_exists($this->_controller, $this->_method)) {
                $this->_controller->{$this->_method}();
            } else {
                throw new Exception('Method ' . $this->_method . ' does not exist!');
                //self::ErrorPage404();
            }
        } else {
            throw new Exception('Controller ' . $this->_controller . ' does not exist!');
            //self::ErrorPage404();
        }
    }

    public static function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'noroute');
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getAction()
    {
        return $this->_method;
    }

    public function getParameters()
    {
        return $this->_parameters;
    }

    public function config()
    {
        return $this->_config;
    }
}