<?php
include_once "modelo/usuario.php";

function cambiarContrasena($usuario, $contrasena) {
  return changepw($usuario, $contrasena);
}

function leerCaducidadPw($usuario) {
  return getPwExpiration($usuario);
}
?>
