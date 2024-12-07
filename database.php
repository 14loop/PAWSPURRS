<?php
class Database {

private $host ="pawsandpurrs-server.mysql.database.azure.com";
private $dbName = "pawsandpurrs-database";
private $username = "zstafqrshb";
private $password = "phpmyadmin";

public $conn;


public function dbConnection() {
    $this->conn =null;
    try {
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
} catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
return $this->conn;
}
}
?>
