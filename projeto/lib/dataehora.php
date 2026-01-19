<?php
//timestamps
//cada dia tem 86400 segundos.
//

echo time();//timestamp atual.
echo " <- Data atual em timestamp <br>";
echo strtotime("1970-01-02");//strtotime recebe uma data no formato americano e retorna o valor em timestamp.
echo " <- Transformar uma data em timestamp <br>";
echo (time() - strtotime("2026-01-17")) / 86400;//essa formula calcula a quantidade de dias.
echo " <- Calculo de dias de uma data até a data atual <br>";
echo date(/*formato*/ "D d/m/Y", /*timestamp*/ time());//date recebe um timestamp e retorna o formato desejado.
echo " <- Transformar timestamp em data atual <br>";
//somar 10 dias em uma data.
$data = time();
$nova_data = $data + (86400 * 10)   ;
echo date("d/m/Y", $nova_data);
echo " <- Adicionar 10 dias a uma data <br>";
$nova_data = $data - (86400 * 10) ;
echo date("d/m/Y", $nova_data);
echo " <- Subtrair 10 dias a uma data <br>";
echo date("l", $data);
echo " <- Mostrar dia da semana da data atual";