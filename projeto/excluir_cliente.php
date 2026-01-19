<?php
session_start();
try {
    require_once('conn.php');
    $id = intval($_GET["id"]);
    $sql_deletar_cliente = "DELETE FROM clientes WHERE id = :id";
    $query_deletar_cliente = $pdo->prepare($sql_deletar_cliente);
    $query_deletar_cliente->bindParam(":id", $id, PDO::PARAM_INT);
    $query_deletar_cliente->execute();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
$_SESSION["mensagem"] = "Cliente deletado com sucesso!";
header("location: lclientes.php");
exit();
?>