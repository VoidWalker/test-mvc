<?php

class Voidwalker_News_Controller_NewsController extends Sohan_Core_Controller_IController
{
    private $_news;

    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        //$newsModel = Sohan::getFactory('Voidwalker_News_Model_NewsModel');
        $newsModel = Sohan::getModel('vn-news');
        //$newsModel = Sohan::getModel('Voidwalker_News_Model_NewsModel');
        $newsModel->init();
        $newsModel->setTableName('news');
        //$model = new News_Model_NewsModel('test', 'testik');
        //echo "<br>TEST: ".$model->getTest();
        //exit;
        $this->_news = $newsModel->getTableByName();
        $this->includeView('list');
    }

    public function setAction()
    {
        $newsModel = Sohan::getModel('vn-news');
        $newsModel->init();
        $newsModel->setTableName('news');
        $newsModel->insertRowInTable(array('title', 'content'), array($_POST['title'], $_POST['content']));
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
        //$this->getAction();
    }

    public function delAction()
    {
        $newsModel = Sohan::getModel('vn-news');
        $newsModel->init();
        $newsModel->setTableName('news');
        $parameters = Sohan::app()->getParameters();
        $newsModel->deleteRowByID($parameters['id']);
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
    }

    public function includeView($view)
    {
        return require 'app/code/local/Voidwalker/News/View/' . $view . '.php';
    }
}