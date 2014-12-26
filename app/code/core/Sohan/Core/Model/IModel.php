<?php

abstract class Sohan_Core_Model_IModel extends Object
{
    const DB_NAME = 'data/news.db';
    private $_db;

    public function init()
    {
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        try {
            $this->_db = new PDO(Sohan::getConfigByPath('DB/DB_TYPE') . ':host=' . Sohan::getConfigByPath('DB/DB_HOST') . ';dbname=' . Sohan::getConfigByPath('DB/DB_NAME'), Sohan::getConfigByPath('DB/DB_USER'), Sohan::getConfigByPath('DB/DB_PASS'), $options);
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
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

    public function getTableByName()
    {
        try {
            $table = strip_tags($this->getData('table_name'));
            $sql = "SELECT * FROM $table";
            $result = $this->_db->query($sql);
            return $result->fetchAll();
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
    }

    public function insertRowInTable(array $fields, array $values)
    {
        $joinedFields = implode(', ', $fields);
        $inputes = array();
        foreach ($values as $value) {
            $inputes[] = $this->_db->quote($value);
        }
        $joinedInputes = implode(', ', $inputes);
        try {
            $table = strip_tags($this->getData('table_name'));
            $sql = "INSERT INTO $table($joinedFields)
					VALUES($joinedInputes)";
            $this->_db->exec($sql);
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
    }

    public function deleteRowByID($id)
    {
        try {
            $table = strip_tags($this->getData('table_name'));
            $sql = "DELETE FROM $table
                    WHERE id = :id";
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
    }
}