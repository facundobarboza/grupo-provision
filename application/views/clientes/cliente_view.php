<?
// echo $empresa[0]["id_cliente"];
// $this->util->dump_exit($empresas);

if($clientes)
{
    $id_cliente      = $clientes->row()->id_cliente;
    $nombre_cliente  = $clientes->row()->nombre_cliente;
    $apellido_cliente  = $clientes->row()->apellido_cliente;
    $dni_cliente  = $clientes->row()->dni_cliente;
    $numero_cliente  = $clientes->row()->numero_cliente;
    $id_sindicato_cliente  = $clientes->row()->id_sindicato_cliente;
}
 
if(!$id_cliente)
{
  $titulo     = "Nuevo afiliado";
  $id_cliente = 0;
}
else
{
  $titulo = "Modificar afiliado";
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
echo form_open('clientes/guardarCliente', array('id' => 'formulario-cliente', 'role' => 'form')); 
?>
  <div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="nombre_cliente">Nombre</label>
        <input type="text" class="form-control" name="nombre_cliente" id="nombre_cliente" autocomplete="off" autofocus maxlength="32" value="<? echo $nombre_cliente?>">
        <input type="hidden" name="id_cliente" value="<? echo $id_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
        <p class="text-center help-block hide">Debe ingresar un nombre.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="apellido_cliente">Apellido</label>
        <input type="text" class="form-control" name="apellido_cliente" id="apellido_cliente" autocomplete="off" autofocus maxlength="50" value="<? echo $apellido_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un apellido.</p>
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
        <label for="dni_cliente">DNI</label>
        <input type="text" class="form-control" name="dni_cliente" id="dni_cliente" autocomplete="off" autofocus maxlength="14" value="<? echo $dni_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar el DNI.</p>
      </div>
    </div>
     <div class="col-md-4">
      <div class="form-group has-feedback">
        <label for="numero_cliente">Número de afiliado</label>
        <input type="text" class="form-control" name="numero_cliente" id="numero_cliente" autocomplete="off" autofocus maxlength="30" value="<? echo $numero_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe ingresar un número de afiliado.</p>
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
        <label for="id_sindicato_cliente">Sindicato</label>
        <input type="text" class="form-control" name="id_sindicato_cliente" id="id_sindicato_cliente" autocomplete="off" autofocus maxlength="32" value="<? echo $id_sindicato_cliente?>">
        <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        <p class="text-center help-block hide">Debe seleccionar un sindicato.</p>
      </div>
    </div>    
  </div><!-- /.row -->

  <div class="row">
  <div class="col-md-2">
    </div>
    <div class="col-md-8" align="center">
      <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
  </div><!-- /.row -->
<?php echo form_close(); ?>
