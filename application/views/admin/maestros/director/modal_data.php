<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <div class="col-md-12 row">

        <div class="form-group col-md-12">
            <label>NOMBRE DE DIRECTOR:</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="nom_director" name="nom_director" placeholder="Ingresar Nombre deL director" autofocus>
        </div>
        
        <div class="form-group col-md-12">
            <label>ESTADO :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>
        
    
    </div>  	           	                	        
<!-- </div> -->



