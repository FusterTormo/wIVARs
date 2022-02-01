<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();
//Codigo pagina principal. Segun lo que se reciba por GET, se vera una pagina u otra. Cada pagina esta definida en una funcion
if (isset($_SESSION["u"])) {
    if (isset($_GET["sampID"])) {
        editarMuestra();
    }
    else if (isset($_GET["newSamp"])) {
        crearMuestra();
    }
    else {
        listaMuestras();
    }
}
else {
    error_sesion();
}


function editarMuestra() {
    //Formulario para mostrar/editar una unica muestra
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>
END;
    print $_GET["sampID"];
    print <<<END
</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/formulario.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
  <script src="javascript/comun.js"></script>
</head>
<body>
END;
    print "<header><h1>Patient " . $_GET["sampID"] . "</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_muestra(leerMuestra($_SESSION["u"], $_GET["sampID"]));
    print <<<END
</section>
</body>
</html>
END;
}

function crearMuestra() {
    //Formulario vacio para crear una nueva muestra
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>New sample</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/formulario.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
  <script src="javascript/muestras.js"></script>
</head>
<body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Create new patient</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_muestra();
    print <<<END
</section>
</body>
</html>
END;
}

function listaMuestras() {
    //Cuando no se ha buscado una muestra (no hay variables pasadas por GET), la pagina es una tabla con todas las muestras guardadas en la base de datos
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Samples</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/tabla.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>

</head>
<body>
	<header><h1>Patients stored in database</h1></header>
	<nav>
END;
    getNavigationBar($_SESSION["u"]);
    print <<<END
	</nav>
	<section id="buscar">

	</section>
	<section id="filtrar">
		<a href="muestras.php?newSamp=true" title="Create new sample"><button type="button">New</button></a>
		<div id="filtros">
			<!--By gene
			<div id="genes"><ul><li>View all</li><li>Hide all</li></ul></div>
			By variant
			<div id="variantes"><ul><li>View all</li><li>Hide all</li></ul></div>
			By MAF
			<div id="mafs"><ul><li>View all</li><li>Hide all</li></ul></div>
			By cases reported
			<div id="casos"><ul><li>View all</li><li>Hide all</li></ul></div>-->
		</div>
	</section>
	<!-- Por lo leido, las barras de progreso no estan muy estandarizadas, aunque html5 tenga la etiqueta progress. Mejor hacer una con css y javascript
	<section id="progressBar">
		<div id="verbBarra">Getting information</div>
		<div id="barra">
			<div id="progreso"></div>
		</div>
	</section>-->
	<section id="tabla">
END;
    $datos = leerTodasMuestras($_SESSION["u"]);
    $header = array_shift($datos);
    print "<div class='fila' id='cabecera'>";
    foreach ($header as $h) {
        print "<div class='negreta celda'>$h</div>";
    }
    print "<div class='negreta celda'>Cryos</div></div>";
    foreach ($datos as $fila) {
        print "<div class='fila'>";
        foreach ($fila as $celda) {
            print "<div class='celda'>$celda</div>";
        }
        print "<div class='celda'><a href='crios.php?sampID=" . $fila[0] . "'>View Cryovials</a></div></div>";
    }
    print <<<END
	</section>
	<footer></footer>
</body>
</html>
END;
}
?>
