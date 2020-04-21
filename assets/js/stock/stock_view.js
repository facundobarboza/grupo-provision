var
  $formulario = $("#formulario-alerta"),

  $id_stock = $("id_stock"),
  $codigo_patilla = $("codigo_patilla"),
  $codigo_color = $("codigo_color"),
  $descripcion_color = $("descripcion_color"),
  $nro_codigo_interno = $("nro_codigo_interno"),
  $letra_color_interno = $("letra_color_interno"),
  $Id_tipo_armazon = $("Id_tipo_armazon"),
  $Id_material = $("Id_material"),
  $Id_ubicacion = $("Id_ubicacion"),
  $cantidad = $("cantidad"),
  $costo = $("costo"),
  $precio_venta = $("precio_venta")

// DOM ready!
$(function () {


  $fecha_mensaje.datepicker({
    firstDay: 1,
    dateFormat: 'dd-mm-yy',
    monthNames: ['Enero', 'Febreo', 'Marzo',
      'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre',
      'Octubre', 'Noviembre', 'Diciembre'],
    dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
  });

  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function (e) {
    var
      error = false,
      fecha_mensaje = $fecha_mensaje.val(),
      Id_tipo_armazon = $Id_tipo_armazon.val();
    mensaje = $mensaje.val();

    // no ingreso
    if (Id_tipo_armazon == 0) {
      error = true;

      $Id_tipo_armazon
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $Id_tipo_armazon
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (codigo_patilla == "") {
      error = true;

      $codigo_patilla
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $codigo_patilla
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");
    }
    else if (codigo_color == "") {
      error = true;

      $codigo_color
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $codigo_color
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (descripcion_color == "") {
      error = true;

      $descripcion_color
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $descripcion_color
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (nro_codigo_interno == "") {
      error = true;

      $nro_codigo_interno
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $nro_codigo_interno
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (letra_color_interno == "") {
      error = true;

      $letra_color_interno
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $letra_color_interno
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (stock_usuario == "") {
      error = true;

      $stock_usuario
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $stock_usuario
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (Id_material == "") {
      error = true;

      $Id_material
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $Id_material
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (Id_ubicacion == "") {
      error = true;

      $Id_ubicacion
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $Id_ubicacion
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (cantidad == "") {
      error = true;

      $cantidad
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $cantidad
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    // else
    //   if (costo == "") {
    //     error = true;

    //     $costo
    //       .parent()
    //       .addClass("has-error")
    //       .find(".form-control-feedback")
    //       .eq(0);

    //     $costo
    //       .parent()
    //       .find(".text-center")
    //       .eq(0)
    //       .removeClass("hide");

    //   }
    //   else
    //     if (precio_venta == "") {
    //       error = true;

    //       $precio_venta
    //         .parent()
    //         .addClass("has-error")
    //         .find(".form-control-feedback")
    //         .eq(0);

    //       $precio_venta
    //         .parent()
    //         .find(".text-center")
    //         .eq(0)
    //         .removeClass("hide");

    //     }

    if (!error) {
    }
    else
      e.preventDefault();
  });
});