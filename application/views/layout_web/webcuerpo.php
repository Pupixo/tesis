		<div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>
            <div class="tm-top-bar" id="tm-top-bar">
                <!-- Top Navbar -->
                <div class="container">
                    <div class="row">
                        
                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto titulo_texto_main" href="#">
<img src=<?php echo base_url("public/web/img/logo_.png");?> alt="Site logo" style=" width: 40px;">Gestión Documental</a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="#top">Inicio <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-4">Noticias</a>
                                  </li>
                              
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-6">Contactanos</a>
                                  </li>
                             
                                  <?php if(!isset($_SESSION['usuario'][0]['id_usuario'])){  ?>
                                  
                                    <button  onclick="Ir_Login_cliente(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                       Inicia Sesión
                                    </button>  
            					<?php }else{  ?>

                                    <?php if($_SESSION['usuario'][0]['id_nivel'] ==3){  ?>
                                        <button  onclick="Ir_Intranet_nivel_admin(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button> 
                                    <?php }else if($_SESSION['usuario'][0]['id_nivel'] ==1){  ?>
                                        <button  onclick="Ir_Intranet_nivel_admin(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button> 

  				    <?php }else if($_SESSION['usuario'][0]['id_nivel'] ==2){  ?>
                                        <button  onclick="Ir_Intranet_nivel_admin(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button> 

  				    <?php }else if($_SESSION['usuario'][0]['id_nivel'] ==5){  ?>
                                        <button  onclick="Ir_Intranet_nivel_alumno(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button> 

  				   <?php }else if($_SESSION['usuario'][0]['id_nivel'] ==4){  ?>
                                        <button   onclick="Ir_Intranet_nivel_admin();  return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button>

                                    <?php }else{  ?>
                                        <button  onclick="Ir_Intranet_nivel_admin(); return false;" class="navbar-brand mr-auto button_sin_estilos" type="button" id="word">
                                            Intranet
                                        </button> 
                                    <?php } ?>
                                  
                                    
								<?php } ?>

                                
                                </ul>
                            </div>   
                                                                 
                        </nav>   
                           
                    </div>
                    
                </div>
            </div>


            <div class="tm-section tm-bg-img" id="tm-section-1" >
                <div class="slide" data-timing="7" data-fadein="1" data-fadeout="1">
                    <img loading="lazy" src=<?php echo base_url("public/web/img/Top-3.jpg");?>>
                    
                            <div class="tm-bg-white ie-container-width-fix-2 tittle_slider">
                                <div class="container ie-h-align-center-fix">
                                    <div class="row">
                                        <div class="col-xs-12 ml-auto mr-auto ie-container-width-fix">
                                            <form action="index.html" method="get" class="tm-search-form tm-section-pad-2">
                                                <div class="form-row tm-search-form-row">
                                                
                                    
                                                </div>
                                                <div class="form-row tm-search-form-row">
                                
                                    
                                                </div>
                                                <div class="form-row clearfix pl-2 pr-2 tm-fx-col-xs">
                                                    <p class="tm-margin-b-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                    <a href="#" class="ie-10-ml-auto ml-auto mt-1 tm-font-semibold tm-color-primary">Need Help?</a>
                                                </div>
                                            </form>
                                        </div>                        
                                    </div>      
                                </div>
                            </div>   
                </div>

                <div class="slide" data-timing="5" data-fadein="1" data-fadeout="1" >
                    <img loading="lazy" src=<?php echo base_url("public/web/img/BANNER-WEB-1.png");?> >
                </div>

                
                <div class="slide" data-timing="8" data-fadein="1" data-fadeout="1" >
                  <!--  <video preload="none" preload="" autoplay="" muted="" playsinline="" loop="">
                        <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4" type="video/mp4">
                        Video tag is not supported in this browser.
                    </video>-->

                </div>
        
            </div>
            
            <div class="tm-section-2" style="BACKGROUND: #002983!IMPORTANT;">
                <div class="container">
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="tm-section-title">Revisa la noticias de la universidad</h2>
                            <p class="tm-color-white tm-section-subtitle">Somos los mejores</p>
                            <!-- <a href="<?php echo base_url().'index.php?'.$opcion.'/galeria_canchas'; ?>" class="tm-color-white tm-btn-white-bordered">-</a> -->
                        </div>                
                    </div>
                </div>        
            </div>
            
            <div class="tm-section tm-position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" class="tm-section-down-arrow">
                    <polygon fill="#002983" points="0,0  100,0  50,60"></polygon>                   
                </svg> 
                <div class="container tm-pt-5 tm-pb-4">
                    <div class="row text-center">
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                            
                            <img class="fa tm-fa-6x fa-legal tm-color-primary tm-margin-b-20" src=<?php echo base_url("public/web/img/logo_cientifica.jpg");?> style="width: 85px;">

                            <h3 class="tm-color-primary tm-article-title-1">Level HTML Template by Tooplate website</h3>
                            <p>You are allowed to download, edit and use this template for your business or client websites.</p>
                            <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                            
                            <img class="fa tm-fa-6x fa-legal tm-color-primary tm-margin-b-20" src=<?php echo base_url("public/web/img/orgullo_cientifica.jpg");?> style="width: 125px;">

                            <h3 class="tm-color-primary tm-article-title-1">Original Website Template Producer</h3>
                            <p>You are NOT allowed to re-distribute the downloadable template ZIP file on any website.</p>
                            <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>                            
                        </article>
                        <article class="col-sm-12 col-md-4 col-lg-4 col-xl-4 tm-article">                           
                            <img class="fa tm-fa-6x fa-legal tm-color-primary tm-margin-b-20" src=<?php echo base_url("public/web/img/universidad-cientifica-sur-campus-los-olivos.jpg");?> style="width: 125px;">

                            <h3 class="tm-color-primary tm-article-title-1">Contact us if you have any question</h3>
                            <p>If you see this template being distributed on any other site, that is an illegal copy.</p>
                            <a href="#" class="text-uppercase tm-color-primary tm-font-semibold">Continue reading...</a>                           
                        </article>
                    </div>        
                </div>
            </div>
            
            <div class="tm-section tm-section-pad tm-bg-gray" id="tm-section-4">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                            <div class="tm-article-carousel">                            
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-01.jpg");?> alt="Image" style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Nunc in felis aliquet metus luctus iaculis</h3></header>
                                        <p>Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla. Nullam sollicitudin at augue venenatis eleifend. Nulla ligula ligula, egestas sit amet viverra id, iaculis sit amet ligula.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">Get More Info.</a>
                                    </div>                                
                                </article>                    
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-02.jpg");?> alt="Image" style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Sed cursus dictum nunc quis molestie</h3></header>
                                        <p>Pellentesque quis dui sit amet purus scelerisque eleifend sed ut eros. Morbi viverra blandit massa in varius. Sed nec ex eu ex tincidunt iaculis. Curabitur eget turpis gravida.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">View Detail</a>
                                    </div>                                
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-03.jpg");?> alt="Image" style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Eget diam pellentesque interdum ut porta</h3></header>
                                        <p>Aenean finibus tempor nulla, et maximus nibh dapibus ac. Duis consequat sed sapien venenatis consequat. Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">More Info.</a>
                                    </div>                                
                                </article>
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-04.jpg");?> alt="Image"  style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Lorem ipsum dolor sit amet, consectetur</h3></header>
                                        <p>Suspendisse molestie sed dui eget faucibus. Duis accumsan sagittis tortor in ultrices. Praesent tortor ante, fringilla ac nibh porttitor, fermentum commodo nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">Detail Info.</a>
                                    </div>                                
                                </article>                    
                                <article class="tm-bg-white mr-2 tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-01.jpg");?> alt="Image"  style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Orci varius natoque penatibus et</h3></header>
                                        <p>Pellentesque quis dui sit amet purus scelerisque eleifend sed ut eros. Morbi viverra blandit massa in varius. Sed nec ex eu ex tincidunt iaculis. Curabitur eget turpis gravida.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">Read More</a>
                                    </div>                                
                                </article>
                                <article class="tm-bg-white tm-carousel-item">
                                    <img src=<?php echo base_url("public/web/img/img-02.jpg");?> alt="Image" style="height: 269px;" class="img-fluid">
                                    <div class="tm-article-pad">
                                        <header><h3 class="text-uppercase tm-article-title-2">Nullam sollicitudin at augue venenatis eleifend</h3></header>
                                        <p>Aenean finibus tempor nulla, et maximus nibh dapibus ac. Duis consequat sed sapien venenatis consequat. Aliquam ac lacus volutpat, dictum risus at, scelerisque nulla.</p>
                                        <a href="#" class="text-uppercase btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">More Details</a>
                                    </div>                                
                                </article>
                            </div>    
                        </div>
                        
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 tm-recommended-container">
                            <div class="tm-bg-white">
                                <div class="tm-bg-primary tm-sidebar-pad" style="BACKGROUND: #002983!IMPORTANT;">
                                    <h3 class="tm-color-white tm-sidebar-title">SEDES</h3>
                                    <p class="tm-color-white tm-margin-b-0 tm-font-light"></p>
                                </div>
                                <div class="tm-sidebar-pad-2">
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img style="
    WIDTH: 169PX;
    HEIGHT: 100PX;
