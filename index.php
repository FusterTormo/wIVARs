<?php include_once 'presentador/presenter.php'; 
session_start();

$max_intentos = 5;
if (isset($_SESSION["UsuarioBloqueado"])) {
    if (time() > $_SESSION["UsuarioBloqueado"]) {
        session_unset();
        header("Location: index.php");
        exit();
    }
    else {
        $tiempo = $_SESSION["UsuarioBloqueado"] - time();
        print "Queda " . date("i:s", $tiempo) . " minutos de bloqueo";
    }
}
else {
    if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
        if (validar($_POST["usuario"], $_POST["contrasena"])) {
            session_unset();
            $_SESSION["u"] = $_POST["usuario"];
            header("Location: variantes.php");
            exit();
        }
        else {
            if (isset($_SESSION["intentos"]))
                $_SESSION["intentos"] ++;
            else 
                $_SESSION["intentos"] = 1;
            
            if ($_SESSION["intentos"] >= $max_intentos) {
                $_SESSION["UsuarioBloqueado"] =  time() + (30 * 40); //Bloquear 30 minutos
            }
            print $_SESSION["intentos"] . " intentos realizados";
        }
    }
    else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>IJCvars</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/index.css"> 
	<script src="javascript/jquery-3.6.0.min.js"></script>
</head>
<body>
	<header><h1>&Aacute;rea restringida</h1></header>
	<section>
		<form action="index.php" method="post">
			<p>Usuario/a</p>
			<input type="text" name="usuario" placeholder="Usuario" autofocus autocomplete="off">
			<p>Contrase&ntilde;a</p>
			<input type="password" name="contrasena" placeholder="Contrasena">
			<button type="submit" name="login">Acceder</button>
		</form>
	</section>
	<footer><!-- Poner pie?? --></footer>
</body>
</html>
<?php
    }
}
?>