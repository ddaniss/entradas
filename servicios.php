<?php

    $uri = "https://entradas.herokuapp.com/";
    $server = new SoapServer(null,array('uri'=>$uri));
    $server->addFunction("ultEntradas");
    $server->addFunction("categoriasUltEntradas");
    $server->addFunction("entradasPorFechas");
    $server->addFunction("eliminarEntradas");
    $server->handle();

    function ultEntradas(){
        $arrayEntradas= array();
        $conn = new mysqli("eu-cdbr-west-03.cleardb.net","bf6b5c6b976cdc","cdebb3b2","entradas");
        $conn->set_charset("utf8");
        if($conn->connect_error) {
            echo "error";
        }else{
            $query = "SELECT * FROM entrada ORDER BY entrada.fecha DESC LIMIT 10";
            $result = $conn->query($query);
            while($entrada = $result->fetch_array())
            {
                $arrayEntradas[] = $entrada;
            }
            return $arrayEntradas;
        }
    }
    function categoriasUltEntradas($cat){
        $arrayEntradas= array();
        $conn = new mysqli("eu-cdbr-west-03.cleardb.net","bf6b5c6b976cdc","cdebb3b2","entradas");
        $conn->set_charset("utf8");
        if($conn->connect_error) {
            echo "error";
        }else{
            $query = "SELECT * FROM entrada WHERE nombre_categoria = '$cat' ORDER BY entrada.fecha DESC LIMIT 10";
            $result = $conn->query($query);
            while($entrada = $result->fetch_array())
            {
                $arrayEntradas[] = $entrada;
            }
            return $arrayEntradas;
        }
    }
    function entradasPorFechas($fechas){
        $msg = "";
        $arrFechas = explode(",",$fechas);
        
        $arrayEntradas= array();
        $conn = new mysqli("eu-cdbr-west-03.cleardb.net","bf6b5c6b976cdc","cdebb3b2","entradas");
        $conn->set_charset("utf8");

        if (count($arrFechas) > 1) {
            if($conn->connect_error) {
                echo "error";
            }else{
                $query = "SELECT * FROM entrada WHERE fecha BETWEEN '$arrFechas[0]' AND '$arrFechas[1]' ORDER BY entrada.fecha ASC";
                $result = $conn->query($query);
                while($entrada = $result->fetch_array())
                {
                    $arrayEntradas[] = $entrada;
                }
                return $arrayEntradas;
            }
        } else {
            if($conn->connect_error) {
                echo "error";
            }else{
                $query = "SELECT * FROM entrada WHERE fecha > '$fechas' ORDER BY entrada.fecha ASC";
                $result = $conn->query($query);
                while($entrada = $result->fetch_array())
                {
                    $arrayEntradas[] = $entrada;
                }
                return $arrayEntradas;
            }
        }
        return $msg;
    }
    function eliminarEntradas($id){
        $conn = new mysqli("eu-cdbr-west-03.cleardb.net","bf6b5c6b976cdc","cdebb3b2","entradas");
        $conn->set_charset("utf8");
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "DELETE FROM entrada WHERE id = '$id'";
            $conn->query($sql);
        }
    }

?>