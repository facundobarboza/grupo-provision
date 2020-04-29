var
    $formulario               = $("#formulario-fichas"),
    $id_ficha                 = $("#id_ficha"),
    $id_stock                 = $("#id_stock"),
    $id_cliente               = $("#id_cliente"),

    $beneficiario             = $("#beneficiario"),    
    $delegacion               = $("#delegacion"),
    $optica                   = $("#optica"),
    $fecha                    = $("#fecha"),
    $codigo_armazon           = $("#codigo_armazon"),
    $color_armazon            = $("#color_armazon"),
    $estado                   = $("#estado"),
    $voucher                  = $("#voucher"),
    $nro_pedido               = $("#nro_pedido"),
    $grad_od_esf              = $("#grad_od_esf"),
    $grad_od_cil              = $("#grad_od_cil"),
    $eje_od                   = $("#eje_od"),
    $grad_oi_esf              = $("#grad_oi_esf"),
    $grad_oi_cil              = $("#grad_oi_cil"),
    $eje_oi                   = $("#eje_oi"),
    $comentario               = $("#comentario"),
    $es_lejos                 = $("#es_lejos"),
    $adicional                = $("#adicional"),
    $descripcion_adicional    = $("#descripcion_adicional"),
    $telefono                 = $("#telefono"),
    $costo_adicional          = $("#costo_adicional"),
    $sena_adicional           = $("#sena_adicional"),
    $saldo_adicional          = $("#saldo_adicional");


