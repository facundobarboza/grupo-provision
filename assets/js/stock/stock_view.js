var
  $formulario = $("#formulario-stock"),

  $id_stock            = $("#id_stock"),
  $codigo_patilla      = $("#codigo_patilla"),
  $codigo_color        = $("#codigo_color"),
  $descripcion_color   = $("#descripcion_color"),
  $nro_codigo_interno  = $("#nro_codigo_interno"),
  $letra_color_interno = $("#letra_color_interno"),
  $id_tipo_armazon     = $("#id_tipo_armazon"),
  $id_material         = $("#id_material"),
  $id_ubicacion        = $("#id_ubicacion"),
  $cantidad            = $("#cantidad"),
  $costo               = $("#costo"),
  $precio_venta        = $("#precio_venta");

// DOM ready!
$(function () {


  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function (e) {
    var
      error = false,
      codigo_patilla      = $codigo_patilla.val(),
      codigo_color        = $codigo_color.val(),
      descripcion_color   = $descripcion_color.val(),
      nro_codigo_interno  = $nro_codigo_interno.val(),
      letra_color_interno = $letra_color_interno.val(),
      id_tipo_armazon     = $id_tipo_armazon.val(),
      id_material         = $id_material.val(),
      id_ubicacion        = $id_ubicacion.val(),
      cantidad            = $cantidad.val(),
      costo               = $costo.val(),
      precio_venta        = $precio_venta.val();

    // no ingreso
    if (codigo_patilla == "") {
      error = true;

      $codigo_patilla
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

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
        .eq(0)
        .removeClass("hide");

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
    else if (id_tipo_armazon == 0) {
      error = true;

      $id_tipo_armazon
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $id_tipo_armazon
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (id_material == 0) {
      error = true;

      $id_material
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $id_material
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else if (id_ubicacion == 0) {
      error = true;

      $id_ubicacion
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $id_ubicacion
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
    else
      if (costo == "") {
        error = true;

        $costo
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0);

        $costo
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");

      }
      else
        if (precio_venta == "") {
          error = true;

          $precio_venta
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0);

          $precio_venta
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");
        }

    if (!error) 
    {
    }
    else
      e.preventDefault();
    // return false;
  });
});