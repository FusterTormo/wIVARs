<?php 
include_once 'presentador/presenter.php';
include_once 'lib.php';

session_start();

if (isset($_SESSION["u"])) {
    //$variantes = leerVariantes($_SESSION["u"], 0, 1000);
    $totalMuestras = contarPacientes($_SESSION["u"]);

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
	<script src="javascript/variantes.js"></script>
	
</head>
<body onload="leerVariantes('<?php print $_SESSION["u"] ?>')">
	<input type="hidden" id="nomUsuario" readonly="readonly" value="<?php print $_SESSION["u"]?>">
	<header><h1>Variants found in <?php print $totalMuestras ?> samples</h1></header>
	<nav>
		<?php getNavigationBar($_SESSION["u"]); ?>
	</nav>
	<section id="buscar">
		<form>
			<input type="text" autocapitalize="words" placeholder="Search gene">
			<input type="text" name="buscar_pos" placeholder="Search initial position">
		</form>
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
	<!-- Por lo leido, las barras de progreso no estan muy estandarizadas, aunque html5 tenga la etiqueta progress. Mejor hacer una con css y javascript -->
	<section id="progressBar">
		<div id="verbBarra">Getting information</div>
		<div id="barra">
			<div id="progreso"></div>
		</div>
	</section>
	<section id="tabla">
		<div class="fila" id="cabecera"></div>
	</section>
	<section class="modal" id="modal">
		<div class="modal-content">
			<span class="close">&times;</span>
			<p></p>
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