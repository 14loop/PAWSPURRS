<?php

require_once 'database.php';

class Clients {
    private $conn;


    // Constructor
    public function __construct(){
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    // Execute queries SQL
   public function runQuery($sql){
    $stmt = $this->conn->conn->prepare($sql);
    return $stmt;
   }

    // Insert
    public function insert($name, $email){
        try{
            $stmt = $this->conn->prepare("INSERT INTO clients (name, email) VALUES (:name, :email)");
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":email", $email);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    // Update
    public function update($name, $email, $id){
        try{
            $stmt = $this->conn->prepare("UPDATE clients SET name = :name, email = :email, WHERE id = :id);"
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    
    // Delete
    public function delete($id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM clients WHERE id = :id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    
    
    // Redirect URL method
    public function redirect($url){
        header("Location: $url");
    }
}
?>
