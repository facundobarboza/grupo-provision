     
var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_usuarios       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $contrasenia             = $("#contrasenia"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_empresa = $("#iframe-modificar-empresa")
      $cb_check                 = $(".cb-check");

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ fichas por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ fichas";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 fichas";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ fichas)";

    $datatable_fichas = $("#datatable-ficha").DataTable({
      "iDisplayLength"  : 50,
      "sPaginationType" : "full_numbers",
      "searching": true,        
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
                    { bSortable: false },
                    { bSortable: false },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: true },
                    { bSortable: false }
                  ]
    });

    $("#fecha_hasta").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febrero', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

    $("#fecha_desde").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febrero', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

    $("#fecha_envio").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febrero', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});


    // boton para descargar el recibo de sueldo
    $datatable_fichas.on("click", ".btn-modificar-ficha", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      //pasamos por parametro el id
       window.open(appGeneral.obtenerSiteUrl() + "archivo/nuevo/" + $info.data("id"));
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      
    });

    $("#descargar").click(function(event) {
     
    fecha_desde   = $("#fecha_desde").val();
    fecha_hasta   = $("#fecha_hasta").val();
    id_sindicato  = $("#id_sindicato").val();
    estado        = $("#estado").val();

    window.location = appGeneral.obtenerSiteUrl() + "archivo/listado_excel/"+fecha_desde+"/"+fecha_hasta+"/"+id_sindicato+"/"+estado;

    return false;
    });
     // boton para eliminar un ficha
    $datatable_fichas.on("click", ".btn-eliminar-ficha", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este ficha?"))
      {
        id_ficha = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "archivo/eliminar/"+id_ficha,
            type: 'POST',
            data: {
                'id_ficha': id_ficha
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

    $(".stock_minimo").click(function(event) {  
      id = $(this).attr('id');
      window.location = appGeneral.obtenerSiteUrl() + "stock/nuevoStock/"+id;
      /* Act on the event */

    });

    /*$cb_check.on("click", function(event) {
     
          var $this = $(this),
            $info = $this.parents("tr").find(".info");

          if($this.is(':checked'))
          {
            var id_fichas    = $info.data("id")+","+$("#id-ficha-estado").val();

            $("#id-ficha-estado").val(id_fichas);
          }
          else
          {
            var array_fichas = $("#id-ficha-estado").val().split(",");

            if(array_fichas.length>0)
            {
              $("#id-ficha-estado").val('');

              for (var i = 0; i < array_fichas.length ; i++) {

                  if(array_fichas[i]!=$info.data("id"))
                  {
                    var id_fichas = array_fichas[i]+",";

                    $("#id-ficha-estado").val(id_fichas);
                  }

                }
            } 
          }

    });*/

    $("#btn-cambiar-estado").click(function(){

      fecha_envio =  $("#fecha_envio").val();
      var id_ficha = "";
      if(confirm("Desea cambiar las fichas seleccionadas con fecha "+fecha_envio +" a estado enviadas?"))
      {
        $cb_check.each(function() {      
      
          var
            $this = $(this),
            $info = $this.parents("tr").find(".info");

          if($this.is(':checked'))
          {
            if(id_ficha=="")
              id_ficha    = $info.data("id");
            else
              id_ficha    = id_ficha +'-'+ $info.data("id");
          }
        });

        console.log(id_ficha);

        if(id_ficha!="")
        {
          jQuery.ajax({
                  url: appGeneral.obtenerSiteUrl() + "archivo/cambiarEstado/"+id_ficha+"/"+fecha_envio,
                  type: 'POST',
                  data: {
                      'id_ficha': id_ficha
                  },
                  async: true,
                  dataType: 'html',
                  contentType: 'application/x-www-form-urlencoded',
                  timeout: 10000,
                  success: function (data)
                  {
                      window.location = appGeneral.obtenerSiteUrl() + "archivo/listado/2";            
                  }
              });
        }
        else
          alert("Debe seleccionar una ficha");

      }
      return false;
    });

  };

})( window, appListado );


// DOM ready
$(function() {

  appListado.inicializar();

});// fin document ready