<?php

function changepw($usuario, $contrasena) {
  $resultado = "";
  $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, "UsuariosVar");
  if ($dbcon->connect_errno > 0) {
      $resultado = "Cannot connect to database";
  }
  else {
      $cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
      date_default_timezone_set("Europe/Madrid");
      $nextyear = strtotime("+1 Year");
      $caduca = date("Y-m-d", $nextyear);
      $edita = "UPDATE usuario SET contrasena='$cifrada',caduca='$caduca'  WHERE nombre='$usuario'";
      if ($dbcon->query($edita)) // La consulta se ha ejecutado correctamente
          $resultado = "Ok";
      else
          $resultado = $dbcon->errno . " - " . $dbcon->error;
      $dbcon->close();
  }
  return $resultado;
}


function getPwExpiration($usuario) {
  $resultado = "";
  $dbcon = new mysqli(SERVIDOR, USUARIO, CONTRASENA, "UsuariosVar");
  if ($dbcon->connect_errno > 0) {
    $resultado = "Cannot connect to database";
  }
  else {
    $consulta = $dbcon->query("SELECT caduca FROM usuario WHERE nombre='$usuario'");
    if ($consulta->num_rows == 0)
      $resultado = "User not found in database";
    else {
      $aux = $consulta->fetch_assoc();
      $resultado = $aux["caduca"];
    }
    $dbcon->close();
  }
  return $resultado;
}
?>
