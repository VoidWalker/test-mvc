<?php

class Object
{
    protected  $_data = array();

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
                $this->getData($key);
                break;
            case 'hasData':
                $this->hasData($key);
                break;
            case 'unsData':
                $this->unsData($key);
                break;
            default:
                throw new Exception('No such method: ' . $method);
        }
    }

    private function setData($key, $value)
    {
        $this->_data[$key] = $value;
    }

    private function getData($key)
    {
        return $this->_data[$key];
    }

    private function hasData($key)
    {
        return isset($this->_data[$key]);
    }

    private function unsData($key)
    {
        unset($this->_data[$key]);
    }

}