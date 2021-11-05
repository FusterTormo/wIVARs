<?php
/**
 * Incluye funciones para todas las consultas que se hagan a las base de datos
 */

/**
 * Constantes usadas en las siguientes funciones
 */
define("SERVIDOR", "localhost");
define("USUARIO", "ffuster");
define("CONTRASENA", "Aetaeb6e");
define("BD", "ALLvar");


/**
 * Leer la informacion de todas las variantes que hay guardadas en la base de datos
 * @param string $usuario Identificador de usuario que accede a la base de datos. Se usa para seleccionar que base de datos abrir
 * @return string
 */
function getVariantes($usuario)
{
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,BD);
    if($dbcon->connect_errno > 0) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT id, cromosoma, inicio, fin, referencia, observado, gen, tipo_var, tipo_ex, hgvs_prot, dbsnp, cosmic, maf FROM variant");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("Chrom" => $r["cromosoma"], "Start" => $r["inicio"], "End" => $r["fin"], "Ref" => $r["referencia"], "Alt" => $r["observado"], "Gene" => $r["gen"],
                "Variant" => $r["tipo_ex"], "Transcript" => $r["transcrito"], "AA_Change" => $r["hgvs_prot"], "dbSNP" => $r["dbsnp"], "COSMIC" => $r["cosmic"], "MAF" => $r["maf"]
            );
            if ($r["tipo_ex"] == "NA")
                $resultado[$it]["Variant"] = $r["tipo_var"];
            
            $cont = $dbcon->query("SELECT count(*) veces FROM run WHERE id_variant=" . $r["id"]);
            $aux = $cont->fetch_assoc();
            $resultado[$it]["Reported"] = $aux["veces"] . " time(s)";
            $it++;
        }
    }
    $dbcon->close();
    
    return $resultado;
}

/**
 * Recoger el total de muestras guardadas en la base de datos
 * @param string $usuario Identificador de usuario que accede a la base de datos. Se usa para seleccionar que base de datos abrir 
 * @return string Numero de muestras guardas en la base de datos | Mensaje de error en caso de que no se pueda conectar a la base de datos 
 */
function getTotalMuestras($usuario) {
    $resultado = "";
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,BD);
    if($dbcon->connect_errno > 0) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT count(*) total FROM mostra");
        $aux = $consulta->fetch_assoc();
        $resultado = $aux["total"];
    }
    
    $dbcon->close();
    return $resultado;
}

function getUnaMuestra($usuario, $id) {
    $resultado = "";
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, BD);
    if ($dbcon->connect_errno > 0 ) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM variant v JOIN run r ON r.id_variant=v.id WHERE id=$id;");
        //TODO continuar la consulta per recollir una mostra completa
    }
    $dbcon->close();
    return $resultado;
}
?>