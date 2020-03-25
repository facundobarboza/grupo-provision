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
        <input type="button" id='nueva-stock' value="Agregar a Stock" class="btn btn-primary"
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
        <table id="datatable-stocks" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código patilla</th>
                    <th>Código color</th>
                    <th>Descrición color</th>
                    <th>N° código int.</th>
                    <th>Letra código int.</th>
                    <th>ID tipo armazon</th>
                    <th>ID material</th>
                    <th>ID ubicación</th>
                    <th>Cantidad</th>
                    <th>Costo</th>
                    <th>Precio venta</th>
                    <th>Modificar / Eliminar</th>
                </tr>
            </thead>
         
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