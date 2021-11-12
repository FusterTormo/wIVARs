$(document).ready(function(){
	$(document).ajaxStop(function(){
		//Mostrar la tabla de variantes una vez se han cargado los datos
		ordenarTabla(1);
		$("#tabla").show();
		$("#progressBar").hide();
		//Asignar los eventos de la pagina
		$("input").val("");
		
		//Eventos del formulario para buscar genes o posiciones. Esconde las filas que no cumplen la condicion
		$("input[name=buscar_gen]").on("keyup",function(){
			$("input[name=buscar_gen]").val($("input[name=buscar_gen]").val().toUpperCase());
			var gen = $("input[name=buscar_gen]").val();
			if (gen.length > 2) {
				$(".fila").not("#cabecera").each(function() {
					if ($(this).find(".celda:nth-child(6)").text().indexOf(gen) < 0)
						$(this).hide();
					else
						$(this).show();
				});
			}
			else {
				$(".fila").not("#cabecera").show();
			}
		});
		$("input[name=buscar_pos]").on("keyup", function(){
			var pos = $("input[name=buscar_pos]").val();
			if (pos.length > 4) {
				$(".fila").not("#cabecera").each(function(){
					if ($(this).find(".celda:nth-child(2)").text() != pos)
						$(this).hide();
					else
						$(this).show();
				});
			}
			else {
				$(".fila").not("#cabecera").show();
			}
		});
		
		//Mostrar las opciones de filtrado
		$("#filtrar button").on("click", function(){
			$("#filtros").slideToggle();
			$("#filtrar button").toggleClass("abierto");
		});
		cargarFiltros();
		$("#filtros ul li").on("click", function(){
			var ul = $(this).parent("ul");
			if ($(this).text() == "Ocultar todos") {
				ul.find("li").each(function(){
					$(this).removeClass("selected");
				});
			}
			else if ($(this).text() == "Ver todos") {
				ul.find("li").each(function(){
					if ($(this).text() != "Ver todos" && $(this).text() != "Ocultar todos")
						$(this).addClass("selected");
				});
			}
			else 
				$(this).toggleClass("selected");
			
			aplicarFiltros(ul.parent("div").attr("id"));
		});
		
		//Mostrar la cabecera en la parte de arriba cuando se quede fuera de la pantalla
		var cabecera = document.getElementById("cabecera");
		var pegar = cabecera.offsetTop;
		$(window).on("scroll", function() {
			if (window.pageYOffset >= pegar)
				cabecera.classList.add("fixe");
			else 
				cabecera.classList.remove("fixe");
		});
		
		//Ordenar la tabla
		$("#cabecera").find(".negreta").on("click", function(){
			var columna = -1;
			if ($(this).text().indexOf("Chrom") >= 0)
				columna = 1;
			else if ($(this).text().indexOf("Start") >= 0)
				columna = 2;
			else if ($(this).text().indexOf("End") >= 0)
				columna = 3;
			else if ($(this).text().indexOf("Ref") >= 0)
				columna = 4;
			else if ($(this).text().indexOf("Alt") >= 0)
				columna = 5;
			else if ($(this).text().indexOf("Gene") >= 0)
				columna = 6;
			else if ($(this).text().indexOf("Variant") >= 0)
				columna = 7;
			else if ($(this).text().indexOf("Transcript") >= 0)
				columna = 8;
			else if ($(this).text().indexOf("AA_Change") >= 0)
				columna = 9;
			else if ($(this).text().indexOf("dbSNP") >= 0)
				columna = 10;
			else if ($(this).text().indexOf("COSMIC") >= 0)
				columna = 11;
			else if ($(this).text().indexOf("MAF") >= 0)
				columna = 12;
			else if ($(this).text().indexOf("Reported") >= 0)
				columna = 13;
			
			if (columna > -1)
				ordenarTabla(columna);
		});
		
		//Pintar las filas impares de la tabla de otro color (zebra table)
		$('#tabla').each(function(){
			$(this).find('.fila:even').not("#cabecera").css('background-color','#eeeeee')
		});
	});
});

