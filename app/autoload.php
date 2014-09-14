<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 14.09.14
 * Time: 17:00
 */
spl_autoload_register(null, false);

spl_autoload_extensions('.php');

/*function classLoader($class)
{
    $filename = 'app/code/core/'.strtolower(str_replace('_', '/', $class)) . '.php';
    echo '</br>'.$filename;
    if (!file_exists($filename))
    {
        return false;
    }
    include $filename;
}
*/
function classLoader($class)
{
    $paths = array('app/code/core/', 'app/code/local/modules/');
    $classPath = strtolower(str_replace('_', '/', $class)) . '.php';
    echo '</br>'.$classPath;
    foreach ($paths as $path) {
        $filepath = $path.$classPath;
        if(file_exists($filepath)){
            echo '</br>Include: '.$filepath;
            include $filepath;
            //break;
        }
    }
}

spl_autoload_register('classLoader');