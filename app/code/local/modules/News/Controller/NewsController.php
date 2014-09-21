<?php

class News_Controller_NewsController extends Sohan_Core_Model_IController
{
    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        //$newsModel1 = Sohan::getFactory('News_Model_NewsModel');
        $newsModel = Sohan::getFactory('News_Model_NewsModel');
        $newsModel->setTableName('news');
        $news = $newsModel->getTableByName();

        require_once 'app/code/local/modules/News/View/list.php';
    }
}