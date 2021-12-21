<?php include_once 'presentador/presenter.php'; 
session_start();

define("MAX_INTENTOS", 5);

if (isset($_SESSION["UsuarioBloqueado"])) {
    if (time() > $_SESSION["UsuarioBloqueado"]) {
        session_unset();
        header("Location: index.php");
        exit();
    }
    else {
        $tiempo = $_SESSION["UsuarioBloqueado"] - time();
        paginaBloqueo($tiempo);
    }
}
else {
    if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
        if (validar($_POST["usuario"], $_POST["contrasena"])) {
            session_unset();
            $redirige = getPral($_POST["usuario"]);
            //Comprobar que no se han enviado mensajes de error
            if (preg_match("/php/", $redirige) == 0) {
                die("ERROR connecting to database. Description: $redirige");
            }
            else {
                $_SESSION["u"] = $_POST["usuario"];
                header("Location: $redirige");
                exit();
            }
        }
        else {
            if (isset($_SESSION["intentos"]))
                $_SESSION["intentos"] ++;
            else 
                $_SESSION["intentos"] = 1;
            
            if ($_SESSION["intentos"] >= MAX_INTENTOS -1) {
                $_SESSION["UsuarioBloqueado"] =  time() + (30 * 60); //Bloquear 30 minutos
            }
            paginaIntentos($_SESSION["intentos"]);
        }
    }
    else {
        paginaNormal();
    }
}

function paginaNormal() {
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
    </head>
    <body>
    	<header><h1>Restricted area</h1></header>
    	<section>
    		<form action="index.php" method="post">
    			<p>User</p>
    			<input type="text" name="usuario" placeholder="User" autofocus autocomplete="off">
    			<p>Password</p>
    			<input type="password" name="contrasena" placeholder="Password">
    			<button type="submit" name="login">Login</button>
    		</form>
    	</section>
    </body>
    </html>
END;
}

function paginaIntentos($intentos) {
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
    </head>
    <body>
    	<header><h1>Restricted area</h1></header>
        <section>
    		<form action="index.php" method="post">
    			<p>User</p>
    			<input type="text" name="usuario" placeholder="User" autofocus autocomplete="off">
    			<p>Password</p>
    			<input type="password" name="contrasena" placeholder="Password">
    			<button type="submit" name="login">Login</button>
    		</form>
    	</section>
    	<footer>
END;
    print "<p class='error'>Incorrect user/password. " . (MAX_INTENTOS - $intentos) . " remaining attempts.</p>";
    print <<<END
        </footer>
    </body>
    </html>
END;
}

function paginaBloqueo($tiempo) {
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
    </head>
    <body>
    	<header><h1>Blocked terminal</h1></header>
END;
    print "<section id='bloqueo'><h2>User blocked</h2><p class='error'>" . date("i:s", $tiempo) . " minutes remaining.</p></section>";
    
}
?>