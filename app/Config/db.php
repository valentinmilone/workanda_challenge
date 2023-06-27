<?php

$host = 'localhost';
$dbName = 'workanda_challenge';
$user = 'root'; 
$password = ''; 

function getConnection() {
    global $host, $dbName, $user, $password;
    
    try {
        $db = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo "Error de conexión a la base de datos: " . $e->getMessage();
        exit;
    }
}

?>
