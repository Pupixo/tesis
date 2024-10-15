<?php 

$fotogr_perf=actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'foto');  

$foto_usu='';
if($fotogr_perf == null){
   $foto_usu= base_url().'assets/images/user.png'; 

} else{
    
    $file_path_ruta = getcwd().'\assets\images\photos_profile\datos_personales_'.$_SESSION['usuario'][0]['id_usuario'].$fotogr_perf ;
    if (file_exists($file_path_ruta)) {
        $foto_usu=  base_url() .'assets/images/photos_profile/datos_personales_'.$_SESSION['usuario'][0]['id_usuario'].$fotogr_perf ;
    } else {
            $foto_usu= base_url().'assets/images/user.png'; 
    } 
}
 ?>

<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <input name="id_nivel_main" type="hidden" id="id_nivel_main" value="<?php echo $_SESSION['usuario'][0]['id_nivel']; ?>">        
        <input name="id_usuario_sesion" type="hidden" id="id_usuario_sesion" value="<?php echo $_SESSION['usuario'][0]['id_usuario']; ?>">        


        

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <!-- Logo icon -->
                        <!-- href="index.html" -->
                        <a >
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="<?= base_url() ?>public/web/img/logo_.png" width="60" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="<?= base_url() ?>public/web/img/logo_.png" width="60" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                 <!-- dark Logo text 
                                <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" />
                                Light Logo text
                                <img src="assets/images/logo-light-text.png" class="light-logo" alt="homepage" /> -->
                                Gestión 

                            </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <!-- Notification -->
                        <!-- 
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger rounded-circle btn-circle"><i
                                                        data-feather="airplay" class="text-white"></i></div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Luanch Admin</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Just see
                                                        the my new
                                                        admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Event today</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">Just
                                                        a reminder that you have event</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i
                                                        data-feather="settings" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Settings</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">You
                                                        can customize this template
                                                        as you want</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i
                                                        data-feather="box" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span
                                                        class="font-12 text-nowrap d-block text-muted">Just
                                                        see the my admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Mirar todas la notificaciones</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> 
                        -->



                        <!-- End Notification -->
                        <!-- ============================================================== -->
                        <!-- create new -->
                        <!-- ============================================================== -->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="settings" class="svg-icon"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li> -->
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select disabled class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option >EMPRESA</option>
                                        <option value="1" selected>CIENTIFICA DEL SUR</option>
                                        <option value="2">EN</option>
                                    </select>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- d-none ============================================================== -->
                        <li class="nav-item  d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input  id="search_secciones" class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="text" placeholder="Buscar Sección" aria-label="Search" onfocusout="Limpiar_buscador()">
                                        <i id="icon_busqueda_seccion" class="form-control-icon" data-feather="search"></i>
                                        <ul class="list-group" id="result_busqueda_seccion"></ul>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="imagen_usuario_perfil" 
                                    src="<?= $foto_usu; ?>" 
                                    alt="user" class="rounded-circle" width="40"
                                >
                                <span class="ml-2 d-none d-lg-inline-block"><span>Hola, <?php echo actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'usuario_codigo'); ?></span>
                                <span class="text-dark"></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">


                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="user"  class="svg-icon mr-2 ml-1"></i>  Mi Perfil</a>
                                <a class="dropdown-item" href="javascript:void(0)"> <i data-feather="bar-chart" class="feather-icon"></i>  Mis Estadisticas</a>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="mail" class="svg-icon mr-2 ml-1"></i> Correos</a>
                                <a class="dropdown-item" href="javascript:void(0)">  <i data-feather="calendar" class="feather-icon"></i> Cronogramas </a>

                                <div class="dropdown-divider"></div>

                       
                                <a data-toggle="modal" data-target="#acceso_modal"  app_crear_per="<?= site_url('admin/usuarios/Inicioadmin/Cambiar_clave') ?>" class="dropdown-item" href="javascript:void(0)">
                                    <i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                                    Configuración de cuenta
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= site_url('login/logout') ?>"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Cerrar Sesión</a>
                                <div class="dropdown-divider"></div>
                                    <div class="pl-4 p-3">

                                        <a style="color: white;" class="btn btn-sm btn-info"
                                         data-toggle="modal" data-target="#acceso_modal"  app_crear_per="<?= site_url('admin/usuarios/Inicioadmin/Modal_Anuncios') ?>">
                                            <i data-feather="tag" class="feather-icon"></i> Ver Avisos de Universidad
                                        </a>
                                    
                                    </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>


