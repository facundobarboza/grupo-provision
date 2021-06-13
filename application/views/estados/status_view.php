<?
?>
<div class="row">
    <div class="col-md-12" align="center">
        <h4 class="page-header text-uppercase">
            Cambio de Estados
        </h4>
    </div>
</div><!-- /.row -->
<?php 
    echo form_open('status/saveStatus', array('id' => 'status-form', 'role' => 'form')); 
?>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-1" align="right">
        <label for="nombre_delegacion">Nro de Pedido:</label>
    </div>
    <div class="col-md-2" align="left">
        <div class="form-group has-feedback">
            <input type="text" class="form-control" name="txt-search" id="id-txt-search" autofocus autocomplete="off" maxlength="32" value="">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe ingresar un nro de pedido.</p>
        </div>
    </div>
    <div class="col-md-4">
        <input type="submit" value="Buscar" id='search' class="btn btn-success">
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8" align="left">
        <div class="panel panel-default" >
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-2" align="center">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                          <label for="status-date">Fecha</label>
                          <br>
                          <input type="input" name="status-date" style="width: 100%;
                                                                        height: 34px;
                                                                        padding: 6px 12px;    
                                                                        border: 1px solid #ccc;" id='status-date' autocomplete="off" maxlength="50" value="<? echo $status-date?>">
                          <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
                          <p class="text-center help-block hide">Debe ingresar un fecha.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label for="id_estado_cerca">Estado</label>
                            <select class="form-control" name="id_estado_cerca" id="id_estado_cerca">
                                <option value="1" >Laboratorio</option>
                                <option value="2" >Enviado</option>
                                <option value="3" >Revisión</option>
                            </select>
                            <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                            <p class="text-center help-block hide">Debe ingresar un codigo de estado.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback">
                            <label for="optica">Óptica</label>
                            <select class="form-control" name="id_optica" id="id_optica_cliente">
                                <option value="0">Seleccionar --</option>
                                <?  
                                    foreach( $opticas as $optica )
                                    {
                                        if($id_optica==$optica['id_optica'])
                                            echo "<option value='".$optica['id_optica']."' selected >".$optica['descripcion']."</option>";
                                        else 
                                            echo "<option value='".$optica['id_optica']."'>".$optica['descripcion']."</option>";
                                    }
                                ?>
                            </select>
                            <span class="glyphicon glyphicon-remove form-control-feedba ck hide"></span>
                            <p class="text-center help-block hide">Debe ingresar un optica.</p>
                        </div>
                    </div>
                    <div class="col-md-2" align="center">

                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-12" align="center">
                        <input type="submit" value="Guardar" id='guardar-delegacion' class="btn btn-primary">
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
    <div class="col-md-2">        
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-1">
    </div>
    <div class="col-md-10">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" > Fecha Pedido </th>
                    <th scope="col" > Fecha Pedido </th>
                    <th scope="col" > Beneficiario </th>
                    <th scope="col" > Nro Afiliado / DNI </th>
                    <th scope="col" > Tipo de Lente </th>
                    <th scope="col" > Nro Pedido </th>
                    <th scope="col" > Sindicato </th>
                    <th scope="col" > Estado </th>
                    <th scope="col" > Fecha Envio </th>
                    <th scope="col" > Delegación </th>
                    <th scope="col" > Optica </th>
                    <th scope="col" > Código Armazon </th>
                    <th scope="col" > Tipo Lente </th>
                    <th scope="col" > Tipo </th>
                    <th scope="col" > Voucher </th>
                    <th scope="col" > Elim </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mark</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-1">
    </div>
</div><!-- /.row -->
<?php echo form_close(); ?>
