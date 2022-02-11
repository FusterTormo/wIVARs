<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();

if (isset($_SESSION["u"])) {
    if (isset($_GET["cryoID"])) {
        editarCrio();
    }
    else if (isset($_GET["newCryo"])) {
        nuevoCrio();
    }
    else if (isset($_GET["sampID"])) {
        criosXmuestra();
    }
    else {
        tablaCrios();
    }
}
else {
    error_sesion();
}

function editarCrio() {
    //Formulario para mostrar/editar un unico criovial
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>
END;
    print $_GET["cryoID"];
    print <<<END
</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/formulario.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
</head>
<body>
END;
    print "<header><h1>Cryovial " . $_GET["cryoID"] . "</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_cryo(leerCryo($_SESSION["u"], $_GET["cryoID"]));
    print <<<END
</section>
</body>
</html>
END;
}

function nuevoCrio() {
    //Formulario vacio para crear una nueva muestra
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>New cryovial</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/formulario.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
    <script src="javascript/crios.js"></script>
</head>
<body>
END;
    print "<header><h1>Create new cryovial</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_cryo();
    print <<<END
</section>
</body>
</html>
END;
}

function criosXmuestra() {
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cryovials</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/tabla.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>

</head>
<body>
END;
	print "<header><h1>Cryovials stored in the database from " . $_GET["sampID"] . "</h1></header>";
	print "<nav>";

    getNavigationBar($_SESSION["u"]);
    print <<<END
	</nav>
	<section id="buscar">

	</section>
	<section id="filtrar">
		<button type="button">Filter</button>
		<div id="filtros">
			By gene
			<div id="genes"><ul><li>View all</li><li>Hide all</li></ul></div>
			By variant
			<div id="variantes"><ul><li>View all</li><li>Hide all</li></ul></div>
			By MAF
			<div id="mafs"><ul><li>View all</li><li>Hide all</li></ul></div>
			By cases reported
			<div id="casos"><ul><li>View all</li><li>Hide all</li></ul></div>
		</div>
	</section>
    <section id="tabla">
END;
    $datos = leerTodosCrioviales($_SESSION["u"], $_GET["sampID"]);
    $header = array_shift($datos);
    print "<div class='fila' id='cabecera'>";
    foreach ($header as $h) {
        print "<div class='negreta celda'>$h</div>";
    }
    print "</div>";
    foreach ($datos as $fila) {
        print "<div class='fila'>";
        foreach ($fila as $celda) {
            print "<div class='celda'>$celda</div>";
        }
    }
    print <<<END
    </section>
</body>
</html>
END;
}

function tablaCrios() {
    //Cuando no se ha buscado una muestra (no hay variables pasadas por GET), la pagina es una tabla con todas las muestras guardadas en la base de datos
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cryovials</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/tabla.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>

</head>
<body>
	<header><h1>Cryovials stored in database</h1></header>
	<nav>
END;
    getNavigationBar($_SESSION["u"]);
    print <<<END
	</nav>
	<section id="buscar">

	</section>
	<section id="filtrar">
		<a href="crios.php?newCryo=true" title="Create new cryovial"><button type="button">New</button></a>
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
    $datos = leerTodosCrioviales($_SESSION["u"]);
    $header = array_shift($datos);
    print "<div class='fila' id='cabecera'>";
    foreach ($header as $h) {
        print "<div class='negreta celda'>$h</div>";
    }
    print "</div>";
    foreach ($datos as $fila) {
        print "<div class='fila'>";
        foreach ($fila as $celda) {
            print "<div class='celda'>$celda</div>";
        }
    }
    print <<<END
	</section>
	<footer></footer>
</body>
</html>
END;
}
?>
