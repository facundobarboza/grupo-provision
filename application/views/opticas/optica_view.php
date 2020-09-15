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

//si existe mostramos el log
if($id_optica)
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

echo form_open('opticas/guardarOptica', array('id' => 'formulario-optica', 'role' => 'form')); 
?>


   <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
      <div class="form-group has-feedback">
        <label for="nombre_optica">Nombre</label>
         <input type="hidden" name="id_optica" value="<? echo $id_optica;?>">
        <input type="text" class="form-control" name="nombre_optica" id="nombre_optica" autocomplete="off" autofocus maxlength="32" value="<? echo utf8_encode($nombre_optica);?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-md-6" align="center">
      <input type="submit" value="Guardar" id='guardar-optica' class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
