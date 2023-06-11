<!-- <div class="modal-body" style="max-height:700px; overflow:auto;"> -->
    <div class="col-md-12 row">

        <div class="form-group col-md-12">
            <label>NOMBRE DE NIVEL:</label>
        </div>            
        <div class="form-group col-md-12">
            <input type="text" class="form-control" id="nom_nivel" name="nom_nivel" placeholder="Ingresar Nombre del nivel" autofocus>
        </div>
        
        <div class="form-group col-md-12">
            <label>ESTADO :</label>
        </div>
        <div class="form-group col-md-12">
            <?= cbx_basicos('id_status',0,false,'estados_general',null,'id_status','nom_status'); ?>
        </div>
        
    
    </div>  	           	                	        
<!-- </div> -->



