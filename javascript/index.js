$(document).ready(function(){
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
	
	//Pintar las filas impares de la tabla de otro color (zebra table)
	$('#tabla').each(function(){
		$(this).find('.fila:even').not("#cabecera").css('background-color','#eeeeee')
	});
});

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