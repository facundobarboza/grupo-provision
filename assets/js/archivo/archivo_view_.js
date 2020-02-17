var
    $formulario               = $("#formulario-archivo"),
    $select_empresa           = $('#select_empresa'),
    $select_departamento      = $('#select_departamento'),
    $select_sub_departamento  = $('#select_sub_departamento'),
    $archivo                  = $('#archivo'),
    $observacion              = $('#observacion'),
    $fecha_vigencia           = $('#fecha_vigencia');

// DOM ready!
$(function() {

  id_departamento = $("#cookie_id_departamento").val();
  //precargamos el select de departamento con el ultimo usado
  if($select_empresa.val()>0)
  {    

    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerDepartamento/"+$select_empresa.val()+"/"+id_departamento,
            type: 'POST',
            data: {
                'id_empresa': $select_empresa.val()
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              // alert(data);
              $('#select_departamento').html(data);
            }
        });
  }



  if(id_departamento>0)
  {    
    id_sub_departamento = $("#cookie_id_sub_departamento").val();

    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerSubDepartamento/"+id_departamento+"/"+id_sub_departamento,
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
  }

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

  $fecha_vigencia.datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

  $formulario.on("submit", function(e) {
    var
        error                   = false,
        select_empresa          = $select_empresa.val(),
        select_departamento     = $select_departamento.val(),
        select_sub_departamento = $select_sub_departamento.val(),
        archivo                 = $archivo.val(),
        observacion             = $observacion.val(),
        fecha_vigencia          = $fecha_vigencia.val();


    // no ingreso
    if( select_empresa == 0 )
    {
      error = true;

      $select_empresa
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $select_empresa
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");
    }
    else
    {
      if( select_departamento == 0)
      {
        error = true;

        $select_departamento
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0);

        $select_departamento
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");
      }
      else
      {
        if( select_sub_departamento == 0)
        {
          error = true;

          $select_sub_departamento
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0);

          $select_sub_departamento
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");
        }
        else
        {
          if( fecha_vigencia == "")
          {
            error = true;

            $fecha_vigencia
              .parent()
              .addClass("has-error")
              .find(".form-control-feedback")
              .eq(0);

            $fecha_vigencia
              .parent()
              .find(".text-center")
              .eq(0)
              .removeClass("hide");
          }
          else
          {
            if( archivo == "")
            {
              error = true;

              $archivo
                .parent()
                .addClass("has-error")
                .find(".form-control-feedback")
                .eq(0);

              $archivo
                .parent()
                .find(".text-center")
                .eq(0)
                .removeClass("hide");
            }
            else
            {
              if( observacion == "")
              {
                error = true;

                $observacion
                  .parent()
                  .addClass("has-error")
                  .find(".form-control-feedback")
                  .eq(0);

                $observacion
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

    if(! error )
    {
      $('#id-guardar').addClass('hide');
      $('#id-cargando').removeClass('hide');
      $('#text-cargando').removeClass('hide');
    }
    else
      e.preventDefault();
  });

  $select_empresa.change(function(){
    // alert()
    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerDepartamento/"+$select_empresa.val(),
            type: 'POST',
            data: {
                'id_empresa': $select_empresa.val()
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              // alert(data);
              $('#select_departamento').html(data);
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
  
});