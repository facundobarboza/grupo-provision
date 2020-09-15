var
  $formulario = $("#formulario-optica"),
  $nombre_optica = $('#nombre_optica');

// DOM ready!
$(function () {

  // $fecha_vigencia.datepicker();
   // mostrar/ocultar el log
  $('#mostrar_log').click(function () {
      if (this.checked)
          $('#tabla_logs').show();
      else
          $('#tabla_logs').hide();
  });
  
  $formulario.on("submit", function (e) {
    var
      error = false,
      nombre_optica = $nombre_optica.val();

    if(nombre_optica == "") {
      error = true;

      $nombre_optica
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_optica
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");
    }
    if (!error) {

    }
    else
      e.preventDefault();
  });
});