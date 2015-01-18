<?php

/**
 * Parent class with methods to provide comfort data saving
 *
 * Class Object
 */
class Object
{
    protected $_data = array();

    /**
     * Can receive array or pair of values
     */
    public function __construct()
    {
        $num_args = func_num_args();
        $args = func_get_args();
        //print_r($args);
        if ($num_args == 1) {
            if (!is_array($args[0])) {
                throw new Exception("Argument must be array or pair of strings.");
            }
            $this->addData($args[0]);
        } elseif ($num_args == 2) {
            $this->setData($args[0], $args[1]);
        }
    }

    /**
     * Based on called method name,
     * perform set,get,unset action or
     * check for presence
     *
     * @param $name
     * @param $arguments
     * @return bool|null
     * @throws Exception
     */
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

    /**
     * Set data to class storage
     *
     * @param $key
     * @param $value
     */
    public function setData($key, $value)
    {
        $this->_data[$key] = $value;
    }

    /**
     * Get value from storage by key
     *
     * @param $key
     * @return null
     */
    public function getData($key)
    {
        if (!isset($this->_data[$key])) {
            return null;
        }

        return $this->_data[$key];
    }

    /**
     * Check data presence by key
     *
     * @param $key
     * @return bool
     */
    public function hasData($key)
    {
        return isset($this->_data[$key]);
    }

    /**
     * Unset data by key
     *
     * @param $key
     */
    public function unsData($key)
    {
        unset($this->_data[$key]);
    }

    /**
     * Add array to storage
     *
     * @param array $data
     */
    public function addData(array $data)
    {
        $this->_data = array_replace($this->_data, $data);
    }
}