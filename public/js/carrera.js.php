<script>
  
    var url_general = "<?php echo base_url().'index.php?'; ?>";

    function fnDataGeneral(){
        /* VARIABLES POR DEFECTO A CARGAR, pueden agregarse mas segun el programador */
        var abrev = "<?php echo $abrev; ?>";
        var opcion = "<?php echo $opcion; ?>";

        var formPrincipal ="<?php echo $formPrincipal; ?>";
        var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";
        var base_url = "<?= base_url() ?>";
        var mydata = {
            _abrev      : abrev,
            _nombre : opcion,
            __wurl          : wurl,
            modal_principal : '#modal_largo_'+abrev,
            formulario_principal: "#"+formPrincipal,
            _tabla                :'#tbl'+abrev,
            _base_url :base_url
        };

        return mydata;
    }
    
    function loading_tabla(flag) {
        var objGeneral = fnDataGeneral();
        // setTimeout(function(){  
        //     $(objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12').addClass( "altura_tabla-unopx" ) 
        //     }, 100);

        // if (flag) {

        //     $(objGeneral._tabla+'_wrapper .row:nth-child(2)').prepend('<div class="content-loading" >\
        //     <img style="width: 100px;height: 100px;" src="'+objGeneral._base_url+'assets/images/loading-tabla.gif" />\
        //    </div>');
           
      

        //     setTimeout(function(){  
        //          $(objGeneral._tabla).removeClass("invisible ");   
        //     }, 700);
           
        // } else {
        //    setTimeout(function(){ 
        //     $( ".content-loading" ).remove();
        //     $(objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12').removeClass( "altura_tabla-unopx" ) 
 
        // }, 500);         
        //}
    }

    function cargarTabla<?php echo $opcion; ?>(){
        var objGeneral = fnDataGeneral();

        $(objGeneral._tabla).dataTable().fnDestroy();
        
        $(objGeneral._tabla).on('processing.dt', function (e, settings, processing) {
        processing ? loading_tabla(true) : loading_tabla(false);
        }).dataTable({
            //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
            "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
            "pageLength": 10,
            "order": [[1, "desc"]],
            "processing": false,
            "serverSide": false,
            "ajax": { url : objGeneral.__wurl + "cargar_tabla_<?php echo $opcion; ?>",  type : 'POST' },
            "responsive": true,
            "columns": [
                {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_CARRERA"},
                {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "NOM_DIRECTOR" },
                {"data": "NOM_ESTATUS" },
                {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "FEG_REG" },
                {"data": "ACCION" }
            ]
        });
        return false;
    }   

    $(document).ready(function() {
        cargarTabla<?php echo $opcion; ?>();
        var msgDate = '';
        var inputFocus = '';

        /********* */


        $("#cbx_basicos_id_director").select2({
        width: 'resolve',
        });
        


    });

    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();

        $(objGeneral.modal_principal+" "+'#nom_carrera').val('');
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(0);
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val(0);
        $(objGeneral.modal_principal+" "+"#cbx_basicos_id_director").trigger("change");

        /*id para actualizar */
        $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val('');

	}

    function fn_AbrirModal(Accion,id_row,fila,funcion_name){

        var objGeneral = fnDataGeneral();
        fn_limpiarPopup();
        $(objGeneral.modal_principal+" "+".modal-footer").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>\
        <button type='button' class='btn btn-primary' onclick="+funcion_name+"('"+Accion+"');>Guardar</button>");

        if( Accion === 'I'){

            $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Registrar '+objGeneral._nombre);

        }else if(Accion === 'A') {

                var data = $(objGeneral._tabla).DataTable().row(fila).data();
                console.log("🚀 ~ file: curso.js.php ~ line 174 ~ fn_AbrirModal ~ data", data)
                /* Poner data en modal */
                $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Actualizar '+objGeneral._nombre +' ' +data['NOM_CARRERA']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);               
                //---

                $(objGeneral.modal_principal+" "+'#nom_carrera').val(data['NOM_CARRERA']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(data['ESTADO']);

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val(data['ID_DIRECTOR']);
                $(objGeneral.modal_principal+" "+"#cbx_basicos_id_director").trigger("change");


        }else{            
       
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_<?php echo $opcion; ?>() {
        var objGeneral = fnDataGeneral();

        if($(objGeneral.modal_principal+" "+'#nom_carrera').val().trim() === '') {
            msgDate = 'Debe ingresar un nombre para la carrera';
            inputFocus = '#nom_carrera';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val().trim() === '0') {
            msgDate = 'Debe seleccionar un director de la carrera';
            inputFocus = '#id_status';
            return false;
        }   


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val().trim() === '0') {
            msgDate = 'Debe seleccionar un estado';
            inputFocus = '#id_status';
            return false;
        }      
        
        return true;
    }

    function Insert_Update_<?php echo $opcion; ?>(Accion){
        var objGeneral = fnDataGeneral();
        var dataString = $(objGeneral.modal_principal+" "+objGeneral.formulario_principal).serialize();
        console.log(objGeneral.modal_principal+" "+objGeneral.formulario_principal);

           console.log(dataString);
                if (Valida_<?php echo $opcion; ?>()) {
                    if(Accion === "A"){
                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Update_<?php echo $opcion; ?>',
                            data  : dataString, 
                            })
                            .done(function(data) {
                                swal.fire(
                                    'Actualización Exitosa!',
                                    'Haga clic en el botón!',
                                    'success'
                                    ).then(function() {
                                        window.location = objGeneral.__wurl;
                                    });
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                someErrorFunction();
                            })
                            .always(function() {});
                    }else if(Accion === "I"){
                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Insert_<?php echo $opcion; ?>',
                            data  : dataString, 
                            })
                            .done(function(data) {
                                swal.fire(
                                        'Registo Exitoso!',
                                        'Haga clic en el botón!',
                                        'success'
                                    ).then(function() {
                                        window.location = objGeneral.__wurl;
                                    });
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                someErrorFunction();
                            })
                            .always(function() {});
                    }else{

                    }
                }else{
                    bootbox.alert(msgDate)
                    var input = $(inputFocus).parent();
                    $(input).addClass("has-error");
                    $(input).on("change", function () {
                        if ($(input).hasClass("has-error")) {
                            $(input).removeClass("has-error");
                        }
                    });
                }
    }

    function Eliminar_<?php echo $opcion; ?>(id){
        var objGeneral = fnDataGeneral();

        var id = id;
        Swal.fire({
            //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
            title: '¿Realmente desea eliminar el registro',
            text: "El registro será eliminado permanentemente",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Delete_<?php echo $opcion; ?>',
                    data: {'id':id},
                    success:function () {
                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado satisfactoriamente.',
                            'success'
                        ).then(function() {
                            window.location = objGeneral.__wurl;
                        });
                    }
                });
            }
        })
    }   


    $(document).on("hidden.bs.modal", ".bootbox.modal", function (e) {

        console.log('2nd level modal closed');
        jQuery("body").addClass("modal-open");
    });


    //-------------------------------------------

</script>