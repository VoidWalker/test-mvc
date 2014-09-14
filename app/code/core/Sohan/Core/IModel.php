<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 08.09.14
 * Time: 22:28
 */
abstract class Sohan_Core_IModel {

    const DB_NAME = 'data/news.db';
    private $_db;

    function __construct(){

        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        $this->_db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
    }

    private function dbCreation(){
        try{
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
        }catch (PDOException $e){
            echo $e->getCode().":".$e->getMessage();
            $this->_db->rollBack();
            echo "Cannot create DB.<br>";
        }
    }

    public function getTableByName($table){
        $table = strip_tags($table);
        $sql = "SELECT * FROM $table";
        $result = $this->_db->query($sql);


        return $result->fetchAll();

    }


}