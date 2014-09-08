<?php
echo "This is {$_SERVER['SCRIPT_NAME']}";

spl_autoload_register(null, false);

spl_autoload_extensions('.php');

function classLoader($class)
{
    $filename = strtolower(str_replace('_', '/', $class)) . '.php';
    echo '</br>'.$filename;
    if (!file_exists($filename))
    {
        return false;
    }
    include $filename;
}

spl_autoload_register('classLoader');

require 'app/Router.php';

$router = Router::getInstance();
//phpinfo();
?>