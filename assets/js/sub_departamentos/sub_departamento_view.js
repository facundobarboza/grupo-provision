// var
    $formulario           = $("#formulario-sub-departamento"),
    $select_empresa       = $('#select_empresa'),
    $select_departamento  = $('#select_departamento'),
    $nombre_sub_departamento  = $('#nombre_sub_departamento')

// DOM ready!
$(function() {

  // $fecha_vigencia.datepicker();

  $formulario.on("submit", function(e) {
    var
        error                   = false,
        nombre_sub_departamento = $nombre_sub_departamento.val(),
        select_departamento     = $select_departamento.val(),
        select_empresa          = $select_empresa.val();

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
       // no ingreso
      if( select_departamento == 0 )
      {
        error = true;

        $select_departamento
          .parent()
          .addClass("has-error")
          .find(".form-control-feedback")
          .eq(0);

        $select_departamento
          .parent()
          .find(".text-center")
          .eq(0)
          .removeClass("hide");

      }
      else
      {
        if( nombre_sub_departamento == "")
        {
          error = true;

          $nombre_sub_departamento
            .parent()
            .addClass("has-error")
            .find(".form-control-feedback")
            .eq(0)
            .removeClass("hide");

          $nombre_sub_departamento
            .parent()
            .find(".text-center")
            .eq(0)
            .removeClass("hide");

        }
      }      
    }    

    if( !error )
    {

    }
    else
      e.preventDefault();
  });
  

  $select_empresa.change(function(){
    // alert()
    jQuery.ajax({
            url: appGeneral.obtenerSiteUrl() + "sub_departamentos/traerDepartamento/"+$select_empresa.val(),
            type: 'POST',
            data: {
                'id_empresa': $select_empresa.val()
            },
            async: true,
            dataType: 'html',
            contentType: 'application/x-www-form-urlencoded',
            timeout: 10000,
            success: function (data)
            {
              // alert(data);
              $('#select_departamento').html(data);
            }
        });
  });

});