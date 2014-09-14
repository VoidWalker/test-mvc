<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 08.09.14
 * Time: 7:51
 */

class News_Controller_NewsController extends Sohan_Core_IController {

    public function indexAction(){
        echo '</br>Index Action of News Controller';
    }

    public function getAction() {
        $newsModel = new News_Model_NewsModel();
        $news = $newsModel->getTableByName('news');

        require_once 'app/code/local/modules/News/View/list.php';


    }

}