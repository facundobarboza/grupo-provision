<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);


if(!$id_sindicato)
{
  $titulo       = "Nuevo Sindicato";
  $id_sindicato = 0;
}
else
{
  $titulo = "Modificar Sindicato";
}
?>
  <div class="row">
    <div class="col-md-6">
    <h4 class="page-header text-uppercase">
        <?echo $titulo;?>
      </h4>
    </div>
  </div><!-- /.row -->
<?php 

echo form_open('sindicatos/guardarSindicato', array('id' => 'formulario-sindicato', 'role' => 'form')); 
?>


   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="nombre_sindicato">Nombre</label>
         <input type="hidden" name="id_sindicato" value="<? echo $id_sindicato;?>">
        <input type="text" class="form-control" name="nombre_sindicato" id="nombre_sindicato" autocomplete="off" autofocus maxlength="32" value="<? echo $nombre_sindicato;?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-6" align="center">
      <input type="submit" value="Guardar" id='guardar-sindicato' class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
