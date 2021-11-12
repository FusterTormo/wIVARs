<?php 

include_once '../modelo/consultas.php';
include_once '../presentador/presenter.php';

if (isset($_POST["contar"]) && isset($_POST["usuario"])) {
    print getNumeroVariantes($_POST["usuario"]);
}
elseif (isset($_POST["dameVariantes"]) && isset($_POST["usuario"])) {
    $datos = getVariantes($_POST["usuario"], $_POST["inicio"], $_POST["registros"]);
    $tabla = array();
    $it = 0;
    if (is_array($datos)) {
        if ($_POST["inicio"] == 0) {
            $tabla[0] = array_keys($datos[0]); // La primera fila de la tabla contendra la cabecera de la tabla
            $it = 1;
        }
        foreach ($datos as $fila) {
            $tabla[$it] = array_values($fila);
            $it ++;
        }
    }
    else {
        $tabla[0] = $datos;
    }
    print json_encode($tabla);
}


?>