<?php

spl_autoload_register(null, false);

spl_autoload_extensions('.php');

function classLoader($className)
{
    $codePull[] = join(DIRECTORY_SEPARATOR, array('app', 'code', 'core')) . DIRECTORY_SEPARATOR;
    $codePull[] = join(DIRECTORY_SEPARATOR, array('app', 'code', 'local', 'modules')) . DIRECTORY_SEPARATOR;
    //print_r($codePull);
    //$paths = array('app\code\core\\', 'app\code\local\modules\\');
    $classPath = strtolower(str_replace('_', DIRECTORY_SEPARATOR, $className)) . '.php';
    echo '</br>' . $classPath;
    foreach ($codePull as $path) {
        $filepath = $path . $classPath;
        if (file_exists($filepath)) {
            echo '</br>Include: ' . $filepath;
            include $filepath;
            //break;
        }
    }
}

spl_autoload_register('classLoader');