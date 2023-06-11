<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <div class="col-md-12 row">

        <div class="form-group col-md-4">
            <label>NOMBRE DE CARRERA :</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="nom_carrera" name="nom_carrera" placeholder="Ingresar Nombre de la carrera" autofocus>
        </div>
    

        <div class="form-group col-md-4">
            <label>Director: </label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_director',0,false,'lista_directores',null,'id_director','nom_director'); ?>
        </div>   

    
        <div class="form-group col-md-4">
            <label>ESTADO :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>
        
    
    </div>  	           	                	        
<!-- </div> -->



