<?php

class Sohan_Core_Model_App
{
    private $_module = null;

    private $_controller = null;

    private $_method = null;

    private $_parameters = array();

    public function __construct()
    {
        $this->splitURL();
        $this->route();
    }

    private function splitURL()
    {
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Get module
        $this->_module = !empty($parts[0]) ? ucfirst($parts[0]) : null;
        //Get controller
        $this->_controller = !empty($parts[1]) ? $this->_module . '_Controller_' . ucfirst($parts[1]) . 'Controller' : 'Sohan_Core_IndexController';
        //Get action
        $this->_method = !empty($parts[2]) ? $parts[2] . 'Action' : 'indexAction';
        //Get parameters
        if ($parts[3]) {
            $keys = $values = array();
            for ($i = 3; $i < count($parts); $i++) {
                if ($i % 2 == 0) {
                    $values[] = $parts[$i];
                } else {
                    $keys[] = $parts[$i];
                }
            }
            $this->_parameters = array_combine($keys, $values);
            print_r($this->_parameters);
        }
    }

    public function route()
    {
        if (class_exists($this->_controller)) {
            $this->_controller = new $this->_controller();
            if (method_exists($this->_controller, $this->_method)) {
                $this->_controller->{$this->_method}();
            }
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
} 