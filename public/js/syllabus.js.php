    <script>
    
        var wurl = "<?php echo base_url().'index.php?'; ?>";

                function Ir_Login_cliente() {
                location.href = wurl+'login';
                }

                function Ir_Intranet_nivel_usuario() {
                location.href = wurl+'admin/usuarios/Inicioadmin';
                }

 		function Ir_Intranet_nivel_alumno() {
                location.href = wurl+'alumno/InicioAlumno';
                }

                function Ir_Intranet_nivel_admin() {
                location.href = wurl+'admin/usuarios/Inicioadmin';
                }

                
                
        
            var n = 0;
            $( ".whatsappwiget" )
            .mouseenter(function() {
                n += 1;
                $( '.nube' ).addClass( "nubein" );
                $( '.nube' ).removeClass( "nubeout" );

            })
            $( ".textnube_x" ).click(function() {
                $( '.nube' ).removeClass( "nubein" );
                $( '.nube' ).addClass( "nubeout" );
            });

    

    </script>

<?php if(!isset($_SESSION['usuario'][0]['id_usuario'])){  ?>
                                  
    <script>
  
       // var wurl = "<?php echo base_url().'index.php?'; ?>";
                $(function () {
                    count = 0;
                    wordsArray = ["Inicia Sesión", "para gestionar"," tus archivos ", "¡Click Aqui!"];
                    setInterval(function () {
                        count++;
                        $("#word").fadeOut(400, function () {
                        $(this).text(wordsArray[count % wordsArray.length]).fadeIn(400);
                        });
                    }, 2000);
                });     
    </script>
    
<?php }else{  ?>

<?php } ?>