function leerVariantes(usuario) {
	$("#tabla").hide();
	$.ajax({
		method : "post",
		url : "presentador/getVariantes.php",
		data : {"contar" : true, "usuario" : usuario},
		datatype : "html"
	}).done(function(data){
		$("#verbBarra").html("Recogiendo " + data + " variantes");
		total = data;
		var actual = 0;
		var tope = 1000;
		var body = "";
		while (actual <= total) {
			$.ajax({
				method : "post",
				url : "presentador/getVariantes.php",
				data : {"dameVariantes" : true, "usuario" : usuario, "inicio" : actual, "registros" : tope},
				datatype : "jsonp"
			}).done(function(data){
				var tab = JSON.parse(data);
				porcentaje = 100 * actual / total;
				if (porcentaje > 100)
					porcentaje = 100;
				$("#progreso").css("width", porcentaje + "%");
				//Dibujar la cabecera en su sitio
				if (tab[0][0] == "Chrom") {
					var lin = tab.shift(); //Extraer el primer elemento de la tabla
					var head = "";
					for (var i = 0; i < lin.length; i ++) {
						head += "<div class='negreta celda'>" + lin[i] + "</div>";
					}
					$("#cabecera").html(head);
				}
				for (var i = 0; i < tab.length; i ++) {
					body += "<div class='fila'>";
					for (var j = 0; j < tab[j].length; j ++) {
						body += "<div class='celda'>" + tab[i][j] + "</div>";
					}
					body += "</div>";
				}
				$("#tabla").append(body);
			});
			actual += tope;
		}
		$("#verbBarra").html("Montando la tabla de variantes. Espera un momento");
	});	
}

/**
 * Cargar el contenido de los filtros una vez se haya cargado la tabla
 * @returns
 */
function cargarFiltros() {
	var genes = [], variantes = [], aux;
	var cnt = "";
	$(".fila").not("#cabecera").each(function(){
		aux = $(this).find(".celda:nth-child(6)").text(); // Leer el gen de la fila
		if ($.inArray(aux, genes) == -1)
			genes.push(aux);
		aux = $(this).find(".celda:nth-child(7)").text(); // Leer el tipo de variante de la fila
		if ($.inArray(aux, variantes) == -1)
			variantes.push(aux);
	});
	//Rellenar el contenedor del filtro de genes
	genes.sort();
	genes.forEach(function(g) {
		cnt += "<li class='selected' title='" + g + "'>" + g + "</li>";
	});
	aux = $("#genes ul").html();
	$("#genes ul").html(cnt + aux);
	//Rellenar el contenedor del filtro de variantes
	cnt = "";
	variantes.sort();
	variantes.forEach(function(v){
		cnt += "<li class='selected' title='" + v + "'>" + v + "</li>"; 
	});
	aux = $("#variantes ul").html();
	$("#variantes ul").html(cnt + aux);
}

/**
 * Mostrar/ocultar filas de la tabla segun se cumplan los filtros seleccionados
 * @param id Identificador de la lista de filtros que ha lanzado el evento
 */
function aplicarFiltros(id) {
	var col, temp, selects = [];
	$("#" + id).find("li.selected").each(function(){
		selects.push($(this).text());
	});
	
	if (id == "genes" || id == "variantes") {
		if (id == "genes")
			col = 6;
		else
			col = 7;
		
		$(".fila").not("#cabecera").each(function() {
			// Este if permite hacer filtros acumulativos. Pero va muy lento. Buscar alternativas
			//if ($(this).is(":visible")) {
				temp = $(this).find(".celda:nth-child(" + col + ")").text();
				if ($.inArray(temp, selects) == -1)
					$(this).hide();
				else
					$(this).show();
			//}
		});
	}
}

function ordenarTabla(columna) {
	// Recoger las filas dentro de la tabla que no son la cabecera
	var filas = $(".fila").not("#cabecera").get(); 
	var tabla = [], aux = [], orden;
	columna = columna - 1;
	var temp = $("#cabecera").children().eq(columna).html();
	$("#tabla").css("opacity", "0.2");
	if ($("#cabecera").children().eq(columna).text().indexOf("&darr;") < 0) {
		if ($("#cabecera").children().eq(columna).text().indexOf("&uarr;") > -1 ) {
			temp.replace("&uarr;", "&darr;");
			$("#cabecera").children.eq(columna).html(temp);
		}
		else 
			$("#cabecera").children().eq(columna).html(temp +  " &darr;");
		orden = "asc";
	}
	else {
		temp.replace("&darr;", "&uarr;");
		$("#cabecera").children().eq(columna).html(temp);
		orden = "desc";
	}
	//Ordenar las filas
	filas.sort(function(a, b){
		var A = $(a).children().eq(columna).text();
		var B = $(b).children().eq(columna).text();
		if (orden == "asc") {
			if (A < B)
				return -1;
			if (A > B)
				return 1;
			return 0;
		}
		else {
			if (A < B)
				return 1;
			if (A > B)
				return -1;
			return 0;
		}
	});
	// Escribir el nuevo orden en la tabla
	$.each(filas, function(index, row){
		$("#tabla").append(row);
	});
	$("#tabla").css("opacity", "1.0");
}