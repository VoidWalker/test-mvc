<?php

class News_Controller_NewsController extends Sohan_Core_Controller_IController
{
    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        //$newsModel = Sohan::getFactory('News_Model_NewsModel');
        $newsModel = Sohan::getModel('news/news');
        $newsModel->init();
        $newsModel->setTableName('news');
        //$model = new News_Model_NewsModel(array('tst' => 'test1', 'test' => 'test2'));
        //echo "<br>TEST: ".$model->getTest();
        //exit;
        $news = $newsModel->getTableByName();

        require_once 'app/code/local/modules/News/View/list.php';
    }
}