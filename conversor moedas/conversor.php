<?php
$keyapi = "45f13c3b585baab3c0d710f2";
if (isset($_POST['value']) && $_POST['value'] != '') {
    $requrl = "https://v6.exchangerate-api.com/v6/$keyapi/latest/USD";
    $json = file_get_contents($requrl);
    if ($json) {
        try {
            $resultado = json_decode($json);
            if('success' === $resultado->result){
                $valordigitado = floatval($_POST['value']);
                $convertido = $valordigitado / $resultado->conversion_rates->BRL;
            }
        } catch (Exception $e) {
            echo "error: " . $e;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor</title>
</head>

<body>
    <form action="" method="post">
        <p>R$ <input type="text" name="value" value="<?php if(isset($_POST['value'])) echo $_POST['value']; ?>"></p>
        <p><button type="submit">Converter para dolar</button></p>
    </form>
    <?php if(isset($convertido)) : ?>
        <p>O valor em dólar é: <?php echo number_format($convertido, 2, ',', '.') ?></p>
    <?php endif ?>
</body>

</html>