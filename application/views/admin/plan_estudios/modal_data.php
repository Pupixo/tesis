    <div class="col-md-12 row">

                <div class="form-group col-md-1">
                    <label>Año:</label>
                </div>
                <div class="form-group col-md-2">
                    <?= cbx_basicos('periodo_anio','0',false,'lista_anios_periodo',null,'periodo_anio','nom_periodo_anio'); ?>
                </div>

                <div class="form-group col-md-2">
                    <label>TIPO DE ESTUDIOS :</label>
                </div>            
                <div class="form-group col-md-7">
                    <!-- <input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Ingresar Modalidad" autofocus> -->

                    <?= cbx_basicos('id_tipo_estudios','0',false,'tipo_estudios',null,'id_tipo_estudios','nom_tipo_estudios'); ?>
                
                </div>


                <div class="form-group col-md-4">
                    <label>NOMBRE PLAN DE ESTUDIOS :</label>
                </div>            
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="plan_estudios" name="plan_estudios" placeholder="Ingresar Nombre de Plan de Estudios" autofocus>
                </div>

                <div class="form-group col-md-4">
                    <label>CÓDIGO PLAN DE ESTUDIOS :</label>
                </div>            
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="codigo_plan_estudios" name="codigo_plan_estudios" placeholder="Ingresar Nombre de Plan de Estudios" autofocus>
                </div>


                <div class="form-group col-md-4">
                    <label>MODALIDAD :</label>
                </div>            
                <div class="form-group col-md-12">
                    <!-- <input type="text" class="form-control" id="modalidad" name="modalidad" placeholder="Ingresar Modalidad" autofocus> -->

                    <select class="form-control"  id="modalidad" name="modalidad">
                        <option value="0" selected="">SELECCIONE</option>
                        <option value="PRESENCIAL">PRESENCIAL</option>
                        <option value="A DISTANCIA">A DISTANCIA</option>
                        <option value="SEMI-PRESENCIAL">SEMI-PRESENCIAL</option>
                    </select>
                
                </div>
                
                <div class="form-group col-md-4">
                    <label>GRADO QUE OTORGA :</label>
                </div>
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="grado_otorga" name="grado_otorga" placeholder="Apellido Grado que otorga" autofocus>
                </div>
                <div class="form-group col-md-4">
                    <label>TÍTULO PROFESIONAL :</label>
                </div>
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="titulo_prof" name="titulo_prof" placeholder="Apellido Título profesional" autofocus>
                </div>


                <div class="form-group col-md-4">
                    <label>CARRERA :</label>
                </div>
                <div class="form-group col-md-12">
                    <?= cbx_basicos('id_carrera_original','0',false,'lista_carreras',null,'id_carrera','nom_carrera'); ?>
                </div>




                <div class="form-group col-md-12">
                    <label>Filtros de cursos en los ciclos       
                    <button type="button" class="btn btn-secondary" data-container="body" title="" data-toggle="popover" data-placement="top" data-content="Este combobox no tiene otra función mas que ayudar a filtrar la aparición de los cursos en los selects de curso que estan en las filas de los ciclos, no se tendra registro de los datos al guardar" data-original-title="OJO" aria-describedby="popover60662">
                        <i class="fas fa-eye"></i>
                    </button>:  <input id="chkall_ciclo" onclick="Selec_Todo_Ciclo(this);"  type="checkbox" >Selecionar todas las carreras del filtro


                    </label>
                </div>
                <div class="form-group col-md-12">
                    <?= cbx_basicos_multiple('id_carrera',0,false,'lista_carrera_filtro',null,'id_carrera','nom_carrera'); ?>
                </div>



            


                <div class="form-group col-md-12">
                    <label>Agregar ciclo: &nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-secondary btn-circle" id="boton_agregar_ciclo_edit" onclick="AgregarCICLO()" title='Agregar Ciclo'><i class="fa fa-plus"></i> </button></label>
                </div>
                <div class="form-group col-md-12" id="vista_ciclo" >
                </div>

                
    </div>  	           	                	        
