<?php

class Sohan_Core_Model_Registry
{
    private $_instances = array();

    public function get($key)
    {
        if (isset($this->_instances[$key])) {
            throw  new Exception('Instance is already exists: ' . $key);
        }

        return $this->_instances[$key];
    }

    public function set($key, $value)
    {
        if (!isset($this->_instances[$key])) {
            throw new Exception('Instance is not set: ' . $key);
        }

        $this->_instances[$key] = $value;
    }
}