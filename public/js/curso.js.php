<script>

    var url_general = "<?php echo base_url().'index.php?'; ?>";

    function fnDataGeneral(){
        /* VARIABLES POR DEFECTO A CARGAR, pueden agregarse mas segun el programador */
        var abrev = "<?php echo $abrev; ?>";
        var formPrincipal ="<?php echo $formPrincipal; ?>";
        var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";
        var base_url = "<?= base_url() ?>";
        var mydata = {
            _abrev      : abrev,
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
            //     $(objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12').addClass( "altura_tabla-unopx");
            // }, 20000000000000);
            //     console.log("🚀 ~ file: curso.js.php:28 ~ setTimeout ~ objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12':", objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12')

            //     if (flag) {

            //         $(objGeneral._tabla+'_wrapper .row:nth-child(2)').prepend('<div class="content-loading" >\
            //             <img style="width: 100px;height: 100px;" src="'+objGeneral._base_url+'assets/images/loading-tabla.gif" />\
            //         </div>');
                    
            

            //         setTimeout(function(){  
            //          //   $(objGeneral._tabla).removeClass("invisible ");   
            //         }, 20000000000000);
                
            //     } else {
            //         setTimeout(function(){ 
            //             $( ".content-loading" ).remove();
            //             $(objGeneral._tabla+'_wrapper .row:nth-child(2) .col-sm-12').removeClass( "altura_tabla-unopx" ) 
            
            //         }, 20000000000000);         
            //     }
    }

    function cargarTabla<?php echo $opcion; ?>(){
        var objGeneral = fnDataGeneral();

        $(objGeneral._tabla).dataTable().fnDestroy();
        
        $(objGeneral._tabla).on('processing.dt', function (e, settings, processing) {

        processing ? loading_tabla(true) : loading_tabla(false);
        
        }).dataTable({
         
            lengthMenu: [[5,10, 25, 50, -1], ['5','10', '25', '50', 'Show all']],
            "pageLength": 10,
            "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
            "order": [[0, "desc"]],
            "aProcessing": true, //Activamos el procesamiento del datatables
            "aServerSide": true, //Paginación y filtrado realizados por el servidor
            // "dom": '<"top d-flex justify-content-center""B><"top"lf>rt<"bottom"ip><"clear">',
            // "dom": '<"top d-flex justify-content-center""><"top"lf>rt<"bottom"ip><"clear">',

            // buttons: [
            // {  
            //     extend: 'copy'
            // },
            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //         columns: [0,1] // Column index which needs to export
            //     }
            // },
            // {
            //     extend: 'csv',
            // },
            // {
            //     extend: 'excel',
            // } 
            // ],

            "ajax": { url : objGeneral.__wurl + "cargar_tabla_cursos",  type : 'POST' },
            "responsive": true,
            "columns": [
                {"data": "ID_CURSO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_CURSO"},
                {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_CARRERA"},
                {"data": "ID_PLAN_ESTUDIOS" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "CODIGO" },
                {"data": "CREDITOS" },
                {"data": "HORAS_TEORICAS" },
                {"data": "HORAS_TOTALES"},
                {"data": "HORAS_PRACTICAS"},
                {"data": "REQUISITOS"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false , "searchable": false },
                {"data": "TIPO_CURSO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "TIPO_CURSO_NOM"  ,"searchable": false },
                {"data": "PRESENCIALIDAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "PRESENCIALIDAD_NOM"  ,  "searchable": false },
                {"data": "OBLIGATORIEDAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "OBLIGATORIEDAD_NOM"  , "searchable": false },
                {"data": "NOM_ESTATUS" },
                {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                
                {"data": "HORAS_SINCRO_TEOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "HORAS_ASINCRO_TEOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "HORAS_PRESEN_TEOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "HORAS_SINCRO_PRAC" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "HORAS_ASINCRO_PRAC" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "HORAS_PRESEN_PRAC" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },

                {"data": "CREDITOS_PRESENCIAL" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "CREDITOS_VIRTUAL" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },

                
                {"data": "ACCION" }
            ],
            'searchBuilder': {
                columns: [1]
            },
       
        });
        // console.log("🚀 ~ file: curso.js.php:104 ~ columns:")

        
        return false;
    }   

    $(document).ready(function() {
        cargarTabla<?php echo $opcion; ?>();
        var msgDate = '';
        var inputFocus = '';

        /********* */
            var objGeneral_exec = fnDataGeneral();
            $(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val(sum);

                sumar_horas();
            });        



            $(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val(sum);
                
                sumar_horas();
            });        



            $(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val(sum);
                sumar_horas();

            });        
            //----------------------
            //----------------------
            //----------------------
            //----------------------
            $(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val(sum);
                sumar_horas();

            });        



            $(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val(sum);
                sumar_horas();

            });        



            $(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').focusout(function(){
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val('');

                var val_1 = ( ($(this).val() === '') ? 0 :$(this).val()) ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val())    ;
                var val_3 =  ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val())    ;

                var sum = parseFloat(val_1)+ parseFloat(val_2)+ parseFloat(val_3) ;
                $(objGeneral_exec.modal_principal+" "+'#horas_practicas').val(sum);
                sumar_horas();

            });  


        /********* */

        // $(objGeneral_exec.modal_principal+" "+'#cbx_basicos_id_carrera').select2();

        $(objGeneral_exec.modal_principal+" "+"#cbx_multiple_id_curso").select2();

    });

    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();

        $(objGeneral.modal_principal+" "+'#nom_curso').val('');
    	$(objGeneral.modal_principal+" "+'#codigo').val('');

		$(objGeneral.modal_principal+" "+'#creditos').val('');
    	$(objGeneral.modal_principal+" "+'#horas_teoricas').val(0);

        $(objGeneral.modal_principal+" "+'#horas_sincronas_teoricas').val(0);
    	$(objGeneral.modal_principal+" "+'#horas_asincronas_teoricas').val(0);
    	$(objGeneral.modal_principal+" "+'#horas_teoricas_presencial').val(0);


        $(objGeneral.modal_principal+" "+'#horas_practicas').val(0);

        $(objGeneral.modal_principal+" "+'#horas_sincronas_practicas').val(0);
    	$(objGeneral.modal_principal+" "+'#horas_asincronas_practicas').val(0);
    	$(objGeneral.modal_principal+" "+'#horas_practicas_presencial').val(0);


        $(objGeneral.modal_principal+" "+'#horas_totales').val('');

        $(objGeneral.modal_principal+" "+'#creditos_presencial').val('');
    	$(objGeneral.modal_principal+" "+'#creditos_virtual').val('');


        $(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val('');

        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val(0);
        $( objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').trigger("change");               

    	$(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);
    	$(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(0);

        /* select multiple */
                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso > option").removeAttr("selected");
                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso").trigger("change");

                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso").val("");
                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso").trigger("change");
        /* select multiple */

        /*id para actualizar */
        $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val('');       

	}

    function fn_AbrirModal(Accion,id_row,fila,funcion_name){


        var objGeneral = fnDataGeneral();
        fn_limpiarPopup();
        $(objGeneral.modal_principal+" "+".modal-footer").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>\
        <button type='button' class='btn btn-primary' onclick="+funcion_name+"('"+Accion+"');>Guardar</button>");

        $( objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso' ).trigger( "change" );


        if( Accion === 'I'){

            $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Registrar Curso');

        }else if(Accion === 'A') {

                var data = $(objGeneral._tabla).DataTable().row(fila).data();
                console.log("🚀 ~ file: curso.js.php ~ line 174 ~ fn_AbrirModal ~ data", data)
                /* Poner data en modal */
                $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Actualizar Curso '+data['NOM_CURSO']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);

               
                //---

                $(objGeneral.modal_principal+" "+'#nom_curso').val(data['NOM_CURSO']);
                $(objGeneral.modal_principal+" "+'#codigo').val(data['CODIGO']);

                $(objGeneral.modal_principal+" "+'#creditos').val(data['CREDITOS']);
                $(objGeneral.modal_principal+" "+'#horas_teoricas').val(data['HORAS_TEORICAS']);
 
 
                $(objGeneral.modal_principal+" "+'#horas_sincronas_teoricas').val(data['HORAS_SINCRO_TEOR']);
                $(objGeneral.modal_principal+" "+'#horas_asincronas_teoricas').val(data['HORAS_ASINCRO_TEOR']);
                $(objGeneral.modal_principal+" "+'#horas_teoricas_presencial').val(data['HORAS_PRESEN_TEOR']);

                $(objGeneral.modal_principal+" "+'#creditos_presencial').val(data['CREDITOS_PRESENCIAL']);


                $(objGeneral.modal_principal+" "+'#horas_practicas').val(data['HORAS_PRACTICAS']);

                $(objGeneral.modal_principal+" "+'#horas_sincronas_practicas').val(data['HORAS_SINCRO_PRAC']);
                $(objGeneral.modal_principal+" "+'#horas_asincronas_practicas').val(data['HORAS_ASINCRO_PRAC']);
                $(objGeneral.modal_principal+" "+'#horas_practicas_presencial').val(data['HORAS_PRESEN_PRAC']);

                $(objGeneral.modal_principal+" "+'#creditos_virtual').val(data['CREDITOS_VIRTUAL']);


                $(objGeneral.modal_principal+" "+'#horas_totales').val(data['HORAS_TOTALES']);

                // $(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val(data['REQUISITOS']);


                /*select multiple */
                var ids_cursos = data['REQUISITOS'];
                    console.log("🚀 ~ file: curso.js.php ~ line 202 ~ fn_AbrirModal ~ ids_cursos", ids_cursos)
                    var ids_cursos_data = ids_cursos.split(','); 
                        $.each(ids_cursos_data, function(index, value) {
                                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso > option[value='"+value+"']").prop("selected","selected");
                                $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso").trigger("change");
                        });
                /* */



                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(data['TIPO_CURSO']);
                $( objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso' ).trigger( "change" );

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val(data['ID_CARRERA']);
                $( objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera' ).trigger( "change" );               

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(data['PRESENCIALIDAD']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(data['OBLIGATORIEDAD']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(data['ESTADO']);
                
        }else{            
          
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_<?php echo $opcion; ?>() {
        var objGeneral = fnDataGeneral();

        
           
            if($(objGeneral.modal_principal+" "+'#codigo').val().trim() === '') {
                msgDate = 'Debe seleccionar un código';
                inputFocus = '#codigo';
                return false;
            }

     
      

        if($(objGeneral.modal_principal+" "+'#nom_curso').val().trim() === '') {
            msgDate = 'Debe ingresar un nombre para el curso';
            inputFocus = '#nom_curso';
            return false;
        }

        // L

        if($(objGeneral.modal_principal+" "+'#horas_sincronas_teoricas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas sicronas teoricas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_sincronas_teoricas';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#horas_asincronas_teoricas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas asicronas teoricas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_asincronas_teoricas';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#horas_teoricas_presencial').val().trim() === '') {
            msgDate = 'Debe ingresar las horas presencial teoricas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_teoricas_presencial';
            return false;
        }

        //L
        if($(objGeneral.modal_principal+" "+'#horas_teoricas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas teoricas';
            inputFocus = '#horas_teoricas';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#horas_practicas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas prácticas';
            inputFocus = '#horas_practicas';
            return false;
        }

        // L
        if($(objGeneral.modal_principal+" "+'#horas_sincronas_practicas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas sicronas practicas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_sincronas_practicas';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#horas_asincronas_practicas').val().trim() === '') {
            msgDate = 'Debe ingresar las horas asicronas practicas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_asincronas_practicas';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#horas_practicas_presencial').val().trim() === '') {
            msgDate = 'Debe ingresar las horas presencial practicas, si es cero "0" entonces registrelo';
            inputFocus = '#horas_practicas_presencial';
            return false;
        }

        
        if($(objGeneral.modal_principal+" "+'#creditos').val().trim() === '') {
            msgDate = 'Debe ingresar los créditos del curso';
            inputFocus = '#creditos';
            return false;
        }        
        if($(objGeneral.modal_principal+" "+'#creditos_presencial').val().trim() === '') {
            msgDate = 'Debe ingresar los créditos presencial del curso';
            inputFocus = '#creditos_presencial';
            return false;
        }
                
        if($(objGeneral.modal_principal+" "+'#creditos_virtual').val().trim() === '') {
            msgDate = 'Debe ingresar los créditos virtual del curso';
            inputFocus = '#creditos_virtual';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val().trim() === '1'){
            if($(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val().length == 0) {
                    msgDate = 'Debe ingresar los requisitos del curso';
                    inputFocus = '#cbx_multiple_id_curso';
                    return false;
            }
        }
           

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val().trim() === '0') {
            msgDate = 'Debe seleccionar el tipo de curso';
            inputFocus = '#cbx_basicos_id_tipo_curso';
            return false;
        }  
        
        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val().trim() === '2') {
            if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val().trim() === '0') {
                msgDate = 'Debe seleccionar la carrera';
                inputFocus = '#cbx_basicos_id_carrera';
                return false;
            }  
        }  
        
        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim() === '0') {
            msgDate = 'Debe seleccionar la foma de estudio';
            inputFocus = '#id_curso_forma_estudio';
            return false;
        }      

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val().trim() === '0') {
            msgDate = 'Debe seleccionar el tipo de importancia del curso';
            inputFocus = '#id_curso_importancia';
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
        $(objGeneral.modal_principal+" "+'#boton_guardar_manage').attr("disabled", true);	

        if($(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val().length == 0) {
            var dataString = dataString + "&cbx_multiple_id_curso=null"
        }        

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
                                        $(objGeneral.modal_principal+" "+'#boton_guardar_manage').attr("disabled", false);	

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
                                        $(objGeneral.modal_principal+" "+'#boton_guardar_manage').attr("disabled", false);	

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
        var url="admin/usuarios/Usuarios/Delete_Usuario";
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
                    data: {'id_cursos':id},
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

    /* FUNCIONES ESPECIFICAS DE LA VISTA */

    function TIPO_CURSO(data){

        var objGeneral = fnDataGeneral();

        var  valor  = data.value ;
        if(valor==1){

            $(objGeneral.modal_principal+" "+'.tip_carrera').css({"display": "none"});

            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val(0)
            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').trigger("change");

        }else if(valor==2){
            $(objGeneral.modal_principal+" "+'.tip_carrera').css({"display": ""});
            console.log("🚀 ~ file: curso.js.php:627 ~ TIPO_CURSO ~ objGeneral.modal_principal:", objGeneral.modal_principal)
            
            // $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').select2('destroy');

            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').select2();

        }else{
            $(objGeneral.modal_principal+" "+'.tip_carrera').css({"display": "none"});       
        }
      
    }   

    function CALCULO_HORAS(data){

        var objGeneral = fnDataGeneral();
        var  valor  = data.value ;


        var credTeoria= 16 * valor;
        var credPractica= 32 * valor;

        var credTotal= credTeoria+credPractica;

        $(objGeneral.modal_principal+" "+'#horas_teoricas').val(credTeoria);
        $(objGeneral.modal_principal+" "+'#horas_practicas').val(credPractica);

        $(objGeneral.modal_principal+" "+'#horas_totales').val(credTotal);


    }

    function sumar_horas(){

        var objGeneral_exec = fnDataGeneral();


        var credTeoria= ( ($(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_teoricas').val()) ;
        var credPractica=  ( ($(objGeneral_exec.modal_principal+" "+'#horas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_practicas').val())  ;

        var credTotal= parseFloat(credTeoria) + parseFloat(credPractica);

        $(objGeneral_exec.modal_principal+" "+'#horas_totales').val(credTotal);
        
        
        creditos_presenciales();

    }
    
    function creditos_presenciales(){

        var objGeneral_exec = fnDataGeneral();


        var practicas_presencial= ( ($(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_practicas_presencial').val());
        var teoria_presencial=  ( ($(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_teoricas_presencial').val());




        var total= parseInt((parseFloat(teoria_presencial)/16)+(parseFloat(practicas_presencial)/32));

        $(objGeneral_exec.modal_principal+" "+'#creditos_presencial').val(total);


        creditos_virtuales();

    }

    function creditos_virtuales(){

        var objGeneral_exec = fnDataGeneral();


        var horas_sincronas_practicas= ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_practicas').val());
        var horas_asincronas_practicas=  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_practicas').val());


        var horas_sincronas_teoricas= ( ($(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_sincronas_teoricas').val());
        var horas_asincronas_teoricas=  ( ($(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#horas_asincronas_teoricas').val());



        var total= parseInt(( ( parseFloat(horas_sincronas_practicas) +  parseFloat(horas_asincronas_practicas) ) /32 )+( ( parseFloat(horas_sincronas_teoricas) + parseFloat(horas_asincronas_teoricas) )/16)  );

        $(objGeneral_exec.modal_principal+" "+'#creditos_virtual').val(total);

        creditos_sum();
    }

    function creditos_sum(){

        var objGeneral_exec = fnDataGeneral();



            
        var val_1 =  ( ($(objGeneral_exec.modal_principal+" "+'#creditos_presencial').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#creditos_presencial').val())    ;
                var val_2 =  ( ($(objGeneral_exec.modal_principal+" "+'#creditos_virtual').val() === '') ? 0 :$(objGeneral_exec.modal_principal+" "+'#creditos_virtual').val())    ;

                    var sum = parseFloat(val_1)+ parseFloat(val_2) ;
                    $(objGeneral_exec.modal_principal+" "+'#creditos').val(sum);
    }

    // function OBLIGATORIO_FN(){

    //     var objGeneral = fnDataGeneral();

    //     if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val().trim() === '2'  ) {
            
    //         $(objGeneral.modal_principal+" "+'#codigo').val('');
    //         $(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val('');

    //         $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso > option").removeAttr("selected");
    //         $(objGeneral.modal_principal+" "+"#cbx_multiple_id_curso").trigger("change");


    //         // $(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').val(77).trigger( "change" );
    //         // $(objGeneral.modal_principal+" "+'#cbx_multiple_id_curso').prop("",true);

    //     }


    // }


    
//----------------------------------------------

    const Agrupar_por = (array, key) => {
        return array.reduce((result, currentValue) => {
            (result[currentValue[key]] = result[currentValue[key]] || []).push(
                currentValue
            );
                return result;
        }, {}); 
    };
    
    function Competencia_data(id){
        $('#modal_dicionario_curso').modal('show');       
        var objGeneral = fnDataGeneral();
        var id_curso = id;
        $( '#modal_dicionario_curso'+' #id_curso').val(id_curso);
        
        $( '#modal_dicionario_curso #fullWidthModalLabel_titulo').text(id ==='' ? 'COMPETENCIAS GENERALES' : 'COMPETENCIAS ESPECIFICAS');
        $( '#modal_dicionario_curso #tbl_tabla #titulo_compet').text(id ==='' ? 'COMPETENCIAS GENERALES' : 'COMPETENCIAS ESPECIFICAS');
        $('#modal_dicionario_curso #botonagregar').attr("onClick", "Agregar_competencia('"+(id ==='' ? "G" : "E")+"')");


        $( '#modal_dicionario_curso'+' #tbl_tabla tbody').empty();
        
        $('#modal_dicionario_curso'+' #tbl_tabla tbody').html(`
            <tr>
                <td colspan="5"> 
                    <div style="height: 15pc; display: flex;   justify-content: center; align-items: center;">
                        <div class="spinner_seccion"></div>
                    </div>
                </td>
            </tr>
        `);   


        $.ajax({
            type:"POST",
            url:  objGeneral.__wurl+'Listar_Diccionario_Compt',
            data: {'id_curso':id_curso},
            success:function (data) {

                var data = JSON.parse(data);
                            console.log("🚀 ~ file: carrera.js.php:303 ~ data:", data)

                            var htmldata='';

                        $.each(data, function(index, value) {
                                         
                            htmldata+=  `    <tr>
                                                <td scope="row"  tipo_compt="${(id ==='' ? 1 : 2)}">
                                                    ${index+1}  </br>

                                                    <button type="button"  id="guardar"  onclick="Guardar_fila(this,'${value.id_diccionario_competen}')" class="btn btn-secondary btn-circle"><i class="fa fa-pencil"></i></i></button>
                                                    <button type="button"  onclick="Eliminar_fila(this,'${value.id_diccionario_competen}')"  class="btn btn-secondary btn-circle"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="40" rows="5">${value.nom_compet}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="50" rows="10">${value.nivel_uno}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="50" rows="10">${value.nivel_dos}</textarea>
                                                </td>
                                                <td>
                                                    <textarea name="" id="" cols="50" rows="10">${value.nivel_tres}</textarea>
                                                </td>
                                            </tr>
                                        ` 
                        });
                           

                        setTimeout(function(){  
                            $( '#modal_dicionario_curso'+' #tbl_tabla tbody').empty();

                            $('#modal_dicionario_curso  #tbl_tabla tbody').append(htmldata);
                        }, 500);
            }
        });
    }   
    
    function Agregar_competencia(tabla){



        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
            'Fila agregada!',
            'correctamente ',
            'success'
        ).then(function() {

                    var tbl_general = $("#modal_dicionario_curso #tbl_tabla tbody tr"); 
                    var cantidad_filas = tbl_general.length +1;
                                                    
                        $("#modal_dicionario_curso #tbl_tabla tbody").append(`  

                            <tr>
                                <td scope="row" tipo_compt="${(tabla ==='G' ? 1 : 2)}">
                                    ${cantidad_filas} </br>

                                        <button type="button"  id="guardar"  onclick="Guardar_fila(this,'')" class="btn btn-secondary btn-circle"><i class="fas fa-save"></i></button>
                                        <button type="button"  onclick="Eliminar_fila(this,'')"  class="btn btn-secondary btn-circle"><i class="fa fa-trash-o"></i></button>

                                </td>
                                <td>
                                    <textarea name="" id="" cols="40" rows="5"></textarea>
                                </td>
                                <td>
                                    <textarea name="" id="" cols="50" rows="10"></textarea>
                                </td>
                                <td>
                                    <textarea name="" id="" cols="50" rows="10"></textarea>
                                </td>
                                <td>
                                    <textarea name="" id="" cols="50" rows="10"></textarea>
                                </td>
                
                            </tr>

                        ` );

                });
    
            }
        }) 
    }
    
    function Guardar_fila(th,id){
 
        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar!'
        }).then((result) => {
            if (result.isConfirmed) {

                        var objGeneral = fnDataGeneral();
    
                        var id_diccionario_competen = id;
                        var fila_tr =$(th).parent().parent();
                        var compt_gene=$(fila_tr).find("td").eq(1).find("textarea").val();
                        var nivel_uno=$(fila_tr).find("td").eq(2).find("textarea").val();
                        var nivel_dos=$(fila_tr).find("td").eq(3).find("textarea").val();
                        var nivel_tres=$(fila_tr).find("td").eq(4).find("textarea").val();

                        var id_curso = $('#modal_dicionario_curso #id_curso').val();

                        var tipo_compt=$(fila_tr).find("td").eq(0).attr('tipo_compt');


                        $.ajax({
                            type:"POST",
                            url:  objGeneral.__wurl+'Guardar_Diccionario_Compt',
                            data: {
                                'id_diccionario_competen':id_diccionario_competen,
                                'compt_gene':compt_gene,
                                'nivel_uno':nivel_uno,
                                'nivel_dos':nivel_dos,
                                'nivel_tres':nivel_tres,
                                'id_curso':id_curso,
                                'tipo_compt':tipo_compt

                            },success:function (id_tabla) {

                                Swal.fire(
                                (id_diccionario_competen ==='' ? 'Guardado!' : 'Actualizado'),
                                    'El registro ha sido '+(id_diccionario_competen ==='' ? 'guardado' : 'actualizado')+' satisfactoriamente.',
                                    'success'
                                ).then(function() {
                            
                                    $(fila_tr).find("td").eq(0).html( `

                                            <button type="button"  id="guardar"  onclick="Guardar_fila(this,${(id_diccionario_competen ==='' ? id_tabla : id_diccionario_competen)})" class="btn btn-secondary btn-circle"><i class="fa fa-pencil"></i></i></button>
                                            <button type="button"  onclick="Eliminar_fila(this,${(id_diccionario_competen ==='' ? id_tabla : id_diccionario_competen)})"  class="btn btn-secondary btn-circle"><i class="fa fa-trash-o"></i></button>

                                    `);

                                });
                            }
                        });
            }
        }) 

    }   
    
    function Eliminar_fila(th,id){

        var objGeneral = fnDataGeneral();
        var id_diccionario_competen = id;
        var id_curso = $('#modal_dicionario_curso #id_curso').val();

        var fila_tr =$(th).parent().parent();

        if(id_diccionario_competen===''){

                Swal.fire({
                    title: '¿Realmente desea eliminar la fila',
                    text: "El registro será eliminado permanentemente",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.value) {

                        fila_tr.remove();

                        // setTimeout(function(){  
                        //     Competencia_data(id_curso);

                        // }, 500);

                    }
                });

        }else{


            Swal.fire({
            title: '¿Realmente desea eliminar el registro que existe en la base de datos',
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
                        url:  objGeneral.__wurl+'Eliminar_Diccionario_Compt',
                        data: {'id_diccionario_competen':id_diccionario_competen},
                        success:function () {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado satisfactoriamente.',
                                'success'
                            ).then(function() {

                                fila_tr.remove();
                                // setTimeout(function(){  
                                //     Competencia_data(id_curso);

                                // }, 500);

                            });
                        }
                    });
                }
            })

        }

    }   
    //-----------------------------------------------------------------
    function Sumilla_data(id){


                $('#modal_dicionario_sumilla').modal('show');       
                var objGeneral = fnDataGeneral();
                var id_curso = id;
                $( '#modal_dicionario_sumilla'+' #id_curso_sumilla').val(id_curso);
                

                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Mirar_sumilla_curso',
                    data: {'id_curso':id_curso},
                    success:function (data) {
                        var data = JSON.parse(data);
                        console.log("🚀 ~ file: curso.js.php:993 ~ Sumilla_data ~ data:", data);
                        console.log("🚀 ~ file: curso.js.php:993 ~ Sumilla_data ~ data:",  data.length);

                        var filas = data.length;

                        $('#modal_dicionario_sumilla #botonagregar_sumilla').attr("onClick", "Agregar_sumilla_curso('"+(filas == 0 ? "G" : "E")+"')");

                        if(filas == 0){
                            $('#modal_dicionario_sumilla #descrip_sumilla_curso').val('');
                            $('#modal_dicionario_sumilla #id_sumilla_curso').val('');
                        }else{
                            $('#modal_dicionario_sumilla #descrip_sumilla_curso').val(data[0]['descrip_sumilla']);
                            $('#modal_dicionario_sumilla #id_sumilla_curso').val(data[0]['id_sumilla_curso']);
                        }
                    }
                });

    }   

    function Agregar_sumilla_curso(accion){



         
        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar!'
        }).then((result) => {
            if (result.isConfirmed) {

                        $('#modal_dicionario_sumilla').modal('show');       
                        var objGeneral = fnDataGeneral();
                        var id_curso = id;
                        $( '#modal_dicionario_sumilla'+' #id_curso_sumilla').val(id_curso);
                        

                        $.ajax({
                            type:"POST",
                            url:  objGeneral.__wurl+'Mirar_sumilla_curso',
                            data: {'id_curso':id_curso},
                            success:function (data) {
                                var data = JSON.parse(data);
                                console.log("🚀 ~ file: curso.js.php:993 ~ Sumilla_data ~ data:", data);
                                console.log("🚀 ~ file: curso.js.php:993 ~ Sumilla_data ~ data:",  data.length);

                                var filas = data.length;

                                $('#modal_dicionario_sumilla #botonagregar_sumilla').attr("onClick", "Agregar_sumilla_curso('"+(filas == 0 ? "G" : "E")+"')");

                                if(filas == 0){
                                    $('#modal_dicionario_sumilla #descrip_sumilla_curso').val('');
                                    $('#modal_dicionario_sumilla #id_sumilla_curso').val('');
                                }else{
                                    $('#modal_dicionario_sumilla #descrip_sumilla_curso').val(data[0]['descrip_sumilla']);
                                    $('#modal_dicionario_sumilla #id_sumilla_curso').val(data[0]['id_sumilla_curso']);
                                }
                            }
                        });


                        var objGeneral = fnDataGeneral();
                        var id_sumilla_curso =$('#modal_dicionario_sumilla #id_sumilla_curso').val();
                        var descrip_sumilla =$('#modal_dicionario_sumilla #descrip_sumilla_curso').val();
                        var id_curso_sumilla =$('#modal_dicionario_sumilla #id_curso_sumilla').val();

                        $.ajax({
                                type:"POST",
                                url:  objGeneral.__wurl+'Guardar_Sumilla_Curso',
                                data: {
                                    'id_sumilla_curso':id_sumilla_curso,
                                    'descrip_sumilla':descrip_sumilla,
                                    'id_curso_sumilla':id_curso_sumilla,

                                },success:function () {
                                    Swal.fire(
                                    (id_sumilla_curso ==='' ? 'Guardado!' : 'Actualizado'),
                                        'El registro ha sido '+(id_sumilla_curso ==='' ? 'guardado' : 'actualizado')+' satisfactoriamente.',
                                        'success'
                                    ).then(function() {
                                        $('#modal_dicionario_sumilla').modal('hide');       

                                    });
                                }
                            });


            }
        }) 


     

    }


    


</script>