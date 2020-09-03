<?php
//si tenemos stock minimo mostramos el mensaje
if($stock_minimo)
{ 
  ?>
  <div class="alert alert-warning " role="alert">
    <strong>ATENCIÓN STOCK MINIMO</strong>
    <?php 
      foreach( $stock_minimo as $stock ) 
      { 
        echo "<br>Armazon cod innterno: ".$stock['nro_codigo_interno']." - cod color: ".$stock['codigo_color']." <a href='#' class='stock_minimo' id='".$stock['id_stock']."' ><b> ID ".$stock['id_stock']."</b></a>";
      }
    ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <?
}
?>

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
          <th>Optica</th>
          <th>Codigo Armazon</th>
          <th>Color Armazon</th>
          <th>Estado</th>
          <th>Fecha</th>
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