<?php include_once 'presentador/presenter.php'; 
session_start();

if (isset($_SESSION["u"])) {
    //$variantes = leerVariantes($_SESSION["u"], 0, 1000);
    $totalMuestras = contarPacientes($_SESSION["u"]);

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Variantes encontradas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css"> 
	<link rel="stylesheet" href="estilos/variantes.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
	<script src="javascript/variantes.js"></script>
	
</head>
<body onload="leerVariantes('<?php print $_SESSION["u"] ?>')">
	<header><h1>Variants found in <?php print $totalMuestras ?> sampes</h1></header>
	<nav>
	<!-- Fer una barra de navegacio amb les distintes pagines que es poden visitar segons la base de dades que es busque -->
	</nav>
	<section id="buscar">
		<form>
			<input type="text" name="buscar_gen" placeholder="Search gene">
			<input type="text" name="buscar_pos" placeholder="Search initial position">
		</form>
	</section>
	<section id="filtrar">
		<button type="button">Filtrar</button>
		<div id="filtros">
			Por gen
			<div id="genes"><ul><li>Ver todos</li><li>Ocultar todos</li></ul></div>
			Por variante
			<div id="variantes"><ul><li>Ver todos</li><li>Ocultar todos</li></ul></div>
			Por MAF
			<div id="mafs"><ul><li>Ver todos</li><li>Ocultar todos</li></ul></div>
			Por n&uacute;mero de casos
			<div id="casos"><ul><li>Ver todos</li><li>Ocultar todos</li></ul></div>
		</div>
	</section>
	<!--  <header class="negreta centrat titol">Lista de variantes</header>-->
	<!-- Por lo leido, las barras de progreso no estan muy estandarizadas, aunque html5 tenga la etiqueta progress. Mejor hacer una con css y javascript -->
	<section id="progressBar">
		<div id="verbBarra">Recogiendo informaci&oacute;n</div>
		<div id="barra">
			<div id="progreso"></div>
		</div>
	</section>
	<section id="tabla">
		<div class="fila" id="cabecera">
			<?php /*
			$cabecera = array_shift($variantes);
			foreach ($cabecera as $c) {
			    print "<div class='negreta celda'>$c</div>";
			}
			?>
    	</div>
    		<?php
    		foreach ($variantes as $var) {
    		    print "<div class='fila'>";
    		    foreach ($var as $v) {
    		        print "<div class='celda' title='$v'>$v</div>";
    		    }
    		    print "</div>";
    		}*/
    		?>
    		</div>
	</section>
	<footer></footer>
</body>
</html>
<?php 
}
else {
    print("Sesion no iniciada");
}
?>