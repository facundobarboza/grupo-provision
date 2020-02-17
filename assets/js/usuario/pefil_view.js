var
    $formulario             = $("#formulario-perfil"),
    $contrasenia_actual     = $("#contrasenia_actual"),
    $contrasenia_nueva_1    = $("#contrasenia_nueva_1"),
    $contrasenia_nueva_2    = $("#contrasenia_nueva_2"),
    $msje_contrasenia_nueva = $("#msje_contrasenia_nueva");

// DOM ready!
$(function() {

  $formulario.on("submit", function(e) {
    var
        error              = false,
        contrasenia_actual  = $.trim($contrasenia_actual.val()),
        contrasenia_nueva_1 = $.trim($contrasenia_nueva_1.val()),
        contrasenia_nueva_2 = $.trim($contrasenia_nueva_2.val());

    // no ingreso la contraseña actual
    if( contrasenia_actual.length < 8 )
    {
      error = true;

      $contrasenia_actual
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $contrasenia_actual
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

      $contrasenia_nueva_1
        .parent()
        .removeClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .addClass("hide");

      $contrasenia_nueva_2
        .parent()
        .removeClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .addClass("hide");

      $msje_contrasenia_nueva.addClass("hide");
    }
    // se ingreso la contraseña actual
    else
    {
      $contrasenia_actual
        .parent()
        .removeClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .addClass("hide");

      $contrasenia_actual
        .parent()
        .find(".text-center")
        .eq(0)
        .addClass("hide");

      if( contrasenia_nueva_1.length < 8 || contrasenia_nueva_2.length < 8 )
      {
        error = true;

        $contrasenia_nueva_1
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $contrasenia_nueva_2
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $msje_contrasenia_nueva
          .html("Debe ingresar la contraseña nueva y repetir la misma en el campo 'Repetir nueva contraseña'.")
          .removeClass("hide");
      }
      else
        if( contrasenia_nueva_1 !== contrasenia_nueva_2 )
        {
          error = true;

          $contrasenia_nueva_1
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          $contrasenia_nueva_2
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          $msje_contrasenia_nueva
            .html("La contraseña nueva no coincide con la ingresada en el campo 'Repetir nueva contraseña'.")
            .removeClass("hide");
        }
    }

    if( !error )
    {

    }
    else
      e.preventDefault();
  });

});