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
  $id_ficha                  = $fichas->row()->id_ficha;
  $id_sindicato              = $fichas->row()->id_sindicato;
  $nro_cliente               = $fichas->row()->nro_cliente;
  $titular                   = $fichas->row()->titular_cliente;
  $id_cliente                = $fichas->row()->id_cliente;
  $beneficiario              = $fichas->row()->beneficiario;
  $id_cliente                = $fichas->row()->id_cliente;
  $id_delegacion             = $fichas->row()->id_delegacion;
  $id_optica                 = $fichas->row()->id_optica;
  $fecha                     = $this->util->fecha($fichas->row()->fecha);
    
  $comentario                = $fichas->row()->comentario;
  $select_tipo               = $fichas->row()->es_lejos;
  $adicional                 = $fichas->row()->adicional;
  $descripcion_adicional     = $fichas->row()->descripcion_adicional;
  $telefono                  = $fichas->row()->telefono;
  $costo_adicional           = $fichas->row()->costo_adicional;
  $seña_adicional            = $fichas->row()->sena_adicional;
  $saldo_adicional           = $fichas->row()->saldo_adicional;
  $es_casa_central           = $fichas->row()->es_casa_central;
    
  $codigo_armazon            = $fichas->row()->codigo_armazon;
  $color_armazon             = $fichas->row()->color_armazon;
  $id_stock                  = $fichas->row()->id_stock;
  $voucher                   = $fichas->row()->voucher;
  $nro_pedido                = $fichas->row()->nro_pedido;
  $estado                    = $fichas->row()->estado;
  $grad_od_esf               = $fichas->row()->grad_od_esf;
  $grad_od_cil               = $fichas->row()->grad_od_cil;
  $eje_od                    = $fichas->row()->eje_od;
  $grad_oi_esf               = $fichas->row()->grad_oi_esf;
  $grad_oi_cil               = $fichas->row()->grad_oi_cil;
  $eje_oi                    = $fichas->row()->eje_oi;
  $nro_pedido_voucher        = $fichas->row()->nro_pedido_voucher;
  $tipo_lente                = $fichas->row()->tipo_lente;
  $fecha_envio               = $this->util->fecha($fichas->row()->fecha_envio);

  $codigo_armazon_cerca      = $fichas->row()->codigo_armazon_cerca;
  $color_armazon_cerca       = $fichas->row()->color_armazon_cerca;
  $id_stock_cerca            = $fichas->row()->id_stock_cerca;
  $voucher_cerca             = $fichas->row()->voucher_cerca;
  $nro_pedido_cerca          = $fichas->row()->nro_pedido_cerca;
  $id_estado_cerca           = $fichas->row()->id_estado_cerca;
  $grad_od_esf_cerca         = $fichas->row()->grad_od_esf_cerca;
  $grad_od_cil_cerca         = $fichas->row()->grad_od_cil_cerca;
  $eje_od_cerca              = $fichas->row()->eje_od_cerca;
  $grad_oi_esf_cerca         = $fichas->row()->grad_oi_esf_cerca;
  $grad_oi_cil_cerca         = $fichas->row()->grad_oi_cil_cerca;
  $eje_oi_cerca              = $fichas->row()->eje_oi_cerca;
  $nro_pedido_voucher_cerca  = $fichas->row()->nro_pedido_voucher_cerca;
  $tipo_lente_cerca          = $fichas->row()->tipo_lente_cerca;
  $fecha_envio_cerca         = $this->util->fecha($fichas->row()->fecha_envio_cerca);
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
  $titulo       = "Modificar Ficha" ." ".$casa." N° ".$id_ficha;
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
  <div class="col-md-3">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <input type="hidden" name="es_casa_central" value="<? echo $es_casa_central?>">
    <div class="form-group has-feedback">
      <label for="sindicato">Sindicato</label>
      <select class="form-control" name="id_sindicato" id="id_sindicato_cliente">
        <option value="0">Seleccionar --</option>
        <? foreach( $sindicatos as $sindicato )
        {
          if($id_sindicato==$sindicato['id_sindicato'])
            echo "<option value='".$sindicato['id_sindicato']."' selected >".$sindicato['descripcion']."</option>";
          else echo "<option value='".$sindicato['id_sindicato']."'>".$sindicato['descripcion']."</option>";
        }?>
      </select>
      <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un sindicato.</p>
    </div>
  </div>
  <div class="col-md-3">
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
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe seleccionar un delegación.</p>
    </div>
  </div>
  <div class="col-md-3">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <input type="hidden" name="es_casa_central" value="<? echo $es_casa_central?>">
    <div class="form-group has-feedback">
      <label for="optica">Optica</label>
      <select class="form-control" name="id_optica" id="id_optica_cliente">
        <option value="0">Seleccionar --</option>
        <? foreach( $opticas as $optica )
        {
          if($id_optica==$optica['id_optica'])
            echo "<option value='".$optica['id_optica']."' selected >".$optica['descripcion']."</option>";
          else echo "<option value='".$optica['id_optica']."'>".$optica['descripcion']."</option>";
        }?>
      </select>
      <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un optica.</p>
    </div>
  </div>
  <!-- <div class="col-md-3">
    <div class="form-group has-feedback">
      <label for="optica">Optica</label>
      <input type="text" class="form-control" name="optica" id="optica" autocomplete="off"  maxlength="32" value="<? echo $optica?>">
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un optica.</p>
    </div>
  </div> -->
  <div class="col-md-3">
    <div class="form-group has-feedback">
      <label for="fecha">Fecha pedido</label>
      <br>
      <input type="input" name="fecha" style="width: 100%;
                                                  height: 34px;
                                                  padding: 6px 12px;    
                                                  border: 1px solid #ccc;" id='fecha' autocomplete="off"  maxlength="50" value="<? echo $fecha?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un fecha.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <input type="hidden" name="es_casa_central" value="<? echo $es_casa_central?>">
    <div class="form-group has-feedback">
      <label for="types">Tipos de lentes</label>
      <?php
      $display_cerca = "style='display:none;'";
      $display_lejos = "";
      ?>
      <select class="form-control" name="select_tipo" id="select_tipo">
        <option value="1" <?php if ($select_tipo == 1) {
                            echo "selected";
                            $display_cerca = "style='display:none;'";
                          } ?>>Lejos</option>
        <option value="2" <?php if ($select_tipo == 2) {
                            echo "selected";
                            $display_lejos = "style='display:none;'";
                          } ?>>Cerca</option>
        <option value="3" <?php if ($select_tipo == 3) {
                            echo "selected";
                            $display_cerca = "";
                            $display_lejos = "";
                          } ?>>Lejos y cerca</option>
        <option value="4" <?php if ($select_tipo == 4) {
                            echo "selected";
                            $display_cerca = "";
                            $display_lejos = "";
                          } ?>>Fuera de Prestacion</option>
        <?
              // foreach( $tipos_lentes as $row ) 
              // {
              //   if($id_tipo==$row['id']) 
              //     echo "<option value='".$row['id']."' selected >".$row['descripcion']."</option>";
              //   else  
              //     echo "<option value='".$row['id']."'>".$row['descripcion']."</option>";

              // }
            ?>
      </select>
      <span class="glyphicon glyphicon-remove form-control-feedba
          ck hide"></span>
      <!-- <p class="text-center help-block hide">Debe ingresar un sindicato.</p> -->
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group has-feedback">
      <label for="beneficiario">Beneficiario</label>
      <input type="hidden" name="id_cliente" id='id_cliente' value="<? echo $id_cliente?>">
      <input type='text' class="form-control col-sm"  name='filtro_cliente' id='filtro_cliente' value='<? echo $beneficiario?>' placeholder=''>
      <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_cliente' title='cancelar para buscar un nuevo beneficiario' class="hide">
        <span class="glyphicon glyphicon-remove"></span>
      </div>
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un beneficiario.</p>
    </div>
  </div>
  <div class="col-md-3">
    <input type="hidden" name="id_ficha" value="<? echo $id_ficha?>">
    <div class="form-group has-feedback">
      <label for="beneficiario">Titular</label>
      <input type="text" class="form-control" name="beneficiario" id="beneficiario" autocomplete="off"  maxlength="50" value="<? echo $titular?>">
      <!-- <input type="text" class="form-control" name="beneficiario" id="beneficiario" autocomplete="off"  maxlength="32" value="<? echo $beneficiario?>">
        <input type="hidden" name="id_cliente" value="<? echo $id_cliente?>"> -->
      <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
      <p class="text-center help-block hide">Debe ingresar un titular.</p>
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group has-feedback">
      <label for="fecha">Nro Afiliado / DNI</label>
      <input type="text" class="form-control" name="nro_cliente" id="nro_cliente" autocomplete="off"  maxlength="50" value="<? echo $nro_cliente?>">
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

