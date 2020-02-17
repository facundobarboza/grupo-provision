<style type="text/css">
#menu-superior { margin: 0; }
</style>

<nav class="navbar navbar-default " role="navigation" id="menu-superior">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Grupo Provision S.R.L</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clientes<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url('clientes/listado') ?>" class="item-menu">Listado </a></li>
                <li><a href="<?php echo site_url('clientes/nuevo') ?>" class="item-menu">Nuevo Cliente</a></li>
              </ul>
            </li>        
        <li>
          <a href="<?php echo site_url('sindicatos/listado') ?>" class="item-menu">Sindicatos </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestion de Fichas<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('archivo/listado') ?>" class="item-menu">Listado Fichas </a></li>
            <li><a href="<?php echo site_url('archivo/nuevo') ?>" class="item-menu">Nueva Ficha</a></li>
          </ul>
        </li>
        <li>
          <a href="<?php echo site_url('stock/listado') ?>" class="item-menu">Stock </a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('usuario/listado') ?>" class="item-menu">Listado Usuarios </a></li>
            <li><a href="<?php echo site_url('usuario/nuevo') ?>" class="item-menu">Nuevo Usuario</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('apellido').', '.$this->session->userdata('nombre') ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('usuario/perfil') ?>" class="item-menu">Perfil</a></li>
            <li><a href="<?php echo site_url('usuario/logout') ?>">Cerrar sesi&oacute;n</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>