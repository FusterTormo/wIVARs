<?php

/**
* Funciones comunes para el modelo
**/

function writeLog($log, $contenido) {
  if (file_exists($log)) {
    $fi = fopen($log, "a");
    date_default_timezone_set("Europe/Madrid");
    $linea = date("Y/m/d H:i:s") . " $contenido" . "\n";
    fwrite($fi, $linea);
    fclose($fi);
  }
  else {
    error_log("Unable to find $log");
    error_log(getcwd());
  }
}

?>
