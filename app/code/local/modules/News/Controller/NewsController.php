<?php

class News_Controller_NewsController extends Sohan_Core_Model_IController
{
    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        //$newsModel = Sohan::getSingleton('News_Model_NewsModel');
        $newsModel = Sohan::getFactory('News_Model_NewsModel');
        //$newsModel = new News_Model_NewsModel();
        $news = $newsModel->getTableByName('news');

        require_once 'app/code/local/modules/News/View/list.php';
    }
}