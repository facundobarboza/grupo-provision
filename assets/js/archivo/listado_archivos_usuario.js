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
    datatable_es.sLengthMenu   = "Mostrando _MENU_ archivos por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ archivos";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 archivos";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ archivos)";

    $datatable_archivos = $("#datatable-archivo-usuario").DataTable({
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
        { bSortable: false }
      ]
    });

  };

})( window, appListado );


// DOM ready
$(function() {

  appListado.inicializar();

});// fin document ready