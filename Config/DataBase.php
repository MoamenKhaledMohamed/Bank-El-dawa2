<?php

class DataBase
{
    private $host = 'localhost';
    private $db_name = 'bank el dawa2';
    private $user_name = 'root';
    private $password = '';
    private $conn;

    public function dbconnect()
    {

        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $E) {
            echo "connection error" . $E->getMessage();
        }
        return $this->conn;
    }
}