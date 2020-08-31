<style type="text/css">
  .cancelar-autocomplete {
    position: absolute;
    top: 2px;
    right: 0;
    width: 15px;
    height: 15px;
    background-color: #F5F5F5;
    cursor: hand;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
  }
</style>

<?

if($fichas)
{
  $id_ficha                 = $fichas->row()->id_ficha;
  $id_sindicato             = $fichas->row()->id_sindicato;
  $nro_cliente              = $fichas->row()->nro_cliente;
  $titular                  = $fichas->row()->titular_cliente;
  $id_cliente               = $fichas->row()->id_cliente;
  $beneficiario             = $fichas->row()->beneficiario;
  $id_cliente               = $fichas->row()->id_cliente;
  $delegacion               = $fichas->row()->delegacion;
  $optica                   = $fichas->row()->optica;
  $fecha                    = $this->util->fecha($fichas->row()->fecha);
  $codigo_armazon           = $fichas->row()->codigo_armazon;
  $color_armazon            = $fichas->row()->color_armazon;
  $id_stock                 = $fichas->row()->id_stock;
  $estado                   = $fichas->row()->estado;
  $voucher                  = $fichas->row()->voucher;
  $nro_pedido               = $fichas->row()->nro_pedido;
  $grad_od_esf              = $fichas->row()->grad_od_esf;
  $grad_od_cil              = $fichas->row()->grad_od_cil;
  $eje_od                   = $fichas->row()->eje_od;
  $grad_oi_esf              = $fichas->row()->grad_oi_esf;
  $grad_oi_cil              = $fichas->row()->grad_oi_cil;
  $eje_oi                   = $fichas->row()->eje_oi;
  $comentario               = $fichas->row()->comentario;
  $es_lejos                 = $fichas->row()->es_lejos;
  $adicional                = $fichas->row()->adicional;
  $descripcion_adicional    = $fichas->row()->descripcion_adicional;
  $telefono                 = $fichas->row()->telefono;
  $costo_adicional          = $fichas->row()->costo_adicional;
  $seña_adicional           = $fichas->row()->sena_adicional;
  $saldo_adicional          = $fichas->row()->saldo_adicional;
  $es_casa_central          = $fichas->row()->es_casa_central;
  $id_stock                 = $fichas->row()->id_stock;
}
else
{
  $id_ficha   = 0;
  $fecha      = date("d-m-Y");
  $id_cliente = 0;
  $id_stock   = 0;
}

//si no existe es nuevo
$this->load->helper('cookie');

//si es casa central
if($es_casa_central==1)
{
   $casa = "Casa Central";
}
else
  $casa = " Optica";

