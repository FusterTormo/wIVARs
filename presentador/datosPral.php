<?php 

include_once '../modelo/consultas.php';

if (isset($_POST["dameMuestras"])) {
    $datos = getIDmuestras($_POST["usuario"]);
    $lista = [];
    if (is_array($datos)) {
        foreach ($datos as $d) {
            array_push($lista, $d["ID"]);
        }
        print json_encode($lista);
    }
    else {
        print $datos;
    }
}
elseif (isset($_POST["dameCrios"])) {
    $datos = getIDcrioviales($_POST["usuario"]);
    $lista = [];
    if (is_array($datos)) {
        foreach ($datos as $d) {
            array_push($lista, $d["ID"]);
        }
        print json_encode($lista);
    }
    else {
        print $datos;
    }
}
?>