<?php

/**
 * Class Sohan_Core_Request
 *
 * Wrap of default Post array
 */
class Sohan_Core_Request
{
    /**
     * Return value from POST array by key
     *
     * @param $variable
     * @return mixed
     */
    public static function getPost($variable)
    {
        if (isset($_POST[$variable])) {
            return $_POST[$variable];
        } else {
            trigger_error('Does not set!');
        }
    }

    /**
     * Return value from GET array by key
     *
     * @param $variable
     * @return mixed
     */
    public static function getGet($variable)
    {
        if (isset($_GET[$variable])) {
            return $_GET[$variable];
        } else {
            trigger_error('Does not set!');
        }
    }

    /**
     * Pars the URL to extract information about
     * namespace, module, controller, action, parameters
     */
    public static function URLparser()
    {
        $parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $namespace = !empty($parts[0]) ? ucfirst($parts[0]) : null;
        $module = !empty($parts[1]) ? ucfirst($parts[1]) : null;
        $_GET['controller'] = !empty($parts[2]) ? $namespace . '_' . $module . '_Controller_' . ucfirst($parts[2]) . 'Controller' : 'Sohan_Core_Controller_IndexController';
        $_GET['method'] = !empty($parts[3]) ? $parts[3] . 'Action' : 'indexAction';
        if (isset($parts[4])) {
            $keys = $values = array();
            for ($i = 4; $i < count($parts); $i++) {
                if ($i % 2 == 0) {
                    $keys[] = $parts[$i];
                } else {
                    $values[] = $parts[$i];
                }
            }
            $_GET['parameters'] = array_combine($keys, $values);
        }
    }
}