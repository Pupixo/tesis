<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <div class="col-md-12 row">

        <div class="form-group col-md-4">
            <label>CÓDIGO  :</label>
        </div>
        <div class="form-group col-md-12">
            <input type="text" class="form-control"  maxlength="8"  id="codigo" name="codigo" placeholder="Ingresar Código" autofocus>
        </div>


        <div class="form-group col-md-4">
            <label>NOMBRE DE CURSO :</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="nom_curso" name="nom_curso" placeholder="Ingresar Nombre de Curso" autofocus>
        </div>
        
        <hr style="width: 90%;">
      
                        <!-- ññññññññññññññññññññññññññññññññ   HORAS TEÓRICAS  ññññññññññññññññññññññññññññññññññññññññññ -->


        <div class="form-group col-md-6 text-right">
            <label>HORAS TEÓRICAS :</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control"  readonly id="horas_teoricas" name="horas_teoricas" placeholder="Ingresar horas teóricas" autofocus>
        </div>
        <div class="form-group col-md-4">
        </div>

        <div class="form-group col-md-2" >
            <label data-toggle="tooltip" data-placement="top" title="HORAS TEÓRICAS PRESECNIALES"> H. T. P.:</label>

        </div>
        <div class="form-group col-md-2">
            <input type="text" maxlength="2" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="horas_teoricas_presencial" name="horas_teoricas_presencial" placeholder="Ingresar horas teóricas presencial" autofocus>
        </div>

        
        <div class="form-group col-md-2">
            <label  data-toggle="tooltip" data-placement="top" title="HORAS TEÓRICAS SÍNCRONAS">H. S.:</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text"  maxlength="2"  class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="horas_sincronas_teoricas" name="horas_sincronas_teoricas" placeholder="Ingresar" autofocus>
        </div>

        <div class="form-group col-md-2">
            <label   data-toggle="tooltip" data-placement="top" title="HORAS TEÓRICAS ASÍNCRONAS">H. A.:</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text"  maxlength="2"  class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="horas_asincronas_teoricas" name="horas_asincronas_teoricas" placeholder="Ingresar" autofocus>
        </div>

    <!-- 
        <div class="form-group col-md-2">
            <label>H. T. T.: (Se calculará automaticamente)</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" readonly id="horas_teoricas" name="horas_teoricas" placeholder="Ingresar horas teóricas" autofocus>
        </div> -->

        <!-- kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk    HORAS PRÁCTICAS    kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk -->

        <div class="form-group col-md-6 text-right">
            <label>HORAS PRÁCTICAS :</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control"  id="horas_practicas" readonly name="horas_practicas" placeholder="Ingresar horas practicas" autofocus>
        </div>
        <div class="form-group col-md-4">
        </div>

        <div class="form-group col-md-2">
            <label   data-toggle="tooltip" data-placement="top" title="HORAS PRÁCTICAS PRESENCIALES">H. P. P. :</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text"  maxlength="2"  class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="horas_practicas_presencial" name="horas_practicas_presencial" placeholder="Ingresar horas prácticas presencial"  autofocus>
        </div>  
        
        <div class="form-group col-md-2">
            <label data-toggle="tooltip" data-placement="top" title="HORAS PRÁCTICAS SÍNCRONAS">H.S.:</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text"  maxlength="2"  class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="horas_sincronas_practicas" name="horas_sincronas_practicas" placeholder="Ingresar" autofocus>
        </div>

        <div class="form-group col-md-2">
            <label data-toggle="tooltip" data-placement="top" title="HORAS PRÁCTICAS ASÍNCRONAS">H.A.:</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text"  maxlength="2"  class="form-control"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  id="horas_asincronas_practicas" name="horas_asincronas_practicas" placeholder="Ingresar" autofocus>
        </div>

        <!-- <div class="form-group col-md-2">
            <label>H. P. T.: (Se calculará automaticamente)</label>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control"  id="horas_practicas" readonly name="horas_practicas" placeholder="Ingresar horas practicas" autofocus>
        </div>      -->
        
        <div class="form-group col-md-12 text-center">
            <label>HORAS TOTALES : (Se calculará automaticamente)</label>
        </div>
        <div class="form-group col-md-12">
            <input readonly  type="text" class="form-control" id="horas_totales" name="horas_totales" placeholder="horas totales" autofocus>
        </div>


                        <!-- ññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññññ -->
                
        <hr style="width: 90%;">


        <div class="form-group col-md-3">
            <label>CRÉDITOS PRESENCIALES: (Se calculará automaticamente) </label>
        </div>
        <div class="form-group col-md-3">
            <input type="text"  readonly class="form-control" id="creditos_presencial" name="creditos_presencial" placeholder="Ingresar "  autofocus>
        </div>

        <div class="form-group col-md-3">
            <label>CRÉDITOS VIRTUALES : (Se calculará automaticamente) </label>
        </div>
        <div class="form-group col-md-3">
            <input type="text" readonly class="form-control" id="creditos_virtual" name="creditos_virtual" placeholder="Ingresar "  autofocus>
        </div>

        <div class="form-group col-md-12">
            <label>CRÉDITOS : (Se calculará automaticamente)</label>
        </div>
        <div class="form-group col-md-12">
            <input type="text" readonly class="form-control" id="creditos" name="creditos" placeholder="Ingresar créditos"  autofocus>
        </div>


        <div class="form-group col-md-4">
            <label>REQUISITOS :</label>
        </div>            
        <div class="form-group col-md-12">
            <!-- <input type="text" class="form-control" id="requisitos" name="requisitos" placeholder="Ingresar Requisitos" autofocus> -->
            <?= cbx_basicos_multiple('id_curso', 0 ,false,'lista_cursos',null,'id_curso','nom_curso'); ?>

        </div>
        
        <div class="form-group col-md-4">
            <label>TIPO DE CURSO :</label>
        </div>
        <div class="form-group col-md-12" >
            <?= cbx_basicos('id_tipo_curso',0,false,'lista_tipo_curso','TIPO_CURSO','id_tipo_curso','nom_tipo_curso'); ?>
        </div>

        <div class="form-group col-md-12 tip_carrera">
            <label>Carrera  <b class="text-danger">*</b> :</label>
        </div>
        <div class="form-group col-md-12 tip_carrera">
            <?= cbx_basicos('id_carrera','0',false,'lista_carreras',null,'id_carrera','nom_carrera'); ?>
        </div>



        <div class="form-group col-md-4">
            <label>PRESENCIALIDAD :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_curso_forma_estudio',0,false,'lista_forma_estudio_curso',null,'id_curso_forma_estudio','nom_curso_forma_estudio'); ?>
        </div>

        <div class="form-group col-md-4">
            <label>OBLIGATORIEDAD :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_curso_importancia',0,false,'lista_importancia_curso','OBLIGATORIO_FN','id_curso_importancia','nom_curso_importancia'); ?>
        </div>

        <div class="form-group col-md-4">
            <label>ESTADO :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>
    </div>  	           	                	        
<!-- </div> -->



