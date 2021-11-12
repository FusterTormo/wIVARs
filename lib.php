<?php
include_once 'presentador/presenter.php';

function getNavigationBar($usuario) {
    $bd = getBase($usuario);
    if ($bd == "ALLvar") {
        print <<<END
        <ul>
        	<li><a href="muestras.php">Samples</a></li>
        	<li><a href="">Cryos</a></li>
        	<li><a href="">DNAs</a></li>
        	<li><a href="">RNAs</a></li>
        	<li><a href="">Salivas</a></li>
        	<li><a href="">Others</a></li>
        	<!-- <li title="View all WGS done">WGS</li>
        	<li title="View all gene panels done">TDS</li>
        	<li title="View all RNA done">RNA-seq</li>	-->
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

?>

	