<?php

class Sohan_Core_View_Base extends Object
{
    public $_storage = array();

    public function __set($name, $value) {
        $this->_storage[$name] = $value;
    }
    
    public function __get($name) {
        return $this->_storage[$name];
    }
}
