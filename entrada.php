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
    $sql = "SELECT * FROM entrada";
    $result = $conn->query($sql);

    $entradas = array();
    while($entrada = $result->fetch_array())
    {
        $entradas[] = $entrada;
    }

    $index;
    foreach ($entradas as $key=>$value){
        if($value["id"] == $_GET["entradaID"]) {
            $index = $key;
        }
    }
    $entradaSeleccionada = $entradas[$index];

    $autorID = $entradaSeleccionada["autor_id"];
    $sqlAutor = "SELECT nombre FROM usuario WHERE autor_id = '$autorID'";
    $resultAutor = $conn->query($sqlAutor);
    $autorArr = $resultAutor->fetch_array();
    $autor = $autorArr[0];

    $entradaID = $_GET["entradaID"];
    $sqlComentario = "SELECT * FROM comentario WHERE id = '$entradaID'";
    $result = $conn->query($sqlComentario);

    $comentarios = array();
    while($comentario = $result->fetch_array())
    {
        $comentarios[] = $comentario;
    }

    $categoriaSeleccionada = $entradaSeleccionada["nombre_categoria"];

    $sqlOtrasEntradas = "SELECT * FROM entrada WHERE nombre_categoria = '$categoriaSeleccionada' AND id != '$entradaID' ORDER BY fecha DESC LIMIT 3";
    $resultOtrasEntradas = $conn->query($sqlOtrasEntradas);

    $otrasEntradas = array();
    while($entrada = $resultOtrasEntradas->fetch_array())
    {
        $otrasEntradas[] = $entrada;
    }
    
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $entradaSeleccionada["titulo"] ?></title>
    <link rel="stylesheet" href="./css/entrada.css">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <header>
        <a href="/" class="logo">Entradas_</a>
    </header>

    <main>
        <div class="tituloContainer">
            <h1 class="titulo"><?php echo $entradaSeleccionada["titulo"] ?></h1>
            <div class="autorCard">
                <p>Autor: <span><?php echo $autor ?></span> Fecha:
                    <span><?php echo $entradaSeleccionada["fecha"] ?></span>
                </p>
            </div>
        </div>
        <p class="resumen"><?php echo $entradaSeleccionada["resumen"] ?></p>
        <!-- <hr> -->

        <img src="<?php echo $entradaSeleccionada["imagen"] ?>" alt="">

        <p class="contenido"><?php echo nl2br($entradaSeleccionada["contenido"]) ?></p>
        <hr>
        <div class="seccionComentarios">
            <h2 class="comentariosTitulo">Comentarios</h2>
            <div class="comentarioContainer">
                <!-- <div class="coment">
                    <p>Nombre</p>
                    <p class="comentarioTexto">Lorem ipsum</p>
                </div> -->
                <?php foreach ($comentarios as $key=>$value): ?>
                <div class="coment">
                    <p><?=$value["nombre"]?></p>
                    <p class="comentarioTexto"><?=$value["texto"]?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php if($_SESSION["rol"] === "registrado" || $_SESSION["rol"] === "administrador"): ?>
            <a href="/entradas/escribirComentario.php?entradaID=<?=$_GET["entradaID"]?>"
                class="comentarLink">Comentar</a>
            <?php else: ?>
            <a href="/entradas/login.php" class="comentarLink">Debes tener cuenta para comentar</a>
            <?php endif; ?>
        </div>
        <h2>Otras entradas de <?php echo $entradaSeleccionada["nombre_categoria"] ?></h2>
        <?php foreach ($otrasEntradas as $key=>$value): ?>
        <?php if($value["nombre_categoria"] == $entradaSeleccionada["nombre_categoria"]): ?>
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