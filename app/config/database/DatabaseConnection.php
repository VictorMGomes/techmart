<?php
include_once __DIR__."/../env/IniLoader.php";

class DatabaseConnection
{   
    private $pdo;

    public function __construct()
    {
        $envLoader = new IniLoader(__DIR__."/../env/config.ini");
        
        $sgbd = $envLoader->get('database', 'DB_TYPE');
        $hostname = $envLoader->get('database', 'DB_HOST');
        $charset = $envLoader->get('database', 'DB_CHARSET');
        $username = $envLoader->get('database', 'DB_USER');
        $password = $envLoader->get('database', 'DB_PASS');
        $database = $envLoader->get('database', 'DB_NAME');
        
        $dsn = "$sgbd:host=$hostname;dbname=$database;charset=$charset";

        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
