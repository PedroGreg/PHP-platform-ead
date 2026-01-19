<?php
if (isset($_POST["nome"])) {
    $duracao = time() + (30 * 24 * 60 * 60);
    setcookie("nome", $_POST["nome"], $duracao);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if(isset($_COOKIE["nome"])) : ?>
    <h1>Bem vindo <?php echo $_COOKIE['nome'] ?></h1>
    <?php else : ?>
        <form action="" method="post">
        <p>Qual seu nome?</p>
        <input type="text" name="nome">
        <button type="submit"></button>
    </form>
    <?php endif ?>
</body>

</html>