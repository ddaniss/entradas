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

    if(!isset($_SESSION["rol"]) || isset($_GET["sesion"])) {
        $_SESSION["rol"] = "invitado";
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas</title>
    <link rel="stylesheet" href="./css/index.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <a href="/entradas" class="logo">Entradas_</a>
        <ul class="nav">
            <li class="nav__item"><a href="/entradas?categoria=Politica">Política</a></li>
            <li class="nav__item"><a href="/entradas?categoria=Ciencia">Ciencia</a></li>
            <li class="nav__item"><a href="/entradas?categoria=Ocio">Ocio</a></li>
            <li class="nav__item"><a href="/entradas">Todas las entradas</a></li>
        </ul>

        <div class="sesion">
            <?php if($_SESSION["rol"] === "administrador"): ?>
            <a href="/entradas/gestionEntradas.php" class="loginLink">Gestionar Entradas</a>
            <a href="/entradas/index.php?sesion=logout" class="loginLink loginCorto">Cerrar sesión </a>
            <?php elseif($_SESSION["rol"] === "invitado"): ?>
            <a href="/entradas/login.php" class="loginLink loginCorto1">Login</a>
            <?php elseif($_SESSION["rol"] === "registrado"): ?>
            <span>Bienvenido</span>
            <a href="/entradas/index.php?sesion=logout" class="loginLink loginCorto">Cerrar sesión </a>
            <?php endif; ?>
        </div>
    </header>

    <main class="entradaGallery">
        <!-- <div class="entradaCard">
            <h2 class="entrada__title">Título</h2>
        </div> -->

        <?php foreach ($entradas as $key=>$value): ?>

        <?php if(!isset($_GET["categoria"])): ?>
        <a href="./entrada.php?entradaID=<?php echo $value["id"] ?>" class="entradaCard">
            <img src="<?php echo $value["imagen"]?>" alt="#">
            <h2 class="entrada__title"><?php echo $value["titulo"] ?></h2>
        </a>
        <?php elseif($value["nombre_categoria"] == $_GET["categoria"]): ?>
        <a href="./entrada.php?entradaID=<?php echo $value["id"] ?>" class="entradaCard">
            <img src="<?php echo $value["imagen"]?>" alt="#">
            <h2 class="entrada__title"><?php echo $value["titulo"] ?></h2>
        </a>
        <?php endif; ?>
        <?php endforeach; ?>
    </main>

    <footer>
        Copyright 2020 Entradas
    </footer>
</body>

</html>