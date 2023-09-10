<?php

class DataBase {
    private $conn;
    private $dbName = 'pdo_test';

    public function createDb() {
        $this->conn->query("CREATE DATABASE IF NOT EXISTS {$this->dbName} CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
        $this->useDb();
        $this->conn->query("CREATE TABLE IF NOT EXISTS classes 
                            (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(8) NOT NULL, course TINYINT UNSIGNED NOT NULL)");
        $this->conn->query("CREATE TABLE IF NOT EXISTS professors 
                            (id INT PRIMARY KEY AUTO_INCREMENT, full_name VARCHAR(100) NOT NULL)");
        $this->conn->query("CREATE TABLE IF NOT EXISTS students
                            (id INT PRIMARY KEY AUTO_INCREMENT, full_name VARCHAR(100) NOT NULL, dob DATE NOT NULL, classes_id INT NOT NULL, 
                            CONSTRAINT students_chk_dob CHECK (dob > '1940-01-01'), 
                            FOREIGN KEY (classes_id) REFERENCES classes (id))");
    }

    public function deleteDb() {
        $this->conn->query("DROP DATABASE IF EXISTS {$this->dbName}");
    }

    public function useDb() {
        $this->conn->query("USE {$this->dbName}");
    }
    
    public function migrate() {
        $this->conn->query("INSERT INTO classes (name, course) 
                            VALUES ('8имим1', 1), 
                                   ('4кн7кн', 3)");
        $this->conn->query("INSERT INTO students (full_name, dob, classes_id)
                            VALUES ('Сергеева Ульяна Леонидовна', '2003-08-22', 1), 
                                   ('Коновалова София Тихоновна', '2003-07-13', 1),
                                   ('Кузнецов Алексей Евгеньевич', '2003-10-15', 1),
                                   ('Виноградова Ксения Максимовна', '2003-09-09', 1),
                                   ('Шаповалов Александр Арсентьевич', '2001-01-19', 2),
                                   ('Волкова Мария Сергеевна', '2001-04-19', 2),
                                   ('Комарова Мирослава Матвеевна', '2001-12-24', 2)");
        $this->conn->query("INSERT INTO professors (full_name) 
                            VALUES ('Иванов Кирилл Даниилович'), 
                                   ('Горелов Ярослав Артемьевич')");
    }

    public function getDbName() {
        return $this->dbName;
    }

    public function __construct($conn) {
        $this->conn = $conn;
    }
}
