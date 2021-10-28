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