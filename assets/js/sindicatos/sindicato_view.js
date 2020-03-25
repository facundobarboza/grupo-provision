var
    $formulario           = $("#formulario-sindicato"),
    $nombre_sindicato    = $('#nombre_sindicato')

// DOM ready!
$(function() {

  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function(e) {
    var
        error               = false,
        nombre_sindicato = $nombre_sindicato.val(),

    
    if( nombre_sindicato == "")
    {
      error = true;

      $nombre_sindicato
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0)
        .removeClass("hide");

      $nombre_sindicato
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");
    }
      
        

    if( !error )
    {
      
    }
    else
      e.preventDefault();
  });
  
});