<div class="row div-lejos" <?php echo $display_lejos; ?>>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Datos para lentes de lejos</strong></div>
      <div class="panel-body">

        <div class="row">
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="codigo_armazon">Código armazon</label>
              <input type="hidden" name="id_stock" id='id_stock' value="<? echo $id_stock?>">
              <input type='text' class="form-control col-sm"  name='codigo_armazon' id='codigo_armazon' value="<? echo $codigo_armazon?>" placeholder=''>
              <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_armazon' title='cancelar para buscar un nuevo armazon' class="hide">
                <span class="glyphicon glyphicon-remove"></span>
              </div>
              <!-- <input type="text" class="form-control" name="codigo_armazon" id="codigo_armazon" autocomplete="off"  maxlength="32" value="<? echo $codigo_armazon?>"> -->
              <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
              <p class="text-center help-block hide">Debe ingresar un codigo de armazon.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="color_armazon">Color de armazon</label>
              <input type="text" class="form-control" name="color_armazon" id="color_armazon" autocomplete="off"  maxlength="50" value="<? echo $color_armazon?>">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
              <p class="text-center help-block hide">Debe ingresar un color de armazon.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="nro_pedido_voucher">Número de pedido - Voucher</label>
              <input type="text" class="form-control" name="nro_pedido_voucher" id="nro_pedido_voucher" autocomplete="off"  maxlength="32" value="<? echo $nro_pedido_voucher?>">
              <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
              <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
            </div>
          </div>
        </div>

        <?php
        //si no es casa central
        if ($es_casa_central == 0) {
        ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="eje_od">Eje ojo derecho</label> -->
                <label for="eje_od">Eje O D</label>
                <input type="text" class="form-control" name="eje_od" id="eje_od" autocomplete="off"  maxlength="50" value="<? echo $eje_od?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una eje ojo derecho.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="eje_oi">Eje ojo izquierdo</label> -->
                <label for="eje_oi">Eje O I</label>
                <input type="text" class="form-control" name="eje_oi" id="eje_oi" autocomplete="off"  maxlength="50" value="<? echo $eje_oi?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una eje ojo izquierdo.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_od_esf">Graduación ojo derecho esférico</label> -->
                <label for="grad_od_esf">Grad. O D ESF</label>
                <input type="text" class="form-control" name="grad_od_esf" id="grad_od_esf" autocomplete="off"  maxlength="50" value="<? echo $grad_od_esf?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho esférico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_oi_esf">Graduación ojo izquierdo esférico</label> -->
                <label for="grad_oi_esf">Grad. O I ESF</label>
                <input type="text" class="form-control" name="grad_oi_esf" id="grad_oi_esf" autocomplete="off"  maxlength="50" value="<? echo $grad_oi_esf?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo esférico.</p>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_od_cil">Graduación ojo derecho cilindrico</label> -->
                <label for="grad_od_cil">Grad. O D CIL</label>
                <input type="text" class="form-control" name="grad_od_cil" id="grad_od_cil" autocomplete="off"  maxlength="32" value="<? echo $grad_od_cil?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho cilindrico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_oi_cil">Graduación ojo izquierdo cilindrico</label> -->
                <label for="grad_oi_cil">Grad. O I CIL</label>
                <input type="text" class="form-control" name="grad_oi_cil" id="grad_oi_cil" autocomplete="off"  maxlength="32" value="<? echo $grad_oi_cil?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo cilindrico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="tipo_lente">Tipo lente</label>
                    <select class="form-control" name="tipo_lente" id="tipo_lente">
                      <option value="1" <?php if ($tipo_lente == 1) { echo "selected";} ?>>Stock</option>
                      <option value="2" <?php if ($tipo_lente == 2) { echo "selected";} ?>>Laboratorio</option>
                      <option value="3" <?php if ($tipo_lente == 3) { echo "selected";} ?>>1/2 Stock - 1/2 Laboratorio</option>
                  </select>
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un tipo de lente.</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="nro_pedido">Número de pedido</label>
                <input type="text" class="form-control" name="nro_pedido" id="nro_pedido" autocomplete="off"  maxlength="32" value="<? echo $nro_pedido?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="estado">Estado</label>
                    <select class="form-control" name="estado" id="estado">
                      <option value="1" <?php if ($estado == 1) { echo "selected";} ?>>Laboratorio</option>
                      <option value="2" <?php if ($estado == 2) { echo "selected";} ?>>Enviado</option>
                      <option value="3" <?php if ($estado == 3) { echo "selected";} ?>>Revisión</option>
                  </select>
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un código de estado.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="voucher">Voucher</label>
                <input type="text" class="form-control" name="voucher" id="voucher" autocomplete="off"  maxlength="50" value="<? echo $voucher?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar de voucher.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="fecha_envio">Fecha Envio</label>
                <br>
                <input type="input" name="fecha_envio" <?php if($estado!=2) echo "disabled='true'"?> style="width: 100%;
                                                            height: 34px;
                                                            padding: 6px 12px;    
                                                            border: 1px solid #ccc;" id='fecha_envio' autocomplete="off"  maxlength="50" value="<? echo $fecha_envio?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar un fecha envio.</p>
              </div>
            </div>
          </div>

        <?php
        } // FIN if casa_central
        ?>

      </div>
    </div>
  </div>
