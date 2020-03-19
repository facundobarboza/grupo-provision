<?
/*
<td id="ma">
  <a href="../../uploads/personal/<?=$archivos_varios->fields["url_archivo"]?>" onclick="window.open(this.href, this.target, 'width=800,height=600'); return false;"><img src='<?=$html_root?>/imagenes/page_find.gif' /></a>
</td>
*/

if($archivos)
{
  $id_ficha                 = $archivos->row()->id_ficha;
  $beneficiario             = $archivos->row()->beneficiario;
  $id_cliente               = $archivos->row()->id_cliente;
  $delegacion               = $archivos->row()->delegacion;
  $optica                   = $archivos->row()->optica;
  $fecha                    = $this->util->fecha($archivos->row()->fecha);
  $codigo_armazon           = $archivos->row()->codigo_armazon;
  $color_armazon            = $archivos->row()->color_armazon;
  $id_stock                 = $archivos->row()->id_stock;
  $estado                   = $archivos->row()->estado;
  $voucher                  = $archivos->row()->voucher;
  $nro_pedido               = $archivos->row()->nro_pedido;
  $grad_od_esf              = $archivos->row()->grad_od_esf;
  $grad_od_cil              = $archivos->row()->grad_od_cil;
  $eje_od                   = $archivos->row()->eje_od;
  $grad_oi_esf              = $archivos->row()->grad_oi_esf;
  $grad_oi_cil              = $archivos->row()->grad_oi_cil;
  $eje_oi                   = $archivos->row()->eje_oi;
  $comentario               = $archivos->row()->comentario;
  $es_lejos                 = $archivos->row()->es_lejos;
  $adicional                = $archivos->row()->adicional;
  $descripcion_adicional    = $archivos->row()->descripcion_adicional;
  $telefono                 = $archivos->row()->telefono;
  $costo_adicional          = $archivos->row()->costo_adicional;
  $seña_adicional           = $archivos->row()->seña_adicional;
  $saldo_adicional          = $archivos->row()->saldo_adicional;
}
else
{
  if( $this->input->cookie('id_departamento',true))
  {
    $id_departamento     = $this->input->cookie('id_departamento',true);
    $id_sub_departamento = $this->input->cookie('id_sub_departamento',true);
  }
}

//si no existe es nuevo
$this->load->helper('cookie');

// if($archivos)
// {
//    $this->util->dump_exit($archivos);
// }
if(!$id_archivo)
{
  $titulo = "Ficha";
  $id_sub_departamento = 0;
}
else
{
  $titulo = "Modificar Ficha";
}
?>
  <div class="row">
    <div class="col-md-12">
      <h4 class="page-header text-uppercase">
        <?echo $titulo;?>
</h4>
    </div>
  </div><!-- /.row -->
<?php 

echo form_open_multipart('archivo/guardarArchivo', array('id' => 'formulario-archivo')); 
?>

  <div class="row">
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="beneficiario">Beneficiario</label>
        <input type="text" class="form-control" name="beneficiario" id="beneficiario" autocomplete="off" autofocus maxlength="32" value="<? echo $beneficiario?>">
        <input type="hidden" name="id_cliente" value="<? echo $id_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un beneficiario.</p>
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
        <label for="optica">Optica</label>
        <input type="text" class="form-control" name="optica" id="optica" autocomplete="off" autofocus maxlength="32" value="<? echo $optica?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un optica.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="fecha">Fecha</label>
        <input type="text" class="form-control" name="fecha" id="fecha" autocomplete="off" autofocus maxlength="50" value="<? echo $fecha?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un fecha.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="codigo_armazon">Armazón</label>
        <input type="text" class="form-control" name="codigo_armazon" id="codigo_armazon" autocomplete="off" autofocus maxlength="32" value="<? echo $codigo_armazon?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un codigo de armazon.</p>
      </div>
    </div>
    <div class="col-md-4">
    <div class="form-group has-feedback">
      <label for="color_armazon">Color de armazón</label>
      <input type="text" class="form-control" name="color_armazon" id="color_armazon" autocomplete="off" autofocus maxlength="50" value="<? echo $color_armazon?>">
      <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
      <p class="text-center help-block hide">Debe ingresar un color de armazón.</p>
    </div>
  </div>
  </div><!-- /.row -->

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
        <p class="text-center help-block hide">Debe ingresar un color de voucher.</p>
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
  </div><!-- /.row -->

  <div class="row">
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="grad_od_esf">Graduación ojo derecho esférico</label>
        <input type="text" class="form-control" name="grad_od_esf" id="grad_od_esf" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_od_esf?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="grad_od_cil">Graduación ojo derecho cilindrico</label>
        <input type="text" class="form-control" name="grad_od_cil" id="grad_od_cil" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_od_cil?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo derecho cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="eje_od">Eje ojo derecho</label>
        <input type="text" class="form-control" name="eje_od" id="eje_od" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_od?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo derecho.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="grad_oi_esf">Graduación ojo izquierdo esférico</label>
        <input type="text" class="form-control" name="grad_oi_esf" id="grad_oi_esf" autocomplete="off" autofocus maxlength="50" value="<? echo $grad_oi_esf?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo esférico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="grad_oi_cil">Graduación ojo izquierdo cilindrico</label>
        <input type="text" class="form-control" name="grad_oi_cil" id="grad_oi_cil" autocomplete="off" autofocus maxlength="32" value="<? echo $grad_oi_cil?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar una graduación ojo izquierdo cilindrico.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="eje_oi">Eje ojo izquierdo</label>
        <input type="text" class="form-control" name="eje_oi" id="eje_oi" autocomplete="off" autofocus maxlength="50" value="<? echo $eje_oi?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar una eje ojo izquierdo.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="comentario">Comentario</label>
        <input type="text" class="form-control" name="comentario" id="comentario" autocomplete="off" autofocus maxlength="50" value="<? echo $comentario?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un comentario.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="es_lejos">Lejos</label>
        <input type="text" class="form-control" name="es_lejos" id="es_lejos" autocomplete="off" autofocus maxlength="32" value="<? echo $es_lejos?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar lejos.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="adicional">Adicional</label>
        <input type="text" class="form-control" name="adicional" id="adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un adicional.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
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
        <input type="text" class="form-control" name="telefono" id="telefono" autocomplete="off" autofocus maxlength="32" value="<? echo $telefono?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un telefono.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="costo_adicional">Adicional</label>
        <input type="text" class="form-control" name="costo_adicional" id="costo_adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $costo_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un costo adicional.</p>
      </div>
    </div>
  </div><!-- /.row -->

  <div class="row">
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="seña_adicional">Seña adicional</label>
        <input type="text" class="form-control" name="seña_adicional" id="seña_adicional" autocomplete="off" autofocus maxlength="50" value="<? echo $seña_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un seña adicional.</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="saldo_adicional">Saldo adicional</label>
        <input type="text" class="form-control" name="saldo_adicional" id="saldo_adicional" autocomplete="off" autofocus maxlength="32" value="<? echo $saldo_adicional?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un saldo adicional.</p>
      </div>
    </div>
  </div><!-- /.row -->
 
  <div class="row">
    <div class="col-md-12" align="center" >
      <input type="submit" id='id-guardar' value="Guardar" class="btn btn-primary">      
      <span id='id-cargando' class="glyphicon glyphicon-refresh hide"><b><p id='text-cargando'class="text-center help-block hide">Cargando, por favor esperar..</p></b></span>
    </div>
  </div><!-- /.row -->
  <br>
  <br>
  <br>
  <br>
<?php echo form_close(); ?>
