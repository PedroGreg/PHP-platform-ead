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

