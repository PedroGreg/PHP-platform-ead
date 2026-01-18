<?php
require_once('./conn.php');
//////////////////////////////////////////////////////////////////////////////////////////////////////Função para enviar arquivo
function enviararquivo($pdo, $size, $error, $name, $tmp_name)
{
    if ($size > 2097152)//Verificação do tamanho
        die('O arquivo deve ser menor que 2MB');
    if ($error)//Verificação de tem algum erro
        die('Erro ao enivar o arquivo');
    $path = './arquivos/';//Definição de qual caminho será guardado o arquivo
    $nomeDoArquivo = $name;//Definindo o nome original do arquivo
    $nomeArquivo = uniqid();//Definindo um nome unico para o arquivo via uniqid
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));//Colocando pegando a extensão em minúsculo
    $novoPath = $path . $nomeArquivo . "." . $extensao;//Definindo o path completo do arquivo após guardado
    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "webp")//Validação se é um imagem
        die("tipo de arquivo incorreto");
    $enviar = move_uploaded_file($tmp_name, $novoPath);//Função para mover o arquivo, usa o tmp_name(de onde sai) e o path de onde ficará(pasta + arquivo + extensão)
    if ($enviar) {
        try {
            $sql = "INSERT INTO arquivos (nomeoriginal, path) VALUES (:nome, :path)";
            $query = $pdo->prepare($sql);
            $query->bindParam(":nome", $nomeDoArquivo, PDO::PARAM_STR);
            $query->bindParam(":path", $novoPath, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    } else {
        echo "Falha ao enviar";
        return false;
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['name'] != '') {
    $arquivo = $_FILES['arquivo'];
    $certo = true;
    foreach ($arquivo['name'] as $key => $value) {//Passa o dados de todos os arquivos enviados dentro da função
        $enviarimg = enviararquivo($pdo, $arquivo['size'][$key], $arquivo['error'][$key], $arquivo['name'][$key], $arquivo['tmp_name'][$key]);
        if (!$enviarimg) {
            $certo = false;
        }
    }
    if ($certo) {//Verifica de houve algum erro durante os envios
        echo 'todos arquivos enviados';
    } else {
        echo 'falha a enviar um ou mais arquivos';
    }
}
try {
    $sql = "SELECT * FROM arquivos";
    $query = $pdo->prepare($sql);
    $query->execute();
    if ($query->rowCount() > 0) {
        $arquivos = $query->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload arquivos</title>
</head>

<body>
    <form enctype="multipart/form-data" action="" method="post">
        <p><label for="arquivo">Selecione o arquivo</label>
            <input multiple type="file" name="arquivo[]">
        </p>
        <button type="submit">Enviar</button>
    </form>
    <table border="1" cellpadding="10" style="border-collapse: collapse;">
        <thead>
            <th>Preview</th>
            <th>Nome do arquivo</th>
            <th>Data de envio</th>
        </thead>
        <tbody>
            <?php foreach ($arquivos as $arquivo): ?>
                <tr>
                    <td><img style="width: auto; height: 50px" src="<?php echo $arquivo['path'] ?>" alt=""></td>
                    <td><?php echo $arquivo['nomeoriginal'] ?></td>
                    <td><?php echo date("d/m/Y H:i", strtotime($arquivo['data_upload'])) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>