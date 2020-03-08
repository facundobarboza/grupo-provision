<div class="row">
  <div class="col-md-12">
  <h4 class="page-header text-uppercase">
      Listado de afiliados
    </h4>
  </div>
</div><!-- /.row-fluid -->
<div class="row">
  <div class="col-md-12 col-md-offset-0">
    <table id="datatable-empresa" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>DNI</th>
          <th>Número</th>
          <th>Sindicato</th>
          <th>Modificar / Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      foreach( $empresas as $empresa ) { ?>
        <tr>
          <td>
            <?php echo $empresa['nombre_cliente']; ?>
          </td>
          <td>
            <?php echo $empresa['apellido_cliente']; ?>
          </td>
          <td>
            <?php echo $empresa['dni_cliente']; ?>
          </td>
          <td>
            <?php echo $empresa['numero_cliente']; ?>
          </td>
          <td>
            <?php echo $empresa['id_sindicato_cliente']; ?>
          </td>
          <td width="160px">
            <div class="info" data-id="<?php echo $empresa['id_empresa'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar" title="Modificar empresa">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              &nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-default btn-xs btn-eliminar" title="Eliminar empresa">
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
        <h4 class="modal-title" id="myModalLabel">Modificar Empresa</h4>
      </div><!-- /.modal-header -->
      <div class="modal-body" >                
        <iframe src="" id="iframe-modificar-empresa" width="100%" style="border:0;"></iframe>        
      </div><!-- /.modal-body -->
    </div>
  </div>
</div>
<!-- /Modal -->