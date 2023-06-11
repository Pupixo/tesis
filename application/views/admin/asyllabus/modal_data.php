    <div class="col-md-12 row">

    
        <input type="hidden" name="version_principal" id="version_principal">
        <div class="form-group col-md-2">
            <label>Estado: </label>
        </div>
        <div class="form-group col-md-10"> 
        <?= cbx_basicos('id_est_syllabus','0',true,'listado_estado_syllabus',null,'id_est_syllabus','nom_est_syllabus' ,'form-control','SELECCIONE',false); ?>
        </div>

        <div class="form-group col-md-2">
            <label>Nombre de Syllabus:</label>
        </div>            
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="nombre_syllabus" name="nombre_syllabus" placeholder="Ingresar nombre de silabus" autofocus>
        </div>
        
        <div class="form-group col-md-2">
            <label>Año de periodo:</label>
        </div>
        <div class="form-group col-md-2">
            <?= cbx_basicos('periodo_anio','0',false,'lista_anios_periodo',null,'periodo_anio','nom_periodo_anio'); ?>

        </div>
        <div class="form-group col-md-2">
            <select class="form-control" tabindex="-1" id="periodo_ciclo" name="periodo_ciclo">
                <option value="" selected="">SELECCIONE</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
        </div>

        <div class="form-group col-md-2">
            <label>Plan Estudios: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos_extra_element('id_plan_estudios',$_SESSION['usuario'][0]['id_usuario'],false,'lista_plan_estudios_aginado_usu','Plan_estudios','id_plan_estudios','nom_plan_estudios','form-control','SELECCIONE',false,false,'id_asignacion_plan_estudios'); ?>
        </div>

        <div class="form-group col-md-2">
            <label>Tipo de estudios:</label>
        </div>
        <div class="form-group col-md-4">

            <?= cbx_basicos('id_tipo_estudios',0,true,'tipo_estudios',null,'id_tipo_estudios','nom_tipo_estudios','form-control','SELECCIONE',false); ?>

        </div>


        <div class="form-group col-md-2">
            <label>Carrera:</label>
        </div>
        <div class="form-group col-md-4">

            <?= cbx_basicos('id_carrera','0',false,'lista_carreras','Carrera','id_carrera','nom_carrera'); ?>

        </div>

        
        
        <div class="form-group col-md-2">
            <label>Director: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos('id_director',0,true,'lista_directores',null,'id_director','nom_director','form-control','SELECCIONE',false); ?>
        </div>   

     


        
        <div class="form-group col-md-2">
            <label>Ciclo: </label>
        </div>
        <div class="form-group col-md-4">

            <select class="form-control" id="nom_ciclo" name="nom_ciclo" onchange="Ciclo(this)">
                <option value="0">Seleccionar</option>
            </select>

        </div>


        <div class="form-group col-md-2">
            <label>Curso ciclo: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos('id_curso',0,false,'lista_cursos','Curso','id_curso','nom_curso'); ?>
        </div>
        
      

        <div class="form-group col-md-2">
            <label>Créditos: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="creditos" name="creditos" placeholder="Ingresar creditos" autofocus readonly>
        </div>




        <div class="form-group col-md-2">
            <label>Horas Teoricas teoricas: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="horas_teoricas" name="horas_teoricas" placeholder="Ingresar horas teoricas" autofocus readonly>
        </div>

        <div class="form-group col-md-2">
            <label>Horas Practicas practicas: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="horas_practicas" name="horas_practicas" placeholder="Ingresar horas practicas" autofocus readonly>
        </div>

        <div class="form-group col-md-2">
            <label>Horas totales: </label>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" id="horas_totales" name="horas_totales" placeholder="Ingresar horas totales" autofocus readonly>
        </div>

        <div class="form-group col-md-2">
            <label>Requisito: </label>
        </div>
        <div class="form-group col-md-4">

        
            <select class="form-control" id="requisito" name="requisito[]" readonly multiple >
            </select>
            
        </div>

        <div class="form-group col-md-2">
            <label>Tipo de ciclo: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos('id_tipo_curso','0',true,'lista_tipo_curso',null,'id_tipo_curso','nom_tipo_curso','form-control','SELECCIONE',false); ?>

        </div>


        <div class="form-group col-md-2">
            <label>Presencilidad: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos('id_curso_forma_estudio','0',true,'lista_forma_estudio_curso',null,'id_curso_forma_estudio','nom_curso_forma_estudio','form-control','SELECCIONE',false); ?>

        </div>



        <div class="form-group col-md-2">
            <label>Condición: </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos('id_curso_importancia','0',true,'lista_importancia_curso',null,'id_curso_importancia','nom_curso_importancia','form-control','SELECCIONE',false); ?>

        </div>


        <div class="form-group col-md-2">
            <label>Docente : </label>
        </div>
        <div class="form-group col-md-4">
            <?= cbx_basicos_multiple('id_docente', 0 ,false,'lista_docentes',null,'id_docente','nom_docente'); ?>
        </div>

    </div>  	           	                	        



