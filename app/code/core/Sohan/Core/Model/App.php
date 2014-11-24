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
        $this->_config = new Sohan_Core_Model_Config();
        $this->splitURL();
        $this->route();
    }

    private function splitURL()
    {
        //$alias = array('test' => 'news/news');
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Check for alias
        //foreach ($parts as $part) {

        //}
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
                    $values[] = $parts[$i];
                } else {
                    $keys[] = $parts[$i];
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
                throw new Exception('Method does not exist!');
            }
        } else {
            throw new Exception('Controller does not exist!');
        }
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