<?php 
include_once 'presentador/presenter.php';
include_once 'lib.php';

session_start();

if (isset($_SESSION["u"])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Welcome!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos/base.css">
	<link rel="stylesheet" href="estilos/pral.css">
	<script src="javascript/jquery-3.6.0.min.js"></script>
	<script src="javascript/pral.js"></script>
</head>
<body>
	<input type="hidden" id="nomUsuario" readonly="readonly" value="<?php print $_SESSION["u"]?>">
	<header><h1>Hi <?php print $_SESSION["u"] ?></h1></header>
	<nav>
		<?php getNavigationBar($_SESSION["u"]); ?>
	</nav>
	<input type="hidden" id="nomUsuario" readonly="readonly" value="<?php print $_SESSION["u"]?>">
	<section id="pacients">
		<h3><span class="count">PENDING</span> patients stored</h3>
		<form action="varsXrun.php" method="GET">
			<input list="list_pac" name="varID" placeholder="Search a patient" autocomplete="off">
			<button type="submit">Go!</button>
			<datalist id="list_pac"></datalist>
		</form>
	</section>
	<section id="criotubs">
		<h3><span class="count">PENDING</span> cryovials stored</h3>
		<form>
			<input type="text" placeholder="Search a cryovial">
			<button type="submit">Go!</button>
		</form>
	</section>
	<section id="DNAs">
		<h3><span class="count">PENDING</span> DNAs extracted</h3>
		<form>
			<input type="text" placeholder="Search a DNA">
			<button type="submit">Go!</button>
		</form>
	</section>
	<section id="saliva">
		<h3><span class="count">PENDING</span> salivas stored</h3>
		<form>
			<input type="text" placeholder="Search saliva">
			<button type="submit">Go!</button>
		</form>
	</section>
	<section id="altres">
		<h3><span class="count">PENDING</span> other samples stored</h3>
		<form>
			<input type="text" placeholder="Search sample">
			<button type="submit">Go!</button>
		</form>
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