<div class="row">
  <div class="col-md-12">
    <h4 class="page-header text-uppercase">Listado Fichas</h4>
  </div>
</div>

<div class="row">
  <div class="col-md-12 ">
    <table id="datatable-ficha" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
        <tr>  
          <th>#</th>
          <th>ID</th>
          <th>Beneficiario</th>
          <th>Nro Afiliado / DNI</th>
          <th>Nro Pedido</th>
          <th>Estado</th>
          <th>Fecha</th>
          <th>Delegación</th>
          <th>Optica</th>
          <th>Codigo Armazon</th>
          <th>Color Armazon</th>
          <th>Tipo</th>
          <th>Mod/Elim</th>
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
            <?php echo $ficha['nro_cliente']; ?>
          </td>
          <td>
            <?php echo $ficha['nro_pedido']; ?>
          </td>
          <td>
            <?php 
            switch ($ficha['estado']) {
              case '1':
                $estado = "Laboratorio";
                break;
              case '2':
                $estado = "Enviado";
                break;
              case '3':
                $estado = "Revisión";
                break;
              default:
                $estado = "Laboratorio";
                break;
            }
            echo $estado; ?>
          </td>
          <td>
            <?php echo Util::fecha($ficha['fecha']); ?>
          </td>
          <td>
            <?php echo $ficha['delegacion']; ?>
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
            <?php
            if($ficha['es_casa_central']==1)
              echo "Casa Central";
            else
              echo "Optica";
            ?>
          </td>
          <td width="60px">
            <div class="info" data-id="<?php echo $ficha['id_ficha'] ?>"></div>
            <div class="text-center">
              <button type="button" class="btn btn-default btn-xs btn-modificar-ficha" title="Modificar Archivo">
                <span class="glyphicon glyphicon-pencil"></span>
              </button>
            </div>
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
</div>