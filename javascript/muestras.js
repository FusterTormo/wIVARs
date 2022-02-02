$(document).ready(function(){
  // Buscar en la base de datos cual es el ultimo identificador guardado y poner el siguiente en ID IJC
  $.ajax({
    method : "post",
    url : "presentador/getMuestras.php",
    data : {"getIDIJC" : true, "usuario" : $("#nomUsuario").val()},
    datatype : "jsonp"
  }).done(function(data){
    $("#idijc").val(data);
    $("#idpethema").focus();
  });

  $("form[name=newMuestra]").on("submit", function(e){
    e.preventDefault();
    var enviar = true;
    // Validar el formulario
    //Enviar y guardar los datos en la base de datos
    //Preguntar si se quieren añadir crioviales o dnas
    $("form[name=newMuestra]").hide();
    var cont = document.createElement("div");
    var msg = document.createElement("div");
    var boton1 = document.createElement("button");
    var boton2 = document.createElement("button");
    var boton3 = document.createElement("button");
    $(cont).attr("id", "Preguntar");
    $(cont).css({"width": "30%", "margin" : "auto", "display" : "flex", "justify-content" : "space-between", "padding" : "5px 0px"});
    $(msg).html("Sample stored sucessfully<br>");
    $(msg).css({"color": "#6CC24A", "width" : "30%", "margin": "40px auto", "font-size" : "1.5vw"});
    //Añadir texto, identificador y estilos a los botones
    $(boton1).html("Add Cryovial").attr("id", "addCryo").css("float", "none");
    $(boton2).html("Add DNA").attr("id", "addDNA").css("float", "none");
    $(boton3).html("<a href='muestras.php?newSamp=true'>Save new sample</a>").attr("id", "guardarSample").css("float", "none");
    $(boton3).find("a").css({"text-decoration" : "none", "color" : "#FFFFFF"});
    $(cont).append($(boton1));
    $(cont).append($(boton2));
    $(cont).append($(boton3));
    $("section").append($(msg));
    $("section").append($(cont));
    //Mostrar el formulario correspondiente


  });
});

//Mostrar un mensaje de alerta cuando el usuario salga de esta pagina
/*window.onbeforeunload = function(e){
  var modified = false;
  $("input").not("#idijc").each(function() {
    if ($(this).val() != "")
      modified = true;
  })
  if (modified)
    e.returnValue = "Unsaved changes detected. Leave?";
};*/
