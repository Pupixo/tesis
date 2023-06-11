<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        
<!--===============================================================================================-->	
<link href=<?php echo base_url("public/web/img/logo_.png");?>  rel="icon">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/login/css/main.css">
<!--===============================================================================================-->



<script src="<?= base_url() ?>assets/libs/jquery/dist/jquery-3.6.0.min.js"></script>


   <script type="text/javascript">
      $(document).ready(function() {

        document.getElementById("resultado").style.display = 'none';
        $('#frm_login').submit(function(event) {
            event.preventDefault();
            var Usuario = document.getElementById("Usuario").value;
            var Password = document.getElementById("Password").value;
            //var tipoacc = document.getElementById("tipoacc").value;
            var url = "<?php echo site_url(); ?>" + "login/ingresar";
            var urlsadministrador= "<?php echo site_url(); ?>" + "admin/usuarios/Inicioadmin";
            var urladministrador = "<?php echo site_url(); ?>" + "admin/usuarios/Inicioadmin";
            var urlusuario= "<?php echo site_url(); ?>" + "usuario/cliente/Iniciocliente";
            var urlalumno= "<?php echo site_url(); ?>" + "alumno/InicioAlumno";

              $.ajax({
                url: url,
                data: { Usuario:Usuario, Password:Password},
                type: 'POST',
                success: function(resp){
                  console.log(resp);
                  $('#resultado').html(resp);
                  if(resp==="error"){
                    $('#resultado').html("Verifique datos de usuario y/o contraseña");
                    document.getElementById("resultado").style.display = 'block';
                  }
                  else{ 
                    if(resp == "1"){
                    document.getElementById("resultado").style.display = 'none';
                    location.href = urlsadministrador;
                    }
                    if(resp == "2")
                    {
                      document.getElementById("resultado").style.display = 'none';
                      location.href = urladministrador;
                    }
                    if(resp == "3")
                    {
                      document.getElementById("resultado").style.display = 'none';
                      location.href = urlsadministrador;
                    }
                  if(resp == "4")
                    {
                      document.getElementById("resultado").style.display = 'none';
                      location.href = urlsadministrador;
                    }
                  if(resp == "5")
                    {
                      document.getElementById("resultado").style.display = 'none';
                      location.href = urlalumno;
                    } 


                  }
                }
              });
        });

      });
    </script>
    <title>.:: Gestión Documental ::.</title>
  </head>

  <body>
     
  <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
          
				<div class="login100-pic js-tilt">
             
					<img src="<?= base_url() ?>assets/login/images/img-01.png" style="height: 100%;" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="frm_login" name="frm_login" action="<?= site_url('login/ingresar') ?>" method="post">
                     
              <span class="login100-form-title">
                Inicia Sesión 
              </span>

              <div class="wrap-input100 validate-input" data-validate = "requiere nombre de usuario">
                <input class="input100" type="text" id="Usuario" name="Usuario" placeholder="Ingresa usuario">
              </div>

              <div class="wrap-input100 validate-input" data-validate = "Requiere una contraseña">
                <input class="input100" type="password" id="Password"  name="Password" placeholder="Ingresa una contraseña">
              </div>
					
					    <div class="container-login100-form-btn">
                  <button type="submit" class="login100-form-btn" value="Login" name="login" id="submit">Ingresa</button>
                  <center><span class="txt1 role="alert" id="resultado" style="color:red;"></span></center>
					    </div>

              <div class="text-center p-t-12">
                <img src="<?php echo base_url("public/web/img/logo_.png");?>"  width="100px"  height="100px" alt="">
                <span class="txt1">
                  Gestión Documental 
                </span>
              </div>
                    <!-- 
                <div class="text-center p-t-12">
                  <span class="txt1">
                    Olvidaste
                  </span>
                  <a class="txt2" href="#">
                    usuario / contraseña?
                  </a>
                </div> -->

                <!-- <div class="text-center p-t-13"  >
                  <button class="txt2 js-tilt"  id="btn_registro" >
                    Crearte una cuenta
                    <i   class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                  </button>
                </div> -->
				</form>


			</div>
		</div>
	</div>
     <script type="text/javascript">                
        var user;                                                          
        $("#Password").focus();                    
    </script>

    <!--  javascripts for application -->
    <!--===============================================================================================-->	
    <script src="<?= base_url() ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url() ?>assets/login/vendor/bootstrap/js/popper.js"></script>
      <script src="<?= base_url() ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url() ?>assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url() ?>assets/login/vendor/tilt/tilt.jquery.min.js"></script>
    <script >
        $('.js-tilt').tilt({
          scale: 1.1
        })
    </script>
    <!--===============================================================================================-->

    <script src="<?= base_url() ?>assets/login/js/main.js"></script>

 

  </body>
</html>