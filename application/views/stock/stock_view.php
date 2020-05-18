<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);

if($stock)
{
    $id_stock            = $stock->row()->id_stock;
    $codigo_patilla      = $stock->row()->codigo_patilla;
    $codigo_color        = $stock->row()->codigo_color;
    $descripcion_color   = utf8_encode($stock->row()->descripcion_color);
    $nro_codigo_interno  = $stock->row()->nro_codigo_interno;
    $letra_color_interno = $stock->row()->letra_color_interno;
    $id_tipo_armazon     = $stock->row()->id_tipo_armazon;
    $id_material         = $stock->row()->id_material;
    $id_ubicacion        = $stock->row()->id_ubicacion;
    $cantidad            = $stock->row()->cantidad;
    $costo               = $stock->row()->costo;
    $precio_venta        = $stock->row()->precio_venta;
    $titulo              = "Modificar Stock Armazon ID - ".$id_stock;
    $class_button        = "btn btn-success";
    $name_button         = "Modificar";
}
else
{
  $titulo       = "Nuevo Stock Armazon";
  $class_button = "btn btn-primary";
  $name_button  = "Guardar";
  $id_stock     = 0;
}


//si existe mostramos el log
if($stock>0)
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

echo form_open('stock/guardarStock', array('id' => 'formulario-stock', 'role' => 'form')); 
?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="codigo_patilla">Código patilla</label>
        <input type="hidden" name="id_stock" value="<? echo $id_stock?>">
        <input type="text" class="form-control" name="codigo_patilla" id="codigo_patilla" autocomplete="off" autofocus maxlength="32" value="<? echo $codigo_patilla?>">
        <!-- <input type="hidden" name="id_cliente" value="<? echo $id_cliente?>"> -->
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un código patilla.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="codigo_color">Código color</label>
        <input type="text" class="form-control" name="codigo_color" id="codigo_color" autocomplete="off" autofocus maxlength="32" value="<? echo $codigo_color?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un código color.</p>
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
            <label for="descripcion_color">Descripción color</label>
            <textarea class="form-control" name='descripcion_color' id="descripcion_color" rows="2"
                autocomplete="off"><?echo $descripcion_color;?></textarea>
            <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
            <p class="text-center help-block hide">Debe ingresar un descripción color.</p>
        </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="nro_codigo_interno">Código interno</label>
        <input type="text" class="form-control" name="nro_codigo_interno" id="nro_codigo_interno" autocomplete="off" autofocus maxlength="32" value="<? echo $nro_codigo_interno?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un número código interno.</p>
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
        <label for="letra_color_interno">Letra color interno</label>
        <input type="text" class="form-control" name="letra_color_interno" id="letra_color_interno" autocomplete="off" autofocus maxlength="32" value="<? echo $letra_color_interno?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un letra color interno.</p>
      </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="stock_usuario">Tipo armazon</label>
            <select class="form-control" name="id_tipo_armazon" id="id_tipo_armazon">
                <option value="0">Seleccionar --</option>
                <?
                  foreach( $tipo_armazon as $armazon ) 
                  {
                    if($id_tipo_armazon==$armazon['id_tipo_armazon']) 
                      echo "<option value='".$armazon['id_tipo_armazon']."' selected >".$armazon['descripcion']."</option>";
                    else  
                      echo "<option value='".$armazon['id_tipo_armazon']."'>".$armazon['descripcion']."</option>";

                  }
              ?>                
            </select>
            <!-- <input type="hidden" name="id_stock" value="<? echo $id_stock;?>"> -->
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe seleccionar un tipo de armazon.</p>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div>

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="id_material">Material</label>
            <select class="form-control" name="id_material" id="id_material">
                <option value="0">Seleccionar --</option>
                <?
                  foreach( $materiales as $material ) 
                  {
                    if($id_material==$material['id_material']) 
                      echo "<option value='".$material['id_material']."' selected >".$material['descripcion']."</option>";
                    else  
                      echo "<option value='".$material['id_material']."'>".$material['descripcion']."</option>";

                  }
              ?>                 
            </select>
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar material.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="id_ubicacion">Ubicación</label>
        <select class="form-control" name="id_ubicacion" id="id_ubicacion">
                <option value="0">Seleccionar --</option>
                <?
                  foreach( $ubicaciones as $ubicacion ) 
                  {
                    // echo $ubicacion['id_ubicacion']; exit
                    if($id_ubicacion==$ubicacion['id_ubicacion']) 
                      echo "<option value='".$ubicacion['id_ubicacion']."' selected >".$ubicacion['descripcion']."</option>";
                    else  
                      echo "<option value='".$ubicacion['id_ubicacion']."'>".$ubicacion['descripcion']."</option>";

                  }
              ?>               
            </select>
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar ubicación.</p>
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
        <label for="cantidad">Cantidad</label>
        <input type="text" class="form-control" onkeypress="return filtrar_teclas(event,'0123456789');" name="cantidad" id="cantidad" autocomplete="off" autofocus maxlength="32" value="<? echo $cantidad?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar cantidad.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="costo">Costo</label>
        <input type="text" class="form-control" onkeypress="return filtrar_teclas(event,'0123456789,');"  name="costo" id="costo" autocomplete="off" autofocus maxlength="32" value="<? echo $costo?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar costo.</p>
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
        <label for="precio_venta">Precio venta</label>
        <input type="text" class="form-control" onkeypress="return filtrar_teclas(event,'0123456789,');" name="precio_venta" id="precio_venta" autocomplete="off" autofocus maxlength="32" value="<? echo $precio_venta?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar precio venta.</p>
      </div>
    </div>
    <div class="col-md-2">
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12" align="center">
        <input type="submit" value="<? echo $name_button?>" id='guardar-departamento' class="<? echo $class_button?>">
    </div>
</div><!-- /.row -->
<?php echo form_close(); ?>