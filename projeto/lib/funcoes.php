<?php
function telefoneformat($numero)
{
    $ddd = "(" . substr($numero, 0, 2) . ") ";
    $parte1 = substr($numero, 2, 5) . "-";
    $parte2 = substr($numero, 7, );
    $telefone = $ddd . $parte1 . $parte2;
    return $telefone;
}
function dataformat($data){
    $dataex = explode("-", $data);
    $datarev = array_reverse($dataex);
    $datain = implode("/", $datarev);
    return $datain;
}

// function enviaremail($email, $senha) {
    
// use PHPMailer\PHPMailer\PHPMailer;
// require('vendor/autoload.php');

// $mail = new PHPMailer;
// $mail->IsSMTP();
// $mail->SMTPDebug = 2;
// $mail->Host = 'smtp.gmail.com';
// $mail->Port = 587;
// $mail->SMTPAuth = true;
// $mail->Username = '';
// $mail->Password = '';
// $mail->isHTML(true);
// $mail->CharSet = 'UTF-8';
// $mail->setFrom('', '');
// $mail->addAddress('', '');
// $mail->Subject = '';
// $mail->msgHTML('<h1>Email enviado com sucesso</h1>');
// $mail->Body = 'Email enviado com sucesso';
// if ($mail->send()) {
//     echo 'email enviado';
// } else {
//     echo 'Não enviado';
// }
// }

function enviararquivo($pdo, $size, $error, $name, $tmp_name){
    if ($size > 2097152)
        die('O arquivo deve ser menor que 2MB');
    if ($error)
        die('Erro ao enivar o arquivo');
    $path = './arquivos/';
    $nomeDoArquivo = $name;
    $nomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
    $novoPath = $path . $nomeArquivo . "." . $extensao;
    echo $extensao . "<br>";
    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "webp")
        die("tipo de arquivo incorreto");
    $enviar = move_uploaded_file($tmp_name, $path . $nomeArquivo . "." . $extensao);
    if ($enviar) {
        try {
            $sql = "INSERT INTO arquivos (nomeoriginal, path) VALUES (:nome, :path)";
            $query = $pdo->prepare($sql);
            $query->bindParam(":nome", $nomeDoArquivo, PDO::PARAM_STR);
            $query->bindParam(":path", $novoPath, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return true;
    } else
    echo "Falha ao enviar";
    return false;
}