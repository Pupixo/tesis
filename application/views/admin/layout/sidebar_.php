        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">


                            <?php 
                                                
                                switch ($_SESSION['usuario'][0]['id_nivel'] ){ 
                                    case 1:

                            ?>

                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url('admin/usuarios/Inicioadmin') ?>"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                                class="hide-menu">Inicio</span></a></li>
                                    <li class="list-divider"></li>

                                    <li class="nav-small-cap"><span class="hide-menu">Datos Maestros</span></li>

                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false">
                                            <i data-feather="grid" class="feather-icon"></i><span
                                        class="hide-menu">Crud Maestros </span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                            <li class="sidebar-item">
                                                <a href="<?= site_url('admin/maestros/Cursos') ?>" class="sidebar-link">
                                                    <span
                                                        class="hide-menu"><i class='far fa-book'></i> Cursos
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Carrera') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-road"></i> Carreras
                                                        </span>
                                                    </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Director') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-users-crown"></i>Directores
                                                        </span>
                                                    </a>
                                            </li>
                                          
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Nivel') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Niveles
                                                        </span>
                                                    </a>
                                            </li>

                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/RecursoAula') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Recursos Aula
                                                        </span>
                                                    </a>
                                            </li>
                                        
                                        </ul>
                                    </li>

                                    <li class="list-divider"></li>

                                  
                                    <li class="nav-small-cap"><span class="hide-menu">Administrador</span></li>

                                              
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/PlanEstudios') ?>"
                                                        aria-expanded="false">
                                                        
                                                        <i data-feather="sidebar" class="feather-icon"></i><span
                                                            class="hide-menu">Plan de Estudios
                                                        </span>

                                                      
                                                    </a>
                                                </li>
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Usuarios') ?>"
                                                        aria-expanded="false"><i  class="icon-user"></i><span
                                                            class="hide-menu">Usuarios
                                                        </span></a>
                                                </li>
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Asyllabus') ?>"  aria-expanded="false">
                                                        <i data-feather="file-text" class="feather-icon"></i><span
                                                            class="hide-menu">Sillabus
                                                        </span></a>
                                                </li>
                                               
                                    <li class="list-divider"></li>

                                    

                            <?php     
                            
                                    break;
                                    case 2:

                                        
                                    
                            ?>
                                    
                                   
                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url('admin/usuarios/Inicioadmin') ?>"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                                class="hide-menu">Inicio</span></a></li>
                                    <li class="list-divider"></li>

                                    <li class="nav-small-cap"><span class="hide-menu">Datos Maestros</span></li>

                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false">
                                            <i data-feather="grid" class="feather-icon"></i><span
                                        class="hide-menu">Crud Maestros </span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                            <li class="sidebar-item">
                                                <a href="<?= site_url('admin/maestros/Cursos') ?>" class="sidebar-link">
                                                    <span
                                                        class="hide-menu"><i class='far fa-book'></i> Cursos
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Carrera') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-road"></i> Carreras
                                                        </span>
                                                    </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Director') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-users-crown"></i>Directores
                                                        </span>
                                                    </a>
                                            </li>
                                          
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Nivel') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Niveles
                                                        </span>
                                                    </a>
                                            </li>

                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/RecursoAula') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Recursos Aula
                                                        </span>
                                                    </a>
                                            </li>
                                        
                                        </ul>
                                    </li>

                                    <li class="list-divider"></li>

                                  
                                    <li class="nav-small-cap"><span class="hide-menu">Administrador</span></li>

                                              
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/PlanEstudios') ?>"
                                                        aria-expanded="false">
                                                        <i data-feather="sidebar" class="feather-icon"></i><span
                                                            class="hide-menu">Plan de Estudios
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Usuarios') ?>"
                                                        aria-expanded="false"><i  class="icon-user"></i><span
                                                            class="hide-menu">Usuarios
                                                        </span></a>
                                                </li>
                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Asyllabus') ?>"  aria-expanded="false">
                                                        <i data-feather="file-text" class="feather-icon"></i><span
                                                            class="hide-menu">Sillabus
                                                        </span></a>
                                                </li>
                                               
                                    <li class="list-divider"></li>


                            <?php
                            
                                    break;
                                    case 3:
                            
                            ?>


                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url('admin/usuarios/Inicioadmin') ?>"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                                class="hide-menu">Inicio</span></a></li>
                                    <li class="list-divider"></li>
  				
                                    <li class="list-divider"></li>
                                    <li class="nav-small-cap"><span class="hide-menu">Documentos</span></li>
                                                <li class="sidebar-item">   
                                                    <a class="sidebar-link" href="<?= site_url('admin/usuarios/Asyllabus') ?>"
                                                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                                            class="hide-menu">Sillabus
                                                        </span>
                                                    </a>
                                                </li>    
                                    <li class="list-divider"></li>

                            <?php
                            
                                    break;
                                    case 4:
                            
                            ?>
                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url('admin/usuarios/Inicioadmin') ?>"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                                class="hide-menu">Inicio</span></a></li>
                                    <li class="list-divider"></li>

                                    <li class="nav-small-cap"><span class="hide-menu">Datos Maestros</span></li>

                                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false">
                                            <i data-feather="grid" class="feather-icon"></i><span
                                        class="hide-menu">Crud Maestros </span>
                                        </a>
                                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                            <li class="sidebar-item">
                                                <a href="<?= site_url('admin/maestros/Cursos') ?>" class="sidebar-link">
                                                    <span
                                                        class="hide-menu"><i class='far fa-book'></i> Cursos
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Carrera') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-road"></i> Carreras
                                                        </span>
                                                    </a>
                                            </li>
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Director') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"> <i class="fad fa-users-crown"></i>Directores
                                                        </span>
                                                    </a>
                                            </li>
                                            <!-- <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Docente') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fad fa-users-class"></i> Docentes
                                                        </span>
                                                    </a>
                                            </li> -->
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/Nivel') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Niveles
                                                        </span>
                                                    </a>
                                            </li>
                                        
                                            <li class="sidebar-item">
                                                    <a href="<?= site_url('admin/maestros/RecursoAula') ?>" class="sidebar-link">
                                                        <span
                                                            class="hide-menu"><i class="fab fa-connectdevelop"></i> Recursos Aula
                                                        </span>
                                                    </a>
                                            </li>
                                        
                                        </ul>
                                    </li>

                                    <li class="list-divider"></li>

                                    <li class="nav-small-cap"><span class="hide-menu">Administrador</span></li>


                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/PlanEstudios') ?>"
                                                        aria-expanded="false">
                                                        
                                                        <i data-feather="sidebar" class="feather-icon"></i><span
                                                            class="hide-menu">Plan de Estudios
                                                        </span>
                                                    
                                                    </a>
                                                </li>

   						                        <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Usuarios') ?>"
                                                        aria-expanded="false"><i  class="icon-user"></i><span
                                                            class="hide-menu">Usuarios
                                                        </span></a>
                                                </li>


                                             

                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('admin/usuarios/Asyllabus') ?>"
                                                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                                            class="hide-menu">Sillabus
                                                        </span></a>
                                                </li>
                                                
                                    <li class="list-divider"></li>


                            <?php
                    
                                    break;
                                    case 5:
                            
                            ?>
                                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="<?= site_url('alumno/InicioAlumno') ?>"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                                                class="hide-menu">Inicio Usuario</span></a></li>
                                    <li class="list-divider"></li>
                                    <li class="nav-small-cap"><span class="hide-menu">Herramientas</span></li>

                                                <li class="sidebar-item"> <a class="sidebar-link" href="<?= site_url('alumno/TusSyllabus') ?>"
                                                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                                                            class="hide-menu">Tus Syllabus
                                                        </span></a>
                                                </li>
                                               
                                    <li class="list-divider"></li>




                            <?php
                            
                                    break;

                                    }
                            
                            ?>
                       
                                                             
                        <!-- <li class="nav-small-cap"><span class="hide-menu">Components</span></li> -->
                        <!--                       
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                        class="hide-menu">Tables </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item">
                                        <a href="table-basic.html" class="sidebar-link"><span
                                                class="hide-menu"> Basic Table
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="table-dark-basic.html" class="sidebar-link"><span
                                                class="hide-menu"> Dark Basic Table
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="table-sizing.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Sizing Table
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="table-layout-coloured.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Coloured
                                                Table Layout
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="table-datatable-basic.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Basic
                                                Datatables
                                                Layout
                                            </span></a>
                                    </li>
                                </ul>
                            </li> -->
                        <!--   
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="bar-chart" class="feather-icon"></i><span
                                        class="hide-menu">Charts </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="chart-morris.html" class="sidebar-link"><span
                                                class="hide-menu"> Morris Chart
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="chart-chart-js.html" class="sidebar-link"><span
                                                class="hide-menu"> ChartJs
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="chart-knob.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Knob Chart
                                            </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="box" class="feather-icon"></i><span
                                        class="hide-menu">UI Elements </span></a>
                                <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                    <li class="sidebar-item"><a href="ui-buttons.html" class="sidebar-link"><span
                                                class="hide-menu"> Buttons
                                            </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="ui-modals.html" class="sidebar-link"><span
                                                class="hide-menu"> Modals </span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="ui-tab.html" class="sidebar-link"><span
                                                class="hide-menu"> Tabs </span></a></li>
                                    <li class="sidebar-item"><a href="ui-tooltip-popover.html" class="sidebar-link"><span
                                                class="hide-menu"> Tooltip &
                                                Popover</span></a></li>
                                    <li class="sidebar-item"><a href="ui-notification.html" class="sidebar-link"><span
                                                class="hide-menu">Notification</span></a></li>
                                    <li class="sidebar-item"><a href="ui-progressbar.html" class="sidebar-link"><span
                                                class="hide-menu">Progressbar</span></a></li>
                                    <li class="sidebar-item"><a href="ui-typography.html" class="sidebar-link"><span
                                                class="hide-menu">Typography</span></a></li>
                                    <li class="sidebar-item"><a href="ui-bootstrap.html" class="sidebar-link"><span
                                                class="hide-menu">Bootstrap
                                                UI</span></a></li>
                                    <li class="sidebar-item"><a href="ui-breadcrumb.html" class="sidebar-link"><span
                                                class="hide-menu">Breadcrumb</span></a></li>
                                    <li class="sidebar-item"><a href="ui-list-media.html" class="sidebar-link"><span
                                                class="hide-menu">List
                                                Media</span></a></li>
                                    <li class="sidebar-item"><a href="ui-grid.html" class="sidebar-link"><span
                                                class="hide-menu"> Grid </span></a></li>
                                    <li class="sidebar-item"><a href="ui-carousel.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Carousel</span></a></li>
                                    <li class="sidebar-item"><a href="ui-scrollspy.html" class="sidebar-link"><span
                                                class="hide-menu">
                                                Scrollspy</span></a></li>
                                    <li class="sidebar-item"><a href="ui-toasts.html" class="sidebar-link"><span
                                                class="hide-menu"> Toasts</span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="ui-spinner.html" class="sidebar-link"><span
                                                class="hide-menu"> Spinner </span></a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="ui-cards.html"
                                    aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                        class="hide-menu">Cards
                                    </span></a>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>

                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                                    aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span
                                        class="hide-menu">Login
                                    </span></a>
                            </li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                                    href="authentication-register1.html" aria-expanded="false"><i data-feather="lock"
                                        class="feather-icon"></i><span class="hide-menu">Register
                                    </span></a>
                            </li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="feather" class="feather-icon"></i><span
                                        class="hide-menu">Icons
                                    </span></a>
                                <ul aria-expanded="false" class="collapse first-level base-level-line">
                                    <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><span
                                                class="hide-menu"> Fontawesome Icons </span></a></li>

                                    <li class="sidebar-item"><a href="icon-simple-lineicon.html" class="sidebar-link"><span
                                                class="hide-menu"> Simple Line Icons </span></a></li>
                                </ul>
                            </li>

                            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                                    aria-expanded="false"><i data-feather="crosshair" class="feather-icon"></i><span
                                        class="hide-menu">Multi
                                        level
                                        dd</span></a>
                                <ul aria-expanded="false" class="collapse first-level base-level-line">
                                    <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                class="hide-menu"> item 1.1</span></a>
                                    </li>
                                    <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                class="hide-menu"> item 1.2</span></a>
                                    </li>
                                    <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)"
                                            aria-expanded="false"><span class="hide-menu">Menu 1.3</span></a>
                                        <ul aria-expanded="false" class="collapse second-level base-level-line">
                                            <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                        class="hide-menu"> item
                                                        1.3.1</span></a></li>
                                            <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                        class="hide-menu"> item
                                                        1.3.2</span></a></li>
                                            <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                        class="hide-menu"> item
                                                        1.3.3</span></a></li>
                                            <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                        class="hide-menu"> item
                                                        1.3.4</span></a></li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item"><a href="javascript:void(0)" class="sidebar-link"><span
                                                class="hide-menu"> item
                                                1.4</span></a></li>
                                </ul>
                            </li>
                            <li class="list-divider"></li>
                            <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="docs/docs.html"
                                    aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                                        class="hide-menu">Documentation</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                                    aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                        class="hide-menu">Logout</span></a></li> 
                        -->
                                
                    </ul>
                </nav>
                
               

                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>

        <div class="page-wrapper">