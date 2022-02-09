<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();
//Codigo pagina principal. Segun lo que se reciba por GET, se vera una pagina u otra. Cada pagina esta definida en una funcion
if (isset($_SESSION["u"])) {
    if (isset($_GET["rnaID"])) {
        editarRNA($_GET["rnaID"]);
    }
    else if (isset($_GET["newRna"])) {
        crearRNA();
    }
    else {
        listaRNAs();
    }
}
else {
    error_sesion();
}

function editarRNA($rna) {
    print "UNDER CONSTRUCTION";
}

function crearRNA() {
    //Formulario vacio para guardar un nuevo RNA
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>New RNA</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
            </head>
    <body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Create new RNA</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_rna();
    print <<<END
        </section>
    </body>
    </html>
END;
}

function listaRNAs() {
    print "UNDER CONSTRUCTION";
}
?>