    <?php $sesion =  $_SESSION['usuario'][0];
    
    $foto_modal= $camb_clave[0]['foto'];  

    $foto_usua='';
    if($foto_modal == null){
    $foto_usua= base_url().'assets/images/user.png'; 

    } else{
        
        $file_path_ruta_ = getcwd().'\assets\images\photos_profile\datos_personales_'.$camb_clave[0]['id_usuario'].$foto_modal ;
        if (file_exists($file_path_ruta_)) {
            $foto_usua=  base_url() .'assets/images/photos_profile/datos_personales_'.$camb_clave[0]['id_usuario'].$foto_modal ;
        } else {
                $foto_usua= base_url().'assets/images/user.png'; 
        } 
    }

    
    ?>
    <form method="post" id="from_cmbclave" enctype="multipart/form-data" action="<?= site_url('admin/usuarios/Inicioadmin/Update_clave') ?>" >
        
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Datos de Usuario - <?php echo $camb_clave[0]['usuario_nombres']." ".$camb_clave[0]['usuario_apater']." ".$camb_clave[0]['usuario_amater']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
    

            <div class="modal-body" >

                <div class="col-md-12 row">
                    <div class="form-group col-md-4">

                        <div class="image_area_usu">
                            <form method="post">
                                <label for="upload_image_usu">
                                    <img src="<?= $foto_usua; ?>" id="uploaded_image" class="img-responsive img-circle img_usu" />
                                    <div class="overlay_usu">
                                        <div class="text_usu">Haga clic para cambiar la imagen de perfil</div>
                                    </div>
                                    <input type="file" name="image" class="image" id="upload_image_usu" style="display:none">
                                </label>
                            </form>
                        </div>

                    </div>

                    <div class="form-group col-md-8">
                        <label class="control-label text-bold"> <b>Perfil:</b>  </label>
                        <?php echo $camb_clave[0]['nom_nivel']?>
                        <br>
                        <label class="control-label text-bold"> <b>Usuario:</b>  </label>
                        <?php echo $camb_clave[0]['usuario_codigo']?>
                        <br>
                        <label class="control-label text-bold"> <b>Estado:</b>  </label>
                        <?php echo $camb_clave[0]['nom_status']?>
                        <br>
                        <label class="control-label text-bold"> <b>Nombres:</b>  </label>
                        <?php echo $camb_clave[0]['usuario_nombres']?>
                        <br>
                        <label class="control-label text-bold"> <b>Apellido Paterno:</b>  </label>
                        <?php echo $camb_clave[0]['usuario_apater']?>
                        <br>
                        <label class="control-label text-bold"> <b>Apellido Materno:</b> </label>
                        <?php echo $camb_clave[0]['usuario_amater']?>
                        <br>
                        <label class="control-label text-bold"> <b>Correo:</b>  </label>
                        <?php echo $camb_clave[0]['emailp']?>
                        <br>
                        <label class="control-label text-bold"> <b>Celular:</b>  </label>
                        <?php echo $camb_clave[0]['num_celp']?>
                        <br>
                        <label class="control-label text-bold"> <b>Sexo:</b> </label>
                        <?php echo $camb_clave[0]['sexo']?>
                        <br>
        
                        
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label text-bold">Nueva Clave: </label>
                        <input name="usuario_password" type="password" class="form-control" id="usuario_password" placeholder="Ingresar Clave de Intranet">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label text-bold">Confirmar Clave: </label>
                        <input name="usuario_passwordn" type="password" class="form-control" id="usuario_passwordn" placeholder="Ingresar Nueva Clave de Intranet">
                    </div>
                    <?php if(isset($camb_clave)){ ?>
                        <input  type="hidden" name="id_usuario" id="id_usuario"  value="<?php echo $camb_clave[0]['id_usuario'] ?>">
                    <?php } ?> 
                </div>
            </div>

            <div class="modal-footer">
              
                <button type="button" id="btn_cambiarclave" name="btn_cambiarclave" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger"  data-dismiss="modal">Cancelar</button>
            </div>
    </form>



    <script >

$("#btn_cambiarclave").on('click', function(e){
    if (validar()) {
        bootbox.confirm({
            title: "Cambio de Clave",
            message: "¿Desea cambiar su clave?",
            buttons: {
                cancel: {
                    label: 'Cancelar'
                },
                confirm: {
                    label: 'Confirmar'
                }
            },
            callback: function (result) {
                if (result) {
                    $('#from_cmbclave').submit();
                }
            }
        });
    } else {
        bootbox.alert(msgDate)
        var input = $(inputFocus).parent();
        $(input).addClass("has-error");
        $(input).on("change", function () {
            if ($(input).hasClass("has-error")) {
                $(input).removeClass("has-error");
            }
        });
    }
});

function validar()
{
    if ($('#usuario_password').val().trim() === '')
    {
        msgDate = 'Debe ingresar una nueva clave';

        inputFocus = '#usuario_password';


        return false;
    }

    if ($('#usuario_password').val()!=$('#usuario_passwordn').val())
    {
        msgDate = 'Las claves no coinciden';
        inputFocus = '#usuario_passwordn';
        return false;
    }
    return true;
}

$(document).ready(function() {
    var msgDate = '';
    var inputFocus = '';

        
    $(document).on("hidden.bs.modal", ".bootbox.modal", function (e) {

        console.log('2nd level modal closed');
        jQuery("body").addClass("modal-open");
    });



});
</script>

<script>
$(document).ready(function(){
    
    var $modal_perfil = $('#modal_photo_crop');
    var image = document.getElementById('sample_image_usu');
    var cropper;

    $('#upload_image_usu').change(function(event){

            var files = event.target.files;       
                console.log("🚀 ~ file: index.php:173 ~ $ ~ files:", files)
                $modal_perfil.modal('show');

                var done = function (url) {
                        image.src = url;
                };
                    
                if (files && files.length > 0)
                {
                    reader = new FileReader();
                    reader.onload = function (event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);   
                }
    });

    $modal_perfil.on('shown.bs.modal', function() {
        console.log("----------------------------image:", image)

        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview_img_usu'
        });
    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
        console.log("🚀 ~ file: index.php:205 ~ $modal_perfil.on ~ cropper:", cropper)
    });

    $("#crop_usu").click(function(){

        canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400,
        });

        canvas.toBlob(function(blob) {

            var reader = new FileReader();
            reader.readAsDataURL(blob); 
            reader.onloadend = function() {
                var base64data = reader.result;  
            
                $.ajax({
                    url: "<?php echo base_url().'index.php?admin/usuarios/Inicioadmin/Upload_image_perfil'; ?>",
                    method: "POST",                	
                    data: {image_usu: base64data},
                    success: function(data){
                        console.log(data);
                        $modal_perfil.modal('hide');
                        $('#imagen_usuario_perfil').attr("src",data);
                        $('#uploaded_image').attr('src', data);
                    }
                });
            }
        });
    });
    
});
</script>