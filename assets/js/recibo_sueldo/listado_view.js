var
    appListado = {};

(function(window, context) {
  var
      _debug                   = false,
      $datatable_recibo        = null,
      // modal
      _jqxhr                   = null,
      _confirmando_contrasenia = false,
      _ultima_liquidacion      = null,
      $modal_confirmacion      = $("#modal-confirmacion"),
      $contrasenia             = $("#contrasenia"),
      $btn_form_modal          = $("#btn-form-modal"),

      /**
       * [confirmarContrasenia description]
       *
       * @access private
       * @return {void}
       */
      confirmarContrasenia = function() {
        var
            error = false;

        // si no se ingreso la contraseña
        if( $.trim($contrasenia.val()).length < 8 )
        {
          error = true;

          // dar estilo de error al input
          $contrasenia
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          // mostrar mensaje de error
          $contrasenia
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");
        }
        // ocultar el error
        else
        {
          $contrasenia
            .parent()
            .removeClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .addClass("hide");

          $contrasenia
            .parent()
            .find(".text-center")
            .eq(0)
            .addClass("hide");
        }

        // si no hay ningun error en el formulario
        if( !error )
        {
          _jqxhr = $.ajax({
            url         : appGeneral.obtenerSiteUrl() + "usuario/confirmarContrasenia",
            type        : "POST",
            data        : {
              "id_liquidacion": _ultima_liquidacion,
              "contrasenia": $contrasenia.val()
            },
            async       : true,
            dataType    : "json",
            contentType : "application/x-www-form-urlencoded",
            timeout     : appGeneral.obtenerGeneralTimeoutAjax(),
            // antes que se envie la peticion ajax
            beforeSend  : function() {
              _confirmando_contrasenia = true;

              // deshabilitamos el boton
              $btn_form_modal
                .attr("disabled", "disabled")
                .html("confirmando...");
            }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            // mostramos el mensaje de error
            appGeneral.mostrarMensajeHTML(4, (_debug ? textStatus : "No se pudo confirmar su contrase&ntilde;a, int&eacute;ntelo m&aacute;s tarde."), "body");
          })
          .done(function(data, textStatus, jqXHR) {
            // si no hubo ningun error
            if( !data.error )
            {
              $contrasenia.val("");

              // recorremos las tablas
              $datatable_recibo.$("tr").each(function() {
                var
                    $tr   = $(this),
                    $info = $tr.find(".info");

                // si es la fila de la ultima liquidacion
                if( $info.data("id") == _ultima_liquidacion )
                {
                  // establecemos que ya se confirmado
                  $info.data("confirmado", "t");

                  // detenemos el loop
                  return false;
                }
              });

              window.location = appGeneral.obtenerSiteUrl() + "recibo_sueldo/descargar/" + _ultima_liquidacion;
            }
            // hubo un error
            else
              appGeneral.mostrarMensajeHTML(4, data.mensaje, "body");
          })
          .always(function() {
            _confirmando_contrasenia = false;

            // habilitamos el boton
            $btn_form_modal
              .removeAttr("disabled")
              .html("confirmar");

            // ocultamos el modal
            $modal_confirmacion.modal("hide");
          });
        }
      };

  /**
   * [inicializar description]
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    // establecer los mensajes del datatable
    datatable_es.sLengthMenu   = "Mostrando _MENU_ recibos por p&aacute;gina";
    datatable_es.sInfo         = "_START_ a _END_ de _TOTAL_ recibos";
    datatable_es.sInfoEmpty    = "Mostrando de 0 a 0 de 0 recibos";
    datatable_es.sInfoFiltered = "(filtrado de un total de _MAX_ recibos)";

    $datatable_recibo = $("#datatable-recibo-sueldo").DataTable({
      "searching": false,
      "order": [[ 1, "desc" ], [ 0, "desc" ]],
      "dom": '<"row"<"col-xs-6"l><"col-xs-6"r>>t<"row"<"col-xs-4"i><"col-xs-8"p>>',
      "language": datatable_es,
      "aoColumns": [
        // mes
        { bSortable: true },
        // año
        { bSortable: true },
        // botones
        { bSortable: false }
      ],
      "createdRow": function(row, data, index) {
        var
            $info = $(row).find(".info").eq(0);
            mes   = "";

        // filtro por el numero del mes y muestro el nombre del mismo
        switch( window.parseInt(data[0]) )
        {
          case 1: mes = "Enero"; break;
          case 2: mes = "Febrero"; break;
          case 3: mes = "Marzo"; break;
          case 4: mes = "Abril"; break;
          case 5: mes = "Mayo"; break;
          case 6: mes = "Junio"; break;
          case 7: mes = "Julio"; break;
          case 8: mes = "Agosto"; break;
          case 9: mes = "Septiembre"; break;
          case 10: mes = "Octubre"; break;
          case 11: mes = "Noviembre"; break;
          case 12: mes = "Diciembre"; break;
        }

        // centro los contenidos
        $("td", row).eq(0).html('<div class="text-center">' + mes + '</div>');
        $("td", row).eq(1).html('<div class="text-center">' + data[1] + '</div>');
      }
    });

    // boton para descargar el recibo de sueldo
    $datatable_recibo.on("click", ".btn-descargar", function() {
      var
          $this = $(this),
          $info = $this.parents("tr").find(".info");

      // si es el ultimo recibo y aun no se ha confirmado
      if( $info.data("ultimo") === "t" && $info.data("confirmado") === "f" )
      {
        _ultima_liquidacion = $info.data("id");

        $("#modal-confirmacion").modal({
          backdrop: "static",
          keyboard: false,
          show: true
        });
      }
      else
      {
        window.location = appGeneral.obtenerSiteUrl() + "recibo_sueldo/descargar/" + $info.data("id");
      }
    });

    // boton para regenerar la contraseña
    $btn_form_modal.on("click", confirmarContrasenia);

    // campo para ingresar el numero de documento en el formulario para regenerar la contraseña
    $contrasenia.on("keyup", function(e) {
      // ENTER
      if( e.keyCode == 13 )
      {
        confirmarContrasenia();
      }
    });

    // evento cuando se cierra el modal
    $modal_confirmacion.on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para confirmar la contraseña,
      // evitamos que se cierre el modal
      if( _confirmando_contrasenia )
      {
        e.preventDefault();
      }
    });

    // This event fires immediately when the show instance method is called
    $modal_confirmacion.on("show.bs.modal", function(e) {
      $contrasenia
        .parent()
        .removeClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .addClass("hide");

      $contrasenia
        .parent()
        .find(".text-center")
        .eq(0)
        .addClass("hide");

      $contrasenia.val("");
    });

    // evento cuando es visible al cliente el modal
    // This event is fired when the modal has been made visible to the user
    $modal_confirmacion.on("shown.bs.modal", function(e) {
      // dar el foco al campo de la contraseña
      $contrasenia
        .focus();
    });

  };

})( window, appListado );


// DOM ready
$(function() {

  appListado.inicializar();

});// fin document ready