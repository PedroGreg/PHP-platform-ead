<?php
include_once('../conn.php');
if(isset($_POST['email'])){
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    try {
    $sql = 'INSERT INTO usuarios(email,senha) VALUES (:email, :senha)';
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':senha', $senha, PDO::PARAM_STR);
    $query->execute();
    } catch (PDOException $e) {
        echo 'error: '. $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro</title>
</head>

<body>
    <form action="" method="post">
        
        <p>Email<input type="text" name="email"></p>
        <p>Senha<input type="text" name="senha"></p>
        <button type="submit">cadastrar</button>
        <a href="login.php">Se já cadastrado. Clique aqui!</a>
    </form>
</body>

</html>