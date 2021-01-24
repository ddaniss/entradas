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
    
    $id = $_GET["id"];
    
    $imagen;
    if(isset($_POST["imagen"])) {
        $targetFile = './images/' . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);

        $imagen = $targetFile;
    } else {
        $sqlImagen = "SELECT imagen FROM entrada WHERE id = '$id'";
        $resultImagen = $conn->query($sqlImagen);
        $imagenArr = $resultImagen->fetch_array();
    }

    $autorNombre = $_POST["autor"];
    $sqlAutor = "SELECT autor_id FROM usuario WHERE nombre = '$autorNombre'";

    $resultAutor = $conn->query($sqlAutor);
    $autorArr = $resultAutor->fetch_array();

    $titulo = $_POST["titulo"];
    $resumen = $_POST["resumen"];
    $imagen = $imagenArr[0];
    $contenido = $_POST["contenido"];
    $fecha = $_POST["fecha"];
    $autor = $autorArr[0];
    $nombreCategoria = $_POST["categoria"];

    echo $imagen;

    $sql = "UPDATE entrada 
    SET 
    titulo = '$titulo',
    resumen = '$resumen',
    imagen = '$imagen',
    contenido = '$contenido',
    fecha = '$fecha',
    autor_id = '$autor',
    nombre_categoria = '$nombreCategoria'
    WHERE id = '$id'
    ";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header("Location: /entradas/gestion.php");

    $conn->close();
?>