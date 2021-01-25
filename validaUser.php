<?php 
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $servername = "eu-cdbr-west-03.cleardb.net";
    $user = "bf6b5c6b976cdc";
    $pass = "cdebb3b2";
    $db = "heroku_fa88a7d71d8316f";

    $conn = mysqli_connect($servername,$user,$pass,$db) 
        or die("Error " . mysqli_error($connection));

    $sql = 'SELECT * FROM usuario';
    $result = mysqli_query($conn, $sql) 
        or die("Error in Selecting " . mysqli_error($conn));

    $userData = array();
    while($row =mysqli_fetch_assoc($result))
    {
        $userData[] = $row;
    }

    var_dump($userData);

    mysqli_close($conn);

    foreach ($userData as $key => $value) {
        if($_POST["user"]==$value["nombre"] && $_POST["pass"]==$value["pass"]) {
            if ($value["rol"]=="administrador") {
            header("Location: /index.php?user=administrador");
            $_SESSION["rol"] = "administrador";
            $_SESSION["id"] = $value["autor_id"];
            die();
            } else{ 
                header("Location: /index.php?user=registrado");
                $_SESSION["rol"] = "registrado";
                $_SESSION["id"] = $value["autor_id"];
                die();
            }
    }
} 
    header("Location: /login.php?user=noExiste");
    $_SESSION["rol"] = "registrado";
?>