if($id_ficha==0)
{
  $titulo       = "Nueva Ficha"." ".$casa;
  $title_button = "Guardar";
}
else
{
  $titulo       = "Modificar Ficha" ." ".$casa." Nro".$id_ficha;
  $title_button = "Modificar";
}
//si existe mostramos el log
if($id_ficha>0)
{
?>
<div align="right" style="width: 100%;height: 26px; ">
  <input id="mostrar_log" type="checkbox" value="1"> Mostrar Logs
</div>
<div id="tabla_logs" width="50%" style="display: none">
  <table class="table table-striped" id='tabla_logs'>

    <?
    foreach( $logs->result() as $log ) 
    {
    ?>
    <tr>
      <td height="20" nowrap>
        Fecha:
        <? echo $log->fecha?>
      </td>
      <td nowrap>
        Usuario :
        <? echo utf8_encode($log->apellido).", ".utf8_encode($log->nombre);?>
      </td>
      <td nowrap>
        Acción :
        <? echo $log->accion; ?>
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
  <div class="col-md-12">
    <h4 class="page-header text-uppercase">
      <?echo $titulo;?>
    </h4>
  </div>
</div>
<?php

echo form_open_multipart('archivo/guardarArchivo', array('id' => 'formulario-fichas'));
?>
<div class="row">
  <div class="col-md-4">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <input type="hidden" name="es_casa_central" value="<? echo $es_casa_central?>">
    <div class="form-group has-feedback">
      <label for="sindicato">Sindicato</label>
      <select class="form-control" name="id_sindicato" id="id_sindicato_cliente">
        <option value="0">Seleccionar --</option>
        <?
              foreach( $sindicatos as $sindicato ) 
              {
                if($id_sindicato==$sindicato['id_sindicato']) 
                  echo "<option value='".$sindicato['id_sindicato']."' selected >".$sindicato['descripcion']."</option>";
                else  
                  echo "<option value='".$sindicato['id_sindicato']."'>".$sindicato['descripcion']."</option>";

              }
            ?>
      </select>
      <span class="glyphicon glyphicon-remove form-control-feedba
          ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un sindicato.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="delegacion">Delegación</label>
      <input type="text" class="form-control" name="delegacion" id="delegacion" autocomplete="off" autofocus maxlength="50" value="<? echo $delegacion?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un delegación.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="fecha">Fecha</label>
      <br>
      <input type="input" name="fecha" style="width: 100%;
                                                  height: 34px;
                                                  padding: 6px 12px;    
                                                  border: 1px solid #ccc;" id='fecha' autocomplete="off" autofocus maxlength="50" value="<? echo $fecha?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un fecha.</p>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="delegacion">Beneficiario</label>
      <input type="text" class="form-control" name="beneficiario" id="beneficiario" autocomplete="off" autofocus maxlength="50" value="<? echo $beneficiario?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un beneficiario.</p>
    </div>
  </div>
  <div class="col-md-4">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <div class="form-group has-feedback">
      <label for="beneficiario">Titular</label>
      <input type="hidden" name="id_cliente" id='id_cliente' value="<? echo $id_cliente?>">
      <input type='text' class="form-control col-sm" autofocus name='filtro_cliente' id='filtro_cliente' value='<? echo $titular?>' placeholder=''>
      <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_cliente' title='cancelar para buscar un nuevo beneficiario' class="hide">
        <span class="glyphicon glyphicon-remove"></span>
      </div>
      <!-- <input type="text" class="form-control" name="beneficiario" id="beneficiario" autocomplete="off" autofocus maxlength="32" value="<? echo $beneficiario?>">
        <input type="hidden" name="id_cliente" value="<? echo $id_cliente?>"> -->
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un titular.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="fecha">Nro Afiliado</label>
      <input type="text" class="form-control" name="nro_cliente" id="nro_cliente" autocomplete="off" autofocus maxlength="50" value="<? echo $nro_cliente?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un nro de afiliado.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-10" border='1'>
    <table class="table table-bordered hide" id='thistorial'>
      <thead>
        <tr style="background-color: #cddae4;">
          <th>Sindicato</th>
          <th>Estado</th>
          <th>Codigo Armazon</th>
          <th>Color Armazon</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody id='historial_titular'>
      </tbody>
    </table>
  </div>
  <div class="col-md-1">
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="codigo_armazon">Código armazon</label>
      <input type="hidden" name="id_stock" id='id_stock' value="<? echo $id_stock?>">
      <input type='text' class="form-control col-sm" autofocus name='codigo_armazon' id='codigo_armazon' value="<? echo $codigo_armazon?>" placeholder=''>
      <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_armazon' title='cancelar para buscar un nuevo armazon' class="hide">
        <span class="glyphicon glyphicon-remove"></span>
      </div>
      <!-- <input type="text" class="form-control" name="codigo_armazon" id="codigo_armazon" autocomplete="off" autofocus maxlength="32" value="<? echo $codigo_armazon?>"> -->
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un codigo de armazon.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="color_armazon">Color de armazon</label>
      <input type="text" class="form-control" name="color_armazon" id="color_armazon" autocomplete="off" autofocus maxlength="50" value="<? echo $color_armazon?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un color de armazon.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="nro_pedido">Número de pedido</label>
      <input type="text" class="form-control" name="nro_pedido" id="nro_pedido" autocomplete="off" autofocus maxlength="32" value="<? echo $estado?>">
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="codigo_armazon_cerca">Código armazon cerca</label>
      <input type="hidden" name="id_stock" id='id_stock' value="<? echo $id_stock?>">
      <input type='text' class="form-control col-sm" autofocus name='codigo_armazon_cerca' id='codigo_armazon_cerca' value="<? echo $codigo_armazon_cerca?>" placeholder=''>
      <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_armazon' title='cancelar para buscar un nuevo armazon' class="hide">
        <span class="glyphicon glyphicon-remove"></span>
      </div>
      <!-- <input type="text" class="form-control" name="codigo_armazon_cerca" id="codigo_armazon_cerca" autocomplete="off" autofocus maxlength="32" value="<? echo $codigo_armazon_cerca?>"> -->
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un codigo de armazon.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="color_armazon_cerca">Color de armazon cerca</label>
      <input type="text" class="form-control" name="color_armazon_cerca" id="color_armazon_cerca" autocomplete="off" autofocus maxlength="50" value="<? echo $color_armazon_cerca?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un color de armazon.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="nro_pedido_cerca">Número de pedido cerca</label>
      <input type="text" class="form-control" name="nro_pedido_cerca" id="nro_pedido_cerca" autocomplete="off" autofocus maxlength="32" value="<? echo $estado_cerca?>">
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="estado">Estado</label>
      <input type="text" class="form-control" name="estado" id="estado" autocomplete="off" autofocus maxlength="32" value="<? echo $estado?>">
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un codigo de estado.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="voucher">Voucher</label>
      <input type="text" class="form-control" name="voucher" id="voucher" autocomplete="off" autofocus maxlength="50" value="<? echo $voucher?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar de voucher.</p>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="optica">Optica</label>
      <input type="text" class="form-control" name="optica" id="optica" autocomplete="off" autofocus maxlength="32" value="<? echo $optica?>">
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un optica.</p>
    </div>
  </div>
</div>

<?php
//si no es casa central
if ($es_casa_central == 0) {
?>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_od_esf">Graduación ojo derecho esférico</label> -->
        <label for="grad_od_esf">Grad. O D ESF</label>
        <input type="text" class="form-control" name="grad_od_esf" id="grad_od_esf" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_od_esf?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_od_cil">Graduación ojo derecho cilindrico</label> -->
        <label for="grad_od_cil">Grad. O D CIL</label>
        <input type="text" class="form-control" name="grad_od_cil" id="grad_od_cil" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_od_cil?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="eje_od">Eje ojo derecho</label> -->
        <label for="eje_od">Eje O D</label>
        <input type="text" class="form-control" name="eje_od" id="eje_od" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_od?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo derecho.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_oi_esf">Graduación ojo izquierdo esférico</label> -->
        <label for="grad_oi_esf">Grad. O I ESF</label>
        <input type="text" class="form-control" name="grad_oi_esf" id="grad_oi_esf" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_oi_esf?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_oi_cil">Graduación ojo izquierdo cilindrico</label> -->
        <label for="grad_oi_cil">Grad. O I CIL</label>
        <input type="text" class="form-control" name="grad_oi_cil" id="grad_oi_cil" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_oi_cil?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="eje_oi">Eje ojo izquierdo</label> -->
        <label for="eje_oi">Eje O I</label>
        <input type="text" class="form-control" name="eje_oi" id="eje_oi" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_oi?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo izquierdo.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_od_esf">Graduación ojo derecho esférico</label> -->
        <label for="grad_od_esf_cerca">Grad. O D ESF cerca</label>
        <input type="text" class="form-control" name="grad_od_esf_cerca" id="grad_od_esf_cerca" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_od_esf_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_od_cil">Graduación ojo derecho cilindrico</label> -->
        <label for="grad_od_cil_cerca">Grad. O D CIL cerca</label>
        <input type="text" class="form-control" name="grad_od_cil_cerca" id="grad_od_cil_cerca" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_od_cil_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="eje_od">Eje ojo derecho</label> -->
        <label for="eje_od_cerca">Eje O D cerca</label>
        <input type="text" class="form-control" name="eje_od_cerca" id="eje_od_cerca" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_od_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo derecho.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_oi_esf">Graduación ojo izquierdo esférico</label> -->
        <label for="grad_oi_esf_cerca">Grad. O I ESF cerca</label>
        <input type="text" class="form-control" name="grad_oi_esf_cerca" id="grad_oi_esf_cerca" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_oi_esf_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="grad_oi_cil">Graduación ojo izquierdo cilindrico</label> -->
        <label for="grad_oi_cil_cerca">Grad. O I CIL cerca</label>
        <input type="text" class="form-control" name="grad_oi_cil_cerca" id="grad_oi_cil_cerca" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_oi_cil_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <!-- <label for="eje_oi">Eje ojo izquierdo</label> -->
        <label for="eje_oi_cerca">Eje O I cerca</label>
        <input type="text" class="form-control" name="eje_oi_cerca" id="eje_oi_cerca" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_oi_cerca?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo izquierdo.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="comentario">Comentario</label>
        <input type="text" class="form-control" name="comentario" id="comentario" autocomplete="off" autofocus maxlength="50" value="<? echo $comentario?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un comentario.</p>
      </div>
    </div> -->
    <!-- <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="es_lejos">Lejos</label>
        <input type="text" class="form-control" name="es_lejos" id="es_lejos" autocomplete="off" autofocus maxlength="32" value="<? echo $es_lejos?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar lejos.</p>
      </div>
    </div> -->
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="adicional">Adicional</label>
        <input type="text" class="form-control" name="adicional" id="adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un adicional.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="descripcion_adicional">Descripción adicional</label>
        <input type="text" class="form-control" name="descripcion_adicional" id="descripcion_adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $descripcion_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una descripción adicional.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="telefono">Telefono</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789-');" class="form-control" name="telefono" id="telefono" autocomplete="off" autofocus maxlength="32" value="<? echo $telefono?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un telefono.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="costo_adicional">Costo Adicional</label>
        <input type="text" class="form-control" onkeypress="return filtrar_teclas(event,'0123456789.');" name="costo_adicional" id="costo_adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $costo_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un costo adicional.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="seña_adicional">Seña adicional</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789.');" class="form-control" name="sena_adicional" id="sena_adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $seña_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un seña adicional.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="saldo_adicional">Saldo adicional</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789.');" class="form-control" name="saldo_adicional" id="saldo_adicional" autocomplete="off" autofocus maxlength="32" value="<? echo $saldo_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un saldo adicional.</p>
      </div>
    </div>
  </div>
<?php
} // FIN if casa_central
?>

<div class="row">
  <!-- <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="comentario">Comentario</label>
        <input type="text" class="form-control" name="comentario" id="comentario" autocomplete="off" autofocus maxlength="50" value="<? echo $comentario?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un comentario.</p>
      </div>
    </div> -->
  <div class="col-md-12">
    <div class="form-group has-feedback">
      <label for="comentario">Comentario</label>
      <textarea rows="2" class="form-control" name="comentario" id="comentario" autocomplete="off" autofocus maxlength="50" value="<? echo $comentario?>"></textarea>
      <!-- <input type="text" class="form-control" name="comentario" id="comentario" autocomplete="off" autofocus maxlength="50" value="<? echo $comentario?>"> -->
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un comentario.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12" align="center">
    <input type="submit" id='id-guardar' value="<? echo $title_button;?>" class="btn btn-primary">
    <span id='id-cargando' class="glyphicon glyphicon-refresh hide"><b>
        <p id='text-cargando' class="text-center help-block hide">Cargando, por favor esperar..</p>
      </b></span>
  </div>
</div>
<br>
<br>
<br>
<br>
<?php echo form_close(); ?>