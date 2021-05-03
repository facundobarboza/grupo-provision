var
    $formulario            = $("#formulario-fichas"),
    $id_ficha              = $("#id_ficha"),
    $id_stock              = $("#id_stock"),
    $id_cliente            = $("#id_cliente"),
    $sindicato             = $("#id_sindicato_cliente"),    
    $titular               = $("#titular"),
    $beneficiario          = $("#filtro_cliente"),    
    $delegacion            = $("#delegacion"),
    $nro_cliente           = $("#nro_cliente"),
    $optica                = $("#optica"),
    $fecha                 = $("#fecha"),
    $codigo_armazon        = $("#codigo_armazon"),
    $color_armazon         = $("#color_armazon"),
    $estado                = $("#estado"),
    $voucher               = $("#voucher"),
    $nro_pedido            = $("#nro_pedido"),
    $grad_od_esf           = $("#grad_od_esf"),
    $grad_od_cil           = $("#grad_od_cil"),
    $eje_od                = $("#eje_od"),
    $grad_oi_esf           = $("#grad_oi_esf"),
    $grad_oi_cil           = $("#grad_oi_cil"),
    $eje_oi                = $("#eje_oi"),
    $comentario            = $("#comentario"),
    $es_lejos              = $("#es_lejos"),
    $adicional             = $("#adicional"),
    $descripcion_adicional = $("#descripcion_adicional"),
    $telefono              = $("#telefono"),
    $costo_adicional       = $("#costo_adicional"),
    $sena_adicional        = $("#sena_adicional"),
    $saldo_adicional       = $("#saldo_adicional"),
    $codigo_armazon_cerca  = $("#codigo_armazon_cerca"),
    $color_armazon_cerca   = $("#color_armazon_cerca"),
    $estado_cerca          = $("#id_estado_cerca"),
    $voucher_cerca         = $("#voucher_cerca"),
    $nro_pedido_cerca      = $("#nro_pedido_cerca"),
    $grad_od_esf_cerca     = $("#grad_od_esf_cerca"),
    $grad_od_cil_cerca     = $("#grad_od_cil_cerca"),
    $eje_od_cerca          = $("#eje_od_cerca"),
    $grad_oi_esf_cerca     = $("#grad_oi_esf_cerca"),
    $grad_oi_cil_cerca     = $("#grad_oi_cil_cerca"),
    $eje_oi_cerca          = $("#eje_oi_cerca"),
    $id_stock_cerca        = $("#id_stock_cerca");

    $fecha_envio       = $("#fecha_envio");
    $fecha_envio_cerca = $("#fecha_envio_cerca");
    $tipo_lente        = $("#tipo_lente");
    $tipo_lente_cerca  = $("#tipo_lente_cerca");    
    $id_delegacion     = $("#id_delegacion");
    $id_optica_cliente = $("#id_optica_cliente");
    $id_guardar        = $("#id-guardar");
    $id_editar         = $("#id-editar");
    $select_tipo       = $("#select_tipo");

    $laboratorio           = $("#laboratorio");
    $laboratorio_cerca     = $("#laboratorio_cerca");
    $costo_adicional_cerca = $("#costo_adicional_cerca");
    $adicional_cerca       = $("#adicional_cerca");

    $codigo_barra       = $("#codigo_barra");
    $codigo_barra_cerca = $("#codigo_barra_cerca");
    


