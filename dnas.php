<?php
include_once 'presentador/presenter.php';
include_once 'lib.php';
include_once 'formularios.php';

session_start();
//Codigo pagina principal. Segun lo que se reciba por GET, se vera una pagina u otra. Cada pagina esta definida en una funcion
if (isset($_SESSION["u"])) {
    if (isset($_GET["dnaID"])) {
        editarDNA($_GET["dnaID"]);
    }
    else if (isset($_GET["newDna"])) {
        crearDNA();
    }
    else {
        listaDNAs();
    }
}
else {
    error_sesion();
}

function editarDNA($dna) {
    //Formulario para editar un DNA pasado por paramero. Pendiente de acabar
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
END;
    print "<title>Edit " . $dna["idijc"] . "</title>";
    print "</head>\n<body>";
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Edit " . $dna["idijc"] . "</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    
    print <<<END
        </section>
    </body>
    </html>
END;
}

function crearDNA() {
    //Formulario vacio para guardar un nuevo DNA
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>New DNA</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
            </head>
    <body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>Create new DNA</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    ALL_dna();
    print <<<END
        </section>
    </body>
    </html>
END;
}

function listaDNAs() {
    print <<<END
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>DNAs</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="estilos/base.css">
                <link rel="stylesheet" href="estilos/formulario.css">
                <script src="javascript/jquery-3.6.0.min.js"></script>
            </head>
            <body>
END;
    print "<input type=\"hidden\" id=\"nomUsuario\" readonly=\"readonly\" value=\"" . $_SESSION["u"] . "\">";
    print "<header><h1>DNAs stored in database</h1></header><nav>";
    getNavigationBar($_SESSION["u"]);
    print "</nav>";
    print "<section>";
    print "UNDER CONSTRUCTION";
    print <<<END
        </section>
    </body>
    </html>
END;
}
