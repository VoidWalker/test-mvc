<?php

/**
 * Class Voidwalker_News_Controller_NewsController
 */
class Voidwalker_News_Controller_NewsController extends Sohan_Core_Controller_Base
{
    private $_view;

    private $_model;

    public function indexAction()
    {
        echo '</br>Index Action of News Controller';
    }

    public function testAction()
    {
        for ($i = 0; $i < 100; $i++) {
            Profiler::startMeasure('Cloned_model');
            $this->_model = Sohan::getModel('vn-news');
        }
        Profiler::endMeasure('Cloned_model');
    }

    public function getAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->init();
        $this->_model->setTableName('news');
        $this->_view = Sohan::getSingleton('Voidwalker_News_View_ListView');
        //$this->_view->table = $this->_model->getTable();
        $this->_view->setTable($this->_model->getTable());
        $this->_view->render('list.html');
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