// DOM ready!
$(function() {
  

  if($("#id_ficha").val()>0)
    grisarForm(true);
  else
    grisarForm(false);

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

  $("#fecha_envio").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

  $("#fecha_envio_cerca").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

  $("#estado").change(function(event) {
    
    if($(this).val()==2)
    {
      $("#fecha_envio").prop('disabled', false);
    }
    else
      $("#fecha_envio").prop('disabled', true);
  });

  $("#id_estado_cerca").change(function(event) {
    
    if($(this).val()==2)
    {
      $("#fecha_envio_cerca").prop('disabled', false);
    }
    else
      $("#fecha_envio_cerca").prop('disabled', true);
  });

  $formulario.on("submit", function(e) {
    var
        error                 = false,
        sindicato             = $sindicato.val(),
        beneficiario          = $beneficiario.val(),
        nro_cliente           = $nro_cliente.val(),
        titular               = $titular.val(),
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
        saldo_adicional       = $saldo_adicional.val(),
        id_stock              = $id_stock.val();

    
    if($("#select_tipo").val()==2)//es cerca
    {
      codigo_armazon  = $codigo_armazon_cerca.val();
      color_armazon   = $color_armazon_cerca.val();
      estado          = $estado_cerca.val();
      voucher         = $voucher_cerca.val();
      nro_pedido      = $nro_pedido_cerca.val();
      id_stock        = $id_stock_cerca.val();
    }

    if (sindicato == 0 )
    {
      error = true;
      $sindicato.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $sindicato.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $sindicato.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $sindicato.parent().find(".text-center").eq(0).addClass("hide"); 
    }

    if (delegacion == "" )
    {
      error = true;
      $delegacion.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $delegacion.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      
      $delegacion.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $delegacion.parent().find(".text-center").eq(0).addClass("hide"); 
    }

    if (titular == "" )
    {
      error = true;
      $titular.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $titular.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $titular.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $titular.parent().find(".text-center").eq(0).addClass("hide"); 
    }

    if (beneficiario == "" )
    {
      error = true;
      $beneficiario.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $beneficiario.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $beneficiario.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $beneficiario.parent().find(".text-center").eq(0).addClass("hide"); 
    }


    if (nro_cliente == "" )
    {
      error = true;
      $nro_cliente.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $nro_cliente.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $nro_cliente.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $nro_cliente.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    
    if (optica == "" )
    {
      error = true;
      $optica.parent().addClass("has-error").find(".form-control-feedback").eq(0);
      $optica.parent().find(".text-center").eq(0).removeClass("hide");
    }
    else
    {
      $optica.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
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
      $fecha.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $fecha.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (codigo_armazon == "" || id_stock ==0 )
    {
      error = true;
      if($("#select_tipo").val()==2)//es cerca
      {        
        $codigo_armazon_cerca.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $codigo_armazon_cerca.parent().find(".text-center").eq(0).removeClass("hide");
      }
      else
      {
        $codigo_armazon.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $codigo_armazon.parent().find(".text-center").eq(0).removeClass("hide"); 
      }
    }
    else
    {
      $codigo_armazon.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $codigo_armazon.parent().find(".text-center").eq(0).addClass("hide"); 
      $codigo_armazon_cerca.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $codigo_armazon_cerca.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (color_armazon == "" )
    {
      error = true;
      if($("#select_tipo").val()==2)//es cerca
      {
        $color_armazon_cerca.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $color_armazon_cerca.parent().find(".text-center").eq(0).removeClass("hide");
      }
      else
      {
        $color_armazon.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $color_armazon.parent().find(".text-center").eq(0).removeClass("hide"); 
      }
    }
    else
    {
      $color_armazon.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $color_armazon.parent().find(".text-center").eq(0).addClass("hide"); 
      $color_armazon_cerca.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $color_armazon_cerca.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (estado == "" )
    {
      error = true;
      if($("#select_tipo").val()==2)//es cerca
      {
        $estado_cerca.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $estado_cerca.parent().find(".text-center").eq(0).removeClass("hide");
      }
      else
      {
        $estado.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $estado.parent().find(".text-center").eq(0).removeClass("hide"); 
      }
    }
    else
    {
      $estado.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $estado.parent().find(".text-center").eq(0).addClass("hide"); 
      $estado_cerca.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $estado_cerca.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (voucher == "" )
    {
      error = true;
      if($("#select_tipo").val()==2)//es cerca
      {
        $voucher_cerca.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $voucher_cerca.parent().find(".text-center").eq(0).removeClass("hide"); 
      }
      else
      {
        $voucher.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $voucher.parent().find(".text-center").eq(0).removeClass("hide"); 
      }
    }
    else
    {
      $voucher.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $voucher.parent().find(".text-center").eq(0).addClass("hide"); 
      $voucher_cerca.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $voucher_cerca.parent().find(".text-center").eq(0).addClass("hide"); 
    }
    if (nro_pedido == "" )
    {
      error = true;
      if($("#select_tipo").val()==2)//es cerca
      {
        $nro_pedido_cerca.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $nro_pedido_cerca.parent().find(".text-center").eq(0).removeClass("hide");
      }
      else
      {
        $nro_pedido.parent().addClass("has-error").find(".form-control-feedback").eq(0);
        $nro_pedido.parent().find(".text-center").eq(0).removeClass("hide");
      } 
    }
    else
    {
      $nro_pedido.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $nro_pedido.parent().find(".text-center").eq(0).addClass("hide");
      $nro_pedido_cerca.parent().removeClass("has-error").find(".form-control-feedback").eq(0);
      $nro_pedido_cerca.parent().find(".text-center").eq(0).addClass("hide");
    }

    if(! error )
    {       
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

    $("#select_tipo").change(function(event) {
        
        id = $(this).val();

        if(id==1 || id==5)
        {
          $(".div-cerca").hide();
          $(".div-lejos").show();
          
          if(id==1)
            $("#titulo_lejos").html("<strong>Datos para lentes de lejos</strong>");
          else
            $("#titulo_lejos").html("<strong>Datos para lentes de bifocal</strong>");

          if($("#id_ficha").val()==0)
          {
            $codigo_armazon_cerca.val('');
            $color_armazon_cerca.val('');
            $voucher_cerca.val('');
            $nro_pedido_cerca.val('');
            $id_stock_cerca.val('0');
          }         

        }
        else
        {
          if(id==2)
          {
            $(".div-cerca").show();
            $(".div-lejos").hide();
            if($("#id_ficha").val()==0)
            {
              $codigo_armazon.val('');
              $color_armazon.val('');
              $voucher.val('');
              $nro_pedido.val('');
              $id_stock.val('0');
            }
          }  
          else
          {
            $("#titulo_lejos").html("<strong>Datos para lentes de lejos</strong>");
            $(".div-cerca").show();
            $(".div-lejos").show();
          }
        }
    });

    $id_editar.click(function(event) {
      grisarForm(false);
      return false;
    });

    //AUTOCOMPLETAR DE TITULAR
    $("#filtro_cliente").autocomplete({
        source: appGeneral.obtenerSiteUrl()+"archivo/autocompleteBeneficiario/",
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
              $("#id_cliente").val(ui.item.id);
              $("#beneficiario").val(ui.item.value);
              $("#nro_cliente").val(ui.item.nro_cliente);
              $("#titular").val(ui.item.titular_cliente);
              historialTitular(ui.item.id);
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

      $("#id_cliente").val(0);
      $("#beneficiario").val("");
      $("#nro_cliente").val("");
      $("#historial_titular").html("");
      $("#titular").html("");
      $("#thistorial").addClass('hide');  
    });


    //AUTOCOMPLETAR DE ARMAZON
    $("#codigo_armazon").autocomplete({
        source: appGeneral.obtenerSiteUrl()+"archivo/autocompleteArmazon/",
        minLength: 2,
        open: function (event, ui) 
        {
          $("#codigo_armazon").css('background-color','white');
          $(".ui-autocomplete").eq(0).scrollTop(0);
          
        },
        search: function () 
        {
          $("#codigo_armazon").css('background-color','white');
        },
        select: function (event, ui) 
        {
            if (ui.item.id != "-1")
            {
              // lo deshabilitamos para que no pueda seguir buscando
              $("#codigo_armazon").attr("readonly", true);
              // mostramos boton para cancelar la entidad seleccionada
              $("#cancelar_autocomplete_armazon").removeClass("hide");
              // establecemos el id de la entidad
              $("#id_stock").val(ui.item.id);
              $("#color_armazon").val(ui.item.descripcion_color);

              if(ui.item.alerta>1)
              {
                alert("Atención: armazon con stock mínimo (cantidad disponible: "+ui.item.alerta+").")
              }
            }
            else
                return false;
        }
    });

    $("#cancelar_autocomplete_armazon").click(function () {
       // ocultamos el boton para cancelar
      $("#cancelar_autocomplete_armazon").addClass("hide");
      // habilitamos y reiniciamos el input text para buscar una entidad
      $("#codigo_armazon")
              .val("")
              .removeAttr("readonly")
              .focus();

      $("#id_stock").val(0);
      $("#color_armazon").val("");
    });


    //AUTOCOMPLETAR DE ARMAZON
    $("#codigo_armazon_cerca").autocomplete({
        source: appGeneral.obtenerSiteUrl()+"archivo/autocompleteArmazon/",
        minLength: 2,
        open: function (event, ui) 
        {
          $("#codigo_armazon_cerca").css('background-color','white');
          $(".ui-autocomplete").eq(0).scrollTop(0);
          
        },
        search: function () 
        {
          $("#codigo_armazon_cerca").css('background-color','white');
        },
        select: function (event, ui) 
        {
            if (ui.item.id != "-1")
            {
              // lo deshabilitamos para que no pueda seguir buscando
              $("#codigo_armazon_cerca").attr("readonly", true);
              // mostramos boton para cancelar la entidad seleccionada
              $("#cancelar_autocomplete_armazon_cerca").removeClass("hide");
              // establecemos el id de la entidad
              $("#id_stock_cerca").val(ui.item.id);
              $("#color_armazon_cerca").val(ui.item.descripcion_color);
            }
            else
                return false;
        }
    });

    $("#cancelar_autocomplete_armazon_cerca").click(function () {
       // ocultamos el boton para cancelar
      $("#cancelar_autocomplete_armazon_cerca").addClass("hide");
      // habilitamos y reiniciamos el input text para buscar una entidad
      $("#codigo_armazon_cerca")
              .val("")
              .removeAttr("readonly")
              .focus();

      $("#id_stock_cerca").val(0);
      $("#color_armazon_cerca").val("");
    });

  
});

function grisarForm(value)
{
    $id_cliente.attr("disabled",value);
    $sindicato.attr("disabled",value);
    $titular.attr("disabled",value);
    $beneficiario.attr("disabled",value);
    $delegacion.attr("disabled",value);
    $nro_cliente.attr("disabled",value);
    $optica.attr("disabled",value);
    $fecha.attr("disabled",value);
    $codigo_armazon.attr("disabled",value);
    $color_armazon.attr("disabled",value);
    $estado.attr("disabled",value);
    $voucher.attr("disabled",value);
    $nro_pedido.attr("disabled",value);
    $grad_od_esf.attr("disabled",value);
    $grad_od_cil.attr("disabled",value);
    $eje_od.attr("disabled",value);
    $grad_oi_esf.attr("disabled",value);
    $grad_oi_cil.attr("disabled",value);
    $eje_oi.attr("disabled",value);
    $comentario.attr("disabled",value);
    $es_lejos.attr("disabled",value);
    $adicional.attr("disabled",value);
    $descripcion_adicional.attr("disabled",value);
    $telefono.attr("disabled",value);
    $costo_adicional.attr("disabled",value);
    $sena_adicional.attr("disabled",value);
    $saldo_adicional      .attr("disabled",value);
    $codigo_armazon_cerca.attr("disabled",value);
    $color_armazon_cerca .attr("disabled",value);
    $estado_cerca.attr("disabled",value);
    $voucher_cerca.attr("disabled",value);
    $nro_pedido_cerca.attr("disabled",value);
    //$fecha_envio.attr("disabled",value);
    //$fecha_envio_cerca.attr("disabled",value);
    $tipo_lente.attr("disabled",value);
    $tipo_lente_cerca .attr("disabled",value);
    $id_delegacion.attr("disabled",value);
    $id_optica_cliente.attr("disabled",value);
    $select_tipo.attr("disabled",value);

    $laboratorio.attr("disabled",value);
    $laboratorio_cerca.attr("disabled",value);
    $costo_adicional_cerca.attr("disabled",value);
    $adicional_cerca.attr("disabled",value);

    $grad_od_esf_cerca.attr("disabled",value);
    $grad_od_cil_cerca.attr("disabled",value);
    $eje_od_cerca.attr("disabled",value);
    $grad_oi_esf_cerca.attr("disabled",value);
    $grad_oi_cil_cerca.attr("disabled",value);
    $eje_oi_cerca.attr("disabled",value);

    $codigo_barra.attr("disabled",value);
    $codigo_barra_cerca.attr("disabled",value);

    if(value)
    {
        $id_guardar.attr("style","display:none");
        $id_editar.attr("style","display:block");
    }
    else
    {
        $id_guardar.attr("style","display:block");
        $id_editar.attr("style","display:none");
    }  
    


}

function historialTitular(titular)
{
   jQuery.ajax({
 url: appGeneral.obtenerSiteUrl() + "archivo/historialVentas/",
   type: 'POST',
    data: {
                    'id_cliente': titular
                },
                async: true,
                dataType: 'html',
                contentType: 'application/x-www-form-urlencoded',
                timeout: 10000,
                success: function (data)
                {
                  if(data!="")
                  {
                    $("#historial_titular").html(data);
                  }
                  else
                  {
                     $("#historial_titular").html("<tr><td colspan='5' align='center'><b>No Contiente historial</b></td></tr>");
                  }                  
                  $("#thistorial").removeClass('hide');  
                  // window.location = appGeneral.obtenerSiteUrl() + "archivo/listado/1";
                }
            });
}
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