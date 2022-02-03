<?php
/**
 * Incluye funciones para todas las consultas que se hagan a las base de datos
 */

include_once 'constantes.php';

/******************************************************
 * Consultas a la tabla de muestra (ALLvar y MDSvar) *
 *****************************************************/
/**
 * Calcular el total de muestras guardadas en la base de datos
 * @param string $usuario Identificador de usuario que accede a la base de datos. Se usa para seleccionar que base de datos abrir
 * @return string Numero de muestras guardas en la base de datos | Mensaje de error en caso de que no se pueda conectar a la base de datos
 */
function getTotalMuestras($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,$bd);
    if($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT count(*) total FROM mostra");
        $aux = $consulta->fetch_assoc();
        $resultado = $aux["total"];
        $dbcon->close();
    }
    return $resultado;
}

/**
 * Leer de la base de datos todos los identificadores de muestras y devolverlos en un array de dos dimensiones.
 * @param string $usuario Usuario que quiere acceder a los datos. Se usa para saber de que base de datos recoger la informacion
 * @return string|array[][] Array 2x2 con los identificadores de todas las muestras (titulo de la columna: ID). En caso de error, devuvelve el mensaje de error
 */
function getIDmuestras($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT id_ijc FROM pacient order by id_ijc");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("ID" => $r["id_ijc"]);
            $it ++;
        }
        $dbcon->close();
    }
    return $resultado;
}

/**
 * Recoger todos los datos de una muestra pasada por parametro
 * @param string $usuario Nombre del usuario que hace la consulta. Se usa para seleccionar la base de datos de la cual extraer informacion
 * @param string $id Clave principal de la muestra que se esta buscando
 * @return string|array[][] Todos los datos de la muestra. En caso de error, devuelve un mensaje con el error que se ha producido
 */
function getUnaMuestra($usuario, $id) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        //Leer la informacion basica del paciente
        $consulta = $dbcon->query("SELECT * FROM pacient WHERE id_ijc='$id'");
        $tmp = $consulta->fetch_assoc();
        $resultado = array();
        $resultado[0] = array("ID_IJC" => $tmp["id_ijc"], "ID_PETHEMA" => $tmp["id_pethema"], "ID_Salamanca" => $tmp["id_salamanca"], "Initials" => $tmp["inicials"], "Gender" => $tmp["sexe"],
            "Age" => $tmp["edat"], "Hospital" => $tmp["hospital"], "Email" => $tmp["mail_contacte"], "Protocol" => $tmp["protocol"], "Diagnostic" => $tmp["diagnostic"],
            "DX_Date" => $tmp["data_diagnostic"], "CI" => $tmp["ci"]);
        //Recoger los identificadores de las claves ajenas. Crioviales
        $consulta = $dbcon->query("SELECT codi_extern FROM criovial WHERE id_pacient='$id'");
        $crios = array();
        foreach ($consulta as $r) {
            array_push($crios, $r["codi_extern"]);
        }
        $resultado[0]["Cryovials"] = $crios;
        //TODO Preguntar si una mostra pot tindre dna extret sense haver creat un criovial
        //$consulta = $dbcon->query("SELECT codi_extern FROM dna WHERE ")

        $dbcon->close();
    }
    return $resultado;
}

function getAllMuestras($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to $bd database";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM pacient");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("ID_IJC" => $r["id_ijc"], "ID_PETHEMA" => $r["id_pethema"], "ID_Salamanca" => $r["id_salamanca"], "Initials" => $r["inicials"], "Gender" => $r["sexe"],
                "Age" => $r["edat"], "Hospital" => $r["hospital"], "Email" => $r["mail_contacte"], "Protocol" => $r["protocol"], "Diagnostic" => $r["diagnostic"],
                "DX_Date" => $r["data_diagnostic"], "CI" => $r["ci"]);
            $it ++;
        }
    }
    return $resultado;
}

/***********************************************
 * Consultas a la tabla de Crioviales (ALLvar) *
 **********************************************/
function getIDcrioviales($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT codi_extern FROM criovial order by codi_extern");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("ID" => $r["codi_extern"]);
            $it ++;
        }
        $dbcon->close();
    }
    return $resultado;
}

function getUnCriovial($usuario, $id) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM criovial WHERE codi_extern='$id'");
        $tmp = $consulta->fetch_assoc();
        $resultado = array(0 => array("ID" => $tmp["codi_extern"], "Date" => $tmp["data"], "Origin" => $tmp["origen"], "Disease_step" => $tmp["punt_malaltia"], "Tissue" => $tmp["teixit"],
            "Blast_perc." => $tmp["percent_blasts"], "Stored_in" => $tmp["guardat_en"], "Defrost_date" => $tmp["data_descongelacio"], "Defrost_reas." => $tmp["motiu_descongelacion"],
            "Availability" => $tmp["viabilitat"], "Sorting" => $tmp["sorting"], "Sort.Pop." => $tmp["sorting_population"], "Comment" => $tmp["comentari"], "Pat.ID" => $tmp["id_pacient"],
            "Refrozen" => $tmp["refrozen"], "Mice" => $tmp["mice"]));
        $dbcon->close();
    }
    return $resultado;
}

