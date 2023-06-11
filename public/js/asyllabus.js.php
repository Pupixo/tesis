<script>
  
    var api_key =  <?php echo "'".API_KEY_SISTEMA."'";  ?>  ;
    var url_restapi = "<?php echo site_url(); ?>rest/Restapi/";

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
            modal_principal : '#modal_xl_largo_'+abrev,
            formulario_principal: "#"+formPrincipal,
            _tabla                :'#tbl'+abrev,
            _base_url :base_url
        };

        return mydata;
    }

    function loading_tabla(flag) {
        var objGeneral = fnDataGeneral();
            
    }

    function cargarTablaAsyllabus(param= null){
        var objGeneral = fnDataGeneral();

        $(objGeneral._tabla).dataTable().fnDestroy();
        
        $(objGeneral._tabla).on('processing.dt', function (e, settings, processing) {
        processing ? loading_tabla(true) : loading_tabla(false);
        }).dataTable({
            lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
            "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
            "pageLength": 10,
            "order": [[1, "desc"]],
            "processing": false,
            "serverSide": false,
            "ajax": { url : objGeneral.__wurl + "cargar_tabla_asyllabus/"+param,  type : 'POST' },
            "responsive": true,
            "columns": [
                {"data": "ID_SILABUS", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_FACULTAD", "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOMBRE_SILABUS" },
                {"data": "PERIODO" },

                {"data": "PERIODO_ANIO", "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "PERIODO_CICLO","className": "never", "autoWidth": true, "orderable": false, "visible": false },
                
                {"data": "ID_DEPART_UNIVER" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "ID_CONDICION", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "CREDITOS" },
                {"data": "HORAS_TEORICAS" },
                {"data": "HORAS_PRACTICAS" },
                {"data": "ID_DIRECTOR", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_DOCENTE", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_CURSO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_PLAN_ESTUDIOS", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "REQUISITO", "className": "never", "autoWidth": true, "orderable": false, "visible": false  },
                {"data": "ESTADO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "DURACION" },
                {"data": "USER_REG", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "FEC_ACT", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "USER_ACT", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ESTADO_SILABUS_HTML" },
                {"data": "ACCION" },
                {"data": "NOM_CICLO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "VERSION_PRINCIPAL", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "FECHA_REG", "className": "never", "autoWidth": true, "orderable": false, "visible": false },

            ]
            /*
                "columnDefs": [
                    {
                        "className": "never", 
                        "targets": [ 0],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 1],
                        "visible": false
                    }
                ]
            */
        });
        return false;
    }   

    $(document).ready(function() {
        cargarTablaAsyllabus();
        var msgDate = '';
        var inputFocus = '';        

         /**select2*/
        var datos_Generales = fnDataGeneral();
        $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_docente").select2();

        $(datos_Generales.modal_principal+" "+"#periodo_ciclo").select2();
        $(datos_Generales.modal_principal+" "+"#cbx_basicos_periodo_anio").select2();
        $(datos_Generales.modal_principal+" "+"#cbx_basicos_id_depart_uni").select2();
        $(datos_Generales.modal_principal+" "+"#cbx_basicos_id_plan_estudios").select2();
        $(datos_Generales.modal_principal+" "+"#cbx_basicos_id_carrera").select2();
        // $(datos_Generales.modal_principal+" "+"#cbx_basicos_id_director").select2("readonly", true);
        $(datos_Generales.modal_principal+" "+"#cbx_basicos_id_curso").select2();

        $(datos_Generales.modal_principal+" "+"#nom_ciclo").select2();
        $(datos_Generales.modal_principal+" "+"#requisito").select2();

        $(datos_Generales.modal_principal+" "+'#cbx_basicos_id_carrera').html('<option value="0" selected="">SELECCIONE</option>');
        $(datos_Generales.modal_principal+" "+'#cbx_basicos_id_director').html('<option value="0" selected="">SELECCIONE</option>');
        $(datos_Generales.modal_principal+" "+'#cbx_basicos_id_curso').html('<option value="0" selected="">SELECCIONE</option>');

        $(datos_Generales.modal_principal+" "+'#nom_ciclo').html('<option value="0" selected="">SELECCIONE</option>');
        $(datos_Generales.modal_principal+" "+'#requisito').html('');


        Analizar_Enviar_Correo();

    });

    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();
        $(objGeneral.modal_principal+" "+'#version_principal').val('');
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_est_syllabus').val('0');

		$(objGeneral.modal_principal+" "+'#nombre_syllabus').val('');
    	$(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val(0).trigger("change");
    	$(objGeneral.modal_principal+" "+'#periodo_ciclo').val('').trigger("change");

        // $(objGeneral.modal_principal+" "+'#cbx_basicos_id_depart_uni').val(0);
        //$(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val(0);

        $(objGeneral.modal_principal+" "+'#nom_ciclo').val(0).trigger("change");
        $(objGeneral.modal_principal+" "+'#creditos').val('');
    	$(objGeneral.modal_principal+" "+'#horas_teoricas').val('');
        $(objGeneral.modal_principal+" "+'#horas_practicas').val('');
        $(objGeneral.modal_principal+" "+'#horas_totales').val('');
        $(objGeneral.modal_principal+" "+'#requisito').val('').trigger("change");

        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);

        

        /* select multiple  cbx_multiple_id_docente */
            //$(objGeneral.modal_principal+" "+'#cbx_multiple_id_docente').val();
            $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente > option").removeAttr("selected");
            $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente").trigger("change");

            $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente").val("");
            $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente").trigger("change");

        /* */
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val(0).trigger("change");
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val(0).trigger("change");


        /*id para actualizar */
        $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val('');
        //$('#modal'+objGeneral._abrev +' #progress_ruta_kml .progress-bar').css('width', 0 + '%');
        //$('#modal'+objGeneral._abrev +' #div_'+objGeneral._abrev+'  #check_ruta_kml').css('display','none');
        //$(objGeneral.modal_principal+" "+' #num_celp').attr('nid','');
	}

    function fn_AbrirModal(Accion,id_row,fila,funcion_name){
        
        var objGeneral = fnDataGeneral();
        //$(objGeneral.modal_principal).css({ 'overflow' : 'auto !important' });
        //console.log(objGeneral.modal_principal)

        fn_limpiarPopup();
        $(objGeneral.modal_principal+" "+".modal-footer").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>\
        <button type='button' class='btn btn-primary' onclick="+funcion_name+"('"+Accion+"');>Guardar</button>");

        if( Accion === 'I'){

            $(objGeneral.modal_principal+" "+"#titulo_modal_xl").text('Registrar Nuevo Syllabu');
            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_est_syllabus').val(1);


        }else if(Accion === 'A') {
                var data = $(objGeneral._tabla).DataTable().row(fila).data();
                console.log("🚀 ~ file: asyllabus.js.php ~ line 199 ~ fn_AbrirModal ~ data", data)
                /* Poner data en modal */
                $(objGeneral.modal_principal+" "+"#titulo_modal_xl").text('Actualizar Silabu '+data['NOMBRE_SILABUS']+' ' +data['PERIODO']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);
                $(objGeneral.modal_principal+" "+'#version_principal').val(data['VERSION_PRINCIPAL']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_est_syllabus').val(data['ESTADO']);
                $(objGeneral.modal_principal+" "+'#nombre_syllabus').val(data['NOMBRE_SILABUS']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val(data['PERIODO_ANIO']).trigger("change");
                $(objGeneral.modal_principal+" "+'#periodo_ciclo').val(data['PERIODO_CICLO']).trigger("change");    
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val(data['ID_PLAN_ESTUDIOS']).trigger("change");
                setTimeout(function(){  
                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val(data['ID_CARRERA']).trigger("change");
                }, 2000);

                setTimeout(function(){  
                    $(objGeneral.modal_principal+" "+'#nom_ciclo').val(data['NOM_CICLO']).trigger("change");
                }, 5000);

                setTimeout(function(){  
                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').val(data['ID_CURSO']).trigger("change");
                }, 7000);
                /*select multiple */
                    var ids_docentes = data['ID_DOCENTE'];
                    var ids_docentes_data = ids_docentes.split(','); 
                        $.each(ids_docentes_data, function(index, value) {
                            $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente > option[value='"+value+"']").prop("selected","selected");
                        });
                        $(objGeneral.modal_principal+" "+"#cbx_multiple_id_docente").trigger("change");

                /* ¡¡¡¡¡¡¡ */
        }else{            
            /*
                var data_ = $("#tblusuario #data-fila_"+fila).val();
                obj_datos = data_.replace(/´/g, '"')
                $(objGeneral.modal_principal+" "+"#titulo_modal_xl").text('Actualizar Usuario');
                console.log(JSON.parse(obj_datos));
            */
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_Asyllabus() {
        var objGeneral = fnDataGeneral();
   
        if($(objGeneral.modal_principal+" "+'#nombre_syllabus').val().trim() === '') {
            msgDate = 'Debe ingresar un nombre de silabus';
            inputFocus =objGeneral.modal_principal+" "+ '#nombre_syllabus';
             return false;

        }

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val().trim() === '0') {
            msgDate = 'Debe ingresar el año de periodo';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_periodo_anio';
             return false;
        }

        if($(objGeneral.modal_principal+" "+'#periodo_ciclo').val().trim() === '') {
            msgDate = 'Debe ingresar el ciclo del año';
            inputFocus =objGeneral.modal_principal+" "+ '#periodo_ciclo';
             return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val().trim() === '0') {
            msgDate = 'Debe ingresar el plan de estudios';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_plan_estudios';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val().trim() === '0') {
            msgDate = 'Debe ingresar una carrera';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_carrera';
             return false;
        }

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val().trim() === '0') {
            msgDate = 'Debe ingresar al director';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_director';
            return false;
        }
    
        if($(objGeneral.modal_principal+" "+'#nom_ciclo').val().trim() === '0') {
            msgDate = 'Debe ingresar el ciclo';
            inputFocus =objGeneral.modal_principal+" "+ '#nom_ciclo';
             return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').val().trim() === '0') {
            msgDate = 'Debe ingresar el curso';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_curso';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#creditos').val().trim() === '') {
            msgDate = 'Debe ingresar los creditos';
            inputFocus =objGeneral.modal_principal+" "+ '#creditos';
             return false;
        }

       
        if($(objGeneral.modal_principal+" "+'#horas_teoricas').val().trim() === '') {
            msgDate = 'Debe ingresar el total de horas teóricas';
            inputFocus =objGeneral.modal_principal+" "+ '#horas_teoricas';
             return false;
        }
        if($(objGeneral.modal_principal+" "+'#horas_practicas').val().trim() === '') {
            msgDate = 'Debe ingresar el total de horas practicas';
            inputFocus =objGeneral.modal_principal+" "+ '#horas_practicas';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#horas_totales').val().trim() === '') {
            msgDate = 'Debe ingresar el total de horas ';
            inputFocus =objGeneral.modal_principal+" "+ '#horas_totales';
            return false;
        }

          
        if($(objGeneral.modal_principal+" "+'#requisito').val().length == 0) {
            msgDate = 'Debe ingresar los requisitos';
            inputFocus =objGeneral.modal_principal+" "+ '#requisito';
            return false;
        }

          
        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val().trim() === '0') {
            msgDate = 'Debe ingresar el tipo de cursos';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_tipo_curso';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim() === '0') {
            msgDate = 'Debe ingresar el tipo de presencialidad';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_curso_forma_estudio';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val().trim() === '0') {
            msgDate = 'Debe ingresar las condiciones';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_basicos_id_curso_importancia';
             return false;
        }
       
 

        if($(objGeneral.modal_principal+" "+'#cbx_multiple_id_docente').val().length == 0) {
            msgDate = 'Debe ingresar a los docentes';
            inputFocus =objGeneral.modal_principal+" "+ '#cbx_multiple_id_docente';
            return false;
        }

     
        return true;
    }

    function Insert_Update_Asyllabus(Accion){
        var objGeneral = fnDataGeneral();
        // var dataString = $(objGeneral.modal_principal+" "+objGeneral.formulario_principal).serialize();                // console.log(dataString);
        //   return false;


                if (Valida_Asyllabus()) {

                                    var dataString = {

                                        'id_asyllabus': $(objGeneral.modal_principal+" "+'#id_asyllabus').val().trim() ,
                                        'cbx_basicos_id_est_syllabus': $(objGeneral.modal_principal+" "+'#cbx_basicos_id_est_syllabus').val().trim() ,
                                        'nombre_syllabus': $(objGeneral.modal_principal+" "+'#nombre_syllabus').val().trim(),
                                        'cbx_basicos_periodo_anio': $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val().trim(),
                                        'periodo_ciclo': $(objGeneral.modal_principal+" "+'#periodo_ciclo').val().trim() ,

                                        'cbx_basicos_id_plan_estudios' :$(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val().trim(),
                                        'cbx_basicos_id_carrera' :$(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').val().trim(),
                                        'cbx_basicos_id_director': $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').val().trim(),
                                        'nom_ciclo':$(objGeneral.modal_principal+" "+'#nom_ciclo').val().trim(),

                                        'cbx_basicos_id_curso':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').val().trim(),
                                        'creditos':$(objGeneral.modal_principal+" "+'#creditos').val().trim(),
                                        'horas_teoricas':$(objGeneral.modal_principal+" "+'#horas_teoricas').val().trim(),
                                        'horas_practicas':$(objGeneral.modal_principal+" "+'#horas_practicas').val().trim(),
                                        'horas_totales':$(objGeneral.modal_principal+" "+'#horas_totales').val().trim(),

                                        'requisito':$(objGeneral.modal_principal+" "+'#requisito').val(),
                                        'cbx_basicos_id_tipo_curso':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val().trim(),
                                        'cbx_basicos_id_curso_importancia':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val().trim(),
                                        'cbx_basicos_id_curso_forma_estudio':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim(),
                                        'cbx_multiple_id_docente':$(objGeneral.modal_principal+" "+'#cbx_multiple_id_docente').val(),


                                        'id_ciclo':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').find('option:selected').attr('id-ciclo'),

                                        'id_tipo_estudios':$(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(),

                                        'version_principal':$(objGeneral.modal_principal+" "+'#version_principal').val(),

                                    };



                    if(Accion === "A"){




                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Update_Asyllabus',
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
                            url   : objGeneral.__wurl+'Insert_Asyllabus',
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
                    $('.modal').animate({scrollTop:0}, 500, 'swing');  

                }
    }

    function Eliminar_Asyllabus(id){
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
                    url:  objGeneral.__wurl+'Delete_Asyllabus',
                    data: {'id_syllabus':id},
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

    function Cambiar_Estado_Asyllabus(ide,id_ver){
        var objGeneral = fnDataGeneral();
        
        var id = ide;
        var version_principal=id_ver;
     
            Swal.fire({
                title: 'Seleccione el estado ha cambiar',
                input: 'select',
                inputOptions: {
                    'Estado': {
                    revision: 'En revisión',
                    aprobados: 'Aprobados',
                    desaprobados: 'No Aprobados'
                    }
                },
                inputPlaceholder: 'Seleccione el estado',
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === 'revision') {

                            $.ajax({
                                type:"POST",
                                url:  objGeneral.__wurl+'CambioEstado',
                                data: {'id_syllabus':id,'estado':1,'version_principal':version_principal},
                                success:function () {
                                    Swal.fire(
                                        'Estado Cambiado!',
                                        'El registro ha sido actualizado a revisión.',
                                        'success'
                                    ).then(function() {
                                        window.location = objGeneral.__wurl;
                                    });
                                }
                            });


                        } else if(value === 'aprobados'){

                            $.ajax({
                                type:"POST",
                                url:  objGeneral.__wurl+'CambioEstado',
                                data: {'id_syllabus':id,'estado':2,'version_principal':version_principal},
                                success:function () {
                                    Swal.fire(
                                        'Estado Cambiado!',
                                        'El registro ha sido actualizado a aprobado.',
                                        'success'
                                    ).then(function() {
                                        window.location = objGeneral.__wurl;
                                    });
                                }
                            });


                        }else if(value === 'desaprobados'){
                            
                            $.ajax({
                                type:"POST",
                                url:  objGeneral.__wurl+'CambioEstado',
                                data: {'id_syllabus':id,'estado':3,'version_principal':version_principal},
                                success:function () {
                                    Swal.fire(
                                        'Estado Cambiado!',
                                        'El registro ha sido actualizado a desaprobado.',
                                        'success'
                                    ).then(function() {
                                        window.location = objGeneral.__wurl;
                                    });
                                }
                            });


                        }else{
                            Swal.fire(
                                        '¡Debe Seleccionar una opción!',
                                        '',
                                        'warning'
                                    ).then(function() {
                                    });
                        }
                    })
                }
            })

    }

    function Cambiar_estado(){
        var objGeneral = fnDataGeneral();

        var estados_reservas =$('#estados_silabus').val();
      //  $( "#limpiar_tabla" ).html('');
        $("#limpiar_tabla").html('<table id="tblasyllabus"  class="table table-striped table-bordered table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info"> <thead> <tr> <th class="text-center"> <b>ID_SILABUS </b></th><th class="text-center"> <b>ID_FACULTAD </b></th>  <th class="text-center"> <b>NOMBRE SILABUS </b></th> <th class="text-center"> <b>PERIODO</b></th><th class="text-center"> <b>PERIODO ANIO</b></th>  <th class="text-center"> <b>PERIODO_CICLO</b></th> <th class="text-center"> <b>ID_DEPART_UNIVER </b></th>  <th class="text-center"> <b>ID_CARRERA </b></th><th class="text-center"> <b>ID_CONDICION </b></th> <th class="text-center"> <b>CREDITOS </b></th> <th class="text-center"> <b>HORAS TEORICAS </b></th>   <th class="text-center"> <b>HORAS PRACTICAS </b></th>  <th class="text-center"> <b>ID_DIRECTOR </b></th>   <th class="text-center"> <b>ID_DOCENTE </b></th> <th class="text-center"> <b>ID_CURSO </b></th><th class="text-center"> <b>ID_PLAN_ESTUDIOS </b></th>  <th class="text-center"> <b>REQUISITO </b></th>  <th class="text-center"> <b>ESTADO </b></th>   <th class="text-center"> <b>FECHA CREACIÓN </b></th>  <th class="text-center"> <b>USER_REG </b></th>   <th class="text-center"> <b>FEC_ACT </b></th>   <th class="text-center"> <b>USER_ACT </b></th>  <th class="text-center"> <b>ESTADO SILABUS </b></th> <th class="text-center"> <b>ACCIONES</b></th></tr></thead> <tbody> </tbody> </table>');     

        cargarTablaAsyllabus(estados_reservas);
    }

    $(document).on("hidden.bs.modal", ".bootbox.modal", function (e) {
        //console.log('2nd level modal closed');
        jQuery("body").addClass("modal-open");
    });

    var datos_Generales1 = fnDataGeneral();
    $(datos_Generales1.modal_principal+" "+"#checkbox_id_docente").click(function(){
        if($(datos_Generales.modal_principal+" "+"#checkbox_id_docente").is(':checked') ){
            $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_docente > option").prop("selected","selected");
            $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_docente").trigger("change");
        }else{
            $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_docente > option").removeAttr("selected");
            $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_docente").trigger("change");
        }
    });

    function Plan_estudios(th){
        console.log("🚀 ~ file: asyllabus.js.php:614 ~ Plan_estudios ~ th:", th)
        var extra_id = $(th).find(':selected').attr('data-id-extra')

        console.log("🚀 ~ file: asyllabus.js.php:616 ~ Plan_estudios ~ extra_id:", extra_id)
        var objGeneral = fnDataGeneral();

            var id_plan_estudios = th.value;
            console.log("plan estudios ", id_plan_estudios)

            if(id_plan_estudios == 0){

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').html('');
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').html('');
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').html('');

                        var carrera='<option value="" selected>'+ 'Seleccionar' +'</option>';
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').html(carrera);


                        var curso='<option value="0" selected>'+ 'Seleccionar' +'</option>';
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').html(curso);

                        var ciclo='<option value="0" selected>'+ 'Seleccionar Curso' +'</option>';
                        $(objGeneral.modal_principal+" "+'#nom_ciclo').html(ciclo);


                        $(objGeneral.modal_principal+" "+'#creditos').val('');
                        $(objGeneral.modal_principal+" "+'#horas_teoricas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_practicas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_totales').val('');
                        $(objGeneral.modal_principal+" "+'#requisito').val(0);

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);
                        $(objGeneral.modal_principal+" "+'#tipo_estudios_texto').html('');
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(0);
            }else{

                var parametros = {
                        "id_plan_estudios": id_plan_estudios,
                        "id_asignacion_plan_estudios":extra_id,
                    };

                    $.ajax({
                    type  : "POST",
                    url: url_restapi+'lista_carreras_by_plan_estudios_asign_usu',
                    headers: {
                                    "X-API-KEY":api_key
                    },
                    data  : parametros, 
                    })
                    .done(function(data) {

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').html('');
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').html('');
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').html('');

                        var carrera='<option value="" selected>'+ 'Seleccione Carrera' +'</option>';
                        $.each(data[0], function(index, value) {
                            //el cero es general en plan de estudios
                            if(value['id'] == 0){
                            // carrera += '<option value="'+value['id']+'">General</option>';
                            }else{
                                carrera += '<option value="'+value['id']+'">'+value['nombre'] +'</option>';
                            }
                        });

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera').html(carrera);


                        var ciclo='<option value="0" selected>'+ 'Seleccionar Ciclo' +'</option>';
                        $.each(data[1], function(index, value) {
                            //el cero es general en plan de estudios
                                ciclo += '<option id_extra="'+value['id_asignacion_plan_estudios']+'" value="'+value['nom_ciclo']+'">'+value['nom_ciclo'] +'</option>';
                        });

                        $(objGeneral.modal_principal+" "+'#nom_ciclo').html(ciclo);
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(data[2]);

                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});    

            }
	}

    function Carrera(th){
        var objGeneral = fnDataGeneral();

            var id_carrera = th.value ;

            if(id_carrera == 0){
                        
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').html('');

                        var curso='<option value="0" selected>'+ 'Seleccionar Curso' +'</option>';
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').html(curso);


                        $(objGeneral.modal_principal+" "+'#nom_ciclo').val(0);
                        $(objGeneral.modal_principal+" "+'#creditos').val('');
                        $(objGeneral.modal_principal+" "+'#horas_teoricas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_practicas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_totales').val('');
                        $(objGeneral.modal_principal+" "+'#requisito').val(0);

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);

                

            }else{

                var parametros = {
                    "id_carrera": id_carrera,
                };

                $.ajax({
                type  : "POST",
                url: url_restapi+'lista_directores_by_carrera',
                headers: {
                                "X-API-KEY":api_key
                },
                data  : parametros, 
                })
                .done(function(data) {

                    console.log("🚀 ~ file: asyllabus.js.php ~ line 477 ~ .done ~ data", data);

                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').html('');

                    var directores='';
                    $.each(data, function(index, value) {
                
                            directores += '<option value="'+value['id_director']+'">'+value['nom_director'] +'</option>';

                    });

                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_director').html(directores);

                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    someErrorFunction();
                })
                .always(function() {});  

            }     
    
	}
        
    function Ciclo(th){
        var objGeneral = fnDataGeneral();
        
        var extra_id = $(th).find(':selected').attr('id_extra')

                var num_ciclo = th.value ;

                var  id_plan_estudios= $(objGeneral.modal_principal+" "+"#cbx_basicos_id_plan_estudios").val();

                if(num_ciclo == 0){

                    
                        $(objGeneral.modal_principal+" "+'#nom_ciclo').val(0);
                        $(objGeneral.modal_principal+" "+'#creditos').val('');
                        $(objGeneral.modal_principal+" "+'#horas_teoricas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_practicas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_totales').val('');
                        $(objGeneral.modal_principal+" "+'#requisito').val(0);

                        
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);

                
                }else{

                    

                        var parametros = {
                            "num_ciclo": num_ciclo,
                            "id_plan_estudios":id_plan_estudios,
                            "id_asignacion_plan_estudios":extra_id
                        };

                        $.ajax({
                        type  : "POST",
                        url: url_restapi+'lista_cursos_by_ciclo_by_carrera_asing_usu',
                        headers: {
                                        "X-API-KEY":api_key
                        },
                        data  : parametros, 
                        })
                        .done(function(data) {
                        console.log("🚀 ~ file: asyllabus.js.php:832 ~ .done ~ data:", data)
               
                            
                            var curso='<option value="0" id-ciclo="" selected>'+ 'Seleccionar' +'</option>';
                            $.each(data, function(index, value) {
                                //el cero es general en plan de estudios
                                    curso += '<option  id-ciclo="'+value['id_ciclo']+'" value="'+value['id_curso']+'" >'+value['nom_curso'] +'</option>';
                            });

                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso').html(curso);


                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            someErrorFunction();
                        })
                        .always(function() {});    

                }
    
	}

    function Curso(th){
        var objGeneral = fnDataGeneral();

                var id_ciclo =  $(th).find('option:selected').attr('id-ciclo');

                var id_ciclo = id_ciclo; //th.value ;

                var  id_plan_estudios= $(objGeneral.modal_principal+" "+"#cbx_basicos_id_plan_estudios").val();

                if(id_ciclo == 0){

                    
                        $(objGeneral.modal_principal+" "+'#creditos').val('');
                        $(objGeneral.modal_principal+" "+'#horas_teoricas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_practicas').val('');
                        $(objGeneral.modal_principal+" "+'#horas_totales').val('');
                        $(objGeneral.modal_principal+" "+'#requisito').val(0);

                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(0);
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(0);

                
                }else{

                        var parametros = {
                            "id_ciclo": id_ciclo,
                            "id_plan_estudios":id_plan_estudios
                        };

                        $.ajax({
                        type  : "POST",
                        url: url_restapi+'lista_ciclo_by_carrera',
                        headers: {
                                        "X-API-KEY":api_key
                        },
                        data  : parametros, 
                        })
                        .done(function(data) {
                        console.log("🚀 ~ file: asyllabus.js.php:885 ~ .done ~ data:", data)

                
                            $(objGeneral.modal_principal+" "+'#creditos').val(data['DATAMAIN'][0]['creditos']);
                            $(objGeneral.modal_principal+" "+'#horas_teoricas').val(data['DATAMAIN'][0]['horas_teoricas']);
                            $(objGeneral.modal_principal+" "+'#horas_practicas').val(data['DATAMAIN'][0]['horas_practicas']);
                            $(objGeneral.modal_principal+" "+'#horas_totales').val(data['DATAMAIN'][0]['horas_totales']);


                            $(objGeneral.modal_principal+" "+'#requisito').html('');

                                var requisito_select='';
                                $.each(data['REQUISITOS'], function(index, value) {
                                    //cambio id del curso por id_de ciclo
                                        requisito_select += '<option value="'+value['id_curso']+'" selected>'+value['nom_curso'] +'</option>';
                                });

                                $(objGeneral.modal_principal+" "+'#requisito').html(requisito_select);


                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_curso').val(data['DATAMAIN'][0]['id_tipo_curso']);
                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(data['DATAMAIN'][0]['id_curso_forma_estudio']);

                            $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_importancia').val(data['DATAMAIN'][0]['id_curso_importancia']);


                        })
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            someErrorFunction();
                        })
                        .always(function() {});    

                }
    
	}

    //---------------------------RESUMEN SYLLABUS------------------------------

    function Analizar_Enviar_Correo(){
        var valor =0;

        $( ".progress-title" ).each(function( index, element ) {
             valor += parseInt($(element).attr("valor"));         
        });
        // var valor= 1000;
            console.log("🚀 ~ file: asyllabus.js.php:947 ~ Enviar_Correo ~ valor:", valor);

        
            var es_principal = $("#es_principal").val();
            if(valor >= 1500){

                if(es_principal){
                    $("#enviar_correro").attr("onclick","EnviarCorreo_syllabus_terminado()");
                    $("#enviar_correro").prop("disabled","");
                }else{
                    $("#enviar_correro").prop("disabled","disabled");
                }
              
            }else{
                $("#enviar_correro").prop("disabled","disabled");

            }

    }


    function EnviarCorreo_syllabus_terminado(){

        var id_syllabus = $("#progress_bar_datos_generales #id_syllabus").val();
        var periodo = $("#progress_bar_datos_generales #periodo").val();
        var fecha = $("#progress_bar_datos_generales #fecha").val();

        var nom_syll = $("#progress_bar_datos_generales #nom_syll").val();
        var carrera = $("#progress_bar_datos_generales #carrera").val();
        var plan_estudios = $("#progress_bar_datos_generales #plan_estudios").val();
        var nom_usu_registro = $("#progress_bar_datos_generales #nom_usu_registro").val();
        var id_version_sy = $("#progress_bar_datos_generales #id_version_sy").val();
        var nom_tipo_estudios = $("#progress_bar_datos_generales #nom_tipo_estudios").val();
        

        var nom_curso = $("#progress_bar_datos_generales #nom_curso").val();

        $('.preloader').show();


        var objGeneral = fnDataGeneral();

        $.ajax({
        type  : "POST",
        url   : objGeneral.__wurl+'Enviar_Correo_Syllabus_terminado',
        data  : {
                    'id_version_sy':id_version_sy,
                    'id_syllabus':id_syllabus,
                    'periodo':periodo,
                    'fecha':fecha,
                    'nom_syll':nom_syll,
                    'carrera':carrera,
                    'plan_estudios':plan_estudios,
                    'nom_usu_registro':nom_usu_registro,
                    'nom_tipo_estudios':nom_tipo_estudios,
                    'nom_curso':nom_curso
                }, 
        })
        .done(function(data) {
            $('.preloader').hide();

            swal.fire(
                'Envio Exitosa!',
                'Haga clic en el botón!',
                'success'
                ).then(function() {
                    // window.location = objGeneral.__wurl;
                });
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            someErrorFunction();
        })
        .always(function() {});

    }

    function Hacer_version_principal(id_syllabus,id_version_sy,numero_version,estado){

            var id_syllabus =id_syllabus;
            var id_version_sy = id_version_sy;
            var estado = estado

            $.ajax({
            type  : "POST",
            url   : wurl+'Version_principal',
            data  : {
                        'id_syllabus':id_syllabus,
                        'id_version_sy':id_version_sy,
                        'estado':estado
                    }, 
            })
            .done(function(data) {
                swal.fire(
                    '¡Ahora la versión '+numero_version+' se hizo principal !',
                    'Ahora el pdf y estado cambiará de acuerdo a la versión',
                    'success'
                    ).then(function() {location.reload();   
                        
                        
                       // $("#version_principal_indicador").text( numero_version );

                    
                    });
            }).fail(function(jqXHR, textStatus, errorThrown){someErrorFunction(); }).always(function() {});

    }


    function Ver_version(id_syllabus,id_version_sy,numero_version){

            var id_syllabus =id_syllabus;
            var id_version_sy = id_version_sy;
            var numero_version = numero_version;
          
            $("#version_nombre").html(`
                <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                    <div class="spinner_seccion"></div>
                </div>
            `);

             $("#tiempo_sy_text").html(
            `
                <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                    <div class="spinner_seccion"></div>
                </div>
            `
            );

            $.ajax({
            type  : "POST",
            url   : wurl+'Ver_Version_syllabu',
            data  : {
                        'id_syllabus':id_syllabus,
                        'id_version_sy':id_version_sy,
                        'numero_version':numero_version

                    }, 
            })
            .done(function(data){

                data=$.parseJSON(data);     
                console.log("🚀 ~ file: asyllabus.js.php:1059 ~ .done ~ data:", data)

                    swal.fire(
                        '¡Ahora verá la versión '+numero_version+'',
                        'Ahora el pdf y estado cambiará de acuerdo a la versión',
                        'success'
                    ).then(function() {

                        $("#tiempo_sy_text").html(
                            `
                               <h6 class=" text-dark">${data['tiempo_sy_text']}</h6>                                        
                               <h5 class="font-light text-white" id="tiempo_sy_diff">${data['tiempo_sy_diff']}</h5>
                            `
                        );

                        $("#version_nombre").html(data['version']);
                        $("#es_principal").val(data['es_principal']);

                        /*** */
                        $("#revision_data").attr( "href",data['sy']['revision'] );
                        $("#vista_data").attr( "href",data['sy']['vista'] );
                        $("#mirar_data").attr( "href",data['sy']['mirar'] );
                        
                        $("#id_syllabus").val( data['sy']['id_syllabus'] );
                        $("#periodo").val( data['sy']['periodo'] );
                        $("#fecha").val( data['sy']['fecha'] );
                        $("#nom_syll").val( data['sy']['nom_syll'] );
                        $("#carrera").val( data['sy']['nom_carrera'] );
                        $("#plan_estudios").val( data['sy']['plan_estudios'] );
                        $("#nom_usu_registro").val( data['sy']['nom_usu_registro'] );
                        $("#id_version_sy").val( data['sy']['id_version_sy'] );
                        $("#nom_tipo_estudios").val( data['sy']['nom_tipo_estudios'] );
                        $("#nom_curso").val( data['sy']['nom_curso'] );

                        /** */

                        $("#datos_gene").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_dg']+"%" );
                        $("#datos_gene .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_dg']+"%");
                        $("#datos_gene .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_dg'] );


                        $("#comp_aso_cur").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_ac']+"%" );
                        $("#comp_aso_cur .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_ac']+"%");
                        $("#comp_aso_cur .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_ac'] );


                        $("#sumilla").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_sumilla']+"%" );
                        $("#sumilla .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_sumilla']+"%");
                        $("#sumilla .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_sumilla'] );


                        $("#result_gene_apr").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_result_ga']+"%" );
                        $("#result_gene_apr .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_result_ga']+"%");
                        $("#result_gene_apr .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_result_ga'] );


                        $("#org_apre").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_oa']+"%" );
                        $("#org_apre .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_oa']+"%");
                        $("#datosorg_apre_gene .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_oa'] );


                        $("#estra_didac").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_estrate_didac']+"%" );
                        $("#estra_didac .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_estrate_didac']+"%");
                        $("#estra_didac .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_estrate_didac'] );


                        $("#form_herr").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_fhe']+"%" );
                        $("#form_herr .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_fhe']+"%");
                        $("#form_herr .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_fhe'] );


                        $("#act_prin").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_ap']+"%" );
                        $("#act_prin .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_ap']+"%");
                        $("#act_prin .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_ap'] );


                        $("#plataf_herra").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_ph']+"%" );
                        $("#plataf_herra .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_ph']+"%");
                        $("#plataf_herra .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_ph'] );


                        $("#refer_bibli").attr( "style", "width: "+data['sy']['valor_porcentajes_syllabus_bibli']+"%" );
                        $("#refer_bibli .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['sy']['valor_porcentajes_syllabus_bibli']+"%");
                        $("#refer_bibli .progress-title").attr( "valor", data['sy']['valor_porcentajes_syllabus_bibli'] );


                    /*******************************  ficha eval */
                            
                        $("#revision_data_ficha").attr( "href",data['ficha']['revision_ficha'] );
                        $("#vista_data_ficha").attr( "href",data['ficha']['vista_ficha'] );
                        $("#mirar_data_ficha").attr( "href",data['ficha']['mirar_ficha'] );


                        
                        $("#ficha_evaluno").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval1']+"%" );
                        $("#ficha_evaluno .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval1']+"%");
                        $("#ficha_evaluno .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval1'] );


                        $("#ficha_evaldos").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval2']+"%" );
                        $("#ficha_evaldos .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval2']+"%");
                        $("#ficha_evaldos .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval2'] );



                        $("#ficha_evaltres").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval3']+"%" );
                        $("#ficha_evaltres .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval3']+"%");
                        $("#ficha_evaltres .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval3'] );



                         $("#ficha_evalcuatro").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval4']+"%" );
                        $("#ficha_evalcuatro .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval4']+"%");
                        $("#ficha_evalcuatro .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval4'] );



                        $("#ficha_evalcinco").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval5']+"%" );
                        $("#ficha_evalcinco .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval5']+"%");
                        $("#ficha_evalcinco .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval5'] );


                        $("#ficha_evalseis").attr( "style", "width: "+data['ficha']['valor_porcentajes_syllabus_ficha_eval6']+"%" );
                        $("#ficha_evalseis .progress-title span").html("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data['ficha']['valor_porcentajes_syllabus_ficha_eval6']+"%");
                        $("#ficha_evalseis .progress-title").attr( "valor", data['ficha']['valor_porcentajes_syllabus_ficha_eval6'] );

                        Analizar_Enviar_Correo();
                        
                    });
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});

    }


    function Nueva_Version(id){
            var objGeneral = fnDataGeneral();

            var id = id;
            Swal.fire({
            //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
            title: '¿Realmente desea crear una nueva versión',
            text: "El registro aparecerá ahora",
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
                url:  objGeneral.__wurl+'Nueva_version',
                data: {'id_syllabus':id},
                success:function () {
                    Swal.fire(
                        'Creado!',
                        'El registro ha sido creado satisfactoriamente.',
                        'success'
                    ).then(function() {

                        location.reload();


                    });
                }
            });
            }
            })
    }   



    
    $(document).ready(function() {

        $('#tabla_version').dataTable( {
            "dom": 'f',
            "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},

        } );

    });

    //------------------------------------------------------------------

</script>