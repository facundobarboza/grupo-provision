<div class="panel panel-default" >
   <div class="panel-body">
  <div class="row">
  <div class="col-md-12">
    <h4 class="page-header text-uppercase">
      Listado Fichas
    </h4>
  </div>
</div><!-- /.row-fluid -->
<div class="row">
  <div class="col-md-2" align="left" >  
    <button class="btn btn-danger" id='eliminar-masivo' > Eiminar Seleccionados</button>
  </div>
  <div class="col-md-10" align="right" >    
    <button class="btn btn-success" rol='link' onclick="window.location='<?php echo site_url('archivo/listado_excel') ?>'">
      Descargar Excel</button><br>&nbsp;&nbsp;&nbsp;
      
  </div>
</div><!-- /.row -->
<div class="row">
  <div class="col-md-12 ">
    <table id="datatable-ficha" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>  
          <th>#</th>
          <th>ID</th>
          <th>Beneficiario</th>
          <th>Optica</th>
          <th>Codigo Armazon</th>
          <th>Color Armazon</th>
          <th>Estado</th>
          <th>Fecha</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody> 
      <?php 
      foreach( $fichas as $ficha ) { ?>
        <tr>
          <td align="center">
            <div class="info" data-id="<?php echo $ficha['id_ficha'] ?>"></div>
            <input type="checkbox" class="cb-eliminar">
          </td>
          <td>
            <?php echo $ficha['id_ficha']; ?>
          </td>
          <td>
            <?php echo $ficha['beneficiario']; ?>
          </td>
          <td>
            <?php echo $ficha['optica']; ?>
          </td>
          <td>
            <?php echo $ficha['codigo_armazon']; ?>
          </td>
          <td>
            <?php echo$ficha['color_armazon']; ?>
          </td>
          <td>
            <?php echo $ficha['estado']; ?>
          </td>
          <td>
            <?php echo Util::fecha($ficha['fecha']); ?>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $ficha['id_ficha'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar-ficha" title="Modificar Archivo">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            </div>
          </td>
          <td width="60px">
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-eliminar-ficha" title="Eliminar ficha">
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
</div>
</div>

