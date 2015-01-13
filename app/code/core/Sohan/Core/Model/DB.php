<?php

class Sohan_Core_Model_DB
{
    const DB_NAME = 'data/news.db';

    protected static $_instance = null;

    protected $_db;

    protected function __construct()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            $this->_db = new PDO(Sohan::getConfigByPath('DB/DB_TYPE') . ':host=' . Sohan::getConfigByPath('DB/DB_HOST') . ';dbname=' . Sohan::getConfigByPath('DB/DB_NAME'), Sohan::getConfigByPath('DB/DB_USER'), Sohan::getConfigByPath('DB/DB_PASS'), $options);
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
    }

    public static function DBInit()
    {
        if (self::$_instance == null) {
            self::$_instance = new Sohan_Core_Model_DB();
        }
        return self::$_instance;
    }

    public function DB()
    {
        return $this->_db;
    }
} 