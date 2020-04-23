<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($empresa);


if(!$id_stock)
{
  $titulo    = "Nuevo Stock";
  $id_stock = 0;
}
else
{
  $titulo = "Modificar Stock";
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
            <select class="form-control" name="Id_tipo_armazon" id="Id_tipo_armazon">
                <option value="0">Seleccionar --</option>                
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
        <label for="Id_material">Material</label>
        <input type="text" class="form-control" name="Id_material" id="Id_material" autocomplete="off" autofocus maxlength="32" value="<? echo $Id_material?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar material.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="Id_ubicacion">Ubicación</label>
        <input type="text" class="form-control" name="Id_ubicacion" id="Id_ubicacion" autocomplete="off" autofocus maxlength="32" value="<? echo $Id_ubicacion?>">
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
        <input type="text" class="form-control" name="cantidad" id="cantidad" autocomplete="off" autofocus maxlength="32" value="<? echo $cantidad?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar cantidad.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="costo">Costo</label>
        <input type="text" class="form-control" name="costo" id="costo" autocomplete="off" autofocus maxlength="32" value="<? echo $costo?>">
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
        <input type="text" class="form-control" name="precio_venta" id="precio_venta" autocomplete="off" autofocus maxlength="32" value="<? echo $precio_venta?>">
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
        <input type="submit" value="Guardar" id='guardar-departamento' class="btn btn-primary">
    </div>
</div><!-- /.row -->
<?php echo form_close(); ?>