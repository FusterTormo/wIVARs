<?php
include_once "presentador/presenter.php";
include_once "presentador/datosUsuario.php";

if (!empty($_POST["oldPas"]) && !empty($_POST["newPas1"]) && !empty($_POST["newPas2"])) {
  //TODO posar aquest condicional per poder cridar-lo des de AJAX
  if (validar($_POST["user"], $_POST["oldPas"])) {
    $respuesta = cambiarContrasena($_POST["user"], $_POST["newPas1"]);
    if ($respuesta == "Ok") {
      header("Location: cambiaPas.php?allok=sucess");
      exit;
    }
    else {
      header("Location: cambiaPas.php?error=$respuesta");
      exit;
    }
  }
  else {
    header("Location: cambiaPas.php?error=Login incorrect");
    exit;
  }
}
else {
  header("Location: cambiaPas.php");
  exit();
}

?>
