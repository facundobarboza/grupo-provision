var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_empresa       = null,
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
    datatable_es.sLengthMenu   = "Mostrando _MENU_ empresas por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ empresas";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 empresas";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ empresas)";

    $datatable_empresa = $("#datatable-empresa").DataTable({
      "iDisplayLength"  : 50,
      "searching": true,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: false }
      ]
    });

    // boton para descargar el recibo de sueldo
    $datatable_empresa.on("click", ".btn-modificar", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));

       window.location = appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id");
      
    });

    // boton para eliminar empresa
    $datatable_empresa.on("click", ".btn-eliminar", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar esta empresa??"))
      {
        id_empresa = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "empresas/eliminar/"+id_empresa,
            type: 'POST',
            data: {
                'id_empresa': id_empresa
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "empresas/listado/"+id_empresa;
            }
        });
      }
      
    });

  };

})( window, appListado );


// DOM ready
$(function() {

  appListado.inicializar();

});// fin document ready