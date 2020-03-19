<nav class="navbar navbar-default menu-superior" role="navigation" style="position: relative;">
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
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle"
                    data-toggle="dropdown"><?php echo $this->session->userdata('apellido').', '.$this->session->userdata('nombre') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('usuario/perfil') ?>" class="item-menu">Perfil</a></li>
                    <li><a href="<?php echo site_url('usuario/logout') ?>">Cerrar sesi&oacute;n</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>

<div class="sidenav">
    <ul>
        <li data-toggle="collapse" data-target="#fichas">
            <span class="collapse-item">Gestion de Fichas</span>
            <ul class="nav nav-list collapse" id="fichas">
                <li><a href="<?php echo site_url('archivo/listado') ?>" class="collapse-item item-menu">- Listado Fichas
                    </a></li>
                <li><a href="<?php echo site_url('archivo/nuevo') ?>" class="collapse-item item-menu">- Nueva Ficha</a>
                </li>
            </ul>
        </li>
        <li data-toggle="collapse" data-target="#afiliado">
            <span class="collapse-item">Afiliados</span>
            <ul class="nav nav-list collapse" id="afiliado">
                <li><a href="<?php echo site_url('clientes/listado') ?>" class="collapse-item item-menu">- Listado </a>
                </li>
                <li><a href="<?php echo site_url('clientes/nuevo') ?>" class="collapse-item item-menu">- Nuevo
                        afiliado</a></li>
            </ul>
        </li>
        <li>
            <a href="<?php echo site_url('sindicatos/listado') ?>" class="collapse-item item-menu">Sindicatos </a>
        </li>
        <li>
            <a href="<?php echo site_url('stock/listado') ?>" class="collapse-item item-menu">Stock </a>
        </li>
        <li data-toggle="collapse" data-target="#usuarios">
            <span class="collapse-item">Usuarios</span>
            <ul class="nav nav-list collapse" id="usuarios">
                <li><a href="<?php echo site_url('usuario/listado') ?>" class="collapse-item item-menu">- Listado Usuarios
                    </a></li>
                <li><a href="<?php echo site_url('usuario/nuevo') ?>" class="collapse-item item-menu">- Nuevo Usuario</a>
                </li>
            </ul>
        </li>
    </ul>
</div>