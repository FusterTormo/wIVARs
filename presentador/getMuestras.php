<?php

include_once "../modelo/muestra.php";

if (isset($_POST["getIDIJC"]) && isset($_POST["usuario"])) {
  getMaxId($_POST["usuario"]);
}

function getMaxId($usuario) {
  $datos = getNewIdIjc($usuario);
  $id = preg_replace('/[^0-9]/', '', $datos) + 1; //Extraer el numero del identificador y sumarle uno
  print "A$id";
}

?>
