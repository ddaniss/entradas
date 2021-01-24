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
    
    $id = $_GET["id"];
    
    $sql = "DELETE FROM entrada WHERE id = '$id'";

    $conn->query($sql);
    header("Location: /entradas/gestionEntradas.php");

    $conn->close();
?>