<?php

class Object
{
    protected  $_data = array();

    public function __construct()
    {
        if (func_num_args() == 0) {

        } elseif (func_num_args() == 1) {
            if (!is_array(func_get_arg(0))) {
                throw new Exception("Argument must be array or pair of strings.");
            }
            $this->addData(func_get_arg(0));
        } elseif (func_num_args() == 2) {
            $this->setData(func_get_arg(0), func_get_arg(1));
        } else {
            throw new Exception("Wrong argument.");
        }
    }

    public function __call($name, $arguments)
    {
        $method = strtolower(substr($name, 0, 3)) . 'Data';
        preg_match_all("/[A-Z][a-z]*/", substr($name, 3), $matches);
        $key = strtolower(implode('_', $matches[0]));
        switch ($method) {
            case 'setData':
                $this->setData($key, $arguments[0]);
                break;
            case 'getData':
                return $this->getData($key);
                break;
            case 'hasData':
                return $this->hasData($key);
                break;
            case 'unsData':
                $this->unsData($key);
                break;
            default:
                throw new Exception('No such method: ' . $method);
        }
    }

    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function getData($key)
    {
        if (!isset($this->_data[$key])) {
           return null;
        }
        return $this->_data[$key];
    }

    public function hasData($key)
    {
        return isset($this->_data[$key]);
    }

    public function unsData($key)
    {
        unset($this->_data[$key]);
    }

    public function addData(array $data)
    {
        foreach ($data as $key => $value) {
            $this->setData($key, $value);
        }
    }
}