"src=<?php echo base_url("public/web/img/tn-img-04.jpg");?> alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Villa el Salvador</h4>
                                        </div>
                                    </a>

                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img style="
    WIDTH: 149PX;
    HEIGHT: 100PX;
" src=<?php echo base_url("public/web/img/tn-img-01.jpg");?> alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Miraflores</h4>
                                        </div>                                        
                                    </a>
                                    <a href="#" class="media tm-media tm-recommended-item">
                                        <img style="
    WIDTH: 169PX;
    HEIGHT: 100PX;
" src=<?php echo base_url("public/web/img/tn-img-03.jpg");?> alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">Lima Norte</h4>
                                        </div>
                                    </a>
                                    <a href="#" style="
    WIDTH: 169PX;
    HEIGHT: 100PX;
" class="media tm-media tm-recommended-item">
                                        <img style="
    WIDTH: 169PX;
    HEIGHT: 100PX;
" src=<?php echo base_url("public/web/img/tn-img-02.jpg");?> alt="Image">
                                        <div class="media-body tm-media-body tm-bg-gray">
                                            <h4 class="text-uppercase tm-font-semibold tm-sidebar-item-title">&nbsp;&nbsp;&nbsp;ATE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                                        </div>
                                    </a>
                                                                     
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>

              
            
            <div class="tm-section tm-section-pad tm-bg-img tm-position-relative" id="tm-section-6">
                <div class="container ie-h-align-center-fix">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-7">
                            <div id="google-map"></div>        
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-5 mt-3 mt-md-0">
                            <div class="tm-bg-white tm-p-4">
                                <form action="index.html" method="post" class="contact-form">
                                    <div class="form-group">
                                        <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Nombre"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Correo"  required/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="Asunto"  required/>
                                    </div>
                                    <div class="form-group">
                                        <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Mensaje" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary tm-btn-primary" style="BACKGROUND: #002983!IMPORTANT;">Envianos un mensaje ahora</button>
                                </form>
                            </div>                            
                        </div>
                    </div>        
                </div>
            </div>
            
            <footer class="tm-bg-dark-blue">
                <div class="container">
                    <div class="row">
                        <p class="col-sm-12 text-center tm-font-light tm-color-white p-4 tm-margin-b-0">
                        Copyright &copy; <span class="tm-current-year"> <?php echo date("YYYY");?>  </span> GESTIÓN DOCUMENTAL
                        
                        - Diseñado y Desarrollado: <a rel="nofollow" href="https://www.tooplate.com" class="tm-color-primary tm-font-normal" target="_parent">PEDRO ACOSTA</a></p>        
                    </div>
                </div>                
            </footer>
        </div>

        <div class="whatsappwiget">
            <div>
                <div class="q8c6tt-2 contentwhatsapp">
                    <a  class="nube">  <!--  href="" target="_blank" -->
                        <div class="textnube" onclick="window.open('https://api.whatsapp.com/send?phone=51941547807&text=Hola!&nbsp;me&nbsp;quisera&nbsp;más&nbsp;información?')">
                            <div class="wlineuno">Resuelve tus dudas</div>
                            <div class="wlinedos">Escribenos al whatsapp</div>
                            <button class="wlinebo">+51 933 883 308</button>
                        </div>
                        <div class="textnube_x"></div>
                    </a>
                    <a class="whatsapp" href="https://api.whatsapp.com/send?phone=51941547807&text=Hola!&nbsp;me&nbsp;quisera&nbsp;más&nbsp;información?" target="_blank">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="width: 100%; height: 100%; fill: rgb(255, 255, 255); stroke: none;">
                            <path d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a.63.63 0 0 1-.315-.1c-.802-.402-1.504-.817-2.163-1.447-.545-.516-1.146-1.29-1.46-1.963a.426.426 0 0 1-.073-.215c0-.33.99-.945.99-1.49 0-.143-.73-2.09-.832-2.335-.143-.372-.214-.487-.6-.487-.187 0-.36-.043-.53-.043-.302 0-.53.115-.746.315-.688.645-1.032 1.318-1.06 2.264v.114c-.015.99.472 1.977 1.017 2.78 1.23 1.82 2.506 3.41 4.554 4.34.616.287 2.035.888 2.722.888.817 0 2.15-.515 2.478-1.318.13-.33.244-.73.244-1.088 0-.058 0-.144-.03-.215-.1-.172-2.434-1.39-2.678-1.39zm-2.908 7.593c-1.747 0-3.48-.53-4.942-1.49L7.793 24.41l1.132-3.337a8.955 8.955 0 0 1-1.72-5.272c0-4.955 4.04-8.995 8.997-8.995S25.2 10.845 25.2 15.8c0 4.958-4.04 8.998-8.998 8.998zm0-19.798c-5.96 0-10.8 4.842-10.8 10.8 0 1.964.53 3.898 1.546 5.574L5 27.176l5.974-1.92a10.807 10.807 0 0 0 16.03-9.455c0-5.958-4.842-10.8-10.802-10.8z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>  
        </div>