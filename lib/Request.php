<?php

/**
 * Wrap of default Post array
 *
 * Class Request
 */
class Request
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
}