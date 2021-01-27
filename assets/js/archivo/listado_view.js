     
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
                    { bSortable: false }
                  ]
    });

    $("#fecha_hasta").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
          dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']});

    $("#fecha_desde").datepicker({
          firstDay: 1,
          dateFormat: 'dd-mm-yy',
          monthNames: ['Enero', 'Febreo', 'Marzo',
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
       window.location = appGeneral.obtenerSiteUrl() + "archivo/nuevo/" + $info.data("id");
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      
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

    $("#eliminar-masivo").click(function(){

      if(confirm("Esta seguro que quiere eliminar todos los fichas seleccionados?"))
      {
        $(".cb-eliminar").each(function() {       
      
          var
            $this = $(this),
            $info = $this.parents("tr").find(".info");

          if($this.is(':checked'))
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
                    
                  }
              });
          }
        });

        window.location = appGeneral.obtenerSiteUrl() + "archivo/listado/1";
      }

    });

  };

})( window, appListado );


// DOM ready
$(function() {

  appListado.inicializar();

});// fin document ready