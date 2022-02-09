<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();
//Codigo pagina principal. Segun lo que se reciba por GET, se vera una pagina u otra. Cada pagina esta definida en una funcion
if (isset($_SESSION["u"])) {
    if (isset($_GET["rnaID"])) {
        editarExistente($_GET["otherID"]);
    }
    else if (isset($_GET["newOther"])) {
        crearNuevo();
    }
    else {
        listar();
    }
}
else {
    error_sesion();
}

function editarExistente($rna) {
    print "UNDER CONSTRUCTION";
}

function crearNuevo() {
    //Formulario vacio para guardar un nuevo registro
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>New other</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
            </head>
    <body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Create new other</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_other();
    print <<<END
        </section>
    </body>
    </html>
END;
}

function listar() {
    print "UNDER CONSTRUCTION";
}
?>