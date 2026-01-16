<?php
require_once('funcoes.php');
require_once('conn.php');
$sql_clientes = "SELECT * FROM clientes";
$query_clientes = $pdo->prepare($sql_clientes);
$query_clientes->execute();
if ($query_clientes->rowCount() > 0)
    $clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
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
    <table border="1px" cellpadding="5">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Nascimento</th>
            <th>Data cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if (!$clientes): ?>
                <tr>
                    <td colspan="7">Nenhum cliente cadastrado</td>
                </tr>
            <?php else:
                foreach ($clientes as $cliente):
                    $telefone = "Telefone não cadastrado";
                    if ($cliente["telefone"] != "")
                        $telefone = telefoneformat($cliente["telefone"]);
                    if ($cliente["nascimento"] != "")
                        $nascimento = dataformat($cliente["nascimento"]);
                    $data = strtotime($cliente["cadastro"]);
                    $data = date("d/m/Y H:i" , $data);
                    ?>
                    <tr>
                        <td><?php echo $cliente['id'] ?></td>
                        <td><?php echo $cliente['nome'] ?></td>
                        <td><?php echo $cliente['email'] ?></td>
                        <td><?php echo $telefone ?></td>
                        <td><?php echo $nascimento ?></td>
                        <td><?php echo $data ?></td>
                        <td><a href="editar_cliente.php?id=<?php echo $cliente['id'] ?>">Editar</a><a href="excluir_cliente.php?id=<?php echo $cliente['id'] ?>">Excluir</a></td>
                    </tr>
                <?php endforeach; endif ?>
        </tbody>
    </table>
</body>

</html>