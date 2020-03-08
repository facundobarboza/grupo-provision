<div class="row">
  <div class="col-md-12">
  <h4 class="page-header text-uppercase">
      Listado de Sindicatos
    </h4>
  </div>
</div><!-- /.row-fluid -->
<div class="row">
    <div class="col-md-12" align="right" >
      <input type="button" id='nuevo-sindicato' value="Nuevo Sindicato" class="btn btn-primary" title="Agregar un nuevo sindicato "><br>
    </div>
</div><!-- /.row -->
<div class="row">
  <div class="col-md-12" align="center" >
    &nbsp;&nbsp;&nbsp;
  </div>
</div><!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <table id="datatable-sindicatos" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>
          <th>Nombre Sindicato</th>
          <th>Empresa</th>
          <th>Modificar / Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      foreach( $sindicatos as $sindicato ) { ?>
        <tr>
          <td>
            <?php echo $sindicato['descripcion']; ?>
          </td>
          <td>
            <?php echo $sindicato['nombre_empresa']; ?>
          </td>
          <td width="160px">
            <div class="info" data-id="<?php echo $sindicato['id_sindicato'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar-sindicato" title="Modificar sindicato">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
              &nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-default btn-xs btn-eliminar-sindicato" title="Eliminar sindicato">
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
<div class="modal fade" id="modal-sindicato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="cerrar"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div><!-- /.modal-header -->
      <div class="modal-body" >                
        <iframe src="" id="iframe-modificar-sindicato" width="100%" style="border:0;"></iframe>        
      </div><!-- /.modal-body -->
    </div>
  </div>
</div>
<!-- /Modal -->