<?php
require_once("conn.php");
if (isset($_GET["q"])) {
    $pesquisa = '%' . $_GET["q"] . '%';
    try {
        $sql = "SELECT * FROM veiculos WHERE fabricante LIKE :pesquisa1 OR modelo LIKE :pesquisa2 OR veiculo LIKE :pesquisa3";
        $query_pesquisa = $pdo->prepare($sql);
        $query_pesquisa->bindParam(":pesquisa1", $pesquisa, PDO::PARAM_STR);
        $query_pesquisa->bindParam(":pesquisa2", $pesquisa, PDO::PARAM_STR);
        $query_pesquisa->bindParam(":pesquisa3", $pesquisa, PDO::PARAM_STR);
        $query_pesquisa->execute();
        if ($query_pesquisa->rowCount() > 0) {
            $carros = $query_pesquisa->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <style>
        body {
            min-height: 100vh;
            background-image: linear-gradient(45deg, #4d4d4dff, #969696ff);
        }

        p {
            color: white;
        }
    </style>
</head>

<body>
    <form action="" method="get">
        <p>
            <input placeholder="Digite para pesquisar" type="text" name="q" id="q">
            <button type="submit">Pesquisar</button>
        </p>
    </form>
    <table border="1" cellpadding="10" style="background-color: white; width: 700px;">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Veículo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$carros): ?>
                <tr>
                    <td colspan="3">Nenhuma pesquisa realizada</td>
                </tr>
            <?php else:
                foreach ($carros as $carro): ?>
                    <tr>
                        <td>
                            <?php echo $carro['fabricante'] ?>
                        </td>
                        <td>
                            <?php echo $carro['modelo'] ?>
                        </td>
                        <td>
                            <?php echo $carro['veiculo'] ?>
                        </td>
                    </tr>
                <?php endforeach; endif ?>
        </tbody>
    </table>
</body>

</html>