function getAllCrioviales($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to $bd database";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM criovial");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("ID" => $r["codi_extern"], "Date" => $r["data"], "Origin" => $r["origen"], "Disease_step" => $r["punt_malaltia"], "Tissue" => $r["teixit"],
                "Blast_perc." => $r["percent_blasts"], "Stored_in" => $r["guardat_en"], "Defrost_date" => $r["data_descongelacio"], "Defrost_reas." => $r["motiu_descongelacio"], 
                "Availability" => $r["viabilitat"], "Sorting" => $r["sorting"], "Sort.Pop." => $r["sorting_population"], "Comment" => $r["comentari"], "Pat.ID" => $r["id_pacient"]/*,
                "Refrozen" => $r["refrozen"], "Mice" => $r["mice"]*/);
            $it ++;
        }
    }
    return $resultado;
}

function getCriosXMuestra($usuario, $muestra) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to $bd database";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM criovial WHERE id_pacient='$muestra'");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("ID" => $r["codi_extern"], "Date" => $r["data"], "Origin" => $r["origen"], "Disease_step" => $r["punt_malaltia"], "Tissue" => $r["teixit"],
                "Blast_perc." => $r["percent_blasts"], "Stored_in" => $r["guardat_en"], "Defrost_date" => $r["data_descongelacio"], "Defrost_reas." => $r["motiu_descongelacion"],
                "Availability" => $r["viabilitat"], "Sorting" => $r["sorting"], "Sort.Pop." => $r["sorting_population"], "Comment" => $r["comentari"],"Pat.ID" => $r["id_pacient"]/*,
                "Refrozen" => $r["refrozen"], "Mice" => $r["mice"]*/);
            $it ++;
        }
    }
    return $resultado;
}

/**************************************************
 * Consultas a la tabla de Run (ALLvar y MDSvar) *
 *************************************************/

/**
 *
 * @param string $usuario
 * @param string $id
 * @return string|array[][]
 */
//TODO puede que esta funcion no se use
function getVariantesXmuestra($usuario, $id) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0 ) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM run r JOIN variant v ON r.id_variant=v.id WHERE id_mostra=$id;");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("Chrom" => $r["cromosoma"], "Start" => $r["inicio"], "Fin" => $r["fin"], "Ref" => $r["referencia"], "Alt" => $r["observado"], "Gene" => $r["gen"],  "Gene_Ref." => $r["genoma_ref"],
                "Var_type" => $r["tipo_var"], "Var_exonic" => $r["tipo_ex"], "Transcript" => $r["transcrito"], "HGVS_cDNA" => $r["hgvs_cDNA"], "HGVS_prot" => $r["hgvs_prot"], "Exon" => $r["exon"],
                "dbSNP" => $r["dbsnp"], "ClinVar" => $r["clinvar"], "COSMIC" => $r["cosmic"], "Pred_summary" => $r["sum_pred"], "MAF" => $r["maf"], "Population_MAF" => $r["pop_maf"],
                "Annotations" => $r["anotaciones"], "varID" => $r["id_variant"], "sampID" => $r["id_mostra"], "Cov_Gen." => $r["coverage"], "Cov_Ref." => $r["cov_ref"], "Cov_Alt." => $r["cov_alt"],
                "Ref_FW" => $r["reads_FW_ref"], "Ref_RV" => $r["reads_RV_ref"], "Alt_FW" => $r["reads_FW_alt"], "Alt_RV" => $r["reads_RV_alt"], "VAF" => $r["vaf"], "Filter" => $r["filtro"],
                "Run_info" => $r["info_run"]);
            $it ++;
        }
        $dbcon->close();
    }
    return $resultado;
}

/****************************************************
 * Consultas a la tabla variante (ALLvar y MDSvar) *
 ***************************************************/

/**
 * Leer la informacion de todas las variantes que hay guardadas en la base de datos
 * @param string $usuario Identificador de usuario que accede a la base de datos. Se usa para seleccionar que base de datos abrir
 * @return string
 */
function getVariantes($usuario, $inicio = 0, $filas = 1000)
{
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA, $bd);
    if($dbcon->connect_errno > 0) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT id, cromosoma, inicio, fin, referencia, observado, gen, tipo_var, tipo_ex, transcrito, hgvs_prot, dbsnp, cosmic, maf FROM variant LIMIT $inicio, $filas");
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
        $dbcon->close();
    }
    return $resultado;
}

