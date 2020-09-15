var
  $formulario = $("#formulario-delegacion"),
  $nombre_delegacion = $('#nombre_delegacion');

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
      nombre_delegacion = $nombre_delegacion.val();

    if(nombre_delegacion == "") {
      error = true;

      $nombre_delegacion
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_delegacion
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