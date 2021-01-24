<?php 
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "eu-cdbr-west-03.cleardb.net";
    $user = "bf6b5c6b976cdc";
    $pass = "cdebb3b2";
    $db = "heroku_fa88a7d71d8316f";

    $conn = new mysqli($servername,$user,$pass,$db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $sql = "SELECT * FROM entrada ORDER BY entrada.fecha DESC";
    $result = $conn->query($sql);

    $entradas = array();
    while($entrada = $result->fetch_array())
    {
        $entradas[] = $entrada;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Entradas</title>
    <link rel="stylesheet" href="./css/gestionEntradas.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <a href="/" class="logo">Entradas_</a>
    </header>
    <div class="formContainer">
        <div class="creacionForm">
            <?php foreach ($entradas as $key=>$value): ?>
            <form action="./modEntrada.php?id=<?php echo $value["id"] ?>" class="modForm" method="POST">
                <h2 class="entrada__title"><?php echo $value["titulo"] ?></h2>
                <div>
                    <input type="submit" value="Modificar">
                    <input type="submit" value="Borrar" formaction="./deleteEntrada.php?id=<?php echo $value["id"] ?>">
                </div>
            </form>
            <?php endforeach; ?>
        </div>
        <a class="nuevaEntrada" href="./nuevaEntrada.php">Nueva Entrada</a>
    </div>
    <footer>
        Copyright 2020 Entradas
    </footer>

</body>

</html>