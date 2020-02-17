var
    appLogin = {};

(function(context, window) {

      //---------------------------------
      // PRIVADO
      //---------------------------------

  var
      _debug                   = false,
      $window                  = $(window),
      $document                = $(window.document),
      _$formulario             = $("#formulario-login"),
      _$user_name              = $("#user_name"),
      _$contrasenia            = $("#contrasenia"),
      _$btn_enviar             = $("#btn-enviar"),
      // modal
      _jqxhr                   = null,
      _regenerando_contrasenia = false,
      _$modal_documento        = $("#modal-documento"),
      _$enlace_modal           = $("#enlace-modal"),
      _$documento_modal        = $("#documento-modal"),
      _$captcha_modal          = $("#captcha-modal"),
      _$btn_form_modal         = $("#btn-form-modal"),

      /**
       * [regenerarContrasenia description]
       *
       * @access private
       * @return {void}
       */
      regenerarContrasenia = function() {
        var
            error  = false;

        // si no se ingreso un documento valido
        if( $.trim(_$documento_modal.val()).length < 8 )
        {
          error = true;

          // dar estilo de error al input
          _$documento_modal
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          // mostrar mensaje de error
          _$documento_modal
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");
        }
        // ocultar el error
        else
        {
          _$documento_modal
            .parent()
            .removeClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .addClass("hide");

          _$documento_modal
            .parent()
            .find(".text-center")
            .eq(0)
            .addClass("hide");
        }

        // si no se ingreso el captcha
        if( $.trim(_$captcha_modal.val()).length < 8 )
        {
          error = true;

          // dar estilo de error al input
          _$captcha_modal
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          // mostrar mensaje de error
          _$captcha_modal
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");
        }
        // ocultar el error
        else
        {
          _$captcha_modal
            .parent()
            .removeClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .addClass("hide");

          _$captcha_modal
            .parent()
            .find(".text-center")
            .eq(0)
            .addClass("hide");
        }

        // si no hay ningun error en el formulario
        if( !error )
        {
          _jqxhr = $.ajax({
            url         : appGeneral.obtenerSiteUrl() + "usuario/regenerarContrasenia",
            type        : "POST",
            data        : {
              "documento": _$documento_modal.val(),
              "captcha": _$captcha_modal.val()
            },
            async       : true,
            dataType    : "json",
            contentType : "application/x-www-form-urlencoded",
            timeout     : appGeneral.obtenerGeneralTimeoutAjax(),
            // antes que se envie la peticion ajax
            beforeSend  : function() {
              _regenerando_contrasenia = true;

              // deshabilitamos el boton
              _$btn_form_modal
                .attr("disabled", "disabled")
                .html("solicitando");
            }
          })
          .fail(function(jqXHR, textStatus, errorThrown) {
            // mostramos el mensaje de error
            appGeneral.mostrarMensajeHTML(4, (_debug ? textStatus : "No se pudo regenerar su contrase&ntilde;a, int&eacute;ntelo m&aacute;s tarde."), "body");
          })
          .done(function(data, textStatus, jqXHR) {
            // si no hubo ningun error
            if( !data.error )
              appGeneral.mostrarMensajeHTML(1, data.mensaje, "body");
            // hubo un error
            else
              appGeneral.mostrarMensajeHTML(4, data.mensaje, "body");
          })
          .always(function() {
            _regenerando_contrasenia = false;

            // habilitamos el boton
            _$btn_form_modal
              .removeAttr("disabled")
              .html("solicitar");

            // ocultamos el modal
            _$modal_documento.modal("hide");
          });
        }
      };

      //---------------------------------
      // PUBLICO
      //---------------------------------

  /**
   * inicializar la app
   *
   * @access public
   * @return {void}
   */
  context.inicializar = function() {
    if( _debug )
      console.log("Se ha inicializado la appLogin");

    // dar el foco al campo del documento
    _$user_name.focus();

    // validar los datos del formulario
    _$formulario.on("submit", function(e) {
      var
          error                   = false,
          $contenedor_documento   = _$user_name.parent(),
          user_name               = $.trim(_$user_name.val()),
          $contenedor_contrasenia = _$contrasenia.parent(),
          contrasenia             = $.trim(_$contrasenia.val());

      // validamos el documento
      if( user_name === "" )
      {
        error = true;

        $contenedor_documento
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $contenedor_documento
          .find(".text-center")
          .eq(0)
          .removeClass("hide");
      }
      else
      {
        $contenedor_documento
          .removeClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .addClass("hide");

        $contenedor_documento
          .find(".text-center")
          .eq(0)
          .addClass("hide");
      }

      // validamos la contraseña
      if( contrasenia === "" )
      {
        error = true;

        $contenedor_contrasenia
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $contenedor_contrasenia
          .find(".text-center")
          .eq(0)
          .removeClass("hide");
      }
      else
      {
        $contenedor_contrasenia
          .removeClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .addClass("hide");

        $contenedor_contrasenia
          .find(".text-center")
          .eq(0)
          .addClass("hide");
      }

      // no hay errores en el formulario
      if( !error )
      {
        _$btn_enviar
          .attr("disabled", "disabled")
          .val("Iniciando sesion");

        // enviamos el formulario
        return true;
      }
      else
        e.preventDefault();
    });

    // enlace abrir el modal para regenerar la contraseña
    _$enlace_modal.on("click", function() {
      _$documento_modal
        .parent()
        .removeClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .addClass("hide");

      _$documento_modal
        .parent()
        .find(".text-center")
        .eq(0)
        .addClass("hide");

      _$modal_documento.modal({
        backdrop: 'static',
        keyboard: false,
        show: true
      });
    });

    // boton para regenerar la contraseña
    _$btn_form_modal.on("click", regenerarContrasenia);

    // campo para ingresar el numero de documento en el formulario para regenerar la contraseña
    _$documento_modal.on("keyup", function(e) {
      // ENTER
      if(e.keyCode == 13)
        regenerarContrasenia();
    });

    // evento cuando se cierra el modal
    _$modal_documento.on("hide.bs.modal", function(e) {
      // si se esta haciendo la peticion para regenerar la contraseña,
      // evitamos que se cierre el modal
      if( _regenerando_contrasenia )
        e.preventDefault();
    });

    // evento cuando es visible al cliente el modal
    _$modal_documento.on("shown.bs.modal", function(e) {
      // dar el foco al campo del documento
      _$documento_modal.focus();
    });
  };

})(appLogin, window);

// DOM ready
$(function() {

  // si se ha expirado el tiempo de la sesion
  if( window.parent.appPrincipalView !== undefined )
    // redireccionamos la pagina que contiene el iframe al inicio de sesión
    window.parent.location = "";

  appLogin.inicializar();

});// fin document ready