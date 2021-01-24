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
    $sql = "SELECT * FROM categoria";
    $result = $conn->query($sql);

    $categorias = array();
    while($categoria = $result->fetch_array())
    {
        $categorias[] = $categoria;
    }

    $sql = "SELECT * FROM entrada";
    $result = $conn->query($sql);

    $entradas = array();
    while($entrada = $result->fetch_array())
    {
        $entradas[] = $entrada;
    }

    $sql = "SELECT nombre FROM usuario";
    $result = $conn->query($sql);

    $autores = array();
    while($autor = $result->fetch_array())
    {
        $autores[] = $autor;
    }

    $conn->close();
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
        <form action="./entradaModificada.php?id=<?=$_GET["id"]?>" class="creacionForm" method="POST"
            enctype="multipart/form-data">
            <?php foreach ($entradas as $key=>$value): ?>
            <?php if ($value["id"] === $_GET["id"]): ?>
            <label>
                Título
                <input type="text" name="titulo" value="<?php echo $value["titulo"] ?>">
            </label>
            <label>
                Resumen
                <textarea name="resumen" cols="100" rows="5"
                    style="resize: none;"><?php echo $value["resumen"] ?></textarea>
            </label>
            <label>
                Imagen
                <input type="file" name="img" value="<?php echo $value["imagen"] ?>">
            </label>
            <label>
                Contenido
                <textarea name="contenido" cols="100" rows="50"
                    style="resize: none;"><?php echo $value["contenido"] ?></textarea>
            </label>
            <label>
                Fecha
                <input type="date" name="fecha" value="<?php echo $value["fecha"] ?>">
            </label>
            <label>
                Autor
                <select name="autor">
                    <?php foreach ($autores as $key=>$value): ?>
                    <option value="<?php echo $value['nombre'] ?>"> <?php echo $value["nombre"]; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                Categoría
                <select name="categoria">
                    <?php foreach ($categorias as $key=>$value): ?>
                    <option value="<?php echo $value['nombre_categoria'] ?>"> <?php echo $value["nombre_categoria"]; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button>Modificar Entrada</button>
            <input type="submit" formaction="./gestionEntradas.php" value="Descartar">
            <?php endif; ?>
            <?php endforeach; ?>
        </form>
    </div>
    <footer>
        Copyright 2020 Entradas
    </footer>
</body>

</html>