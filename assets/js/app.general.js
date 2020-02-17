var
    appGeneral = {};

(function( context, window ) {

      //---------------------------------
      // PRIVADO
      //---------------------------------

  var
      _debug                    = false,
      $window                   = $(window),
      $document                 = $(window.document),
      _SITE_URL                 = "",
      // constantes para el tiempo
      _SEGUNDO                  = 1000,
      _MINUTO                   = (60 * _SEGUNDO),
      // tiempo maximo de espera para la respuesta del servidor
      _GENERAL_TIMEOUT_AJAX     = (3 * _MINUTO),
      _site_url_establecida     = false,
      _contenedores_mensajes    = [],
      _habilitar_cerrar_mensaje = false,
      _visible_modal_iframe     = false,

      /**
       * habilitar que dentro del contenedor los mensajes HTML incluidos
       * puedan cerrarse
       *
       * @param  {string} contenedor
       * @return {void}
       */
      habilitarCerrarMensaje = function(contenedor) {
        var
            encontrado = false;

        for( var i=0, cantidad=_contenedores_mensajes.length; i<cantidad; i++ )
        {
          if( contenedor === _contenedores_mensajes[i] )
          {
            encontrado = true;
            break;
          }
        }

        // si el contenedor aun no se ha habilitado
        if( !encontrado )
        {
          if( _debug )
            console.log("habilitar 'cerrar mensaje' al contenedor " + contenedor);

          _contenedores_mensajes.push(contenedor);

          $(contenedor).on("click", ".close", function(e) {
            var
                $enlace_cerrar = $(this);

            e.preventDefault();

            $enlace_cerrar
              .parents(".alert ").eq(0).fadeOut(300, "swing", function() {
                // eliminar el alert-box
                $enlace_cerrar.parents(".alert").eq(0).remove();
              });
          });
        }
      };

      //---------------------------------
      // PUBLICO
      //---------------------------------

  // expresiones regulares utiles
  context.expReg = {
    Fecha                  : /^\d{2}-\d{2}-\d{4}$/,
    Decimal                : /^\d+(,\d{1,6})?$/,
    Int                    : /^\d+$/,
    Natural                : /^[1-9]\d*\.?[0]*$/,
    AlfabeticoASCII        : /^[A-Za-z']+$/,
    AlfabeticoLatin        : /^[A-Za-zñÑ']+$/,
    AlfabeticoLatinAcentos : /^[A-Za-záéíóúñÁÉÍÓÚÑ']+$/,
    Email                  : /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
    NumeroDocumento        : /^\d{7,8}$/
  };

  /**
   * mostrar un mensaje HTML segun el tipo solicitado
   *
   * @param  {int}    tipo
   * @param  {string} mensaje
   * @param  {string} contenedor
   * @return {void}
   */
  context.mostrarMensajeHTML = function(tipo, mensaje, contenedor) {
    if( $.type(tipo) !== "number" )
      throw new Error("Parámetro tipo. mostrarMensajeHTML()");

    if( $.type(mensaje) !== "string" )
      throw new Error("Parámetro mensaje. mostrarMensajeHTML()");

    if( $.type(contenedor) !== "string" )
      throw new Error("Parámetro contenedor. mostrarMensajeHTML()");

    if( $(contenedor).length === 0 )
      throw new Error("El contenedor no se encuentra. mostrarMensajeHTML()");

    var
        existe   = false,
        css_tipo = "",
        fecha    = new Date();

    switch( tipo )
    {
      // success
      case 1:
        css_tipo = "alert-success";
        break;

      // warning
      case 2:
        css_tipo = "alert-warning";
        break;

      // info
      case 3:
        css_tipo = "alert-info";
        break;

      // danger
      case 4:
        css_tipo = "alert-danger";
        break;

      default:
        css_tipo = "alert-info";
    }

    var alert = $('<div class="alert text-justify ' + css_tipo + '" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' +
                    '<div class="contenido-alert">' +
                      '<span class="fecha-alert">' + fecha.format("dd/mm/yyyy hh:MM:ss TT") + '</span>' +
                      ' | ' +
                      '<span class="mensaje-alert">' + mensaje + '</span>' +
                    '</div>' +
                  '</div>');

    // si hay alert dentro del contenedor
    if( $(contenedor).find('.alert').length > 0 )
    {
      // recorrer todos los alert
      $(contenedor).find('.alert').each(function() {
        var
            $this = $(this);

        // si ya existe el mismo mensaje
        if( $this.find(".mensaje-alert").html() == alert.find(".mensaje-alert").html() && $this.hasClass(css_tipo) )
        {
          // actualizar la fecha y aplicar un efecto visual
          $this
            .find(".fecha-alert").eq(0).html(fecha.format("dd/mm/yyyy hh:MM:ss TT"))
            .end()
            .stop(true)
            .fadeTo(600, 0.1)
            .delay(100)
            .fadeTo(600, 1);

          existe = true;

          // salir del each
          return false;
        }
      });
    }

    // si no existe un alert con el mensaje solicitado
    if( !existe )
      $(contenedor).prepend(alert);

    if( _habilitar_cerrar_mensaje )
      habilitarCerrarMensaje(contenedor);
  };

  /**
   * estableceer por unica vez la URL del sitio
   *
   * @public
   * @param  {string} url
   * @return {void}
   */
  context.establecerSiteUrl = function(url) {
    if( $.type(url) !== "string" )
      throw new Error("El parámetro url debe ser una cadena de caracteres. establecerSiteUrl()");

    if( !_site_url_establecida )
    {
      _SITE_URL = url;

      _site_url_establecida = true;
    }
  };

  /**
   * devolver la URL del sitio
   *
   * @return {string}
   */
  context.obtenerSiteUrl = function() {
    return _SITE_URL;
  };

  /**
   * devolver el tiempo general del timeout para ajax
   *
   * @return {int}
   */
  context.obtenerGeneralTimeoutAjax = function() {
    return _GENERAL_TIMEOUT_AJAX;
  };

  /**
   * [abrirVentana description]
   *
   * @param  {int}    ancho
   * @param  {int}    alto
   * @param  {string} destino
   * @param  {string} nombre
   * @return {void}
   */
  context.abrirVentana = function(ancho, alto, destino, nombre) {
    var
        referencia_ventana,
        xpos  = ($window.width() / 2) - (ancho / 2),
        ypos  = ($window.height()/2) - (alto / 2);

    // abrir ventana
    referencia_ventana = window.open(destino, nombre, "scrollbars=1,resizable=1,width=" + ancho + ",height=" + alto + ",left=" + xpos + ",top=" + ypos);

    return referencia_ventana;
  };

  /**
   * crear una capa donde insertamos un iframe con
   * la url pasado por paramero
   *
   * @param  {int}    ancho
   * @param  {int}    alto
   * @param  {string} destino
   * @return {[type]}
   */
  context.modal_iframe = function(ancho, alto, destino) {
    var
        iframe,
        height,
        height_menu,
        height_ven,
        width_ven,
        top,
        left,
        z_index = 20,
        btn_cerrar_modal;

    if( $.type(ancho) !== "number" )
      throw new Error("El parámetro ancho debe ser un número. modal_iframe()");

    if( $.type(alto) !== "number" )
      throw new Error("El parámetro alto debe ser un número. modal_iframe()");

    if( $.type(destino) !== "string" )
      throw new Error("El parámetro destino debe ser una cadena de caracteres. modal_iframe()");

    // si no esta visible el modal iframe
    if( !_visible_modal_iframe )
    {
      _visible_modal_iframe = true;

      // obtenemos el alto mas grande para la capa que cubre el fondo
      height      = $document.height() > $window.height() ? $document.height() : $window.height(),
      // alto del menu superior
      height_menu = $("#menu-superior").length ? $("#menu-superior").outerHeight() : 0,
      // alto real de la ventana modal
      height_ven  = window.parseInt(alto) >= ($window.height() - height_menu) ? ($window.height() - height_menu - 20) : window.parseInt(alto),
      // ancho real de la ventana modal
      width_ven   = window.parseInt( ancho ) >= $window.width() ? $window.width() - 20 : window.parseInt( ancho ),
      top         = ( ( $window.height() - height_menu ) / 2 - height_ven / 2 ) + height_menu,
      left        = $window.width() / 2 - width_ven / 2;

      // quitamos el scroll del body
      $document.find("body").css("overflow", "hidden");

      // capa que cubre el fondo
      $(document.createElement("div"))
        .css({
          "position"         : "absolute",
          "top"              : 0,
          "left"             : 0,
          "width"            : $window.width(),
          "height"           : height,
          "background-color" : "#FFF",
          "z-index"          : z_index,
          "opacity"          : 0.5
        })
        .attr("id","modal_iframe")
        .appendTo("body");

      iframe = $(document.createElement("iframe"))
                .attr({
                  "src"         : destino,
                  "width"       : width_ven,
                  "height"      : height_ven - 30,
                  "frameborder" : "0",
                  "id"          : "iframe_modal",
                  "border"      : "1"
                  });

      btn_cerrar_modal = $(document.createElement("a"))
                          .css({"float":"right", "margin":"2px 2px 2px 0"})
                          .attr("id","cerrar_modal")
                          .addClass("btn btn-danger btn-xs")
                          .html("Cerrar Ventana")
                          .on("click", function() { appGeneral.hide_modal_iframe(); });

      // contenedor del iframe
      $(document.createElement("div"))
        .css({
          "position"           : "fixed",
          "top"                : top,
          "left"               : left,
          "width"              : width_ven + "px",
          "height"             : height_ven + "px",
          "background-color"   : "#FFF",
          "border"             : "1px solid #AAA",
          "-webkit-box-shadow" : "0 0 20px rgba(0, 0, 0, 0.7)",
          "-moz-box-shadow"    : "0 0 20px rgba(0, 0, 0, 0.7)",
          "box-shadow"         : "0 0 20px rgba(0, 0, 0, 0.7)",
          "z-index"            : (z_index++),
          "text-align"         : "center",
          "color"              : "#333"
        })
        .attr("id","contenedor_modal_iframe")
        .append(btn_cerrar_modal)
        .append(iframe)
        .appendTo("body");

      // mensaje cargando del iframe
      $(document.createElement("div"))
        .css({
          "position"           : "fixed",
          "top"                : top,
          "left"               : left,
          "width"              : width_ven + "px",
          "height"             : height_ven + "px",
          "background-color"   : "#FFF",
          "border"             : "1px solid #DDD",
          "-webkit-box-shadow" : "0 0 20px rgba(0, 0, 0, 0.2)",
          "-moz-box-shadow"    : "0 0 20px rgba(0, 0, 0, 0.2)",
          "box-shadow"         : "0 0 20px rgba(0, 0, 0, 0.2)",
          "z-index"            : (z_index++),
          "text-align"         : "center",
          "color"              : "#333"
        })
        .attr("id","msje_loading_modal_iframe")
        .html('<h1>Cargando <img src="' + _SITE_URL + 'images/spinner.gif" width="16px" height="16px" alt="" /></h1>')
        .appendTo("body");

      iframe.load(function() {
        $("#msje_loading_modal_iframe").remove();
      });
    }

    return iframe;
  };

  /**
   * ocultar modal con iframe dentro
   *
   * @return {void}
   */
  context.hide_modal_iframe = function() {
    // si esta visible el modal iframe
    if( _visible_modal_iframe )
    {
      _visible_modal_iframe = false;

      // establecemos el scroll del body
      $document.find("body").css("overflow", "visible");

      // eliminamos los contenedores
      $("#modal_iframe, #contenedor_modal_iframe").remove();
    }
  };

})( appGeneral, window );