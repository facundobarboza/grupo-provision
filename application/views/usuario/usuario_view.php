<?
// echo $empresa[0]["id_empresa"];
// $this->util->dump_exit($usuarios);

if($usuarios)
{
    $id_usuario = $usuarios->row()->id_usuario;
    $apellido   = $usuarios->row()->apellido;
    $nombre     = $usuarios->row()->nombre;
    $mail       = $usuarios->row()->mail;
    $id_rol     = $usuarios->row()->id_rol;
    $user_name  = $usuarios->row()->user_name;

    $titulo = "Modificar Usuario";
}
else
{
  $id_usuario = 0;
  $titulo     = "Nuevo Usuario";
}

?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header text-uppercase">
            <?echo $titulo;?>
        </h4>
    </div>
</div><!-- /.row -->
<?php 

echo form_open('usuario/guardarUsuario', array('id' => 'formulario-usuario', 'role' => 'form')); 
?>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="nombre_usuario">Nombre</label>
            <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" autocomplete="off"
                autofocus maxlength="32" value="<? echo $nombre?>">
            <span class="glyphicon glyphicon-remove form-control-feedba
        ck hide"></span>
            <input type="hidden" name="id_usuario" id='id_usuario' value="<? echo $id_usuario?>">
            <p class="text-center help-block hide">Debe ingresar un nombre.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="apellido_usuario">Apellido</label>
            <input type="text" class="form-control" name="apellido_usuario" id="apellido_usuario" autocomplete="off"
                autofocus maxlength="50" value="<? echo $apellido?>">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe ingresar un apellido.</p>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="rol_usuario">Rol</label>
            <select class="form-control" name="select_rol_usuario" id="select_rol_usuario">
                <option value="0">Seleccionar --</option>
                <?
          //si es super admin
          if($this->session->userdata('id_rol')==1)
          {
          ?>
                <option value="1" <?if($id_rol==1) echo "selected" ;?>>Administrador Total</option>
                <?
          }
          ?>
                <option value="2" <?if($id_rol==2) echo "selected" ;?>>Administrador Empresa</option>
                <option value="3" <?if($id_rol==3) echo "selected" ;?>>Usuario</option>
            </select>
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe seleccionar un rol.</p>
        </div>
    </div>
    
</div><!-- /.row -->


<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="user_name">Usuario</label>
            <input type="text" class="form-control" name="user_name" id="user_name" autocomplete="off" autofocus
                maxlength="15" value="<? echo $user_name?>">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe ingresar un usuario.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="contrasenia_usuario" class="control-label">Contrase&ntilde;a</label>
            <input type="password" name="contrasenia_usuario" id="contrasenia_usuario" maxlength="32"
                class="form-control">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="help-block text-center hide">Debe ingresar su Contrase&ntilde;a.</p>
        </div>
    </div>
    <div class="col-md-2">
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-4">
        <div class="form-group has-feedback">
            <label for="mail_usuario">Mail</label>
            <input type="text" class="form-control" name="mail_usuario" id="mail_usuario" autocomplete="off" autofocus
                maxlength="30" value="<? echo $mail?>">
            <span class="glyphicon glyphicon-remove form-control-feedback hide"></span>
            <p class="text-center help-block hide">Debe ingresar un mail.</p>
        </div>
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-2">
    </div>
</div><!-- /.row -->

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8" align="center">
        <input type="submit" value="Guardar" class="btn btn-primary">
    </div>
</div><!-- /.row -->

<?php echo form_close(); ?>