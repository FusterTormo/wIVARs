$(document).ready(function(){
  $.ajax({
    method : "post",
    url : "presentador/getMuestras.php",
    data : {"getIDIJC" : true, "usuario" : $("#nomUsuario").val()},
    datatype : "jsonp"
  }).done(function(data){
    $("#idijc").val(data);
    $("#idpethema").focus();
  });
});
