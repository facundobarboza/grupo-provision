<?php
echo form_open('clientes/listado', array('id' => 'formulario-listado-afiliado', 'role' => 'form'));

?>

  <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <!-- panel -->
        <div class="panel panel-default" >

        <div class="panel-heading">Busqueda avanzada</div>
        <div class="panel-body">
          <div class="row">
          <div class="col-md-3">
            
          </div>          
            <div class="col-md-4">
                <label for="apellido_cliente">Afiliado / Nro Beneficiario</label>
                <input type="text" class="form-control" name="filtro_afiliado" id="filtro_afiliado" maxlength="50" 
                value="<? echo $filtro_afiliado;?>" >
              <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
              <p class="text-center help-block hide">Debe ingresar un valor a buscar.</p>
            </div>
            <div class="col-md-2"><br>
              <button type="submit" class="btn btn-success" id='btn-buscar'>
                <span class="glyphicon glyphicon-search"></span>
                Buscar
              </button>
              <!-- <input type="submit" class="btn btn-success" id='btn-buscar' value="Buscar">             -->
            </div>
          </div>
         
        </div>
         </div>
        </div>
        <!-- /.panel-->
  </div>
  <?php echo form_close(); ?>
<?php

if($es_busqueda==1)
{
?>


  <div class="row">
    <div class="col-md-12">
    <h4 class="page-header text-uppercase">
        Listado de afiliados
      </h4>
    </div>
  </div><!-- /.row-fluid -->
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <table name="datatable" id="datatable-cliente" class="table table-striped table-bordered table-hover" width="100%">
        <thead>
          <tr>
            <th>Titular</th>
            <th>Beneficiario</th>
            <th>DNI</th>
            <th>Número</th>
            <th>Sindicato</th>
            <th>Modificar / Eliminar</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        foreach( $clientes as $cliente ) { ?>
          <tr>
            <td>
              <?php echo $cliente['titular_cliente']; ?>
            </td>
            <td>
              <?php echo $cliente['beneficiario_cliente']; ?>
            </td>
            <td>
              <?php echo $cliente['dni_cliente']; ?>
            </td>
            <td>
              <?php echo $cliente['numero_cliente']; ?>
            </td>
            <td>
              <?php echo $cliente['sindicato']; ?>
            </td>
            <td width="160px">
              <div class="info" data-id="<?php echo $cliente['id_cliente'] ?>"></div>
              <div class="text-center">
                <button type="button" class="btn btn-default btn-xs btn-modificar" title="Modificar cliente">
                  <span class="glyphicon glyphicon-pencil"></span>
                </button>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-default btn-xs btn-eliminar" title="Eliminar cliente">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>
              </div>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div><!-- /.row-fluid -->


  <!-- Modal -->
  <div class="modal fade" id="modal-modificar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-800">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" title="cerrar"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Modificar Afiliado</h4>
        </div><!-- /.modal-header -->
        <div class="modal-body" >                
          <iframe src="" id="iframe-modificar-cliente" width="100%" style="border:0;"></iframe>        
        </div><!-- /.modal-body -->
      </div>
    </div>
  </div>
  <!-- /Modal -->
  <?php
}
?>

