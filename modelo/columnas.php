<?php 
/**
 * Consultas para saber las columnas que tiene cada tabla. Y los titulos que tendra cada una de las tablas
 */


// NO SE SI SERA UTIL!!!!
function getColsMuestra($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,$bd);
    if($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT * from pacient LIMIT 1");
        $aux = $consulta->fetch_assoc();
        $resultado = array_keys($aux);
        $dbcon->close();
    }
    return $resultado;
}

?>