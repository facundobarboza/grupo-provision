var
    $formulario     = $("#formulario-alerta"),
    $select_usuario = $('#select_usuario'),
    $fecha_mensaje  = $('#fecha_mensaje'),
    $mensaje        = $('#mensaje');

// DOM ready!
$(function() {


  $fecha_mensaje.datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function(e) {
    var
        error          = false,
        fecha_mensaje  = $fecha_mensaje.val(),
        select_usuario = $select_usuario.val();
        mensaje        = $mensaje.val();

    // no ingreso
    if( select_usuario == 0 )
    {
      error = true;

      $select_usuario
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $select_usuario
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( fecha_mensaje == "")
      {
        error = true;

        $fecha_mensaje
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $fecha_mensaje
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");
      }
      else
      {
        if( mensaje == "" )
        {
          error = true;

          $mensaje
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0);

          $mensaje
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");

        }
      }
      
    }    

    if( !error )
    {
      
    }
    else
      e.preventDefault();
  });
  
});