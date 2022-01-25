<?php
include_once 'modelo/consultas.php';

/**
 * Recoger informacion basica de todas las variantes guardadas en la base de datos
 * @param string $usuario Tipo de usuario que pide la informacion. Se pasa al modelo para que elija que la base de datos de la que extraera la informacion
 * @return array[] Array de dos dimensiones con la informacion que ha devuelto el modelo
 */
function leerVariantes($usuario, $inicio, $fin) {
    $datos = getVariantes($usuario, $inicio, $fin);
    $tabla = array();
    $it = 0;
    if (is_array($datos)) {
        if ($inicio == 0) {
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

function getPral($usuario) {
    return getPagPrincipal($usuario);
}

function getBase($usuario) {
    return getBD($usuario);
}

function getTituloVariante($usuario, $id) {
    $datos = getUnaVariante($usuario, $id);
    if ($datos[0]["HGVS"] != "NA") {
        return $datos[0]["Chrom"] . ":g." . $datos[0]["Start"] . $datos[0]["Ref"] . ">"  .$datos[0]["Alt"] .  " (" . $datos[0]["Gene"] . "-" . $datos[0]["HGVS"] . ")";
    }
    else {
        return $datos[0]["Chrom"] . ":g." . $datos[0]["Start"] . $datos[0]["Ref"] . ">"  .$datos[0]["Alt"] .  " (" . $datos[0]["Gene"] . ")";
    }
}

function leerRuns($usuario, $id) {
    $datos = getUnaVariante($usuario, $id);
    $tabla = array();
    $it = 0;
    if (is_array($datos)) {
        $tabla[0] = array("Sample_ID", "VAF", "General", "Ref.", "Alt.", "Ref.FW", "Ref.RV", "Alt.FW", "Alt.RV", "Filter", "Run", "Classification", "Info");
        foreach ($datos as $fila) {
            $it ++;
            $tabla[$it] = array($fila["sampID"], $fila["VAF"], $fila["Gen."], $fila["Ref."], $fila["Alt."], $fila["ref_FW"], $fila["ref_RV"], $fila["alt_FW"], $fila["alt_RV"], $fila["Filter"],
                $fila["RunName"], $fila["Class."], $fila["Oth_info"]);
        }
    }
    else {
        $tabla[0] = $datos;
    }
    return $tabla;
}

function leerMuestra($usuario, $id) {
    $datos = getUnaMuestra($usuario, $id);
    if (is_array($datos))
        return $datos[0];
    else
        return array($datos);
}

function leerTodasMuestras($usuario) {
    $datos = getAllMuestras($usuario);
    $tabla = array();
    $it = 0;
    if (is_array($datos)) {
        $tabla[0] = array_keys($datos[0]);
        $it = 1;
        foreach ($datos as $d) {
            $tabla[$it] = array_values($d);
            $it ++;
        }
    }
    else {
        $tabla[0] = $datos;
    }
    return $tabla;
}

function leerCryo($usuario, $id) {
    $datos = getUnCriovial($usuario, $id);
    if (is_array($datos))
        return $datos[0];
    else
        return array($datos);
}

function leerTodosCrioviales($usuario, $muestra = NULL) {
    if (is_null($muestra))
        $datos = getAllCrioviales($usuario);
    else
        $datos = getCriosXMuestra($usuario, $muestra);
    $tabla = array();
    $it = 0;
    if (is_array($datos)) {
        if (count($datos) == 0) {
            $tabla[0] = array("Information");
            $tabla[1] = array("No data");
        }
        else {
            $tabla[$it] = array_keys($datos[0]);
            $it ++;
            foreach ($datos as $d) {
                $tabla[$it] = array_values($d);
                $it ++;
            }
        }
    }
    else {
        $tabla[$it] = $datos;
    }
    return $tabla;
}
?>
