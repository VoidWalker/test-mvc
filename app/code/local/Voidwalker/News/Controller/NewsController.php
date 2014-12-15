<?php

class Voidwalker_News_Controller_NewsController extends Sohan_Core_Controller_IController
{
    private $_news;

    private $_model;

    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function getAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->init();
        $this->_model->setTableName('news');
        $this->_news = $this->_model->getTableByName();
        $this->includeView('list');
    }

    public function addAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->init();
        $this->_model->setTableName('news');
        $this->_model->insertRowInTable(array('title', 'content'), array(Request::getPost('title'), Request::getPost('content')));
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
    }

    public function delAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->init();
        $this->_model->setTableName('news');
        $parameters = Sohan::app()->getParameters();
        $this->_model->deleteRowByID($parameters['id']);
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
    }

    public function includeView($view)
    {
        return require 'app/code/local/Voidwalker/News/View/' . $view . '.php';
    }
}