</div>

<div class="row div-cerca" <?php echo $display_cerca; ?>>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading"><strong>Datos para lentes de cerca</strong></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="codigo_armazon_cerca">Código armazon</label>
              <input type="hidden" name="id_stock_cerca" id='id_stock_cerca' value="<? echo $id_stock_cerca?>">
              <input type='text' class="form-control col-sm"  name='codigo_armazon_cerca' id='codigo_armazon_cerca' value="<? echo $codigo_armazon_cerca?>" placeholder=''>
              <div class='cancelar-autocomplete hide' id='cancelar_autocomplete_armazon_cerca' title='cancelar para buscar un nuevo armazon' class="hide">
                <span class="glyphicon glyphicon-remove"></span>
              </div>
              <!-- <input type="text" class="form-control" name="codigo_armazon_cerca" id="codigo_armazon_cerca" autocomplete="off"  maxlength="32" value="<? echo $codigo_armazon_cerca?>"> -->
              <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
              <p class="text-center help-block hide">Debe ingresar un codigo de armazon.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="color_armazon_cerca">Color de armazon</label>
              <input type="text" class="form-control" name="color_armazon_cerca" id="color_armazon_cerca" autocomplete="off"  maxlength="50" value="<? echo $color_armazon_cerca?>">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
              <p class="text-center help-block hide">Debe ingresar un color de armazon.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group has-feedback">
              <label for="nro_pedido_voucher_cerca">Número de pedido - Voucher</label>
              <input type="text" class="form-control" name="nro_pedido_voucher_cerca" id="nro_pedido_voucher_cerca" autocomplete="off"  maxlength="32" value="<? echo $nro_pedido_voucher_cerca?>">
              <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
              <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
            </div>
          </div>
        </div>
        <?php
        //si no es casa central
        if ($es_casa_central == 0) {
        ?>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="eje_od">Eje ojo derecho</label> -->
                <label for="eje_od_cerca">Eje O D</label>
                <input type="text" class="form-control" name="eje_od_cerca" id="eje_od_cerca" autocomplete="off"  maxlength="50" value="<? echo $eje_od_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una eje ojo derecho.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="eje_oi">Eje ojo izquierdo</label> -->
                <label for="eje_oi_cerca">Eje O I</label>
                <input type="text" class="form-control" name="eje_oi_cerca" id="eje_oi_cerca" autocomplete="off"  maxlength="50" value="<? echo $eje_oi_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una eje ojo izquierdo.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_od_esf">Graduación ojo derecho esférico</label> -->
                <label for="grad_od_esf_cerca">Grad. O D ESF</label>
                <input type="text" class="form-control" name="grad_od_esf_cerca" id="grad_od_esf_cerca" autocomplete="off"  maxlength="50" value="<? echo $grad_od_esf_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho esférico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_oi_esf">Graduación ojo izquierdo esférico</label> -->
                <label for="grad_oi_esf_cerca">Grad. O I ESF</label>
                <input type="text" class="form-control" name="grad_oi_esf_cerca" id="grad_oi_esf_cerca" autocomplete="off"  maxlength="50" value="<? echo $grad_oi_esf_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo esférico.</p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_od_cil">Graduación ojo derecho cilindrico</label> -->
                <label for="grad_od_cil_cerca">Grad. O D CIL</label>
                <input type="text" class="form-control" name="grad_od_cil_cerca" id="grad_od_cil_cerca" autocomplete="off"  maxlength="32" value="<? echo $grad_od_cil_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho cilindrico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <!-- <label for="grad_oi_cil">Graduación ojo izquierdo cilindrico</label> -->
                <label for="grad_oi_cil_cerca">Grad. O I CIL</label>
                <input type="text" class="form-control" name="grad_oi_cil_cerca" id="grad_oi_cil_cerca" autocomplete="off"  maxlength="32" value="<? echo $grad_oi_cil_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo cilindrico.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="tipo_lente_cerca">Tipo lente</label>
                    <select class="form-control" name="tipo_lente_cerca" id="tipo_lente_cerca">
                      <option value="1" <?php if ($tipo_lente_cerca == 1) { echo "selected";} ?>>Stock</option>
                      <option value="2" <?php if ($tipo_lente_cerca == 2) { echo "selected";} ?>>Laboratorio</option>
                      <option value="3" <?php if ($tipo_lente_cerca == 3) { echo "selected";} ?>>1/2 Stock - 1/2 Laboratorio</option>
                  </select>
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un tipo de lente.</p>
              </div>
            </div>         
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="nro_pedido_cerca">Número de pedido</label>
                <input type="text" class="form-control" name="nro_pedido_cerca" id="nro_pedido_cerca" autocomplete="off"  maxlength="32" value="<? echo $nro_pedido_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un de número pedido.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="id_estado_cerca">Estado</label>
                <select class="form-control" name="id_estado_cerca" id="id_estado_cerca">
                      <option value="1" <?php if ($id_estado_cerca == 1) { echo "selected";} ?>>Laboratorio</option>
                      <option value="2" <?php if ($id_estado_cerca == 2) { echo "selected";} ?>>Enviado</option>
                      <option value="3" <?php if ($id_estado_cerca == 3) { echo "selected";} ?>>Revisión</option>
                  </select>
                <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                <p class="text-center help-block hide">Debe ingresar un codigo de estado.</p>
              </div>
            </div>  
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="voucher_cerca">Voucher</label>
                <input type="text" class="form-control" name="voucher_cerca" id="voucher_cerca" autocomplete="off"  maxlength="50" value="<? echo $voucher_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar de voucher.</p>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group has-feedback">
                <label for="fecha_envio_cerca">Fecha Envio</label>
                <br>
                <input type="input" name="fecha_envio_cerca" <?php if($id_estado_cerca!=2) echo "disabled='true'"?> style="width: 100%;
                                                            height: 34px;
                                                            padding: 6px 12px;    
                                                            border: 1px solid #ccc;" id='fecha_envio_cerca' autocomplete="off"  maxlength="50" value="<? echo $fecha_envio_cerca?>">
                <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                <p class="text-center help-block hide">Debe ingresar un fecha_envio_cerca.</p>
              </div>
            </div>
          </div>
        <?php
        } // FIN if casa_central
        ?>
      </div>
    </div>
  </div>
