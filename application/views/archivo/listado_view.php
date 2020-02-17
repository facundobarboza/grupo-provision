<div class="row">
  <div class="col-md-12">
    <h3 class="page-header">
      Listado de Archivos Subidos
    </h3>
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
    <table id="datatable-archivo" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>  
          <th>#</th>
          <th>Empresa</th>
          <th>Departamento</th>
          <th>Sub Departamento</th>
          <th>Nombre archivo</th>
          <th>Vigencia</th>
          <th>Observacion</th>
          <th>Ver</th>
          <th>Modificar</th>
          <th>Eliminar</th>
        </tr>
      </thead>
      <tbody> 
      <?php 
      foreach( $archivos as $archivo ) { ?>
        <tr>
          <td align="center">
            <div class="info" data-id="<?php echo $archivo['id_archivo'] ?>"></div>
            <input type="checkbox" class="cb-eliminar">
          </td>
          <td>
            <?php echo $archivo['nombre_empresa']; ?>
          </td>
          <td>
            <?php echo $archivo['departamento']; ?>
          </td>
          <td>
            <?php echo $archivo['sub_departamento']; ?>
          </td>
          <td>
            <?php echo $archivo['nombre_archivo']; ?>
          </td>
          <td>
            <?php echo Util::fecha($archivo['fecha_vigencia']); ?>
          </td>
          <td>
            <?php echo $archivo['observacion']; ?>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $archivo['id_archivo'] ?>"></div>
            <div class="text-center">
              <?
               $ruta = "../uploads/".$archivo['id_empresa']."/".$archivo['id_departamento']."/".$archivo['id_sub_departamento']."/".$archivo['nombre_archivo'];
              ?>
              <button type="button" class="btn btn-default btn-xs btn-mostrar-archivo" title="Mostrar Archivo">
                 <a href="<?echo $ruta?>" 
                  onclick="window.open(this.href, this.target); return false;">
                <span class="glyphicon glyphicon-eye-open"></span>
              </a>
              </button>              
            </div>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $archivo['id_archivo'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar-archivo" title="Modificar Archivo">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            </div>
          </td>
          <td width="60px">
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-eliminar-archivo" title="Eliminar archivo">
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

