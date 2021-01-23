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

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // } 
    // $sql = "SELECT * FROM categoria";
    // $result = $conn->query($sql);
    
    $autorID = $_SESSION["id"];
    $sqlNombre = "SELECT nombre FROM usuario WHERE autor_id='$autorID'";
    $result = $conn->query($sqlNombre);
    $autorArr = $result->fetch_array();
    
    $id = $_GET["entradaID"];
    $autor = $autorArr[0];
    $texto = $_POST["comentario"];
    
    $sql = "INSERT INTO comentario (nombre,id,texto) VALUES ('$autor','$id','$texto')";
    $conn->query($sql);

    var_dump($_SESSION);

    header("Location: ./entrada.php?entradaID=$id");
    $conn->close();
?>