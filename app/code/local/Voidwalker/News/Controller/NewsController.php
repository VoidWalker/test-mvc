<?php

/**
 * Class Voidwalker_News_Controller_NewsController
 *
 * All possible actions with news entity
 */
class Voidwalker_News_Controller_NewsController extends Sohan_Core_Controller_Base
{
    private $_view;

    private $_model;

    /**
     * Activated when action is not specified
     */
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

    /**
     * Returns list of news
     */
    public function getAction()
    {
        $this->_model = Sohan::getModel('vn-news', array('key' => 'value'));
        $this->_model->setTableName('news');
        $this->_view = Sohan::getSingleton('Voidwalker_News_View_ListView');
        //$this->_view->table = $this->_model->getTable();
        $this->_view->setTable($this->_model->getTable());
        $this->_view->render('list.html');
    }

    /**
     * Performs adding a piece of news
     */
    public function addAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->setTableName('news');
        $this->_model->insertRowInTable(array('title', 'content'), array(Sohan_Core_Request::getPost('title'), Sohan_Core_Request::getPost('content')));
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
    }

    /**
     * Called for deleting news line
     */
    public function delAction()
    {
        $this->_model = Sohan::getModel('vn-news');
        $this->_model->setTableName('news');
        $parameters = Sohan_Core_Request::getGet('parameters');
        $this->_model->deleteRowByID($parameters['id']);
        header('Location: http://test-mvc.local/voidwalker/news/news/get');
    }
}