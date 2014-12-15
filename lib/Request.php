<?php

class Request
{
    public static function getPost($variable)
    {
        if (isset($_POST[$variable])) {
            return $_POST[$variable];
        } else {
            trigger_error('Does not set!');
        }
    }

    public static function getGet($variable)
    {
        if (isset($_GET[$variable])) {
            return $_GET[$variable];
        } else {
            trigger_error('Does not set!');
        }
    }
}