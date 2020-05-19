var
    $formulario           = $("#formulario-cliente"),
    $titular_cliente      = $('#titular_cliente'),
    $beneficiario_cliente = $('#beneficiario_cliente'),
    $dni_cliente          = $('#dni_cliente'),
    $numero_cliente       = $('#numero_cliente'),
    $id_sindicato_cliente = $('#id_sindicato_cliente')

// DOM ready!
$(function() {


  $formulario.on("submit", function(e) {
    var
        error              = false,

        titular_cliente      = $titular_cliente.val(),
        beneficiario_cliente = $beneficiario_cliente.val(),
        dni_cliente          = $dni_cliente.val(),
        numero_cliente       = $numero_cliente.val(),
        id_sindicato_cliente = $id_sindicato_cliente.val()

    // no ingreso
    if( titular_cliente == "" )
    {
      error = true;

      $titular_cliente
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $titular_cliente
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( beneficiario_cliente == "")
      {
        error = true;

        $beneficiario_cliente
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $beneficiario_cliente
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