<?php

spl_autoload_register(null, false);

spl_autoload_extensions('.php');

function classLoader($class)
{
    $paths = array('app/code/core/', 'app/code/local/modules/');
    $classPath = strtolower(str_replace('_', '/', $class)) . '.php';
    echo '</br>' . $classPath;
    foreach ($paths as $path) {
        $filepath = $path . $classPath;
        if (file_exists($filepath)) {
            echo '</br>Include: ' . $filepath;
            include $filepath;
            //break;
        }
    }
}


spl_autoload_register('classLoader');