<?php
/**
 * Created by PhpStorm.
 * User: Sasha
 * Date: 08.09.14
 * Time: 22:28
 */
abstract class App_IModel {

    const DB_NAME = 'data/news.db';
    private $_db;

    function __construct(){
        if(is_file(self::DB_NAME) and filesize(self::DB_NAME)>0){
            $this->_db = new PDO("sqlite:".self::DB_NAME);
        }else{
            self::dbCreation();
        }
    }

    private function dbCreation(){
        try{
            $this->_db = new PDO("sqlite:".self::DB_NAME);
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
        }catch (PDOException $e){
            echo $e->getCode().":".$e->getMessage();
            $this->_db->rollBack();
            echo "Cannot create DB.<br>";
        }
    }


}