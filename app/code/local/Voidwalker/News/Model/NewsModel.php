<?php

/**
 * Class Voidwalker_News_Model_NewsModel
 */
class Voidwalker_News_Model_NewsModel extends Sohan_Core_Model_Base
{
    private static $_table_name = 'news';

    private $_news_collection = array();

    /**
     * Fill the collection of news
     */
    public function fillCollection()
    {
        $stmt = $this->getTable(self::$_table_name);
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $news = new Voidwalker_News_Model_News();
            $news->setId($row[0]);
            $news->setTitle($row[1]);
            $news->setContent($row[2]);
            $this->_news_collection[] = $news;
        }
    }

    public function getCollection()
    {
        return $this->_news_collection;
    }

}