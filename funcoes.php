<?php
function telefoneformat($numero)
{
    $ddd = "(" . substr($numero, 0, 2) . ")";
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