</div>


<?php
//si no es casa central
if ($es_casa_central == 0) {
?>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="adicional">Adicional</label>
        <input type="text" class="form-control" name="adicional" id="adicional" autocomplete="off"  maxlength="50" value="<? echo $adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un adicional.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="descripcion_adicional">Descripción adicional</label>
        <input type="text" class="form-control" name="descripcion_adicional" id="descripcion_adicional" autocomplete="off"  maxlength="50" value="<? echo $descripcion_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una descripción adicional.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="telefono">Telefono</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789-');" class="form-control" name="telefono" id="telefono" autocomplete="off"  maxlength="32" value="<? echo $telefono?>">
        <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un telefono.</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="costo_adicional">Costo Adicional</label>
        <input type="text" class="form-control" onkeypress="return filtrar_teclas(event,'0123456789.');" name="costo_adicional" id="costo_adicional" autocomplete="off"  maxlength="50" value="<? echo $costo_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un costo adicional.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="seña_adicional">Seña adicional</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789.');" class="form-control" name="sena_adicional" id="sena_adicional" autocomplete="off"  maxlength="50" value="<? echo $seña_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un seña adicional.</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group has-feedback">
        <label for="saldo_adicional">Saldo adicional</label>
        <input type="text" onkeypress="return filtrar_teclas(event,'0123456789.');" class="form-control" name="saldo_adicional" id="saldo_adicional" autocomplete="off"  maxlength="32" value="<? echo $saldo_adicional?>">
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
  <div class="col-md-12">
    <div class="form-group has-feedback">
      <label for="comentario">Comentario</label>
      <textarea rows="2" class="form-control" name="comentario" id="comentario" autocomplete="off"  maxlength="50"><? echo $comentario?></textarea>
      <!-- <input type="text" class="form-control" name="comentario" id="comentario" autocomplete="off"  maxlength="50" value="<? echo $comentario?>"> -->
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