<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <input name="password_original" type="hidden" id="password_original"  value="">
    <div class="col-md-12 row">

        <div class="form-group col-md-2">
            <label>Nivel: </label>
        </div>
        <div class="form-group col-md-10">
            <!-- <?= cbx_basicos('id_nivel',0,false,'nivel_usuario_general',null,'id_nivel','nom_nivel'); ?> -->
            <?= cbx_basicos('id_nivel', 0 ,false,'nivel_usuario_general','Nivel','id_nivel','nom_nivel','form-control','SELECCIONE',false,false); ?>

        </div>
        
    
        <div id="alumno"  class="form-group col-md-12"  style="display:none;"> 

            <div class="form-group col-md-12">
                <label>Plan estudios:</label>
            </div>            
            <div class="form-group col-md-12">
                <?= cbx_basicos('id_plan_estudios',0,false,'lista_plan_estudios','Plan_estudios','id_plan_estudios','nom_plan_estudios'); ?>
            </div>


            
            <div class="form-group col-md-12">
                <label>Número de Ciclo:</label>
            </div>            
            <div class="form-group col-md-12">
                <input type="text" class="form-control" id="num_ciclo" name="num_ciclo" placeholder="Ingresar nombres" autofocus>
            </div>

        </div>


        <div class="form-group col-md-2">
            <label>Estado: </label>
        </div>
        <div class="form-group col-md-10"> 
                <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>


        <div class="form-group col-md-2">
            <label>Nombres:</label>
        </div>            
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="usuario_nombres" name="usuario_nombres" placeholder="Ingresar nombres" autofocus>
        </div>
        
        <div class="form-group col-md-2">
            <label>Apellido Paterno:</label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="usuario_apater" name="usuario_apater" placeholder="Apellido Paterno" autofocus>
        </div>
        <div class="form-group col-md-2">
            <label>Apellido Materno:</label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="usuario_amater" name="usuario_amater" placeholder="Apellido Materno" autofocus>
        </div>
        <div class="form-group col-md-2">
            <label>Celular: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="Number" class="form-control" id="num_celp" name="num_celp" placeholder="Ingresar celular" autofocus>
        </div>

        <div class="form-group col-md-2">
            <label>Usuario: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="usuario_codigo" name="usuario_codigo" placeholder="Ingresar usuario" autofocus>
        </div>

        <div class="form-group col-md-2">
            <label>Email: </label>
        </div>
        <div class="form-group col-md-10">
            <input type="text" class="form-control" id="emailp" name="emailp" placeholder="Ingresar Email" autofocus>
        </div>
  
        <div class="form-group col-md-2">
            <label>Contraseña: </label>
        </div>
        <div class="form-group col-md-10">
            <input type="password" class="form-control" id="usuario_password" name="usuario_password" placeholder="Ingresar contraseña" autofocus>
        </div>
    </div>  	           	                	        
<!-- </div> -->



