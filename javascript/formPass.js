$(document).ready(function(){
  $("form").on("submit", function(ev) {
    var send = true;
    //Validar el formulario
    if ($("#user").val() == "") {
      $("#err_user").css("display", "block");
      $("#user").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      send = false;
    }
    if ($("#oldPas").val() == "") {
      $("#err_pas1").css("display", "block");
      $("#oldPas").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      send = false;
    }
    if ($("#newPas1").val() == "") {
      $("#err_pas2").css("display", "block");
      $("#newPas1").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      send = false;
    }
    if ($("#newPas2").val() == "") {
      $("#err_pas3").css("display", "block");
      $("#err_pas3").html("Please, re-type the new password");
      $("#newPas2").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      send = false;
    }
    if ($("#newPas1").val() != $("#newPas2").val()) {
      $("#err_pas3").css("display", "block");
      $("#err_pas3").html("Passwords must coincide")
      $("#newPas1").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      $("#newPas2").css({"box-shadow" : "0 0 2px 1px red", "border" : "0"});
      send = false;
    }
    if (send == false) {
      //Evitar que el formulario se envie si hay algun mensaje de error visible
      ev.preventDefault();
      setTimeout(restaurarForm, 2000);
    }
  });

  //Mostrar/ocultar las contrasenas
  $("#showPass").on("click", function(){
    if ($(this).html() == "Show passwords") {
      $(this).html("Hide passwords");
      $("input[type=password]").attr("type", "text");
    }
    else {
      $(this).html("Show passwords");
      $("input[type=text]").not("#user").attr("type", "password");
    }
  });
});

function restaurarForm() {
  $("#user").css({"box-shadow" : "initial", "border" : "1px solid #6CC24A"});
  $("#oldPas").css({"box-shadow" : "initial", "border" : "1px solid #6CC24A"});
  $("#newPas1").css({"box-shadow" : "initial", "border" : "1px solid #6CC24A"});
  $("#newPas2").css({"box-shadow" : "initial", "border" : "1px solid #6CC24A"});
}
