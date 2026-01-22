<?php
include("qrcode.php");
if (isset($_POST["qr"]) && $_POST["qr"] != "") {

    $text = $_POST["qr"];
    $name = md5(time()) . '.png';
    $file = "files/{$name}";
    $options = array(
        "w"=> 450,
        "h"=> 450
    );

    $generator = new QRCode($text, $options);
    // $generator->output_image();
    $image = $generator->render_image();
    imagepng($image, $file);
    imagedestroy($image);

    if($image) {
        echo "<p>"; echo "Imagem salva com sucesso!<br>"; echo "<a href='{$file}' target='_blank'> Clique aqui para visualizar!</a>"; echo "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerador qrcode</title>
</head>

<body>
    <form method="POST" action="">
        <input type="text" name="qr" placeholder="enter text">
        <button type="submit">Generate</button>
    </form>
</body>

</html>