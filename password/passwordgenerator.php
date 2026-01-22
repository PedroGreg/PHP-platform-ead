<?php
if (isset($_POST["tamanho"]) && $_POST["tamanho"] != '') {
    $tamanho = intval($_POST['tamanho']);
    $lowercase = isset($_POST['lowercase']);
    $uppercase = isset($_POST['uppercase']);
    $symbols = isset($_POST['symbols']);
    $numbers = isset($_POST['numbers']);
    
    if(!$lowercase && !$uppercase && !$symbols && !$numbers) 
        echo "Falha ao gerar, selecione pelo menos um tipo";

    $lowercase_chars = "abcdefghijklmnopqrstuvwxyz";
    $uppercase_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $symbols_chars = "!@#$%&*()+_-=";
    $numbers_chars = "1234567890";

    $password = "";
    $options = "";
    if($lowercase)
        $options .= $lowercase_chars;
    if($uppercase)
        $options .= $uppercase_chars;
    if($symbols)
        $options .= $symbols_chars;
    if($numbers)
        $options .= $numbers_chars;

    for($i = 0; $i < $tamanho; $i+=1){
        $random = rand(0, strlen($options) - 1);
        $password .= $options[$random];
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador de senha</title>
</head>

<body>
    <form action="" method="POST">
        <div>
            <label for="tamanho">Comprimento da senha</label>
            <input type="number" name="tamanho" required min="8" placeholder="Tamanho da senha" id="tamanho" value="16">
        </div>
        <div>
            <label for="lowercase">Lowercase</label>
            <input type="checkbox" checked name="lowercase" id="lowercase" value="1">
        </div>
        <div>
            <label for="uppercase">Uppercase</label>
            <input type="checkbox" checked name="uppercase" id="uppercase"value="1">
        </div>
        <div>
            <label for="symbols">Symbols</label>
            <input type="checkbox" checked name="symbols" id="symbols"value="1">
        </div>
        <div>
            <label for="numbers">Numbers</label>
            <input type="checkbox" checked name="numbers" id="numbers"value="1">
        </div>
    <button type="submit">GERAR </button>
    </form>
    <p><b>Senha Gerada  </b><input type="text" name="gerada" value="<?php if (isset($password)) echo $password ?>"></p>
</body>

</html>