<?php
if (!isset($_SESSION))
    session_start();
if (!$_SESSION["admin"]) {
    if (!$_SESSION["logado"]) {
        header("location: ./");
        die();
    } else {
        header("location: ./lclientes.php");
        die();
    }
}
try {
    require_once('../lib/conn.php');
    $id = intval($_GET["id"]);
    $sql = "SELECT foto FROM clientes WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $sql_deletar_cliente = "DELETE FROM clientes WHERE id = :id";
    $query_deletar_cliente = $pdo->prepare($sql_deletar_cliente);
    $query_deletar_cliente->bindParam(":id", $id, PDO::PARAM_INT);
    $query_deletar_cliente->execute();
    if ($query_deletar_cliente) {
        if ($query->rowCount() > 0) {
            $foto = $query->fetch(PDO::FETCH_ASSOC);
            if ($foto["foto"] != "") {
                unlink($foto["foto"]);
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
$_SESSION["mensagem"] = "Cliente deletado com sucesso!";
header("location: lclientes.php");
exit();
?>