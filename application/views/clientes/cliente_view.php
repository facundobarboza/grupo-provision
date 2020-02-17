<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresas);

if($clientes)
{
    $id_empresa      = $clientes->row()->id_empresa;
    $nombre_empresa  = $clientes->row()->nombre_empresa;
    $direccion       = $clientes->row()->direccion;
    $cuit            = $clientes->row()->cuit;
    $actividad       = $clientes->row()->tipo_actividad;
    $contacto        = $clientes->row()->nombre_contacto;
    $mail            = $clientes->row()->mail;
    $telefono_1      = $clientes->row()->telefono_1;
    $telefono_2      = $clientes->row()->telefono_2;
    $facebook        = $clientes->row()->facebook;
    $instagram       = $clientes->row()->instagram;
    $observacion     = $clientes->row()->observacion;
    $fecha_vigencia  = $this->util->fecha($empresas->row()->fecha_vigencia);
}
 
if(!$id_empresa)
{
  $titulo     = "Nuevo Cliente";
  $id_empresa = 0;
}
else
{
  $titulo = "Modificar Cliente";
}
?>
  <div class="row">
    <div class="col-md-12" align="center">
      <h3 class="page-header">
        <?echo $titulo;?>
      </h3>
    </div>
  </div><!-- /.row -->
<?php 
echo form_open('clientes/guardarCliente', array('id' => 'formulario-cliente', 'role' => 'form')); 
?>
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="nombre_empresa">Nombre</label>
        <input type="text" class="form-control" name="nombre_empresa" id="nombre_empresa" autocomplete="off" autofocus maxlength="32" value="<? echo $nombre_empresa?>">
        <input type="hidden" name="id_empresa" value="<? echo $id_empresa?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="direccion_empresa">Direccion</label>
        <input type="text" class="form-control" name="direccion_empresa" id="direccion_empresa" autocomplete="off" autofocus maxlength="50" value="<? echo $direccion?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una direccion.</p>
      </div>
    </div>
     <div class="col-md-2">
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="cuit_empresa">CUIT</label>
        <input type="text" class="form-control" name="cuit_empresa" id="cuit_empresa" autocomplete="off" autofocus maxlength="14" value="<? echo $cuit?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar el CUIT.</p>
        <p class="text-info">
          (XX-XXXXXXXX-X)
        </p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="actividad_empresa">Actividad</label>
        <input type="text" class="form-control" name="actividad_empresa" id="actividad_empresa" autocomplete="off" autofocus maxlength="30" value="<? echo $actividad?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una actividad.</p>
      </div>
    </div>
    <div class="col-md-2">
    </div>
  </div><!-- /.row -->

   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="contacto_empresa">Contacto</label>
        <input type="text" class="form-control" name="contacto_empresa" id="contacto_empresa" autocomplete="off" autofocus maxlength="32" value="<? echo $contacto?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un contacto.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="mail_empresa">Mail</label>
        <input type="text" class="form-control" name="mail_empresa" id="mail_empresa" autocomplete="off" autofocus maxlength="32" value="<? echo $mail?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un mail.</p>
      </div>
    </div>
    
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="telefono_empresa_1">Telefono 1</label>
        <input type="text" class="form-control" name="telefono_empresa_1" id="telefono_empresa_1" autocomplete="off" autofocus maxlength="15" value="<? echo $telefono_1?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un telefono.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="telefono_empresa_2">Telefono 2</label>
        <input type="text" class="form-control" name="telefono_empresa_2" id="telefono_empresa_2" autocomplete="off" autofocus maxlength="15" value="<? echo $telefono_2?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un telefono.</p>
      </div>
    </div>
    <div class="col-md-2">
    </div>
  </div><!-- /.row --> 

  <div class="row">
    <div class="col-md-2">
    </div>
     <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="observacion_empresa">Observacion</label>
        <input type="text" class="form-control" name="observacion_empresa" id="observacion_empresa" autofocus  maxlength="200" value="<? echo $observacion?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una observacion.</p>
      </div>
    </div>
  </div><!-- /.row -->

   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="facebook_empresa">Facebook</label>
        <input type="text" class="form-control" name="facebook_empresa" id="facebook_empresa" autocomplete="off" autofocus maxlength="20" value="<? echo $facebook?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar Facebook.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="instagram_empresa">Instagram</label>
        <input type="text" class="form-control" name="instagram_empresa" id="instagram_empresa" autocomplete="off" autofocus maxlength="20" value="<? echo $instagram?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar Instagram.</p>
      </div>
    </div>
    <div class="col-md-2">
    </div>
  </div><!-- /.row -->

   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="fecha_empresa">Fecha de Vigencia</label>
        <input type="text" class="form-control" name='fecha_vigencia' value='<?echo $fecha_vigencia?>' id="fecha_vigencia" autocomplete="off" >
        <p class="text-center help-block hide">Debe seleccionar una fecha.</p>
      </div>
    </div>
    <div class="col-md-6">
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-12" align="center" >
      <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
