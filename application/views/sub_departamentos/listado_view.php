<div class="row">
  <div class="col-md-12">
    <h3 class="page-header">
      Listado de Sub-Departamentos
    </h3>
  </div>
</div><!-- /.row-fluid -->
<div class="row">
    <div class="col-md-12" align="right" >
      <input type="button" id='nuevo-sub-departamento' value="Nuevo Sub-Departamento" class="btn btn-primary" title="Agregar un nuevo sub-departamento "><br>
    </div>
</div><!-- /.row -->
<div class="row">
  <div class="col-md-12" align="center" >
    &nbsp;&nbsp;&nbsp;
  </div>
</div><!-- /.row -->
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <table id="datatable-sub-departamentos" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>      
          <th>Empresa</th>
          <th>Departamento</th>
          <th>Sub-Departamento</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      
      foreach( $sub_departamentos as $departamento ) { ?>
        <tr>
          <td>
            <?php echo $departamento['nombre_empresa']; ?>
          </td>
          <td>
            <?php echo $departamento['departamento']; ?>
          </td>
          <td>
            <?php echo $departamento['descripcion']; ?>            
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $departamento['id_sub_departamento'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar-sub-departamento" title="Modificar departamento">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            </div>
          </td>
          <td width="60px">
            <div class="text-center">
              &nbsp;&nbsp;&nbsp;
              <button type="button" class="btn btn-default btn-xs btn-eliminar-sub-departamento" title="Eliminar departamento">
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
<div class="modal fade" id="modal-sub-departamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" title="cerrar"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>        
      </div><!-- /.modal-header -->
      <div class="modal-body" >                
        <iframe src="" id="iframe-modificar-sub-departamento" width="100%" style="border:0;"></iframe>        
      </div><!-- /.modal-body -->
    </div>
  </div>
</div>
<!-- /Modal -->