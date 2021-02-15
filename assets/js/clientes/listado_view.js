var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_cliente       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $contrasenia             = $("#contrasenia"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_cliente = $("#iframe-modificar-cliente")
    

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ clientes por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ clientes";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 clientes";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ clientes)";

    $datatable_cliente = $("#datatable-cliente").DataTable({
      "iDisplayLength"  : 50,
      "sPaginationType" : "full_numbers",
      "searching": true,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: false },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: false }
      ]
    });

    // boton para descargar el recibo de sueldo
    $datatable_cliente.on("click", ".btn-modificar", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_cliente.attr('src',appGeneral.obtenerSiteUrl() + "clientes/nueva/" + $info.data("id"));

       window.location = appGeneral.obtenerSiteUrl() + "clientes/nuevo/" + $info.data("id");
      
    });

    $("#btn-buscar").click(function(event) {
       
        if ($("#filtro_afiliado").val() == "" )
        {
          $("#filtro_afiliado").parent().addClass("has-error").find(".form-control-feedback").eq(0);
          $("#filtro_afiliado").parent().find(".text-center").eq(0).removeClass("hide");
          return false;
        }
    });

    // boton para eliminar cliente
    $datatable_cliente.on("click", ".btn-eliminar", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_cliente.attr('src',appGeneral.obtenerSiteUrl() + "clientes/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar esta Afiliado??"))
      {
        id_cliente = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "clientes/eliminar/"+id_cliente,
            type: 'POST',
            data: {
                'id_cliente': id_cliente
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "clientes/listado/"+id_cliente;
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