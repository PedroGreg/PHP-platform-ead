<?php
$host = "localhost";
$database = "estudo"; 
$username = "root";
$password = "";
$charset = "utf8mb4";
$dns = "mysql:host=$host;dbname=$database;$charset";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
);
try{
$pdo = new PDO($dns, $username, $password, $options);
}
catch(PDOException $e){
    echo 'Error: ' . $e->getMessage();
}
?>