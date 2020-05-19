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
  $cantidad_minima     = $("#cantidad_minima"),
  $costo               = $("#costo"),
  $precio_venta        = $("#precio_venta");

// DOM ready!
$(function () {

   // mostrar/ocultar el log
  $('#mostrar_log').click(function () {
      if (this.checked)
          $('#tabla_logs').show();
      else
          $('#tabla_logs').hide();
  });

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
      cantidad_minima     = $cantidad_minima.val(),
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
      if (cantidad_minima == "") {
        error = true;

        $cantidad_minima
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0);

        $cantidad_minima
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
        {
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
        }
          

    if (!error) 
    {
    }
    else
      e.preventDefault();
    // return false;
  });
});

function filtrar_teclas(e, goods, invert)
  {
    var key, keychar;
    key = getkey(e);
    if (key == null) return false;

    // get character
    keychar = String.fromCharCode(key);
    keychar = keychar.toLowerCase();
    goods = goods.toLowerCase();

    // check goodkeys
    //si invert==true checkea que las teclas que se pasaron no aparezcan
    //de lo contrario solo deja imprimir las teclas que se pasaron
    if (arguments.length==3 && invert)
    {
      if (goods.indexOf(keychar) == -1)
        return true;
    }
    else if (goods.indexOf(keychar) != -1)
      return true;

    // control keys
    if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
       return true;

    // else return false
    return false;
  }

  function getkey(e)
  {
    if (window.event)
      return window.event.keyCode;
    else if (e)
      return e.which;
    else
      return null;
  }