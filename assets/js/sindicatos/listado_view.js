var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_sindicatos       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_sindicato = $("#iframe-modificar-sindicato")

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ sindicatos por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ sindicatos";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 sindicatos";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ sindicatos)";

    $datatable_sindicatos = $("#datatable-sindicatos").DataTable({
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
    $datatable_sindicatos.on("click", ".btn-modificar-sindicato", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      $("#modal-sindicato").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_sindicato.attr('src',appGeneral.obtenerSiteUrl() + "sindicatos/nuevoDepartamento/" + $info.data("id"));

       // window.location = appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id");
      
    });

    $("#nuevo-sindicato").click(function(){

       $("#modal-sindicato").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_sindicato.attr('src',appGeneral.obtenerSiteUrl() + "sindicatos/nuevoDepartamento/");

    });

    $("#modal-sindicato").on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      window.location.reload();
    });


     // boton para eliminar el sindicato
    $datatable_sindicatos.on("click", ".btn-eliminar-sindicato", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este sindicato?"))
      {
        id_sindicato = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sindicatos/eliminar/"+id_sindicato,
            type: 'POST',
            data: {
                'id_sindicato': id_sindicato
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "sindicatos/listado/1";
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