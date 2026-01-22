<?php
if(!isset($_GET['h']))
    die('URL invalida');
require_once('conn.php');
try {
$sql = "SELECT url FROM encurtador WHERE id = :hash";
$query = $pdo->prepare($sql);
$query->bindParam(":hash", $_GET["h"], PDO::PARAM_STR);
$query->execute();
if($query->rowCount() > 0){
    $site = $query->fetch(PDO::FETCH_ASSOC);
    $sql_view = "UPDATE encurtador SET views = views + 1 WHERE id = :view";
    $query = $pdo->prepare($sql_view);
    $query->bindParam(":view", $_GET["h"], PDO::PARAM_STR);
    $query->execute();
    header("location: {$site['url']}");
}else
    die('URL invalida');
} catch(PDOException $e) {
    echo 'error: ' . $e->getMessage();
}