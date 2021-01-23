<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "localhost";
    $user = "pma";
    $pass = "";
    $db = "entradas";

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
        <a href="/entradas" class="logo">Entradas_</a>
    </header>
    <div class="formContainer">
        <form action="./crearEntrada.php" class="creacionForm" method="POST" enctype="multipart/form-data">
            <label>
                Título
                <input type="text" name="titulo">
            </label>
            <label>
                Resumen
                <textarea name="resumen" cols="100" rows="5" style="resize: none;"></textarea>
            </label>
            <label>
                Imagen
                <input type="file" name="img">
            </label>
            <label>
                Contenido
                <textarea name="contenido" cols="100" rows="50" style="resize: none;"></textarea>
            </label>
            <label>
                Fecha
                <input type="date" name="fecha">
            </label>
            <label>
                Autor
                <input type="text" name="autor">
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
            <button>Crear entrada</button>
        </form>
    </div>
    <footer>
        Copyright 2020 Entradas
    </footer>
</body>

</html>