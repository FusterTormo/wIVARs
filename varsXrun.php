<?php 
include_once 'presentador/presenter.php';
include_once 'lib.php';

session_start();

if (isset($_SESSION["u"])) {
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Variants table</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css"> 
	<link rel="stylesheet" href="estilos/variantes.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
	
</head>
<body>
    <?php
    // Mostrar los datos de una variante: En cuantes muestras ha sido reportada, que coverages/VAFs/filtros tenia en cada muestra...
    if (isset($_GET["varID"])) {
        $v = leerRuns($_SESSION["u"], $_GET["varID"]);
        if (is_array($v)) {
            $head = array_shift($v);
        }
        else {
            $head = "";
        }
    ?>
    	<header><h1>Variant <?php print getTituloVariante($_SESSION["u"], $_GET["varID"]) ?></h1></header>
    	<nav>
			<?php getNavigationBar($_SESSION["u"]); ?>
		</nav>
		<section id="tabVariantes">
			<div class="fila" id="cabecera">
			<?php
			if ($head != "") {
			    foreach ($head as $h) {
			        print "<div class='negreta celda'>$h</div>";
			    }
			}
			?>
			</div>
			<?php 
			if (is_array($v)) {
			    foreach ($v as $w) {
			        print "<div class='fila'>";
			        foreach ($w as $x) {
			            print "<div class='celda'>$x</div>";
			        }
			        print "</div>";
			    }
			}
			?>
		</section>
<?php 
    }
    // Mostrar las variantes reportadas en la muestra
    elseif (isset($_GET["sampID"])) {
        $s = leerMuestra($_SESSION["u"], $_GET["sampID"]);
        ?>
        <header><h1>Sample <?php print $_GET["sampID"]; ?></h1></header>
        <nav>
    		<?php getNavigationBar($_SESSION["u"]); ?>
    	</nav>
        <?php 
    }
    else {
        print "No information passed as parameter";
    }
?>
</body>
</html>
<?php 
}
else {
    print("Sesion no iniciada");
}
?>