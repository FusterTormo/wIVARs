<?php
include_once 'presentador/presenter.php';
include_once 'presentador/ctes.php';

session_start();
if (isset($_SESSION["u"])) {
  $frase = "INFO: " . $_SESSION["u"] . " cierra sesion";
  editarLog(ACCESO, $frase);
}
session_unset();
session_destroy();
header("Location: index.php");
exit();
?>
