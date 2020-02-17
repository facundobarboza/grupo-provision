var
    $formulario             = $("#formulario-usuario"),
    $nombre_usuario         = $('#nombre_usuario'),
    $apellido_usuario       = $('#apellido_usuario'),
    $select_rol_usuario     = $('#select_rol_usuario' ),
    $select_empresa_usuario = $('#select_empresa_usuario'),
    $select_departamento      = $('#select_departamento'),
    $select_sub_departamento  = $('#select_sub_departamento'),
    $user_name              = $('#user_name'),
    $contrasenia_usuario    = $('#contrasenia_usuario'),
    $mail_usuario           = $('#mail_usuario'),
    $contacto_empresa       = $('#contacto_empresa'),
    $observacion_empresa    = $('#observacion_empresa'),
    $facebook_empresa       = $('#facebook_empresa'),
    $id_usuario       = $('#id_usuario'),
    $instagram_empresa      = $('#instagram_empresa');

// DOM ready!
$(function() {

 $select_empresa_usuario.change(function(){
    // alert()
    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerDepartamento/"+$select_empresa_usuario.val(),
            type: 'POST',
            data: {
                'id_empresa': $select_empresa_usuario.val()
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              // alert(data);
              $('#select_departamento').html(data);
              $select_sub_departamento.html("<option value='-1'>Seleccionar --</option>");
            }
        });
  });

   $select_departamento.change(function(){
    
    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerSubDepartamento/"+$select_departamento.val(),
            type: 'POST',
            data: {
                'id_departamento': $select_departamento.val()
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              // alert(data);
              $('#select_sub_departamento').html(data);
            }
        });
  });
  
  $formulario.on("submit", function(e) {
    var
        error                  = false,
        nombre_usuario         = $nombre_usuario.val(),
        apellido_usuario       = $apellido_usuario.val(),
        select_rol_usuario     = $select_rol_usuario.val(),
        select_empresa_usuario = $select_empresa_usuario.val(),
        user_name              = $user_name.val(),
        contrasenia_usuario    = $contrasenia_usuario.val(),
        mail_usuario           = $mail_usuario.val();
        id_usuario           = $id_usuario.val();

    // no ingreso
    if( nombre_usuario == "" )
    {
      error = true;

      $nombre_usuario
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_usuario
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( apellido_usuario == "")
      {
        error = true;

        $apellido_usuario
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $apellido_usuario
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");

      }
      else
      { 

         if( select_rol_usuario == 0 )
        {
          error = true;

          $select_rol_usuario
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0);

          $select_rol_usuario
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");

        }
        else
        {
          if( select_empresa_usuario == 0 && select_rol_usuario > 1 )
          {
            error = true;

             $select_empresa_usuario
              .parent()
              .addClass("has-error")
              .find(".form-control-feedback")
              .eq(0);

            $select_empresa_usuario
              .parent()
              .find(".text-center")
              .eq(0)
              .removeClass("hide");

          }
          else
          {
            if( user_name == "" )
            {
              error = true;

              $user_name
                .parent()
                .addClass("has-error")
                .find(".form-control-feedback")
                .eq(0)
                .removeClass("hide");

              $user_name
                .parent()
                .find(".text-center")
                .eq(0)
                .removeClass("hide");
            }
            else
            {
              if( contrasenia_usuario  == "" && id_usuario==0)
              {
                error = true;

                $contrasenia_usuario
                  .parent()
                  .addClass("has-error")
                  .find(".form-control-feedback")
                  .eq(0)
                  .removeClass("hide");

                $contrasenia_usuario
                  .parent()
                  .find(".text-center")
                  .eq(0)
                  .removeClass("hide");

              }
              else
              {
                if( mail_usuario == "")
                {
                  error = true;

                  $mail_usuario
                    .parent()
                    .addClass("has-error")
                    .find(".form-control-feedback")
                    .eq(0)
                    .removeClass("hide");

                  $mail_usuario
                    .parent()
                    .find(".text-center")
                    .eq(0)
                    .removeClass("hide");
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