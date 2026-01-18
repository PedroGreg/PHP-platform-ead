<?php

$senhadigitada = 'usuariodigitouessasenha';
$senha = md5($senhadigitada);
$sql = "INSERT INTO usuarios (senha) VALUES ('$senha')";
//Para logar depois.
$senhalogin = 'usuariodigitouissoagora';
$senhateste = md5($senhalogin);
$sql = "SELECT * FROM usuarios WHERE senha = '$senhateste'";

//Método mais confiável, função hash no PHP
$email = 'usuario@email.com';
$senhadigitadaagora = 'usuariodigitouasenha';
$senhahash = password_hash($senhadigitadaagora, PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (senha) VALUES ('$senhahash')";

//Para logar
$email = 'usuario@email.com';
$senhalogar = 'usuarioerrouasenha';
$sql = "SELECT * FROM usuarios WHERE email = $email";
if($sql->rowCount() > 0){
$senhateste = $sql['senha'];
$senhatest = password_verify($senhalogar, $senhateste);
}//Se a senha estiver correta retornará 1, se não 0