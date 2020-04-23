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

    .img {
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .wrapper {
        width: 100%;
    }

    #sidebar {
        min-width: 300px;
        max-width: 300px;
        background: #32373d;
        color: #fff;
        transition: all 0.3s;
        position: relative;
    }

    #sidebar .h6 {
        color: #fff;
    }

    #sidebar.active {
        margin-left: -300px;
    }

    #sidebar.active .custom-menu {
        margin-right: -50px;
    }

    #sidebar.active .btn.btn-primary:before {
        content: "\f054";
        font-family: "FontAwesome";
        left: 2px !important;
    }

    #sidebar.active .btn.btn-primary:after {
        display: none;
    }

    #sidebar h1 {
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 20px;
    }

    #sidebar h1 .logo {
        color: #fff;
        display: block;
        padding: 10px 30px;
        background: #2f89fc;
    }

    #sidebar ul.components {
        padding: 0;
    }

    #sidebar ul li {
        font-size: 16px;
    }

    #sidebar ul li>ul {
        margin-left: 10px;
    }

    #sidebar ul li>ul li {
        font-size: 14px;
    }

    #sidebar ul li a {
        padding: 15px 30px;
        display: block;
        color: rgba(255, 255, 255, .6);
        border-bottom: 1px solid rgba(255, 255, 255, .05);
    }

    #sidebar ul li a span.notif {
        position: relative;
    }

    #sidebar ul li a span.notif small {
        position: absolute;
        top: -3px;
        bottom: 0;
        right: -3px;
        width: 12px;
        height: 12px;
        content: '';
        background: red;
        border-radius: 50%;
        font-family: 'Poppins', Arial, sans-serif;
        font-size: 8px;
    }

    #sidebar ul li a:hover {
        color: #fff;
        background: #2f89fc;
        border-bottom: 1px solid #2f89fc;
    }

    #sidebar ul li.active>a {
        background: transparent;
        color: #fff;
    }

    #sidebar ul li.active>a:hover {
        background: #2f89fc;
        border-bottom: 1px solid #2f89fc;
    }

    #sidebar .custom-menu {
        display: inline-block;
        position: absolute;
        top: 20px;
        right: 0;
        margin-right: -35px;
    }

    .bg-wrap {
        width: 100%;
        position: relative;
        z-index: 0;
    }

    .bg-wrap:after {
        z-index: -1;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        content: '';
        background: #000;
        opacity: 0.3;
    }

    .bg-wrap .user-logo .img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto;
        margin-bottom: 10px;
    }

    .bg-wrap .user-logo h3 {
        color: #fff;
        font-size: 18px;
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

    #content {
        width: 100%;
        padding: 0;
        min-height: 100vh;
        transition: all 0.3s;
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

    .footer p {
        color: rgba(255, 255, 255, .5);
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

    .form-control:focus,
    .form-control:active {
        border-color: #000;
    }

    .form-control::-webkit-input-placeholder {
        /* Chrome/Opera/Safari */
        color: rgba(255, 255, 255, .5);
    }

    .form-control::-moz-placeholder {
        /* Firefox 19+ */
        color: rgba(255, 255, 255, .5);
    }

    .form-control:-ms-input-placeholder {
        /* IE 10+ */
        color: rgba(255, 255, 255, .5);
    }

    .form-control:-moz-placeholder {
        /* Firefox 18- */
        color: rgba(255, 255, 255, .5);
    }

    .subscribe-form .form-control {
        background: #4897fc;
    }

    .img.bg-wrap {
        padding: 10px;
    }

    span.fa {
        margin-right: 4px;
    }
</style>

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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->userdata('apellido') . ', ' . $this->session->userdata('nombre') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo site_url('usuario/perfil') ?>" class="item-menu">Perfil</a></li>
                    <li><a href="<?php echo site_url('usuario/logout') ?>">Cerrar sesi&oacute;n</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<div class="wrapper d-flex align-items-stretch">
    <div class="sidenav">
        <div class="img bg-wrap text-center" style="background-image: url(assets/images/anteojo-bg.jpg);">
            <div class="user-logo">
                <img src="assets/images/logo-solo.png" width="50">
                <h6><a style="color: white" href="<?php echo site_url('usuario/perfil') ?>"><?php echo $this->session->userdata('apellido') . ', ' . $this->session->userdata('nombre') ?></a></h6>
            </div>
        </div>
        <ul>
            <li data-toggle="collapse" data-target="#fichas">
                <span class="collapse-item"><span class="fa fa-file"></span> Gestion de Fichas</span>
                <ul class="nav nav-list collapse" id="fichas">
                    <li><a href="<?php echo site_url('archivo/listado') ?>" class="collapse-item item-menu">- Listado Fichas
                        </a></li>
                    <li><a href="<?php echo site_url('archivo/nuevo') ?>" class="collapse-item item-menu">- Nueva Ficha</a>
                    </li>
                </ul>
            </li>
            <li data-toggle="collapse" data-target="#afiliado">
                <span class="collapse-item"><span class="fa fa-address-card"></span> Afiliados</span>
                <ul class="nav nav-list collapse" id="afiliado">
                    <li><a href="<?php echo site_url('clientes/listado') ?>" class="collapse-item item-menu">- Listado </a>
                    </li>
                    <li><a href="<?php echo site_url('clientes/nuevo') ?>" class="collapse-item item-menu">- Nuevo
                            afiliado</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo site_url('sindicatos/listado') ?>" class="collapse-item item-menu"><span class="fa fa-building"></span> Sindicatos </a>
            </li>
            <li data-toggle="collapse" data-target="#stock">
                <span class="collapse-item"><span class="fa fa-th-list"></span> Stock</span>
                <ul class="nav nav-list collapse" id="stock">
                    <li><a href="<?php echo site_url('stock/listado') ?>" class="collapse-item item-menu">- Listado </a>
                    </li>
                    <li><a href="<?php echo site_url('stock/nuevoStock') ?>" class="collapse-item item-menu">- Nuevo
                            stock</a></li>
                </ul>
            </li>
            <li data-toggle="collapse" data-target="#usuarios">
                <span class="collapse-item"><span class="fa fa-user-circle"></span> Usuarios</span>
                <ul class="nav nav-list collapse" id="usuarios">
                    <li><a href="<?php echo site_url('usuario/listado') ?>" class="collapse-item item-menu">- Listado Usuarios
                        </a></li>
                    <li><a href="<?php echo site_url('usuario/nuevo') ?>" class="collapse-item item-menu">- Nuevo Usuario</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>