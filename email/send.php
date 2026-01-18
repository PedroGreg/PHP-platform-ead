<?php
//Senha:
//Email: 
//HOST: smtp.gmail.com
//Porta: 587

mail("cofib94245@naprb.com", "Test", "Testando o envio deste email", "", "");//Modo incorreto!

use PHPMailer\PHPMailer\PHPMailer;
require('vendor/autoload.php');

$mail = new PHPMailer;
$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = '';
$mail->Password = '';
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->setFrom('', '');
$mail->addAddress('', '');
$mail->Subject = '';
$mail->msgHTML('<h1>Email enviado com sucesso</h1>');
$mail->Body = 'Email enviado com sucesso';
if ($mail->send()) {
    echo 'email enviado';
} else {
    echo 'Não enviado';
}

?>