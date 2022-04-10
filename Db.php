<?php

class Db {
    protected static $instance;
    private $db_server = "mysql";
    private $host = "localhost";
    private $db_name = "products_app";
    private $username = "root";
    private $password = "199087";
    public $conn;
    // получаем соединение с БД 
    public function __construct()
    {
        $this->conn = null;
        try
        {
            $this->conn = new PDO($this->db_server.":host=".$this->host.";dbname=".$this->db_name.";user=".$this->username.";password=".$this->password);
            $this->conn->exec("set names 'utf8'");
        }
        catch(PDOException $exception)
        {
            echo "Ошибка соединения с базой данных: " . $exception->getMessage();
        }
    }

    public static function instance(){
        if (null === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
