var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_stocks       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $iframe_modificar_stock = $("#iframe-modificar-stock")

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ stocks por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ stocks";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 stocks";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ stocks)";

    $datatable_stocks = $("#datatable-stocks").DataTable({
      "iDisplayLength"  : 50,
      "searching": true,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: false },
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

    $datatable_stocks.on("click", ".btn-modificar-stock", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      $("#modal-stock").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_stock.attr('src',appGeneral.obtenerSiteUrl() + "stock/nuevoStock/" + $info.data("id"));
      
    });

    $("#nueva-stock").click(function(){

       $("#modal-stock").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_stock.attr('src',appGeneral.obtenerSiteUrl() + "stock/nuevoStock/");

    });

    $("#modal-stock").on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      window.location.reload();
    });


     // boton para eliminar el producto
    $datatable_stocks.on("click", ".btn-eliminar-stock", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este producto?"))
      {
        id_stock = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "stock/eliminar/"+id_stock,
            type: 'POST',
            data: {
                'id_stock': id_stock
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "stock/listado/1";
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