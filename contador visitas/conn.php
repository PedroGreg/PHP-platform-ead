<?php
$host = "localhost";
$pass = "";
$dbname = "estudo";
$username = "root";
$charset = "utf8mb4";
$dns = "mysql:host=$host;dbname=$dbname;$charset";
$options = array(
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
try{
$pdo = new PDO($dns,$username,$pass,$options);
}
catch(PDOException $e){
    echo 'error: ' . $e->getMessage();
}