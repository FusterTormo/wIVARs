$(document).ready(function(){
	/*
	 * Eventos para el formulario de crear un nueva saliva
	 */
	// Leer en la url si hay parametros pasados por GET
	var url = location.search.substring(1).split("&"); // location.search devuelve ?param1=val1&param2=val2. Eliminar el '?' y dividir los parametros en una lista
	var json = {}; //JSON con los parametros GET
	for (var i = 0; i < url.length; i++) {
		var aux = url[i].split("=");
		json[aux[0]] = aux[1];
	}
	// Rellenar el campo con el identificador de muestra que se ha pasado por GET y evitar que se sobreescriba
	if (json.hasOwnProperty("newSamp")) {
		$("#idPacient").val(json["newSamp"]);
		$("#idPacient").attr("readonly", true);
	}
});