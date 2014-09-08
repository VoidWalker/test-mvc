<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 07.09.14
 * Time: 21:29
 */

//namespace app;


class Router {

    private $_controller = null;

    private $_method = null;

    private $_parameters = array();

    static private $_instance;

    public static function getInstance(){
        if(!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    private function __construct(){
        $this->splitURL();
        $this->route();
    }

    private function splitURL(){
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        //Get controller
        $this->_controller = !empty($parts[0]) ? 'Modules_'.ucfirst($parts[0]).'_Controllers_'.ucfirst($parts[0]).'Controller' : 'App_IndexController';
        //Get action
        $this->_method = !empty($parts[1]) ? $parts[1].'Action' : 'indexAction';
        //Get parameters
        if($parts[2]){
            $keys = $values = array();
            for($i = 2; $i < count($parts); $i++){
                if($i%2 == 0){
                    $keys[] = $parts[$i];
                }else{
                    $values[] = $parts[$i];
                }
            }
            $this->_parameters = array_combine($keys, $values);
        }
    }

    public function route(){
        if(class_exists($this->_controller)){

            $this->_controller = new $this->_controller();
            if(method_exists($this->_controller, $this->_method)){
                $this->_controller->{$this->_method}();
            }
        }
    }

    public function getController(){
        return $this->_controller;
    }

    public function getAction(){
        return $this->_method;
    }

    public function getParameters(){
        return $this->_parameters;
    }

} 