var
    appPrincipalView = {};

(function( context, window ) {

      //---------------------------------
      // PRIVADO
      //---------------------------------

  var
      _debug                = false,
      $window               = $(window),
      $document             = $(window.document),
      // constantes para el tiempo
      _SEGUNDO              = 1000,
      _MINUTO               = (60 * _SEGUNDO),
      // tiempo maximo de espera para la respuesta del servidor
      _GENERAL_TIMEOUT_AJAX = (5 * _MINUTO),
      // referencia al contenedor del menu principal
      _$menu_superior       = null,
      // referencia a los items del menu
      _$items_menu          = null,
      // referencia al iframe donde se carga el contenido de la aplicacion
      _$iframe_principal    = $("#iframe-principal"),

      /**
       * establecer la altura del iframe
       * para que quepa dentro de la ventana
       *
       * @return {[type]} [description]
       */
      acomodarIframe = function() {
        if( _debug )
          console.log("acomodarIframe");

        _$iframe_principal.css({
          'height': ($window.height() - _$menu_superior.outerHeight() - 5) + "px"
        });
      };

      //---------------------------------
      // PUBLICO
      //---------------------------------

  /**
   * inicializar la app
   * 
   * @param  {[type]} identificador_iframe [description]
   * @return {[type]}                      [description]
   */
  context.inicializar = function(identificador_iframe) {
    // guardamos la referencia al menu superior
    _$menu_superior = $("#menu-superior");

    // guardamos la referencia a los items del menu
    _$items_menu = $(".item-menu");

    if( _$items_menu.length )
    {
      _$items_menu.on("click", function(e) {
        var
            $item = $(this);

        e.preventDefault();

        _$iframe_principal.attr("src", $item.attr("href"));
      });
    }

    // guardamos la referencia al iframe
    _$iframe_principal = $(identificador_iframe);

    if( _$iframe_principal.length )
    {
      // establecemos la altura del iframe
      acomodarIframe();

      // cada vez que se redimensiona la ventana, acomodamos la altuma del iframe
      $(window).on("resize", acomodarIframe);
    }
  }

  /**
   * establecer el item del menu solicitado
   * 
   * @param  {array} posicion
   * @return {void}
   */
  context.establecerMenuActivo = function(posicion) {
    var
        item = _$menu_superior;

    for( var i=0, cantidad=posicion.length; i<cantidad; i++ )
    {
      item = item.find(".item-menu").eq(posicion[i]);
    }

    // si se localizo el item del menu
    if( item.length )
    {
      // quitamos el estilo de activo del menu
      _$menu_superior.find(".active").removeClass("active");

      // estblecemos como "activo" el item del menu solicitado
      item.parent().addClass("active");
    }
  }

})( appPrincipalView, window );