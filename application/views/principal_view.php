<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Celoma S.A. - Tecnologia</title>

    <link rel="icon" href="<?php echo base_url('assets/images/celomaicon.jpg') ?>" />
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.submenu.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/util.css') ?>" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="<?php echo base_url('assets/js/html5shiv.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/respond.min.js') ?>"></script>
    <![endif]-->
  </head>
  <body>
    <?php 
    $this->load->view('menu_view'); 

    if($this->session->userdata('id_rol')==3)
    {
      $url_index = "archivo/listado";
    }
    else
    {
      $url_index = "archivo/nuevo";
    }
    ?>

    <iframe src="<?php echo site_url($url_index); ?>" id="iframe-principal" width="100%" style="border:0; padding-top:5px;"></iframe>

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/date.format.js') ?>"></script>    
    <script src="<?php echo base_url('assets/js/jquery.onlyDigits.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.principal.view.js') ?>"></script>
    <script>
    // DOM ready
    $(function() {

      appPrincipalView.inicializar("#iframe-principal");

    });// fin document ready
    </script>
  </body>
</html>