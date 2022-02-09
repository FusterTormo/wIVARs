<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();
//Codigo pagina principal. Segun lo que se reciba por GET, se vera una pagina u otra. Cada pagina esta definida en una funcion
if (isset($_SESSION["u"])) {
    if (isset($_GET["rnaID"])) {
        editarSaliva($_GET["salivaID"]);
    }
    else if (isset($_GET["newSaliva"])) {
        crearSaliva();
    }
    else {
        listaSalivas();
    }
}
else {
    error_sesion();
}

function editarSaliva($rna) {
    print "UNDER CONSTRUCTION";
}

function crearSaliva() {
    //Formulario vacio para guardar un nuevo RNA
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>New Saliva</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
            </head>
    <body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Create new saliva</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_saliva();
    print <<<END
        </section>
    </body>
    </html>
END;
}

function listaSalivas() {
    print "UNDER CONSTRUCTION";
}
?>