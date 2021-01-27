<?php

echo form_open('archivo/listado', array('id' => 'formulario-listado', 'role' => 'form'));
?>
<div class="row">
  <div class="col-md-12">
    <h4 class="page-header text-uppercase">Listado Fichas</h4>
  </div>
</div>
<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
      <!-- panel -->
      <div class="panel panel-default" >

      <div class="panel-heading">Busqueda avanzada</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-3">
              <div class="form-group has-feedback">
                  <label>Fecha desde</label>
              <input type="input" name="fecha_desde" style="
                                                        height: 34px;
                                                        padding: 6px 12px;    
                                                        border: 1px solid #ccc;" id='fecha_desde' autocomplete="off" maxlength="50" value="<? echo $fecha_desde?>">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
              </div>
          </div>
          <div class="col-md-3">
              <label >Fecha hasta</label>
              <input type="input" name="fecha_hasta" style="
                                                        height: 34px;
                                                        padding: 6px 12px;    
                                                        border: 1px solid #ccc;" id='fecha_hasta' autocomplete="off" maxlength="50" value="<? echo $fecha_hasta?>">
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
          </div>
          <div class="col-md-2">
              <label for="apellido_cliente">Estado</label>
                <select class="form-control" name="estado" id="estado">
                      <option value="-1">Todos --</option>
                      <option value="1" <?php if ($estado == 1) { echo "selected";} ?>>Laboratorio</option>
                      <option value="2" <?php if ($estado == 2) { echo "selected";} ?>>Enviado</option>
                      <option value="3" <?php if ($estado == 3) { echo "selected";} ?>>Revisión</option>
                  </select>
              <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
          </div>
          
          <div class="col-md-2"><br>
            <input type="submit" class="btn btn-success" id='btn-buscar' value="Buscar">
          </div>
        </div>
       </div>
      </div>
      <!-- /.panel-->
</div>
   
</div>
<?php echo form_close(); ?>
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
          <th>Sindicato</th>
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
            <?php echo $ficha['sindicato']; ?>
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