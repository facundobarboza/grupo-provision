var
    $formulario           = $("#formulario-departamento"),
    $select_empresa       = $('#select_empresa'),
    $nombre_departamento    = $('#nombre_departamento')

// DOM ready!
$(function() {

  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function(e) {
    var
        error               = false,
        nombre_departamento = $nombre_departamento.val(),
        select_empresa      = $select_empresa.val();

    // no ingreso
    if( select_empresa == 0 )
    {
      error = true;

      $select_empresa
        .parent()
        .addClass("has-error")
        .find(".form-control-feedback")
        .eq(0);

      $select_empresa
        .parent()
        .find(".text-center")
        .eq(0)
        .removeClass("hide");

    }
    else
    {
      if( nombre_departamento == "")
      {
        error = true;

        $nombre_departamento
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0)
          .removeClass("hide");

        $nombre_departamento
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");
      }
      
    }    

    if( !error )
    {
      
    }
    else
      e.preventDefault();
  });
  
});