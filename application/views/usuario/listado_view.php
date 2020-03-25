<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-uppercase">
            Listado de Usuarios
        </h4>
    </div>
</div><!-- /.row-fluid -->
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <table id="datatable-usuarios" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>Id </th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Mail</th>
                    <th>Usuario</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
      foreach( $usuarios as $usuario ) { ?>
                <tr>
                    <td>
                        <?php echo $usuario['id_usuario']; ?>
                    </td>
                    <td>
                        <?php echo $usuario['nombre']; ?>
                    </td>
                    <td>
                        <?php echo $usuario['apellido']; ?>
                    </td>
                    <td>
                        <?php echo $usuario['mail']; ?>
                    </td>
                    <td>
                        <?php echo $usuario['user_name']; ?>
                    </td>

                    <td width="160px">
                        <div class="info" data-id="<?php echo $usuario['id_usuario'] ?>"></div>
                        <div class="text-center">
                            <button type="button" class="btn btn-default btn-xs btn-modificar-usuario"
                                title="Modificar usuario">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-default btn-xs btn-eliminar-usuario"
                                title="Eliminar usuario">
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