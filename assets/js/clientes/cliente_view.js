var
    $formulario           = $("#formulario-cliente"),
    $nombre_cliente       = $('#nombre_cliente'),
    $apellido_cliente     = $('#apellido_cliente'),
    $dni_cliente          = $('#dni_cliente'),
    $numero_cliente       = $('#numero_cliente'),
    $id_sindicato_cliente = $('#id_sindicato_cliente')

// DOM ready!
$(function() {


  $formulario.on("submit", function(e) {
    var
        error              = false,

        nombre_cliente       = $nombre_cliente.val(),
        apellido_cliente     = $apellido_cliente.val(),
        dni_cliente          = $dni_cliente.val(),
        numero_cliente       = $numero_cliente.val(),
        id_sindicato_cliente = $id_sindicato_cliente.val()

    // no ingreso
    if( nombre_cliente == "" )
    {
      error = true;

      $nombre_cliente
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_cliente
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( apellido_cliente == "")
      {
        error = true;

        $apellido_cliente
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $apellido_cliente
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");

      }
      else
      { 

         if( dni_cliente == "" )
        {
          error = true;

          $dni_cliente
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          $dni_cliente
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");

        }
        else
        {
          if( numero_cliente == "" )
          {
            error = true;

            $numero_cliente
              .parent()
              .addClass("has-error")
              .find(".form-control-feedback")
              .eq(0)
              .removeClass("hide");

            $numero_cliente
              .parent()
              .find(".text-center")
              .eq(0)
              .removeClass("hide");

          }
          else
          {
            if( id_sindicato_cliente == 0)
            {
              error = true;

              $id_sindicato_cliente
                .parent()
                .addClass("has-error")
                .find(".form-control-feedback")
                .eq(0)
                .removeClass("hide");

              $id_sindicato_cliente
                .parent()
                .find(".text-center")
                .eq(0)
                .removeClass("hide");
            }   
          }          
        }        
      }
    }
    

    if( !error )
    {

    }
    else
      e.preventDefault();
  });
  
  // mostrar/ocultar el log
  $('#mostrar_log').click(function () {
      if (this.checked)
          $('#tabla_logs').show();
      else
          $('#tabla_logs').hide();
  });
  
});