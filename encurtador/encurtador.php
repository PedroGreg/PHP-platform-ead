<?php
require_once('conn.php');
$url_prefix = '/r.php?h=';
if (isset($_POST['url']) && $_POST['url'] != '') {

    $hash = uniqid();   
    $url = $_POST['url'];
    $sql = 'INSERT INTO encurtador(id,url) VALUES (:id,:url)';
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $hash, PDO::PARAM_STR);
    $query->bindParam(':url', $url, PDO::PARAM_STR);
    $query->execute();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encurtador de link</title>
</head>

<body>
    <form action="" method="post">
        <input type="url" name="url" id="">
        <button type="submit">Encurtar</button>
    </form>
    <?php if (isset($url) && $query): ?>
        <p>URL encurtada: <input type="text" readonly value="seulink.com/rd.php?h=<?php echo $hash ?>"></p>
            <?php endif ?>
    </body>

</html>