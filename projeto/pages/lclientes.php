<?php
if (!isset($_SESSION))
    session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] == false) {
    var_dump($_SESSION);
    header('location: ./index.php');
    die();
}
require_once('../lib/funcoes.php');
try {
    require_once('../lib/conn.php');
    $sql_clientes = "SELECT * FROM clientes";
    $query_clientes = $pdo->prepare($sql_clientes);
    $query_clientes->execute();
    if ($query_clientes->rowCount() > 0)
        $clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
</head>

<body>
    <h2>Clientes</h2>
    <p><?php if (isset($_SESSION['mensagem']))
        echo $_SESSION['mensagem'] ?></p>
        <table border="1px" cellpadding="5">
            <thead>
                <th>ID</th>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Nascimento</th>
                <th>Data cadastro</th>
                <th>Admin</th>
            <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                <th>Ações</th>
            <?php endif ?>
        </thead>
        <tbody>
            <?php if (!$clientes): ?>
                <tr>
                    <td colspan="<?php if (isset($_SESSION['admin']) && $_SESSION['admin'])
                        echo '9';
                    else
                        echo '8'; ?>">Nenhum cliente cadastrado</td>
                </tr>
            <?php else:
                foreach ($clientes as $cliente):
                    $telefone = "Telefone não cadastrado";
                    if ($cliente["telefone"] != "")
                        $telefone = telefoneformat($cliente["telefone"]);
                    $nascimento = "Nascimento não cadastrado";
                    if ($cliente["nascimento"] != "")
                        $nascimento = dataformat($cliente["nascimento"]);
                    $data = strtotime($cliente["cadastro"]);
                    $data = date("d/m/Y H:i", $data);
                    ?>
                    <tr>
                        <td><?php echo $cliente['id'] ?></td>
                        <td><img style="width: auto; height: 50px;" src="<?php echo $cliente['foto'] ?>" alt=""></td>
                        <td><?php echo $cliente['nome'] ?></td>
                        <td><?php echo $cliente['email'] ?></td>
                        <td><?php echo $telefone ?></td>
                        <td><?php echo $nascimento ?></td>
                        <td><?php echo $data ?></td>
                        <td><?php if ($cliente['admin'])
                            echo 'SIM';
                        else
                            echo 'NÃO' ?></td>
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                            <td><a href="./editar_cliente.php?id=<?php echo $cliente['id'] ?>">Editar</a>
                                <a href="./excluir_cliente.php?id=<?php echo $cliente['id'] ?>"
                                    onclick="return confirmar()">Excluir</a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach; endif ?>
        </tbody>
    </table>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
        <a href="cadastro.php">Cadastrar cliente</a>
    <?php endif ?>
    <a href="logout.php">Sair</a>
    <script src="../lib/script.js"></script>
</body>

</html>
<?php unset($_SESSION['mensagem']);