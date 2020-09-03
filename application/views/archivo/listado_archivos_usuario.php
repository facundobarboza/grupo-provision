<?
//listamos las alertas para este usuario
foreach( $alertas as $alerta ) 
{
  ?>
  <div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>ALERTA</strong> - <b> <?=$alerta['mensaje']?></b>
  </div>
  <?
}

?>
<div class="row">
  <div class="col-md-12">
    <h4 class="page-header text-uppercase">
      Listado de Archivos Subidos
    </h4>
  </div>
</div><!-- /.row-fluid -->
<div class="row">
</div><!-- /.row -->
<div class="row">
  <div class="col-md-12 ">
    <table id="datatable-archivo-usuario" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>  
          <th>Empresa</th>
          <th>Departamento</th>
          <th>Sub Departamento</th>
          <th>Nombre archivo</th>
          <th>Vigencia</th>
          <th>Observacion</th>
          <th>Ver</th>        
        </tr>
      </thead>
      <tbody> 
      <?php 
      foreach( $archivos as $archivo ) { ?>
        <tr>
          
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
        </tr>
      <?php } ?>   
      </tbody>
    </table>
  </div>
</div><!-- /.row-fluid -->

