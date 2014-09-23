<?php

spl_autoload_register(null, false);

spl_autoload_extensions('.php');

function classLoader($className)
{
    $codePull[] = join(DS, array('app', 'code', 'local')) . DS;
    $codePull[] = join(DS, array('app', 'code', 'core')) . DS;
    $codePull[] = 'lib' . DS;
    $classPath = str_replace('_', DS, $className) . '.php';
    echo '</br>Try to include: ' . $classPath;
    foreach ($codePull as $path) {
        $filePath = $path . $classPath;
        if (file_exists($filePath)) {
            echo '</br>Included: ' . $filePath;
            include_once $filePath;
            break;
        }
    }
}

spl_autoload_register('classLoader');