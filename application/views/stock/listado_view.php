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
    <div class="col-md-12" align="right">
        <input type="button" id='nueva-alerta' value="Agregar a Stock" class="btn btn-primary"
            title="Agregar un nuevo stock"><br>
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-md-12" align="center">
        &nbsp;&nbsp;&nbsp;
    </div>
</div><!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <table id="datatable-alertas" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código patilla</th>
                    <th>Código color</th>
                    <th>Descrición color</th>
                    <th>N° código int.</th>
                    <th>Letra código int.</th>
                    <!-- <th>ID tipo armazon</th>
                    <th>ID material</th>
                    <th>ID ubicación</th> -->
                    <th>cantidad</th>
                    <th>Costo</th>
                    <th>Precio venta</th>
                    <th>Modificar / Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach( $alertas as $alerta ) { ?>
                <tr>
                    <td>
                        <?php echo $alerta['id_stock']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['codigo_patilla']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['codigo_color']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['descripcion_color']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['nro_codigo_interno']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['letra_color_interno']; ?>
                    </td>
                    <!-- <td>
                        <?php echo $alerta['id_tipo_armazon']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['id_material']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['id_ubicacion']; ?>
                    </td> -->
                    <td>
                        <?php echo $alerta['cantidad']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['costo']; ?>
                    </td>
                    <td>
                        <?php echo $alerta['precio_venta']; ?>
                    </td>
                    <td width="160px">
                        <div class="info" data-id="<?php echo $alerta['id_alerta'] ?>"></div>
                        <div class="text-center">
                            <button type="button" class="btn btn-default btn-xs btn-modificar-alerta"
                                title="Modificar alerta">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-default btn-xs btn-eliminar-alerta"
                                title="Eliminar alerta">
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
<div class="modal fade" id="modal-alerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" title="cerrar"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

            </div><!-- /.modal-header -->
            <div class="modal-body">
                <iframe src="" id="iframe-modificar-alerta" width="100%" style="border:0;"></iframe>
            </div><!-- /.modal-body -->
        </div>
    </div>
</div>
<!-- /Modal -->