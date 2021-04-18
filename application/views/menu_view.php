<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        font-size: 14px;
        line-height: 1.8;
        font-weight: normal;
        background: #fff;
        color: #808080;
    }

    a {
        transition: 0.3s all ease;
        color: #2f89fc;
    }

    a:hover,
    a:focus {
        text-decoration: none !important;
        outline: none !important;
        box-shadow: none;
    }

    button {
        transition: 0.3s all ease;
    }

    button:hover,
    button:focus {
        text-decoration: none !important;
        outline: none !important;
        box-shadow: none !important;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    .h1,
    .h2,
    .h3,
    .h4,
    .h5 {
        line-height: 1.5;
        font-weight: 400;
        font-family: 'Poppins', Arial, sans-serif;
        color: #000;
    }

    a[data-toggle="collapse"] {
        position: relative;
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
    }

    .btn.btn-primary {
        background: #2f89fc;
        border-color: #2f89fc;
    }

    .btn.btn-primary:hover,
    .btn.btn-primary:focus {
        background: #2f89fc !important;
        border-color: #2f89fc !important;
    }

    .form-control {
        height: 40px !important;
        background: #fff;
        color: #000;
        font-size: 13px;
        border-radius: 4px;
        box-shadow: none !important;
        border: transparent;
    }

    .navbar.navbar-default {
        background-color: #32373d;
        color: rgba(255, 255, 255, 0.6);
        border: none;
        border-radius: 0px;
    }

    .navbar.navbar-default .navbar-brand,
    .navbar-default .navbar-nav>li>a {
        color: rgba(255, 255, 255, 0.6);
    }

    .navbar-default .navbar-nav>li>a:hover,
    .navbar-default .navbar-nav>li>a:focus,
    .navbar-default .navbar-nav>.open>a,
    .navbar-default .navbar-nav>.open>a:hover,
    .navbar-default .navbar-nav>.open>a:focus,
    .navbar-default .navbar-brand:hover,
    .navbar-default .navbar-brand:focus {
        color: #ffffff;
        background-color: transparent;
    }

    #menu-superior {
        margin: 0;
    }
</style>

<nav class="navbar navbar-default " role="navigation" id="menu-superior">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand item-menu" href="<?php echo site_url('archivo/listado') ?>">Grupo Provision S.R.L</a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gestión de fichas<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('archivo/listado') ?>" class="item-menu">Listado Fichas</a></li>
                    <li><a href="<?php echo site_url('archivo/nuevo/0/0/1') ?>" class="item-menu">Nueva Ficha Casa Central</a></li>
                    <li><a href="<?php echo site_url('archivo/nuevo/0/0/0') ?>" class="item-menu">Nueva Ficha Optica</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Afiliados<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('clientes/listado') ?>" class="item-menu">Listado</a></li>
                    <li><a href="<?php echo site_url('clientes/nuevo') ?>" class="item-menu">Nuevo afiliado</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('sindicatos/listado') ?>" class="item-menu"></span>Sindicatos</a>
            </li>
            <li>
                <a href="<?php echo site_url('opticas/listado') ?>" class="item-menu"></span>Opticas</a>
            </li>
            <li>
                <a href="<?php echo site_url('delegacion/listado') ?>" class="item-menu"></span>Delegaciones</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Stock armazones<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('stock/listado') ?>" class="item-menu">Listado de stock</a></li>
                    <li><a href="<?php echo site_url('stock/listado/0/1') ?>" class="item-menu">Listado stock mínimo</a></li>
                    <li><a href="<?php echo site_url('stock/nuevoStock') ?>" class="item-menu">Nuevo stock</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('usuario/listado') ?>" class="item-menu">Listado usuarios</a></li>
                    <li><a href="<?php echo site_url('usuario/nuevo') ?>" class="item-menu">Nuevo usuario</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('apellido') . ', ' . $this->session->userdata('nombre') ?> <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('usuario/perfil') ?>" class="item-menu">Perfil</a></li>
                    <li><a href="<?php echo site_url('usuario/logout') ?>">Cerrar sesi&oacute;n</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>