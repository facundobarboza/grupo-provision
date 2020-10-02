<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-uppercase">
            Perfil
        </h4>
    </div>
</div><!-- /.row -->


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <p class="text-info">
            La nueva contrase&ntilde;a debe ser de al menos 8 caracteres de longitud.
        </p>
    </div>
</div><!-- /.row -->

<?php echo form_open('usuario/actualizarPerfil', array('id' => 'formulario-perfil', 'role' => 'form')); ?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="contrasenia_actual">Contrase&ntilde;a actual</label>
            <input type="password" class="form-control" name="contrasenia_actual" id="contrasenia_actual" 
                maxlength="32">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe ingresar su contrase&ntilde;a actual.</p>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="contrasenia_nueva_1">Nueva contrase&ntilde;a</label>
            <input type="password" class="form-control" name="contrasenia_nueva_1" id="contrasenia_nueva_1"
                maxlength="32">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="contrasenia_nueva_2">Repetir nueva contrase&ntilde;a</label>
            <input type="password" class="form-control" name="contrasenia_nueva_2" id="contrasenia_nueva_2"
                maxlength="32">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
        </div>

    </div>
</div>
<div class="row">
    <p class="text-center text-danger" id="msje_contrasenia_nueva"></p>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8" align="center">
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
</div><!-- /.row -->
<?php echo form_close(); ?>