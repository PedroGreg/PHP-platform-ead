<?php
require_once('conn.php');
if(!isset($_SESSION)){
    session_start();
    $_SESSION['visitou'] = true;
}
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];
//if(!isset($_SESSION['visitou'])){
$sql = 'INSERT INTO visitas(data,browser,ip) VALUES (NOW(),:browser,:ip)';
$query = $pdo->prepare($sql);
$query->bindParam(':browser', $browser, PDO::PARAM_STR);
$query->bindParam(':ip', $ip, PDO::PARAM_STR);
$query->execute();
//}
$sql_consulta = "SELECT count(id) as visitas FROM visitas /*WHERE DATE(data) BETWEEN '2026-01-10' AND '2026-01-15'*/";
$query_consulta = $pdo->prepare($sql_consulta);
$query_consulta->execute();
$visitas = $query_consulta->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
</head>
<body>
    <h1>Esse site teve <?php if(isset($visitas)) echo $visitas['visitas']; else echo 0 ?> visitas</h1>
</body>
</html>