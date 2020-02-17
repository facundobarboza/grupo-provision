var
    $formulario           = $("#formulario-empresa"),
    $nombre_empresa       = $('#nombre_empresa'),
    $direccion_empresa    = $('#direccion_empresa'),
    $cuit_empresa         = $('#cuit_empresa' ),
    $actividad_empresa    = $('#actividad_empresa'),
    $telefono_empresa_1   = $('#telefono_empresa_1'),
    $telefono_empresa_2   = $('#telefono_empresa_2'),
    $mail_empresa         = $('#mail_empresa'),
    $contacto_empresa     = $('#contacto_empresa'),
    $observacion_empresa  = $('#observacion_empresa'),
    $facebook_empresa     = $('#facebook_empresa'),
    $instagram_empresa    = $('#instagram_empresa'),
    $fecha_vigencia       = $("#fecha_vigencia")

// DOM ready!
$(function() {

$fecha_vigencia.datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
        });

  $formulario.on("submit", function(e) {
    var
        error              = false,

        nombre_empresa       = $nombre_empresa.val(),
        direccion_empresa    = $direccion_empresa.val(),
        cuit_empresa         = $cuit_empresa.val(),
        actividad_empresa    = $actividad_empresa.val(),
        telefono_empresa_1   = $telefono_empresa_1.val(),
        telefono_empresa_2   = $telefono_empresa_2.val(),
        mail_empresa         = $mail_empresa.val(),
        contacto_empresa     = $contacto_empresa.val(),
        observacion_empresa  = $observacion_empresa.val(),
        facebook_empresa     = $facebook_empresa.val(),
        instagram_empresa    = $instagram_empresa.val();
        fecha_vigencia       = $fecha_vigencia.val();

    // no ingreso
    if( nombre_empresa == "" )
    {
      error = true;

      $nombre_empresa
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_empresa
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( direccion_empresa == "")
      {
        error = true;

        $direccion_empresa
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $direccion_empresa
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");

      }
      else
      { 

         if( cuit_empresa == "" )
        {
          error = true;

          $cuit_empresa
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          $cuit_empresa
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");

        }
        else
        {
          if( actividad_empresa == "" )
          {
            error = true;

            $actividad_empresa
              .parent()
              .addClass("has-error")
              .find(".form-control-feedback")
              .eq(0)
              .removeClass("hide");

            $actividad_empresa
              .parent()
              .find(".text-center")
              .eq(0)
              .removeClass("hide");

          }
          else
          {
            if( contacto_empresa == "" )
            {
              error = true;

              $contacto_empresa
                .parent()
                .addClass("has-error")
                .find(".form-control-feedback")
                .eq(0)
                .removeClass("hide");

              $contacto_empresa
                .parent()
                .find(".text-center")
                .eq(0)
                .removeClass("hide");
            }
            else
            {
              if( mail_empresa  == "" )
              {
                error = true;

                $mail_empresa
                  .parent()
                  .addClass("has-error")
                  .find(".form-control-feedback")
                  .eq(0)
                  .removeClass("hide");

                $mail_empresa
                  .parent()
                  .find(".text-center")
                  .eq(0)
                  .removeClass("hide");

              }
              else
              {
                if( telefono_empresa_1 == "")
                {
                  error = true;

                  $telefono_empresa_1
                    .parent()
                    .addClass("has-error")
                    .find(".form-control-feedback")
                    .eq(0)
                    .removeClass("hide");

                  $telefono_empresa_1
                    .parent()
                    .find(".text-center")
                    .eq(0)
                    .removeClass("hide");
                }
                else
                {
                  if( fecha_vigencia == "" )
                  {
                    error = true;

                    $fecha_vigencia
                      .parent()
                      .addClass("has-error")
                      .find(".form-control-feedback")
                      .eq(0)
                      .removeClass("hide");

                    $fecha_vigencia
                      .parent()
                      .find(".text-center")
                      .eq(0)
                      .removeClass("hide");
                  }
                  // if( observacion_empresa == "" )
                  // {
                  //   error = true;

                  //   $observacion_empresa
                  //     .parent()
                  //     .addClass("has-error")
                  //     .find(".form-control-feedback")
                  //     .eq(0)
                  //     .removeClass("hide");

                  //   $observacion_empresa
                  //     .parent()
                  //     .find(".text-center")
                  //     .eq(0)
                  //     .removeClass("hide");
                  // }
                  // else
                  // {
                  //   if( fecha_vigencia == "" )
                  //   {
                  //     error = true;

                  //     $fecha_vigencia
                  //       .parent()
                  //       .addClass("has-error")
                  //       .find(".form-control-feedback")
                  //       .eq(0)
                  //       .removeClass("hide");

                  //     $fecha_vigencia
                  //       .parent()
                  //       .find(".text-center")
                  //       .eq(0)
                  //       .removeClass("hide");
                  //   }
                  // }                  
                }
              }
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
  
});