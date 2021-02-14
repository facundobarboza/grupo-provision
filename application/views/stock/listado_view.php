<?
 
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-uppercase">
            Listado de Stock
        </h4>
    </div>
</div><!-- /.row-fluid -->
<div class="row">
    <div class="col-md-12"  align="right">
        <button class="btn btn-primary" rol='link' id='descargar' title="Descarga excel filtrando por busqueda avanzada">
          <span class="glyphicon glyphicon-download-alt"></span>
          Descargar Excel
        </button>
      <br>
      <br>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <table id="datatable-stocks" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código patilla</th>
                    <th>N° código int.</th>
                    <th>Tipo armazon</th>
                    <th>Material</th>
                    <th>Letra Color</th>
                    <th>Código Color</th>
                    <th>Ubicación</th>
                    <th>Cantidad</th>
                    <th>Modificar / Eliminar</th>
                </tr>
            </thead>
            <?php 
            foreach( $stocks as $stock ) { ?>
                <tr>
                  
                  <td>
                    <?php echo $stock['id_stock']; ?>
                  </td>
                  <td>
                    <?php echo $stock['codigo_patilla']; ?>
                  </td>
                  <td>
                    <?php echo $stock['nro_codigo_interno']; ?>
                  </td>
                  <td>
                    <?php echo $stock['tipo_armazon']; ?>
                  </td>
                  <td>
                    <?php echo$stock['material']; ?>
                  </td>
                  <td>
                    <?php echo$stock['letra_color_interno']; ?>
                  </td>
                   <td>
                    <?php echo$stock['codigo_color']; ?>
                  </td>
                  <td>
                    <?php echo $stock['ubicacion']; ?>
                  </td>
                  <td>
                    <?php echo $stock['cantidad']; ?>
                  </td>
                  <td width="60px">
                    <div class="info" data-id="<?php echo $stock['id_stock'] ?>"></div>
                    <div class="text-center">
                      <button type="button" class="btn btn-default btn-xs btn-modificar-stock" title="Modificar Stock">
                        <span class="glyphicon glyphicon-pencil"></span>
                      </button>
                    
                      <button type="button" class="btn btn-default btn-xs btn-eliminar-stock" title="Eliminar stock">
                        <span class="glyphicon glyphicon-remove"></span>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php } ?> 
         
        </table>
    </div>
</div><!-- /.row-fluid -->

<!-- Modal -->
<div class="modal fade" id="modal-stock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" title="cerrar"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

            </div><!-- /.modal-header -->
            <div class="modal-body">
                <iframe src="" id="iframe-modificar-stock" width="100%" style="border:0;"></iframe>
            </div><!-- /.modal-body -->
        </div>
    </div>
</div>
<!-- /Modal -->