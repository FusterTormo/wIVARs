<?php
  session_start();
  $usuario = "";
  if (isset($_SESSION["u"]))
    $usuario = $_SESSION["u"];
  if (isset($_GET["error"])) {
    paginaError($_GET["error"]);
  }
  elseif (isset($_GET["allok"])) {
    paginaExito();
  }
  else {
    paginaNormal($usuario);
  }

/**
 * Muestra el codigo html para ver la pagina normal de cambio de contraseña. Esta pagina se muestra cuando no se han pasado datos a
 * la pagina por $GET
 * @param $usuario String Nombre del usuario que tiene que cambiar la contraseña. Se incrusta en el primer input del formulario
*/
function paginaNormal($usuario) {
  print <<<END
  <!DOCTYPE html>
  <html lang="es">
  <head>
     <title>LAbDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/base.css">
    <link rel="stylesheet" href="estilos/index.css">
    <script src="javascript/jquery-3.6.0.min.js"></script>
    <script src="javascript/formPass.js"></script>
  </head>
  <body>
    <header><h1>Change password</h1></header>
    <section style="width: 30%">
      <h3 style="text-align: left; color: red; border-bottom: 1px solid red; font-size: 1.5vw">Password expired</h3>
      <form action="doCambiarPas.php" method="post">
        <label for="usuario">User</label>
END;
  print "<input type='text' name='user' id='user' placeholder='User' readonly value='$usuario'>";
  print <<<END
        <span id="err_user" class="error">User cannot be empty</span>
        <label for="oldPas">Old password</label>
        <input type="password" name="oldPas" id="oldPas" placeholder="Old password" autofocus>
        <span id="err_pas1" class="error">Password cannot be empty</span>
        <label for="newPas1">New Password</label>
        <input type="password" name="newPas1" id="newPas1" placeholder="New Password">
        <span id="err_pas2" class="error">Please fill the new password</span>
        <label for="newPas2">Re-type your Password</label>
        <input type="password" name="newPas2" id="newPas2" placeholder="New Password">
        <span id="err_pas3" class="error">Please, re-type the new password</span>
        <button type="button" style="float: left; background-color: #6CC24A" id="showPass">Show passwords</button>
        <button type="submit" name="login">Change password</button>
      </form>
    </section>
  </body>
  </html>
END;
}

/**
 * Muestra el codigo html para notificiar al usuario que se ha cambiado la contraseña de su usuario
*/
function paginaExito() {
  print <<<END
  <!DOCTYPE html>
  <html lang="es">
  <head>
     <title>LAbDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/base.css">
    <link rel="stylesheet" href="estilos/index.css">
  </head>
  <body>
    <header><h1>Change password</h1></header>
    <section style="width: 40%">
      <h3 style="text-align: left; color: #6CC24A; font-size: 1.5vw">Password changed sucessfully</h3>
      <p><a href="index.php">Login</a></p>
    </section>
  </body>
  </html>
END;
}

/**
 * Muestra al usuario una pagina que explica el error que puede haber ocurrido cuando se iba a cambiar la contraseña
 * @param $mensaje String Mensaje de error que se ha recibido al intentar validar el cambio de contraseña del usuario
*/
function paginaError($mensaje) {
  print <<<END
  <!DOCTYPE html>
  <html lang="es">
  <head>
     <title>LAbDb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/base.css">
    <link rel="stylesheet" href="estilos/index.css">
  </head>
  <body>
    <header><h1>Change password</h1></header>
    <section style="width: 40%">
      <h3 style="text-align: left; color: red; border-bottom: 1px solid red; font-size: 1.5vw">Error updating password</h3>
      <p style="font-weight: bold">Description</p>
END;
      print "<p>$mensaje</p>";
  print <<<END
      <p><a href="cambiaPas.php">Try again</a></p>
    </section>
  </body>
  </html>
END;
}
