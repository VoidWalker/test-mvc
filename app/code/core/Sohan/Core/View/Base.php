<?php

class Sohan_Core_View_Base
{
    public $_storage = array();
    
    private $templatePath;
    
    //abstract public function render($view);
    
    public function __set($name, $value) {
        $this->_storage[$name] = $value;
    }
    
    public function __get($name) {
        return $this->_storage[$name];
    }
    
    public function render($view)
    {
        include $this->templatePath . $view;
    }
}
