<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "eu-cdbr-west-03.cleardb.net";
    $user = "bf6b5c6b976cdc";
    $pass = "cdebb3b2";
    $db = "entradas";

    $conn = new mysqli($servername,$user,$pass,$db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $targetFile = './images/' . basename($_FILES["img"]["name"]);
    move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);

    $autorNombre = $_POST["autor"];
    $sqlAutor = "SELECT autor_id FROM usuario WHERE nombre = '$autorNombre'";

    $resultAutor = $conn->query($sqlAutor);
    $autorArr = $resultAutor->fetch_array();

    $titulo = $_POST["titulo"];
    $resumen = $_POST["resumen"];
    $imagen = $targetFile;
    $contenido = $_POST["contenido"];
    $fecha = $_POST["fecha"];
    $autor = $autorArr[0];
    $nombreCategoria = $_POST["categoria"];

    $sql = "INSERT INTO entrada (titulo,resumen,imagen,contenido,fecha,autor_id,nombre_categoria) VALUES ('$titulo','$resumen','$imagen','$contenido','$fecha','$autor','$nombreCategoria')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: /entradas/gestionEntradas.php");
?>