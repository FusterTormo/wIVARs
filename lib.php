<?php
include_once 'presentador/presenter.php';

function getNavigationBar($usuario) {
    $bd = getBase($usuario);
    if ($bd == "ALLvar") {
        print <<<END
        <ul>
            <li><a href="pral.php">Home</a></li>
        	<li title="View all samples stored in the database"><a href="muestras.php">Samples</a></li>
        	<li title="View all cryovials stored in the database"><a href="crios.php">Cryos</a></li>
            <li title="View all salivas stored in the database"><a href="salivas.php">Salivas</a></li>
        	<li><a href="others.php">Others</a></li>
        	<li title="View all DNAs stored in the database"><a href="dnas.php">DNAs</a></li>
        	<li title="View all RNAs stored in the database"><a href="rnas.php">RNAs</a></li>
        	<li title="View variants stored"><a href="variantes.php">Variants</a></li>
            <li style="float: right"><a href="salir.php">Log out</a></li>
        </ul>
END;
    }
    else if ($bd == "MDSvar") {
        print <<<END
        <ul>
        	<li title="View variants stored"><a href="variantes.php">Variants</a></li>
            <li style="float: right"><a href="salir.php">Log out</a></li>
        </ul>
END;
    }
}

function error_sesion() {
    print <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ERROR</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/error.css">
</head>
<body>
	<header><h1>ERROR</h1></header>
	<section id="error">
		You are not allowed to see this page. <a href="index.php">Return home</a>
	</section>
</body>
</html>
END;
}

?>
