<?php
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = strtolower($_POST['email']);
    $telefone = $_POST['telefone'];
    $nascimento = $_POST['nascimento'];
    if (empty($nome)) {
        echo "Preencha o nome!";
    }
    if (empty($email)) {
        echo "Preencha o email!";
    }
    if (!empty($telefone)) {
        $telefone = preg_replace('/[^0-9]/',"", $telefone);
    }
    if (!empty($nascimento)) {
        $pedacos = explode('/', $nascimento);
        $dataexplode = array_reverse($pedacos);
        $dataimplode = implode('-', $dataexplode);
    }
    try {
        require_once('./conn.php');
        $sql = "INSERT INTO clientes(nome,email,nascimento,telefone) VALUES (:nome, :email, :data, :telefone)";
        $query = $pdo->prepare($sql);
        $query->bindParam(':nome', $nome, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':data', $dataimplode, PDO::PARAM_STR);
        $query->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $query->execute();
        echo "cliente cadastrado com sucesso!";
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
        <form action="" method="post">
            <div class="divinput">
                <label for="nome">Nome:</label><input type="text" name="nome" id="nome"
                    value="<?php echo $_POST['nome'] ?>">
            </div>
            <div class="divinput">
                <label for="">Email:</label><input type="text" name="email" id="email"
                    value="<?php echo $_POST['email'] ?>">
            </div>
            <div class="divinput">
                <label for="">Telefone:</label><input type="text" name="telefone" id="telefone"
                    value="<?php echo $_POST['telefone'] ?>">
            </div>
            <div class="divinput">
                <label for="">Data de Nascimento</label><input placeholder="dd/mm/AAAA" type="text" name="nascimento"
                    id="nascimento" value="<?php echo $_POST['nascimento'] ?>">
            </div>
            <button type="submit" id="enviar">Cadastrar</button>
        </form>
    </div>
    <div id="mensagem">
    </div>
    <a href="lclientes.php">Voltar à lista</a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
    <script>VMasker(document.getElementById("nascimento")).maskPattern("99/99/9999");</script>
    <script src="script.js"></script>
</body>

</html>