// DOM ready!
$(function() {

   // mostrar/ocultar el log
  $('#mostrar_log').click(function () {
      if (this.checked)
          $('#tabla_logs').show();
      else
          $('#tabla_logs').hide();
  });
  

  // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ archivos por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ archivos";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 archivos";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ archivos)";

    $("#datatable-archivo").DataTable({
      "iDisplayLength"  : 50,
      "sPaginationType" : "full_numbers",
      "searching": true,        
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: false },
        { bSortable: false },
        { bSortable: false }
      ]
    });

  $fecha.datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

  $formulario.on("submit", function(e) {
    var
        error                 = false,
        beneficiario          = $beneficiario.val(),
        delegacion            = $delegacion.val(),
        optica                = $optica.val(),
        fecha                 = $fecha.val(),
        codigo_armazon        = $codigo_armazon.val(),
        color_armazon         = $color_armazon.val(),
        estado                = $estado.val(),
        voucher               = $voucher.val(),
        nro_pedido            = $nro_pedido.val(),
        grad_od_esf           = $grad_od_esf.val(),
        grad_od_cil           = $grad_od_cil.val(),
        eje_od                = $eje_od.val(),
        grad_oi_esf           = $grad_oi_esf.val(),
        grad_oi_cil           = $grad_oi_cil.val(),
        eje_oi                = $eje_oi.val(),
        comentario            = $comentario.val(),
        es_lejos              = $es_lejos.val(),
        adicional             = $adicional.val(),
        descripcion_adicional = $descripcion_adicional.val(),
        telefono              = $telefono.val(),
        costo_adicional       = $costo_adicional.val(),
        sena_adicional        = $sena_adicional.val(),
        saldo_adicional       = $saldo_adicional.val();

    
    if (beneficiario == "" )
    {
      error = true;
      $beneficiario.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $beneficiario.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $beneficiario.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (delegacion == "" )
    {
      error = true;
      $delegacion.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $delegacion.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $delegacion.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (optica == "" )
    {
      error = true;
      $optica.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $optica.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $optica.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (fecha == "" )
    {
      error = true;
      $fecha.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $fecha.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $fecha.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (codigo_armazon == "" )
    {
      error = true;
      $codigo_armazon.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $codigo_armazon.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $codigo_armazon.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (color_armazon == "" )
    {
      error = true;
      $color_armazon.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $color_armazon.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $color_armazon.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (estado == "" )
    {
      error = true;
      $estado.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $estado.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $estado.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (voucher == "" )
    {
      error = true;
      $voucher.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $voucher.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $voucher.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (nro_pedido == "" )
    {
      error = true;
      $nro_pedido.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $nro_pedido.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $nro_pedido.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (grad_od_esf == "" )
    {
      error = true;
      $grad_od_esf.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $grad_od_esf.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $grad_od_esf.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (grad_od_cil == "" )
    {
      error = true;
      $grad_od_cil.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $grad_od_cil.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $grad_od_cil.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (eje_od == "" )
    {
      error = true;
      $eje_od.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $eje_od.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $eje_od.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (grad_oi_esf == "" )
    {
      error = true;
      $grad_oi_esf.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $grad_oi_esf.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $grad_oi_esf.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (grad_oi_cil == "" )
    {
      error = true;
      $grad_oi_cil.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $grad_oi_cil.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $grad_oi_cil.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (eje_oi  == "" )
    {
      error = true;
      $eje_oi.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $eje_oi.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $eje_oi.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (comentario == "" )
    {
      error = true;
      $comentario.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $comentario.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $comentario.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (es_lejos == "" )
    {
      error = true;
      $es_lejos.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $es_lejos.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $es_lejos.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (adicional == "" )
    {
      error = true;
      $adicional.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $adicional.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $adicional.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (descripcion_adicional == "" )
    {
      error = true;
      $descripcion_adicional.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $descripcion_adicional.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $descripcion_adicional.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (telefono == "" )
    {
      error = true;
      $telefono.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $telefono.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $telefono.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (costo_adicional == "" )
    {
      error = true;
      $costo_adicional.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $costo_adicional.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $costo_adicional.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (sena_adicional == "" )
    {
      error = true;
      $sena_adicional.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $sena_adicional.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $sena_adicional.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (saldo_adicional== "" )
    {
      error = true;
      $saldo_adicional.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $saldo_adicional.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $saldo_adicional.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    

    if(! error )
    {
      // console.log($archivo.attr('filename'));
      // //Verificamos que el archivo no exista
      //  jQuery.ajax({
      //       url: appGeneral.obtenerSiteUrl() + "archivo/existeArchivo/"+select_empresa+"/"+select_departamento+"/"+select_sub_departamento+"/"+archivo,
      //       type: 'POST',
      //       data: {
      //           'select_empresa': select_empresa
      //       },
      //       async: true,
      //       dataType: 'html',
      //       contentType: 'application/x-www-form-urlencoded',
      //       timeout: 10000,
      //       success: function (data)
      //       {

      //          e.preventDefault();
      //         // $('#id-guardar').addClass('hide');
      //         // $('#id-cargando').removeClass('hide');
      //         // $('#text-cargando').removeClass('hide');
      //         // window.location = appGeneral.obtenerSiteUrl() + "archivo/listado/1";
      //       }
      //   }); 
         // e.preventDefault();     
         $('#id-guardar').addClass('hide');
          $('#id-cargando').removeClass('hide');
          $('#text-cargando').removeClass('hide');
    }
    else
      e.preventDefault();
  });

    // boton para eliminar un archivo
    $("#datatable-archivo").on("click", ".btn-eliminar-archivo", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este archivo?"))
      {
        id_archivo = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "archivo/eliminar/"+id_archivo,
            type: 'POST',
            data: {
                'id_archivo': id_archivo
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "archivo/listado/1";
            }
        });
      }
      
    });

    //AUTOCOMPLETAR DE PROVEEDOR
    $("#filtro_cliente").autocomplete({
        source: "index.php?operacion=2",
        minLength: 2,
        open: function (event, ui) 
        {
          $("#filtro_cliente").css('background-color','white');
          $(".ui-autocomplete").eq(0).scrollTop(0);
          
        },
        search: function () 
        {
          $("#filtro_cliente").css('background-color','white');
        },
        select: function (event, ui) 
        {
            if (ui.item.id != "-1")
            {
              // lo deshabilitamos para que no pueda seguir buscando
              $("#filtro_cliente").attr("readonly", true);
              // mostramos boton para cancelar la entidad seleccionada
              $("#cancelar_autocomplete_cliente").removeClass("hide");
              // establecemos el id de la entidad
              $("#select_cliente").val(ui.item.id);
            }
            else
                return false;
        }
    });

    $("#cancelar_autocomplete_cliente").click(function () {
       // ocultamos el boton para cancelar
      $("#cancelar_autocomplete_cliente").addClass("hide");
      // habilitamos y reiniciamos el input text para buscar una entidad
      $("#filtro_cliente")
              .val("")
              .removeAttr("readonly")
              .focus();

      $("#select_cliente").val(0);
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