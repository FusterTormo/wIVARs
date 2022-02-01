<?php

include_once "constantes.php";
include_once "consultas.php";


function getNewIdIjc($usuario) {
  $resultado = "";
  $bd = getBD($usuario);
  $dbcon = new mysqli(SERVIDOR,USUARIO,CONTRASENA,$bd);
  if($dbcon->connect_errno > 0) {
    $resultado = "Cannot connect to database";
  }
  else {
    $consulta = $dbcon->query("SELECT max(id_ijc) id FROM pacient");
    if ($consulta->num_rows == 1) {
      $resultado = $consulta->fetch_assoc()["id"];
    }
    else {
      $resultado = "A001";
    }
    $dbcon->close();
    return $resultado;
  }
}

?>
