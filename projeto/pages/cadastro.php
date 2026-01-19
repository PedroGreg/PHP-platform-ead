<?php
if (!isset($_SESSION))
    session_start();
if (!$_SESSION["admin"]) {
    if (!$_SESSION["logado"]) {
        header("location: ./");
        die();
    } else {
        header("location: ./lclientes.php");
        die();
    }
}
require_once("../lib/email.php");
require_once("../lib/upload.php");
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto'];
        $path = enviararquivo($pdo, $foto['size'], $foto['error'], $foto['name'], $foto['tmp_name']);
        if (!$path) {
            echo 'erro ao enviar a imagem';
        }

        //     $foto = $_FILES["foto"];
        //     if ($foto["error"] != 0) {
        //         echo 'erro ao enviar imagem';
        //         die();
        //     }
        //     if ($foto['size'] > 4194304) {
        //         echo 'a foto deve ser menor que 4 MB';
        //         die();
        //     }
        //     $path = '../lib/fotos/';
        //     $caminho = $foto['tmp_name'];
        //     $nomeoriginal = $foto['name'];
        //     $nomefoto = uniqid();
        //     $extensao = pathinfo(strtolower($foto['name']), PATHINFO_EXTENSION);
        //     $novoPath = $path . $nomefoto . '.' . $extensao;
        //     if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg' && $extensao != 'webp') {
        //         echo 'o arquivo deve ser uma imagem';
        //         die();
        //     }
        //     $enviar = move_uploaded_file($caminho, $novoPath);
        //     if (!$enviar) {
        //         echo "erro ao enviar a foto";
        //         die();
        //     }
    }

    $nome = $_POST['nome'];
    $email = strtolower($_POST['email']);
    $senhaenc = $_POST['senha'];
    $senha = password_hash($senhaenc, PASSWORD_DEFAULT);
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];
    $admin = $_POST['admin'];
    if (empty($nome)) {
        echo "Preencha o nome!";
    }
    if (empty($email)) {
        echo "Preencha o email!";
    }
    if (!empty($telefone)) {
        $telefone = preg_replace('/[^0-9]/', "", $telefone);
    }
    if (!empty($nascimento)) {
        $pedacos = explode('/', $nascimento);
        $dataexplode = array_reverse($pedacos);
        $dataimplode = implode('-', $dataexplode);
    }
    try {
        require_once('../lib/conn.php');
        $sql = "INSERT INTO clientes(nome,email,senha,nascimento,telefone,foto,admin) VALUES (:nome, :email,:senha, :data, :telefone, :foto, :admin)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':senha', $senha, PDO::PARAM_STR);
        $query->bindParam(':data', $dataimplode, PDO::PARAM_STR);
        $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $query->bindParam(':foto', $path, PDO::PARAM_STR);
        $query->bindParam(':admin', $admin, PDO::PARAM_BOOL);
        $query->execute();
        echo "cliente cadastrado com sucesso!";
        $assunto = 'Cadastrado no sistema Pedro!';
        $conteudo = "<h1>Seja bem vindo!!</h1><br><p>Seu email de login é: $email</p><p>Sua senha para login é: $senhaenc</p><br><br><p>Obrigado por utilizar nosso sistema!!</p>";

        // if (enviaremail($email, $assunto, $conteudo))
        //     echo "email enviado";
        // else
        //     echo "email não enviado";
    } catch (PDOException $e) {
        echo 'error: ' . $e;
    }

}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro cliente</title>
    <style>
        body {
            display: grid;
            place-items: center;
            height: 100vh;
        }

        .erro {
            background-color: #99000044;
            border: 1px solid red;
        }
    </style>
</head>

<body>
    <div>
        <form enctype="multipart/form-data" action="" method="post">
            <div class="divinput">
                <label for="nome">Nome:</label><input type="text" name="nome" id="nome"
                    value="<?php echo $_POST['nome'] ?>">
            </div>
            <div class="divinput">
                <label for="">Email:</label><input type="text" name="email" id="email"
                    value="<?php echo $_POST['email'] ?>">
            </div>
            <div class="divinput">
                <label for="">Senha:</label><input type="password" name="senha" id="senha"
                    value="<?php echo $_POST['senha'] ?>">
            </div>
            <div class="divinput">
                <label for="">Telefone:</label><input type="text" name="telefone" id="telefone"
                    value="<?php echo $_POST['telefone'] ?>">
            </div>
            <div class="divinput">
                <label for="">Data de Nascimento</label><input placeholder="dd/mm/AAAA" type="text" name="nascimento"
                    id="nascimento" value="<?php echo $_POST['nascimento'] ?>">
            </div>
            <div class="divinput">
                <label for="">Foto do usuario</label><input type="file" name="foto" id="foto">
            </div>
            <div>
                <p>
                    <label for="">Tipo:</label>
                    <input type="radio" name="admin" value="1" id=""><label for="">Admin</label>
                    <input type="radio" checked name="admin" value="0" id=""><label for="">Cliente</label>
                </p>
            </div>
            <button type="submit" id="enviar">Cadastrar</button>
        </form>
    </div>
    <div id="mensagem">
    </div>
    <a href="lclientes.php">Voltar à lista</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
    <script>VMasker(document.getElementById("nascimento")).maskPattern("99/99/9999");</script>
    <script src="../lib/script.js"></script>
</body>

</html>