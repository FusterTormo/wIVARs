$(document).ready(function(){
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
});