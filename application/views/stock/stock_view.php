<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);


if(!$id_alerta)
{
  $titulo    = "Nueva Stock";
  $id_alerta = 0;
}
else
{
  $titulo = "Modificar Stock";
}
?>
  <div class="row">
    <div class="col-md-6" align="center">
      <h3 class="page-header">
        <?echo $titulo;?>
      </h3>
    </div>
  </div><!-- /.row -->
<?php 

echo form_open('stock/guardarStock', array('id' => 'formulario-alerta', 'role' => 'form')); 
?>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="alerta_usuario">Usuarios</label>
        <select class="form-control" name="select_usuario" id="select_usuario"  >
          <option value="0">Seleccionar --</option>
          <?
          foreach( $usuarios as $usuario ) 
          {
            if(($id_usuario==$usuario['id_usuario']))
              echo "<option value='".$usuario['id_usuario']."' selected >".$usuario['apellido'].", ".$usuario['nombre']."</option>";
            else  
              echo "<option value='".$usuario['id_usuario']."'>".$usuario['apellido'].", ".$usuario['nombre']."</option>";

          }
          ?>          
        </select>
        <input type="hidden" name="id_alerta" value="<? echo $id_alerta;?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe seleccionar un usuario.</p>
      </div>
    </div>
  </div><!-- /.row -->
  
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="fecha">Fecha</label><br>
        <input form-control type="text" name='fecha_mensaje' id="fecha_mensaje" autocomplete="off" value='<?echo Util::fecha($fecha_mensaje)?>'>
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe seleccionar una fecha.</p>
      </div>
    </div>
  </div><!-- /.row -->

   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="mensaje">Mensaje</label>
         <textarea class="form-control" name='mensaje' id="mensaje" rows="2" autocomplete="off" ><?echo $mensaje;?></textarea>
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un mensaje.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-6" align="center" >
      <input type="submit" value="Guardar" id='guardar-departamento' class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
