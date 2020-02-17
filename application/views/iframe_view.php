<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Celoma S.A. - Tecnologia</title>

    <link rel="icon" href="<?php echo base_url('assets/images/celomaicon.jpg') ?>" />

    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/util.css') ?>" rel="stylesheet">
    <?php

    // cargar estilos
    if( isset($css) )
    {
      if( is_array($css) )
        foreach( $css as $c )
          echo '<link href="'.$c.'" rel="stylesheet">' . PHP_EOL;
      else
        echo '<link href="'.$css.'" rel="stylesheet">' . PHP_EOL;
    }

    ?>

    <!--[if lt IE 9]>
      <script src="<?php echo base_url('assets/js/html5shiv.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/respond.min.js') ?>"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <?php
      // error flashdata
      if( $this->session->flashdata('exito') )
        echo '<div class="alert text-justify alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div class="contenido-alert">
                  <span class="fecha-alert">'.date('d/m/Y h:i:s A').'</span> | 
                  <span class="mensaje-alert">'.$this->session->flashdata('exito').'</span>
                </div>
              </div>';

      // error flashdata
      if( $this->session->flashdata('error') )
        echo '<div class="alert text-justify alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div class="contenido-alert">
                  <span class="fecha-alert">'.date('d/m/Y h:i:s A').'</span> | 
                  <span class="mensaje-alert">'.$this->session->flashdata('error').'</span>
                </div>
              </div>';

      // error form validation
      echo validation_errors('<div class="alert text-justify alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><div class="contenido-alert"><span class="fecha-alert">'.date('d/m/Y h:i:s A').'</span> | <span class="mensaje-alert">','</span></div></div>');
      ?>

      <div id="contenedor-mensajes"></div>

      <?php 
        //LEEMOS LA VISTA QUE MANDAMOS DESDE EL CONTROLADOR
        if( isset($contenido_view) && $contenido_view !== '' ) 
          $this->load->view($contenido_view); 

      ?>

    </div><!-- /.container -->

    <?php $this->load->view('pie_view') ?>

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/date.format.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.general.js') ?>"></script>
    <script>appGeneral.establecerSiteUrl("<?php echo site_url() ?>");</script>
<!-- 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

    <?php

    // cargar scripts
    if( isset($js) )
    {
      if( is_array($js) )
        foreach( $js as $j )
          echo '<script src="'.$j.'"></script>' . PHP_EOL;
      else
        echo '<script src="'.$js.'"></script>' . PHP_EOL;
    }
    // $this->util->dump_exit($js);
    ?>
  </body>
</html>