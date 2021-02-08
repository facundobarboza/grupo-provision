<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);


if(!$id_optica)
{
  $titulo       = "Nuevo Optica";
  $id_optica = 0;
}
else
{
  $titulo = "Modificar Optica";
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

echo form_open('opticas/guardarOptica', array('id' => 'formulario-optica', 'role' => 'form')); 
?>


   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="nombre_optica">Nombre</label>
         <input type="hidden" name="id_optica" value="<? echo $id_optica;?>">
        <input type="text" class="form-control" name="nombre_optica" id="nombre_optica" autocomplete="off"  maxlength="32" value="<? echo utf8_encode($nombre_optica);?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
  </div><!-- /.row -->
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="form-group has-feedback">
          <label for="delegacion">Delegación</label>
            <select class="form-control" name="id_delegacion" id="id_delegacion">
              <option value="0">Seleccionar --</option>
              <? foreach( $delegaciones as $delegacion )
              {
                if($id_delegacion==$delegacion['id_delegacion'])
                  echo "<option value='".$delegacion['id_delegacion']."' selected >".$delegacion['descripcion']."</option>";
                else echo "<option value='".$delegacion['id_delegacion']."'>".$delegacion['descripcion']."</option>";
              }?>
            </select>
          </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6" align="center">
      <input type="submit" value="Guardar" id='guardar-optica' class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
