<?php

abstract class Sohan_Core_Model_IModel
{
    const DB_NAME = 'data/news.db';
    private $_db;

    function __construct()
    {
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->_db = new PDO($GLOBALS['ini']['DB_TYPE'] . ':host=' . $GLOBALS['ini']['DB_HOST'] . ';dbname=' . $GLOBALS['ini']['DB_NAME'], $GLOBALS['ini']['DB_USER'], $GLOBALS['ini']['DB_PASS'], $options);
    }

    private function dbCreation()
    {
        try {
            $this->openDatabaseConnection();
            //Start transaction
            $this->_db->beginTransaction();

            $sql = "CREATE TABLE News(
                                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                                        title TEXT,
                                        content TEXT,
                                        datetime INTEGER
                                    )";
            $this->_db->exec($sql);
            $sql = "CREATE TABLE Comment(
                                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                                            idUser INTEGER NOT NULL,
                                            idNews INTEGER NOT NULL,
                                            Comment TEXT,
                                            FOREIGN KEY (idUser) REFERENCES User(id),
                                            FOREIGN KEY (idNews) REFERENCES News(id)
                                        )";
            $this->_db->exec($sql);
            $sql = "CREATE TABLE User(
                                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                                            name INTEGER,
                                            surname INTEGER
                                        )";
            $this->_db->exec($sql);
            //End transaction
            $this->_db->commit();
        } catch (PDOException $e) {
            echo $e->getCode() . ":" . $e->getMessage();
            $this->_db->rollBack();
            echo "Cannot create DB.<br>";
        }
    }

    public function getTableByName($table)
    {
        $table = strip_tags($table);
        $sql = "SELECT * FROM $table";
        $result = $this->_db->query($sql);

        return $result->fetchAll();
    }
}