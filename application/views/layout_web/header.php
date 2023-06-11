<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta NAME="keywords" CONTENT="Tu Cancha,futbol,Alquiler de canchas deportivas">
    <meta name="description" content="Tu cancha es una plataforma web que nos brinda una vía de intercomunicación con nuestros clientes internos y externos con información en tiempo real para el alquiler de losas deportivas en el horarios y horas deseadas sin salir de casa. La evolución de las plataformas interactivas se muestra muy ligada al desarrollo de la operatividad de nuestras operaciones, y más en concreto, a adaptarse a las necesidades reales de los clientes. Tú cancha es desarrollado por el LyF proyectos">
	<!-- Favicons -->
    <link href=<?php echo base_url("public/web/img/logo_.png");?>  rel="icon">
    <title> <?php $tituloPrincipal  ?></title>
        <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href=<?php echo base_url("public/web/font-awesome-4.7.0/css/font-awesome.min.css");?> >                <!-- Font Awesome -->
    <link rel="stylesheet" href=<?php echo base_url("public/web/css/bootstrap.min.css");?> >                                   <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href=<?php echo base_url("public/web/slick/slick.css");?> />
    <link rel="stylesheet" type="text/css" href=<?php echo base_url("public/web/slick/slick-theme.css");?> />
    <link rel="stylesheet" type="text/css" href=<?php echo base_url("public/web/css/datepicker.css");?> />
    <link rel="stylesheet" href=<?php echo base_url("public/web/css/tooplate-style.css");?> > 
    
    <link rel="stylesheet" type="text/css" href=<?php echo base_url("public/web/csschat/chat.css");?> >

<style>
.titulo_texto_main {
 }

@media (max-width: 450px) {
  .titulo_texto_main {
    font-size: 20px;
  }
}
</style>
    <style>
            
            .tm-section.tm-bg-img .slide img {
                width: 100%;
                height: 100%;
                object-fit: fill;

            }

            .tm-section.tm-bg-img .slide video {
                object-fit: cover;
                z-index: 0;
                position: absolute;
                background-size: 100% 100%;
                top: 50%;
                left: 50%;
                min-width: 100%;
                min-height: 100%;
                width: auto;
                height: auto;
            }
            

            .tm-section.tm-bg-img .slide{
                opacity:0;
                width: 100%;
                height: 100%;
                position: absolute;
            }

            .title {
                margin-bottom: 10px!important;
                text-align: center;
            }

            .tittle_slider{
                position: absolute !important;top: 35%!important;z-index: 3!important;right: 7%;
             }

             .button_sin_estilos{
                background: none;
                color: inherit;
                border: none;
                padding: 20px;
                font: inherit;
                cursor: pointer;
                outline: inherit; 
                width: 100%;            
            }
         
    </style>

</head>



<body >

            <!-- Modal -->

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-warning-sign" style="color:orange;"></span> &nbsp;&nbsp;&nbsp;Advertencia</h3>
                        </div>
                        <div class="modal-body">Estimado(a) <?php //echo retornar_dato_usuario('NombreCompleto'); ?>, su session a caducado. <br>¿Desea permanecer en la pagina?</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCerrar">NO</button>
                            <button type="button" class="btn btn-primary" id="btnAbrir">SI</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-warning-sign" style="color:orange;"></span> &nbsp;&nbsp;&nbsp;Advertencia</h3>
                        </div>
                        <div class="modal-body">
                            <h5 id="titulo">Esta Seguro que desea eliminar:</h5> <br> <label id="lblRegistro"></label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnNO">NO</button>
                            <button type="button" class="btn btn-primary" id="btnSI">SI</button>
                        </div>
                    </div>
                </div>
            </div>
     
            <!-- Modal -->
            <div class="modal fade" id="modalActivar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><span class="glyphicon glyphicon-warning-sign" style="color:orange;"></span> &nbsp;&nbsp;&nbsp;Advertencia</h3>
                        </div>
                        <div class="modal-body">Esta Seguro que desea Activar: <br> <label id="lblRegistro"></label></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="abtnNO">NO</button>
                            <button type="button" class="btn btn-primary" id="abtnSI">SI</button>
                        </div>
                    </div>
                </div>
            </div>

           



