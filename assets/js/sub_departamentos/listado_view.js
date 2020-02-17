var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_sub_departamentos       = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $btn_form_modal          = $("#btn-form-modal"),
      $iframe_modificar_sub_departamento = $("#iframe-modificar-sub-departamento");

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ sub-departamentos por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ sub-departamentos";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 sub-departamentos";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ sub-departamentos)";

    $datatable_sub_departamentos = $("#datatable-sub-departamentos").DataTable({
      "iDisplayLength"  : 50,
      "searching": true,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "language": datatable_es,
      "aoColumns": [
        { bSortable: true },
        { bSortable: true },
        { bSortable: true },
        { bSortable: false },
        { bSortable: false }
      ]
    });

    // boton para descargar el recibo de sueldo
    $datatable_sub_departamentos.on("click", ".btn-modificar-sub-departamento", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      $("#modal-sub-departamento").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_sub_departamento.attr('src',appGeneral.obtenerSiteUrl() + "sub_departamentos/nuevoSubDepartamento/" + $info.data("id"));

       // window.location = appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id");
      
    });

     $("#modal-sub-departamento").on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      window.location.reload();
    });

    $("#nuevo-sub-departamento").click(function(){

       $("#modal-sub-departamento").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      
      //pasamos por parametro el id
      $iframe_modificar_sub_departamento.attr('src',appGeneral.obtenerSiteUrl() + "sub_departamentos/nuevoSubDepartamento/");

    });

    // boton para eliminar un sub departamento
    $datatable_sub_departamentos.on("click", ".btn-eliminar-sub-departamento", function() {
      
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");
      
      //pasamos por parametro el id
      // $iframe_modificar_empresa.attr('src',appGeneral.obtenerSiteUrl() + "empresas/nueva/" + $info.data("id"));
      if(confirm("Esta seguro que quiere eliminar este Sub-Departamento??"))
      {
        id_sub_departamento = $info.data("id");

       jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/eliminar/"+id_sub_departamento,
            type: 'POST',
            data: {
                'id_sub_departamento': id_sub_departamento
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              window.location = appGeneral.obtenerSiteUrl() + "sub_departamentos/listado/1";
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