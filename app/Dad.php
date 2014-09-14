<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 14.09.14
 * Time: 16:48
 */
final class Dad {

    const BP = 'test-mvc.local';

    private static $_app;

    public static function run(){
        require 'app/autoload.php';
        require 'app/config.php';
        self::$_app = new Sohan_Core_App();

    }

}