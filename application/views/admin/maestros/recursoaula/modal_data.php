<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <div class="col-md-12 row">

        <div class="form-group col-md-12">
            <label>Modalidad:</label>
        </div>            
        <div class="form-group col-md-12">
        <?= cbx_basicos('id_curso_forma_estudio',0,false,'lista_forma_estudio_curso',null,'id_curso_forma_estudio','nom_curso_forma_estudio'); ?>
        </div>
        

        <div class="form-group col-md-12">
            <label>Codigo Local Sede:</label>
        </div>            
        <div class="form-group col-md-12">
            <select class="form-control" tabindex="-1" id="codigo_local" name="codigo_local">
                <option value="0" >SELECCIONE</option>
                <option value="1" >SL01</option>
                <option value="2" >SL02</option>
                <option value="3" >SL03</option>
            </select>
        </div>
        

        <div class="form-group col-md-12">
            <label>NÚMERO DE RECURSO:</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="num_recurso" name="num_recurso" placeholder="Ingresar número de recurso" autofocus>
        </div>
        

        <div class="form-group col-md-12">
            <label>CODIGO DE RECURSO:</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="codigo_recurso" name="codigo_recurso" placeholder="Ingresar codigo de recurso" autofocus>
        </div>
        

        <div class="form-group col-md-12">
            <label>NOMBRE DE RECURSO:</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="nom_recurso" name="nom_recurso" placeholder="Ingresar nombre de recurso" autofocus>
        </div>
        

        
        <div class="form-group col-md-12">
            <label>TIPO DE RECURSO:</label>
        </div>            
        <div class="form-group col-md-12">
            <select class="form-control"  tabindex="-1" id="tipo_recurso" name="tipo_recurso">
                <option value="0" >SELECCIONE</option>
                <option value="1" >Herramienta Digital</option>
                <option value="2" >Otros Software</option>
            </select>

        </div>
        
     
        <div class="form-group col-md-12">
            <label>TIPO DE LICENCIA:</label>
        </div>            
        <div class="form-group col-md-12">
            <select class="form-control"  tabindex="-1" id="tipo_licencia" name="tipo_licencia">
                <option value="0" >SELECCIONE</option>
                <option value="1" >Contrato</option>
                <option value="2" >Libre</option>
            </select>

        </div>
        
        
        <div class="form-group col-md-12">
            <label>CANTIDAD DE AÑOS DE LICENCIA (EN CASO CORRESPONDA):</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="cant_anios_licencia" name="cant_anios_licencia" placeholder="Ingresar cantidad" autofocus>
        </div>
        
     
        <div class="form-group col-md-12">
            <label>DESCRIPCIÓN Y PRINCIPALES ACTIVIDADES:</label>
        </div>            
        <div class="form-group col-md-12">
        <textarea class="form-control" name="recurso_descrip" id="recurso_descrip" cols="20" rows="2"></textarea>
        </div>
        
     
        
        <div class="form-group col-md-12">
            <label>CANTIDAD DE PROGRAMA(S) QUE UTILIZAN EL RECURSO</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="cant_programas" name="cant_programas" placeholder="Ingresar cantidad" autofocus>
        </div>
        

        
        <div class="form-group col-md-12">
            <label>ANÁLISIS SOBRE LA CAPACIDAD Y PERTINENCIA DE DICHOS RECURSOS 
                DE ACUERDO AL TIPO DE PROGRAMA, CURSOS, NÚMERO DE ESTUDIANTES Y TIPO DE CONECTIVIDAD :</label>
        </div>            
        <div class="form-group col-md-12">
        <textarea class="form-control" name="analisis_pertinencia" id="analisis_pertinencia" cols="20" rows="2"></textarea>
        </div>


         
        <div class="form-group col-md-12">
            <label>COMENTARIOS :</label>
        </div>            
        <div class="form-group col-md-12">
        <textarea class="form-control" name="recurso_coment" id="recurso_coment" cols="20" rows="2"></textarea>
        </div>



        <div class="form-group col-md-12">
            <label>ESTADO :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>
        
    
    </div>  	           	                	        
<!-- </div> -->



