<?php

function enviararquivo($pdo, $size, $error, $name, $tmp_name)
{
    if ($size > 4194304)//Verificação do tamanho
        die('O arquivo deve ser menor que 4MB');
    if ($error)//Verificação de tem algum erro
        die('Erro ao enivar o arquivo');
    $path = '../lib/fotos/';//Definição de qual caminho será guardado o arquivo
    $nomeDoArquivo = $name;//Definindo o nome original do arquivo
    $nomeArquivo = uniqid();//Definindo um nome unico para o arquivo via uniqid
    $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));//Colocando pegando a extensão em minúsculo
    $novoPath = $path . $nomeArquivo . "." . $extensao;//Definindo o path completo do arquivo após guardado
    if ($extensao != "png" && $extensao != "jpg" && $extensao != "jpeg" && $extensao != "webp")//Validação se é um imagem
        die("tipo de arquivo incorreto");
    $enviar = move_uploaded_file($tmp_name, $novoPath);//Função para mover o arquivo, usa o tmp_name(de onde sai) e o path de onde ficará(pasta + arquivo + extensão)
    if ($enviar)
        return $novoPath;
    else
        return false;
    if ($pdo) {
        try {
            $sql = "INSERT INTO arquivos (nomeoriginal, path) VALUES (:nome, :path)";
            $query = $pdo->prepare($sql);
            $query->bindParam(":nome", $nomeDoArquivo, PDO::PARAM_STR);
            $query->bindParam(":path", $novoPath, PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $novoPath;
        }

    } else {
        echo "Falha ao enviar";
        return false;
    }
}