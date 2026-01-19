<?php
if(isset($_POST["email"]) && isset($_POST["senha"])) {
    require_once("../lib/conn.php");
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $sql = "SELECT id, senha, admin FROM clientes WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(":email", $email, PDO::PARAM_STR);
    $query->execute();
    if($query->rowCount() > 0) {
        $usuario = $query->fetch(PDO::FETCH_ASSOC);
        $teste = password_verify($senha, $usuario["senha"]);
        if($teste) {
            if(!isset($_SESSION))
                session_start();
            $_SESSION["logado"] = true;
            $_SESSION["admin"] = $usuario['admin'];
            $_SESSION['usuario'] = $usuario['id'];
            header('location: ./lclientes.php');
            die();
        }else {
            echo "senha incorreta";
        }
    }else{
        echo "email incorreto!";
    }

}
?><!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if(isset($email)) echo $email ?>">
        </div>

        <div>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha">
        </div>

        <button type="submit" id="submit">Entrar</button>
    </form>
</body>

</html>