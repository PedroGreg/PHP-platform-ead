<?php
$id = intval($_GET["id"]);
require_once("../lib/funcoes.php");
require_once("../lib/upload.php");
try {
    require_once("../lib/conn.php");
    require_once("../lib/email.php");
    if ($_SERVER['REQUEST_METHOD'] === "POST" && $_POST["nome"] != "" && $_POST["email"] != "") {
        if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ''){
            $foto = $_FILES['foto'];
            $path = enviararquivo($pdo, $foto['size'], $foto['error'], $foto['name'], $foto['tmp_name']);
            if($path){
                $sql_foto = 'UPDATE clientes SET foto = :foto WHERE id = :id';
                $query_foto = $pdo->prepare($sql_foto);
                $query_foto->bindParam(':id', $id, PDO::PARAM_INT);
                $query_foto->bindParam(':foto', $path, PDO::PARAM_STR);
                $query_foto->execute();
            }
            else {
                echo 'Erro ao enviar imagem';
            }
        }
        $nome = $_POST['nome'];
        $email = strtolower($_POST['email']);
        if(!empty($_POST['senha'])){
        $senhaenc = $_POST['senha'];
        $senha = password_hash($senhaenc, PASSWORD_DEFAULT);
        $sql_senha = "senha = :senha,";
        }else
        $sql_senha = '';
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        if (!empty($telefone)) {
            $telefone = preg_replace('/[^0-9]/', "", $telefone);
        }
        if (!empty($nascimento)) {
            $pedacos = explode('/', $nascimento);
            $dataexplode = array_reverse($pedacos);
            $dataimplode = implode('-', $dataexplode);
        }
        $sql_atualizar_cliente = "UPDATE clientes SET nome = :nome, email = :email, $sql_senha telefone = :telefone, nascimento = :nascimento WHERE id = :id";
        $query_atualizar_cliente = $pdo->prepare($sql_atualizar_cliente);
        $query_atualizar_cliente->bindParam(':id', $id, PDO::PARAM_INT);
        $query_atualizar_cliente->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query_atualizar_cliente->bindParam(':email', $email, PDO::PARAM_STR);
        if($sql_senha != '')
            $query_atualizar_cliente->bindParam(':senha', $senha, PDO::PARAM_STR);
        $query_atualizar_cliente->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $query_atualizar_cliente->bindParam(':nascimento', $dataimplode, PDO::PARAM_STR);
        $query_atualizar_cliente->execute();
        $assunto = 'Usuario atualizado!';
        $conteudo = "<h1>Usuario atualizado!!</h1><br><p>Sua nova senha para login é: $senhaenc</p><br><br><p>Obrigado por utilizar nosso sistema!!</p>";
        // if(enviaremail($email, $assunto, $conteudo))
        //     echo "Email enviado";
        // else
        //     echo "Email não enviado";
    }
    $sql_cliente = "SELECT * FROM clientes WHERE id = :id";
    $query_cliente = $pdo->prepare($sql_cliente);
    $query_cliente->bindParam(":id", $id, PDO::PARAM_INT);
    $query_cliente->execute();
    $cliente = $query_cliente->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
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
                    value="<?php echo $cliente['nome'] ?>">
            </div>
            <div class="divinput">
                <label for="">Email:</label><input type="text" name="email" id="email"
                    value="<?php echo $cliente['email'] ?>">
            </div>
            <div class="divinput">
                <label for="">Senha:</label><input type="password" name="senha" id="senha"
                    value="">
            </div>
            <div class="divinput">
                <label for="">Telefone:</label><input type="text" name="telefone" id="telefone"
                    value="<?php echo telefoneformat($cliente['telefone']) ?>">
            </div>
            <div class="divinput">
                <label for="">Data de Nascimento</label><input placeholder="dd/mm/AAAA" type="text" name="nascimento"
                    id="nascimento" value="<?php echo dataformat($cliente['nascimento']) ?>">
            </div>
            <?php if($cliente['foto']) : ?>
            <p>Foto atual: <img height="50" src="<?php echo $cliente['foto'] ?>"></p>
            <?php endif ?>
            <div class="divinput">
                <label for="">Foto do usuario</label><input type="file" name="foto"
                    id="foto">
            </div>
            <button type="submit" id="teste">Cadastrar</button>
        </form>
    </div>
    <div id="mensagem">
    </div>
    <a href="lclientes.php">Voltar à lista</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
    <script src="../lib/script.js"></script>
</body>

</html>