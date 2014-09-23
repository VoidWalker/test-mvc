<?php

class Object
{
    protected $_data = array();

    public function __construct()
    {
        $num_args = func_num_args();
        $args = func_get_args();
        print_r($args);
        if ($num_args == 1) {
            if (!is_array($args[0])) {
                throw new Exception("Argument must be array or pair of strings.");
            }
            $this->addData($args[0]);
        } elseif ($num_args == 2) {
            $this->setData($args[0], $args[1]);
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
        $this->_data = array_merge($this->_data, $data);
    }
}