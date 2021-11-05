<?php include_once 'presentador/presenter.php'; 

$variantes = leerVariantes("pepe");
$totalMuestras = contarPacientes("pepe");

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Variantes encontradas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css"> 
	<script src="javascript/jquery-3.6.0.min.js"></script>
	<script src="javascript/index.js"></script>
	
</head>
<body>
	<header><h1>Variantes encontradas en <?php print $totalMuestras ?> pacientes</h1></header>
	<nav>
	<!-- Fer una barra de navegacio amb les distintes pagines que es poden visitar segons la base de dades que es busque -->
	</nav>
	<section id="buscar">
		<form>
			<input type="text" name="buscar_gen" placeholder="Buscar gen">
			<input type="text" name="buscar_pos" placeholder="Buscar posicion de inicio">
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
	<section id="tabla">
		<div class="fila" id="cabecera">
			<?php 
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
    		}
    		?>
	</section>
	<footer>Poner ayuda??</footer>
</body>
</html>