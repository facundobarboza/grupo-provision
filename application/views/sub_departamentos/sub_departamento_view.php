<?

//si no existe es nuevo
if(!$id_sub_departamento)
{
  $titulo          = "Nuevo Sub-Departamento";
  $id_sub_departamento = 0;
}
else
{
  $titulo = "Modificar Sub-Departamento";
}
?>
<div class="row">
    <div class="col-md-6">
        <h4 class="page-header text-uppercase">
            <?echo $titulo;?>
        </h4>
    </div>
</div><!-- /.row -->
<?php 

echo form_open('sub_departamentos/guardarSubDepartamento', array('id' => 'formulario-sub-departamento', 'role' => 'form')); 
?>

<div class="row">
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="empresa_usuario">Empresa Asociada</label>
            <select class="form-control" name="select_empresa" id="select_empresa">
                <option value="0">Seleccionar --</option>
                <?
          foreach( $empresas as $empresa ) 
          {
            if($id_empresa==$empresa['id_empresa']) 
              echo "<option value='".$empresa['id_empresa']."' selected >".$empresa['nombre_empresa']."</option>";
            else  
              echo "<option value='".$empresa['id_empresa']."'>".$empresa['nombre_empresa']."</option>";

          }
          ?>
            </select>
            <input type="hidden" name="id_sub_departamento" value="<? echo $id_sub_departamento;?>">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe seleccionar una empresa.</p>
        </div>
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="select_departamento">Departamento</label>
            <select class="form-control" name="select_departamento" id="select_departamento">
                <option value="0">Seleccionar --</option>
                <?          
            if($id_sub_departamento!=0)
            {
              foreach( $departamentos as $departamento ) 
              {
                if($id_departamento==$departamento['id_departamento']) 
                  echo "<option value='".$departamento['id_departamento']."' selected >".$departamento['descripcion']."</option>";
                else  
                  echo "<option value='".$departamento['id_departamento']."'>".$departamento['descripcion']."</option>";
              }
            }
          ?>
            </select>
            <input type="hidden" name="id_departamento" value="<? echo $id_departamento;?>">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe seleccionar un departamento.</p>
        </div>
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="nombre_sub_departamento">Nombre</label>
            <input type="text" class="form-control" name="nombre_sub_departamento" id="nombre_sub_departamento"
                autocomplete="off" autofocus maxlength="32" value="<? echo $nombre_sub_departamento;?>">
            <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
            <p class="text-center help-block hide">Debe ingresar un nombre.</p>
        </div>
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-6" align="center">
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
</div><!-- /.row -->
<?php echo form_close(); ?>