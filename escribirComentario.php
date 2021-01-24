<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // $servername = "localhost";
    // $user = "pma";
    // $pass = "";
    // $db = "entradas";

    // $conn = new mysqli($servername,$user,$pass,$db);

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // } 
    // $sql = "SELECT * FROM categoria";
    // $result = $conn->query($sql);

    // $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear entrada</title>
    <link rel="stylesheet" href="./css/nuevaEntrada.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <a href="/" class="logo">Entradas_</a>
    </header>
    <div class="formContainer">
        <form action="./publicarComentario.php?entradaID=<?=$_GET["entradaID"]?>" class="creacionForm" method="POST">
            <label>
                Comentario
                <textarea name="comentario" cols="100" rows="5" style="resize: none;"></textarea>
            </label>

            <button>Publicar comentario</button>
            <input type="submit" formaction="./entrada.php?entradaID=<?=$_GET["entradaID"]?>" value="Descartar">
        </form>
    </div>
    <footer>
        Copyright 2020 Entradas
    </footer>
</body>

</html>