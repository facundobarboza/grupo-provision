<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);


if(!$id_delegacion)
{
  $titulo       = "Nuevo Delegacion";
  $id_delegacion = 0;
}
else
{
  $titulo = "Modificar Delegacion";
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

echo form_open('delegacion/guardarDelegacion', array('id' => 'formulario-delegacion', 'role' => 'form')); 
?>


   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="nombre_delegacion">Nombre</label>
         <input type="hidden" name="id_delegacion" value="<? echo $id_delegacion;?>">
        <input type="text" class="form-control" name="nombre_delegacion" id="nombre_delegacion" autocomplete="off" maxlength="32" value="<? echo utf8_encode($nombre_delegacion);?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-6" align="center">
      <input type="submit" value="Guardar" id='guardar-delegacion' class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
