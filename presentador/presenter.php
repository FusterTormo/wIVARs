<?php
include_once 'modelo/consultas.php';

/**
 * Recoger informacion basica de todas las variantes guardadas en la base de datos
 * @param string $usuario Tipo de usuario que pide la informacion. Se pasa al modelo para que elija que la base de datos de la que extraera la informacion
 * @return array[] Array de dos dimensiones con la informacion que ha devuelto el modelo
 */
function leerVariantes($usuario) {
    $datos = getVariantes($usuario);
    $tabla = array();
    if (is_array($datos)) {
        $tabla[0] = array_keys($datos[0]); // La primera fila de la tabla contendra la cabecera de la tabla
        $it = 1;
        foreach ($datos as $fila) {
            $tabla[$it] = array_values($fila);
            $it ++;
        }
    }
    else {
        $tabla[0] = $datos;
    }
    return $tabla;
}

/**
 * Preguntar a la base de datos cuantas muestras hay guardados en la base de datos
 * @param string $usuario Tipo de usuario que pide la informacion
 * @return int Numero de muestras que hay en la base de datos con dicha informacion
 */
function contarPacientes($usuario) {
    return getTotalMuestras($usuario);
}

function validar($usuario, $contrasena) {
    $cn = getPw($usuario);
    return password_verify($contrasena, $cn);
}
?>
