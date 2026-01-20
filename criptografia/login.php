<?php
if (isset($_POST["email"]) && isset($_POST["senha"])) {
    include_once("./conn.php");
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $teste = password_verify($senha, $usuario["senha"]);
        if ($teste) {
            echo "Logado!!";
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Email incorreto!";
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

        <p>Email<input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"></p>
        <p>Senha<input type="text" name="senha" value="<?php if(isset($_POST['senha'])) echo $_POST['senha'] ?>"></p>
        <button type="submit">cadastrar</button>
        <a href="cadastro.php">Se não cadastrado. Clique aqui!</a>
    </form>
</body>

</html>