<?php

class Voidwalker_News_Controller_NewsController extends Sohan_Core_Controller_IController
{
    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        //$newsModel = Sohan::getFactory('Voidwalker_News_Model_NewsModel');
        $newsModel = Sohan::getModel('vn/news');
        $newsModel->init();
        $newsModel->setTableName('news');
        //$model = new News_Model_NewsModel('test', 'testik');
        //echo "<br>TEST: ".$model->getTest();
        //exit;
        $news = $newsModel->getTableByName();

        require_once 'app/code/local/Voidwalker/News/View/list.php';
    }
}