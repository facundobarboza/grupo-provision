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

//si existe mostramos el log
if($id_delegacion)
{
?>
<div align="right" style="width: 100%;height: 26px; ">
    <input id="mostrar_log" type="checkbox" value="1"> Mostrar Logs
</div>
<div id="tabla_logs" width="50%" style="display: none" >
    <table class="table table-striped" id='tabla_logs' >

  <?
    foreach( $logs->result() as $log ) 
    {
      // print_r($log);
    ?>
      <tr >
          <td height="20" nowrap>
            Fecha: <? echo $log->fecha?> 
        </td>
        <td nowrap > 
          Usuario : <? echo utf8_encode($log->apellido).", ".utf8_encode($log->nombre);?> 
        </td>
        <td nowrap > 
            Acción : <? echo $log->accion; ?> 
        </td>
      </tr>
    <?    
    } 
    ?>
    </table>
</div>
      <?
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

echo form_open('delegaciones/guardarDelegacion', array('id' => 'formulario-delegacion', 'role' => 'form')); 
?>


   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="nombre_delegacion">Nombre</label>
         <input type="hidden" name="id_delegacion" value="<? echo $id_delegacion;?>">
        <input type="text" class="form-control" name="nombre_delegacion" id="nombre_delegacion" autocomplete="off" autofocus maxlength="32" value="<? echo utf8_encode($nombre_delegacion);?>">
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
