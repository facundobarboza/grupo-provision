var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_opticas       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_optica = $("#iframe-modificar-optica")

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ opticas por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ opticas";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 opticas";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ opticas)";

    $datatable_opticas = $("#datatable-opticas").DataTable({
      "iDisplayLength"  : 50,
      "searching": true,
      "order": [[ 1, "asc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: false }
      ]
    });

    // boton para descargar el recibo de sueldo
    $datatable_opticas.on("click", ".btn-modificar-optica", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      $("#modal-optica").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_optica.attr('src',appGeneral.obtenerSiteUrl() + "opticas/nuevoOptica/" + $info.data("id"));

       // window.location = appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id");
      
    });

    $("#nuevo-optica").click(function(){

       $("#modal-optica").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_optica.attr('src',appGeneral.obtenerSiteUrl() + "opticas/nuevoOptica/");

    });

    $("#modal-optica").on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      window.location.reload();
    });


     // boton para eliminar el optica
    $datatable_opticas.on("click", ".btn-eliminar-optica", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este optica?"))
      {
        id_optica = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "opticas/eliminar/"+id_optica,
            type: 'POST',
            data: {
                'id_optica': id_optica
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "opticas/listado/1";
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