<?php

abstract class Sohan_Core_View_IView
{
    public $_storage = array();
    
    abstract public function render($view);
    
    public function __set($name, $value) {
        $this->_storage[$name] = $value;
    }
    
    public function __get($name) {
        $this->_storage[$name];
    }
}
