<!DOCTYPE html>
<html lang="es">
<head>
	<title>IJCvars</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/index.css"> 
	<script src="javascript/jquery-3.6.0.min.js"></script>
	<script src="javascript/index.js"></script>
</head>
<body>
	<header><h1>Usuario creado</h1></header>
	<?php
if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
?>
	<section>
		<h2 style="color: #6CC24A">Datos a guardar en la base de datos</h2>
		<p>Usuario</p><input type="text" disabled value="<?php print $_POST["usuario"]?>">
		<p>Contrase&ntilde;a</p><input type="text" disabled value="<?php print password_hash($_POST["contrasena"], PASSWORD_DEFAULT) ?>">
	</section>
<?php   
}
else {
?>
	<section>
		<form action="crearUsuario.php" method="post">
			<p>Nombre de usuaria/o</p>
			<input type="text" name="usuario" placeholder="Usuaria" autofocus autocomplete="off">
			<p>Contrase&ntilde;a</p>
			<input type="password" name="contrasena" placeholder="Contrasena">
			<button type="submit" name="login">Crear usuario</button>
		</form>
	</section>
<?php 
}
?>
	<footer><!-- Poner pie?? --></footer>
</body>
</html>

    
