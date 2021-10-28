<?php
/**
 * Incluye funciones para todas las consultas que se hagan a las base de datos
 */

/**
 * Leer la informacion de todas las variantes que hay guardadas en la base de datos
 * @param string $usuario Identificador de usuario que accede a la base de datos. Se usa para seleccionar que base de datos abrir
 * @return string
 */
function getVariantes($usuario)
{
    $servidor = "localhost";
    $usuario = "ffuster";
    $contrasena = "Aetaeb6e";
    $baseDatos = "ALLvar";
    $dbcon = new mysqli($servidor,$usuario,$contrasena,$baseDatos);
    if($dbcon->connect_errno > 0)
    {
        $resultado = "No se puede conectar a la base de datos";
    }
    else
    {
        $consulta = $dbcon->query("SELECT id, cromosoma, inicio, fin, referencia, observado, gen, tipo_var, tipo_ex, hgvs_prot, dbsnp, cosmic, maf FROM variant");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("Chromosome" => $r["cromosoma"], "Start" => $r["inicio"], "End" => $r["fin"], "Ref" => $r["referencia"], "Alt" => $r["observado"], "Gene" => $r["gen"],
                "Variant" => $r["tipo_ex"], "AA_Change" => $r["hgvs_prot"], "dbSNP" => $r["dbsnp"], "COSMIC" => $r["cosmic"], "MAF" => $r["maf"]
            );
            if ($r["tipo_ex"] == "NA")
                $resultado[$it]["Variant"] = $r["tipo_var"];
            
            $cont = $dbcon->query("SELECT count(*) veces FROM run WHERE id_variant=" . $r["id"]);
            error_log("SELECT count(*) veces FROM run WHERE id_mostra=" . $r["id"]);
            $aux = $cont->fetch_assoc();
            $resultado[$it]["Reported"] = $aux["veces"] . " time(s)";
            $it++;
        }
    }
    return $resultado;
}

function getTotalMuestras($usuario) {
    $servidor = "localhost";
    $usuario = "ffuster";
    $contrasena = "Aetaeb6e";
    $baseDatos = "ALLvar";
    $dbcon = new mysqli($servidor,$usuario,$contrasena,$baseDatos);
    if($dbcon->connect_errno > 0)
    {
        $resultado = "No se puede conectar a la base de datos";
    }
    else
    {
        $consulta = $dbcon->query("SELECT count(*) total FROM mostra");
        $aux = $consulta->fetch_assoc();
        $resultado = $aux["total"];
    }
    
    return $resultado;
}
?>