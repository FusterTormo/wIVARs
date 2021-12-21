$(document).ready(function(){
	//Leer de la base de datos los identificadores de las muestras
	$.ajax({
		method : "post",
		data : {"dameMuestras" : true, "usuario" : $("#nomUsuario").val()},
		datatype : "html",
		url : "presentador/datosPral.php"
	}).done(function(ret){
		try {
			var data = $.parseJSON(ret);
			var datalist = "";
			for (var i = 0; i < data.length; i ++) {
				datalist += "<option value='" + data[i] + "'>";
			}
			$("#pacients").find(".count").html(i);
			$("#list_pac").html(datalist);
		}
		catch(err) {
			alert("Error when loading sample data. Description: " + ret);
			alert(err.message)
		}
	});
	//Leer de la base de datos los identificadores de los crioviales
	$.ajax({
		method : "post",
		data : {"dameCrios" : true, "usuario": $("#nomUsuario").val()},
		datatype : "html", 
		url: "presentador/datosPral.php"
	}).done(function(jsn){
		try {
			var data = $.parseJSON(jsn);
			var datalist = "";
			for (var i = 0; i < data.length; i++){
				datalist += "<option value='" + data[i] + "'>";
			}
			$("#criotubs").find(".count").html(i);
			$("#list_cryo").html(datalist);
		}
		catch(err) {
			alert("Error when loading cryovial data. Description: " + jsn);
			alert(err.message);
		}
	});
});