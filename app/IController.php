<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 08.09.14
 * Time: 21:43
 */
abstract class App_IController {

    public function indexAction(){
        echo '</br>Index Action of  IController';
        $newsModel = new Modules_News_Models_NewsModel();
    }
}