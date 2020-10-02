var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_delegaciones       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_delegacion = $("#iframe-modificar-delegacion")

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ delegaciones por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ delegaciones";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 delegaciones";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ delegaciones)";

    $datatable_delegaciones = $("#datatable-delegaciones").DataTable({
      "iDisplayLength"  : 50,
      "searching": true,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: true },
        { bSortable: true },
        { bSortable: false }
      ]
    });

    // boton para descargar el recibo de sueldo
    $datatable_delegaciones.on("click", ".btn-modificar-delegacion", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      $("#modal-delegacion").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_delegacion.attr('src',appGeneral.obtenerSiteUrl() + "delegacion/nuevoDelegacion/" + $info.data("id"));

       // window.location = appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id");
      
    });

    $("#nuevo-delegacion").click(function(){

       $("#modal-delegacion").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_delegacion.attr('src',appGeneral.obtenerSiteUrl() + "delegacion/nuevoDelegacion/");

    });

    $("#modal-delegacion").on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      window.location.reload();
    });


     // boton para eliminar el delegacion
    $datatable_delegaciones.on("click", ".btn-eliminar-delegacion", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este delegacion?"))
      {
        id_delegacion = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "delegacion/eliminar/"+id_delegacion,
            type: 'POST',
            data: {
                'id_delegacion': id_delegacion
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "delegacion/listado/1";
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