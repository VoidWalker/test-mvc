<?php

/**
 * Contains basic methods for data processing
 *
 * Class Sohan_Core_Model_Base
 */
abstract class Sohan_Core_Model_Base extends Object
{
    private $_db;

    /**
     * Service method
     * for DB creation
     */
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

    /**
     * Initialize DB on first call
     */
    public function __construct()
    {
        $this->_db = Sohan_Core_DB::DBInit()->DB();
        if (func_num_args() == 1) {
            parent::__construct(func_get_arg(0));
        }
    }

    /**
     * Get table from BD
     * declared previously
     *
     * @return mixed
     */
    public function getTable($table_name)
    {
        try {
            $table = strip_tags($table_name);
            $sql = "SELECT * FROM $table";
            return $this->_db->query($sql);
            //return $result->fetchAll();
        } catch (PDOException $e) {
            echo '<br>' . $e->getMessage();
        }
    }

    /**
     * @param array $fields
     * @param array $values
     */
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