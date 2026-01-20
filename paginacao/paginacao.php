<?php
require_once('conn.php');
if(!isset($_SESSION))
    session_start();
if(!isset($_SESSION['maxpages'])){
    $sqlpages = "SELECT count(id) as total FROM veiculos";
    $query_pages = $pdo->prepare($sqlpages);
    $query_pages->execute();
    if($query_pages)
        $total = $query_pages->fetch(PDO::FETCH_ASSOC);
    $_SESSION['maxpages'] = $total['total'];
}
echo $_SESSION['maxpages'];
$page = 1;
$limit = 15;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM veiculos ORDER BY id ASC LIMIT $limit OFFSET $offset";
$query = $pdo->prepare($sql);
$query->execute();
if($query)
    $ids = $query->fetchAll(PDO::FETCH_ASSOC);
else
    $ids = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border='1' cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fabricante</th>
                <th>Modelo</th>
                <th>Veiculo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ids as $id): ?>
                <tr>
                    <td><?php echo $id['id'] ?></td>
                    <td><?php echo $id['fabricante'] ?></td>
                    <td><?php echo $id['modelo'] ?></td>
                    <td><?php echo $id['veiculo'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>