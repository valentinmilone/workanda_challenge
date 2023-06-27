<?php

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM `user` WHERE `email` = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
            $query = "SELECT * FROM `user` WHERE `id` = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyUserCredentials($email, $password) {
        $query = "SELECT * FROM `user` WHERE `email` = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    
        return false;
    }

    
    
    
    public function getUsers() {
        $query = "SELECT * FROM `user`";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email, $phone, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $query = "INSERT INTO `user` (`name`, `email`, `phone`, `password`) VALUES (:name, :email, :phone, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->execute();
    
        return $this->db->lastInsertId();

        
    }

    public function updateUser($id, $name, $email, $phone) {
        $query = "UPDATE `user` SET `name` = :name, `email` = :email, `phone` = :phone WHERE `id` = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM `user` WHERE `id` = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

}

?>
