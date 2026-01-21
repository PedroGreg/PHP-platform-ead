<?php
require_once('conn.php');

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['maxpages'])) {
    $sqlpages = "SELECT count(id) as total FROM veiculos";
    $query_pages = $pdo->prepare($sqlpages);
    $query_pages->execute();
    if ($query_pages)
        $total = $query_pages->fetch(PDO::FETCH_ASSOC);
    $_SESSION['maxpages'] = $total['total'];
}

$page = $_GET['page'] ? intval($_GET['page']) : 1;
$limit = 15;
$maxpage = ceil($_SESSION['maxpages'] / $limit);
$offset = ($page - 1) * $limit;
$interval = 3;
$firstpage = max($page - $interval, 1);
$lastpage = min($maxpage, $page + $interval);

$sql = "SELECT * FROM veiculos ORDER BY id ASC LIMIT $limit OFFSET $offset";
$query = $pdo->prepare($sql);
$query->execute();

if ($query)
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
    <p><?php echo "Page: $page.  Number of pages: $maxpage" ?></p>
    <p><a href="?page=1"><<</a>
        <?php
        for($p = $firstpage; $p <= $lastpage; $p+=1){
            echo "<a href='?page=$p'>[$p]</a>";
        }
        // for ($p = $page - 2; $p <= $maxpage; $p += 1) {
        //     if ($p <= $page + 2 || $p >= $maxpage - 1) {
        //         if ($p > 0) {
        //             if ($p == $maxpage - 1 && $page < $maxpage - 4) {
        //                 echo '<span>. . . . .</span>';
        //             }
        //             echo "<a href='?page=$p'>[$p]</a>";
        //         }
        //     }
        // }

        ?>
        <a href="?page=<?php echo $maxpage ?>">>></a>
    </p>
</body>

</html>