function getNumeroVariantes($usuario) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,$bd);
    if($dbcon->connect_errno > 0) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT count(*) total FROM variant");
        $aux = $consulta->fetch_assoc();
        $resultado = $aux["total"];
        $dbcon->close();
    }
    return $resultado;
}

function getUnaVariante($usuario, $id) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
          $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM variant v JOIN run r ON r.id_variant=v.id WHERE id=$id");
        $resultado = array();
        $it = 0;
        foreach ($consulta as $r) {
            $resultado[$it] = array("Chrom" => $r["cromosoma"], "Start" => $r["inicio"], "Fin" => $r["fin"], "Ref" => $r["referencia"], "Alt" => $r["observado"],  "Gene" => $r["gen"],
                "HGVS" => $r["hgvs_prot"], "Variant" => $r["tipo_ex"], "sampID" => $r["id_mostra"], "Gen." => $r["coverage"], "Ref." => $r["cov_ref"], "Alt." => $r["cov_alt"],
                "ref_FW" => $r["reads_FW_ref"], "ref_RV" => $r["reads_RV_ref"], "alt_FW" => $r["reads_FW_alt"], "alt_RV" => $r["reads_RV_alt"], "VAF" => $r["vaf"], "Filter" => $r["filtro"],
                "Class." => $r["clasificacion"], "RunName" => $r["nom"], "Oth_info" => $r["info_run"]);
            if ($r["tipo_ex"] == "NA")
                $resultado[$it]["Variant"] = $r["tipo_var"];
            $it++;
        }
        $dbcon->close();
    }
    return $resultado;
}

function getFullVariante($usuario, $chr, $inicio, $obs) {
    $resultado = "";
    $bd = getBD($usuario);
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, $bd);
    if ($dbcon->connect_errno > 0) {
        $resultado = "No se puede conectar a la base de datos";
    }
    else {
        $consulta = $dbcon->query("SELECT * FROM variant v WHERE cromosoma='$chr' AND inicio=$inicio AND observado='$obs'");
        $aux = $consulta->fetch_assoc();
        $resultado = array("Id" => $aux["id"], "Chromosome" => $aux["cromosoma"], "Start" => $aux["inicio"], "Fin" => $aux["fin"], "Ref" => $aux["referencia"], "Alt" => $aux["observado"],
            "Gene" => $aux["gen"],"Gene_Ref." => $aux["genoma_ref"], "Var_type" => $aux["tipo_var"], "Var_exonic" => $aux["tipo_ex"], "Transcript" => $aux["transcrito"],
            "HGVS_cDNA" => $aux["hgvs_cDNA"], "HGVS_prot" => $aux["hgvs_prot"], "Exon" => $aux["exon"], "dbSNP" => $aux["dbsnp"], "ClinVar" => $aux["clinvar"], "COSMIC" => $aux["cosmic"],
            "Pred_summary" => $aux["sum_pred"], "MAF" => $aux["maf"], "Population_MAF" => $aux["pop_maf"], "Annotations" => $aux["anotaciones"]);
        $dbcon->close();
    }
    return $resultado;
}



/*********************************************
 * Consultas a la base de datos de usuarios *
 ********************************************/

function getPw($usuario) {
    $resultado = "";
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, "UsuariosVar");
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT contrasena FROM usuario WHERE nombre='$usuario'");
        if ($consulta->num_rows == 0)
            $resultado = "No existe";
        else {
            $aux = $consulta->fetch_assoc();
            $resultado = $aux["contrasena"];
        }
        $dbcon->close();
    }
    return $resultado;
}

function getBD($usuario) {
    $resultado = "";
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, "UsuariosVar");
    if ($dbcon->connect_errno > 0) {
        error_log("ERROR: No se pudo conectar a la base de datos desde getBD");
        $resultado = "";
    }
    else {
        $consulta = $dbcon->query("SELECT base_datos FROM usuario WHERE nombre='$usuario'");
        if ($consulta->num_rows == 0) {
            $resultado = "Not found";
        }
        else {
            $aux = $consulta->fetch_assoc();
            $resultado = $aux["base_datos"];
        }
        $dbcon->close();
    }
    return $resultado;
}

function getPagPrincipal($usuario) {
    $resultado = "";
    $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, "UsuariosVar");
    if ($dbcon->connect_errno > 0) {
        $resultado = "Cannot connect to database";
    }
    else {
        $consulta = $dbcon->query("SELECT pag_pral FROM usuario WHERE nombre='$usuario'");
        if ($consulta->num_rows == 0) {
            $resultado = "Not found user";
        }
        else {
            $aux = $consulta->fetch_assoc();
            $resultado = $aux["pag_pral"];
        }
        $dbcon->close();
    }
    return $resultado;
}
?>
