<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="iso-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grupo Provision S.R.L</title>

    <!-- Favicons -->
    <!-- <link rel="apple-touch-icon" href="<?php echo base_url('assets/images/celomaicon.jpg') ?>">
    <link rel="icon" href="<?php echo base_url('assets/images/celomaicon.jpg') ?>"> -->

    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style type="text/css">
    
    body {
      background-color: #eeeeee;
    }
    
    body input.form-control,
    body .btn {
      border-radius: 2px;
    }

    .container-top{
      margin-top: 25px;
      margin-bottom: 25px; 
    }
    
    .container-top img {
      width: 100%;
    }
    
    #bg {
      min-height: 100%;
      min-width: 1024px;
      width: 100%;
      height: auto;
      position: fixed;
      top: 0;
      left: 0;
      z-index: -1;
    }

    @media screen and (max-width: 1024px) {
      #bg {
        left: 50%;
        margin-left: -512px;
      }
    }

    #login-div {
      background-color: #FFFFFF;
      box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
      padding: 15px;
      margin-top: 25px;
      border-radius: 2px;
    }
    </style>

    <!--[if lt IE 9]>
      <script src="<?php echo base_url('assets/js/html5shiv.min.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/respond.min.js') ?>"></script>
    <![endif]-->
  </head>
  <body>
    <!-- <img src="<?php echo base_url('assets/images/fondo_1.jpg')?>" id="bg"> -->

    <?php
    $inicio_html_error = '<div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                              <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>';
    $fin_html_error    = '  </div>
                          </div>';

    // error form validation
    echo validation_errors($inicio_html_error,$fin_html_error);

    // si hay un mensaje de error
    if( isset($error) && $error !== '' )
      echo $inicio_html_error.$error.$fin_html_error;

    // error flashdata
    if( $this->session->flashdata('error') )
      echo '<div class="alert text-justify alert-danger" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <div class="contenido-alert">
                <span class="mensaje-alert">'.$this->session->flashdata('error').'</span>
              </div>
            </div>';
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="col-md-6 col-md-offset-3 container-top">
            <img src="http://www.grupoprovision.com/img/logo1.png">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <div id="login-div">
          <div class="row">
            <div class="col-md-12">
              <h5 class="page-header text-uppercase" style="margin-top:5px;">Iniciar sesi&oacute;n</h4>
            </div>
          </div><!-- /.row -->

          <?php echo form_open('usuario/login', array('id' => 'formulario-login')); ?>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label for="user_name" class="control-label">Usuario</label>
                  <input type="text" name="user_name" id="user_name" maxlength="10" class="form-control" autofocus autocomplete="off">
                  <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                  <p class="text-center help-block hide">Debe ingresar su usuario.</p>
                </div>
              </div>
            </div><!-- /.row -->

            <div class="row">
              <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label for="contrasenia" class="control-label">Contrase&ntilde;a</label>
                  <input type="password" name="contrasenia" id="contrasenia" maxlength="32" class="form-control">
                  <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                  <p class="help-block text-center hide">Debe ingresar su contrase&ntilde;a.</p>
                </div>
              </div>
            </div><!-- /.row -->

            <div class="row">
              <div class="col-md-12 text-right">
                <input type="submit" id="btn-enviar" value="Iniciar sesi&oacute;n" class="btn btn-primary">
                <!-- <p class="pull-right">
                  <small>&iquest;Olvid&oacute; su contrase&ntilde;a? 
                    <a href="javascript:" id="enlace-modal">Click aqu&iacute; </a></small>
                </p> -->
              </div>
            </div>
            <!-- /.row -->
          <?php echo form_close(); ?>
        </div>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- Modal -->
    <div class="modal fade" id="modal-documento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" title="cerrar"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Regenerar tu contrase&ntilde;a</h4>
            <h6 class="text-justify">
              Ingrese su n&uacute;mero de documento y los caracteres que hay dentro de la imagen para que el sistema le env&iacute;e su nueva
              contrase&ntilde;a a su correo electr&oacute;nico.
            </h6>
          </div>
          <div class="modal-body">
            <div class="form-group has-feedback">
              <label for="documento" class="control-label">N&deg; de Documento</label>
              <input type="text" id="documento-modal" maxlength="10" class="form-control">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
              <p class="text-center help-block hide">Debe ingresar su n&uacute;mero de documento.</p>
            </div>

            <div class="text-center">
              <?php echo isset($captcha) ? $captcha : '' ?>
            </div>

            <div class="form-group has-feedback">
              <label for="captcha-modal" class="control-label">&nbsp;</label>
              <input type="text" id="captcha-modal" maxlength="8" class="form-control">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
              <p class="text-center help-block hide">Debe ingresar los n&uacute;meros y letras de la imagen.</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn-form-modal">solicitar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/date.format.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/app.general.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/usuario/login_view.js') ?>"></script>
    <script>appGeneral.establecerSiteUrl("<?php echo site_url() ?>");</script>
  </body>
</html>