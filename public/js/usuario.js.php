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
        // }
    }

    function cargarTablaUsuarios(){
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
            "ajax": { url : objGeneral.__wurl + "cargar_tabla_usuario",  type : 'POST' },
            "responsive": true,
            "columns": [
                {"data": "NOMBRE" },
                {"data": "NIVEL"},
                {"data": "ESTADO" },
                {"data": "ID_NIVEL" , "className": "never", "autoWidth": true, "orderable": false, "visible": true},
                {"data": "ESTADO_ID" , "className": "never", "autoWidth": true, "orderable": false, "visible": true},
                {"data": "PATERNO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "MATERNO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "CODIGO"},
                {"data": "PASSWORD", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "MAIL", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "CELULAR", "className": "never", "autoWidth": true, "orderable": false, "visible": false },


                {"data": "ID_PLAN_ESTUDIOS" , "className": "never", "autoWidth": true, "orderable": false, "visible": true},
                {"data": "CICLO_NUM" , "className": "never", "autoWidth": true, "orderable": false, "visible": true},


                {"data": "ACCION" }
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
        cargarTablaUsuarios();
        var msgDate = '';
        var inputFocus = '';     
        
        $("#modal_asignar_plan_estudio_usu #cbx_basicos_id_plan_estudios").select2();
        $('#modal_asignar_curso #nom_ciclo').select2();

        
        // $('#Lista_plan_estudios_usu_tbl').DataTable({
        //         "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
        //         "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
        //         "pageLength": 10,
        //         "processing": false,
        //         "serverSide": false,
        //         "responsive": true,
              
        // });
    });

    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_nivel').val(0);
    	$(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(0);

		$(objGeneral.modal_principal+" "+'#usuario_nombres').val('');
    	$(objGeneral.modal_principal+" "+'#usuario_apater').val('');
        $(objGeneral.modal_principal+" "+'#usuario_amater').val('');
        $(objGeneral.modal_principal+" "+'#num_celp').val('');
    	$(objGeneral.modal_principal+" "+'#emailp').val('');
    	$(objGeneral.modal_principal+" "+'#usuario_codigo').val('');
        $(objGeneral.modal_principal+" "+'#usuario_password').val('');

        /*id para actualizar */
        $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val('');


        //$('#modal'+objGeneral._abrev +' #progress_ruta_kml .progress-bar').css('width', 0 + '%');
        //$('#modal'+objGeneral._abrev +' #div_'+objGeneral._abrev+'  #check_ruta_kml').css('display','none');
        //$(objGeneral.modal_principal+" "+' #num_celp').attr('nid','');
	}

    function fn_AbrirModal(Accion,id_row,fila,funcion_name){


        var objGeneral = fnDataGeneral();

        fn_limpiarPopup();
        $(objGeneral.modal_principal+" "+".modal-footer").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>\
        <button type='button' class='btn btn-primary' onclick="+funcion_name+"('"+Accion+"');>Guardar</button>");

        if( Accion === 'I'){

            $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Registrar Nuevo Usuario');
            $(objGeneral.modal_principal+" "+"#alumno").hide();

        }else if(Accion === 'A') {

                var data = $(objGeneral._tabla).DataTable().row(fila).data();
                /* Poner data en modal */
                $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Actualizar Usuario '+data['NOMBRE']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_nivel').val(data['ID_NIVEL']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(data['ESTADO_ID']);
                $(objGeneral.modal_principal+" "+'#usuario_nombres').val(data['NOMBRE']);
                $(objGeneral.modal_principal+" "+'#usuario_apater').val(data['PATERNO']);
                $(objGeneral.modal_principal+" "+'#usuario_amater').val(data['MATERNO']);
                $(objGeneral.modal_principal+" "+'#num_celp').val(data['CELULAR']);
                $(objGeneral.modal_principal+" "+'#emailp').val(data['MAIL']);
                $(objGeneral.modal_principal+" "+'#usuario_codigo').val(data['CODIGO']);
                $(objGeneral.modal_principal+" "+'#usuario_password').val('*****');
                $(objGeneral.modal_principal+" "+'#password_original').val(data['PASSWORD']);


                if(data['ID_NIVEL']==5){

                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val(data['ID_PLAN_ESTUDIOS']);
                    $(objGeneral.modal_principal+" "+'#num_ciclo').val(data['CICLO_NUM']);

                    $(objGeneral.modal_principal+" "+"#alumno").show();

                }else{

                    $(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val(0);
                    $(objGeneral.modal_principal+" "+'#num_ciclo').val(null);

                    $(objGeneral.modal_principal+" "+"#alumno").hide();

                }




        }else{            
            /*
                var data_ = $("#tblusuario #data-fila_"+fila).val();
                obj_datos = data_.replace(/´/g, '"')
                $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Actualizar Usuario');
                console.log(JSON.parse(obj_datos));
            */
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_Usuario() {
        var objGeneral = fnDataGeneral();
        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_nivel').val().trim() === '0') {
            msgDate = 'Debe seleccionar un nivel';
            inputFocus = '#id_nivel';
            return false;
        }



        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_nivel').val().trim() === '5'){

            if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_plan_estudios').val().trim() === '0') {
                msgDate = 'Debe seleccionar un plan de estudio';
                inputFocus = '#id_status';
                return false;
            }

            if($(objGeneral.modal_principal+" "+'#num_ciclo').val().trim() === '') {
                msgDate = 'Debe seleccionar un ciclo';
                inputFocus = '#id_status';
                return false;
            }

        }



        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val().trim() === '0') {
            msgDate = 'Debe seleccionar un estado';
            inputFocus = '#id_status';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#usuario_nombres').val().trim() === '') {
            msgDate = 'Debe ingresar un nombre';
            inputFocus = '#usuario_nombres';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#usuario_apater').val().trim() === '') {
            msgDate = 'Debe ingresar un apellido paterno';
            inputFocus = '#usuario_apater';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#usuario_amater').val().trim() === '') {
            msgDate = 'Debe ingresar un apellido materno';
            inputFocus = '#usuario_amater';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#num_celp').val().trim() === '') {
            msgDate = 'Debe ingresar un celular del nuevo usuario';
            inputFocus = '#num_celp';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#emailp').val().trim() === '') {
            msgDate = 'Debe ingresar un correo';
            inputFocus = '#emailp';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#usuario_codigo').val().trim() === '') {
            msgDate = 'Debe ingresar un código';
            inputFocus = '#usuario_codigo';
            return false;
        }
        if($(objGeneral.modal_principal+" "+'#usuario_password').val().trim() === '') {
            msgDate = 'Debe ingresar un contraseña';
            inputFocus = '#usuario_password';
            return false;
        }
        
        return true;
    }

    function Insert_Update_Usuarios(Accion){
        var objGeneral = fnDataGeneral();
        var dataString = $(objGeneral.modal_principal+" "+objGeneral.formulario_principal).serialize();
        console.log(objGeneral.modal_principal+" "+objGeneral.formulario_principal);

           console.log(dataString);
                if (Valida_Usuario()) {
                    if(Accion === "A"){
                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Update_Usuario',
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
                            url   : objGeneral.__wurl+'Insert_Usuario',
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

    function Eliminar_Usuario(id){
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
                    url:  objGeneral.__wurl+'/Delete_Usuario',
                    data: {'id_usuario':id},
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

    function Nivel(id){
        var objGeneral = fnDataGeneral();

        var id = id.value;
        console.log("🚀 ~ file: usuario.js.php:336 ~ Nivel ~ id", id);

        if(id ==5 ){

            $(objGeneral.modal_principal+" "+"#alumno").show();
        }else{
            $(objGeneral.modal_principal+" "+"#alumno").hide();
        }

    }   


    $(document).on("hidden.bs.modal", ".bootbox.modal", function (e) {

    console.log('2nd level modal closed');
    jQuery("body").addClass("modal-open");
    });

//----------------------------------------------------------------------------------------------------------------------------------------------------

    function AsignarPlanEstudio(id){
        $('#modal_asignar_plan_estudio_usu').modal('show');       
        var objGeneral = fnDataGeneral();
        var id_usuario = id;
        
        $('#modal_asignar_plan_estudio_usu #id_usuario').val(id_usuario);
        List_AsignarPlanEstudio();
    }   

    function List_AsignarPlanEstudio(){
        var objGeneral = fnDataGeneral();

        var id_usuario = $('#modal_asignar_plan_estudio_usu #id_usuario').val();
     
        $('#Lista_plan_estudios_usu_tbl').dataTable().fnDestroy();

        $('#Lista_plan_estudios_usu_tbl').DataTable({
                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                "pageLength": 10,
                "processing": false,
                "serverSide": false,
                "ajax": { url : objGeneral.__wurl + "Mirar_asignar_plan_estudio/"+id_usuario,  type : 'POST' },
                "responsive": true,
                columns:    [   {
                                    data: 'NOMBRE', width: "90%"
                                }, 
                                {
                                    data: 'ACCION',width: "10%"
                                }                                
                            ],
        });

        $.ajax({
            type:"POST",
            url:  objGeneral.__wurl+'Combo_planes_estudios',
            data: {'id_usuario':id_usuario},
            success:function (data) {
                const myArr = JSON.parse(data);
                    var planestudios ='<option value="0" selected>'+ 'Seleccionar Plan de Estudios' +'</option>';
                    $.each(myArr, function(index, value) {
                            planestudios  += '<option value="'+value['id_plan_estudios']+'">'+value['nom_plan_estudios'] +' - '+value['anio'] +'</option>';
                    });
                    $('#modal_asignar_plan_estudio_usu #cbx_basicos_id_plan_estudios').html(planestudios);
            }
        });


    }   


    function AddAsignarPlanEstudios(){
        var id_plan_estudios = $('#modal_asignar_plan_estudio_usu #cbx_basicos_id_plan_estudios').val();  
        var id_usuario = $('#modal_asignar_plan_estudio_usu #id_usuario').val();
     
        var objGeneral = fnDataGeneral();
        

        
        if(id_plan_estudios == 0 ){
            $.toast({
                heading: 'Error',
                text: 'Seleccione al menos un plan de estudio' ,
                position: 'top-right',
                icon: 'error',
                stack: false
            })
            return false;

        }

        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "Se agragará el plan de estudio a al usuario",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, agreguelo!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Insertar_AsignacionPlanEstudios',
                    data: {'id_usuario':id_usuario,'id_plan_estudios':id_plan_estudios},
                    success:function () {
                        List_AsignarPlanEstudio();
                        Swal.fire(
                        'Agregado!',
                        'El registro ha sido agregado a la tabla',
                        'success'
                        )
                    }
                });

            }
        })






       
    }   


    function Eliminar_PlanEstudiosAsignado(id_asignacion_plan_estudios){
        var id_asignacion_plan_estudios = id_asignacion_plan_estudios;  

        var objGeneral = fnDataGeneral();
        

        
        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "Se eliminará el plan de estudio a este usuario, incluyendo todos los syllabus creados que pertenezcan al plan del usuario",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínelo!'
        }).then((result) => {
            if (result.isConfirmed) {

                
                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Eliminar_AsignacionPlanEstudios',
                    data: {'id_asignacion_plan_estudios':id_asignacion_plan_estudios},
                    success:function () {
                        List_AsignarPlanEstudio();
                        Swal.fire(
                        'Agregado!',
                        'El registro ha sido eliminado a la tabla',
                        'success'
                        )
                    }
                });

            }
        })




        
    }   
    
    //_--------------------------------------------------------



    function Asignar_Cursos(id_asignacion_plan_estudios,id_plan_estudios,id_usuario,th){
        $('#modal_asignar_curso').modal('show');       
        var objGeneral = fnDataGeneral();
        $('#modal_asignar_curso #id_asignacion_plan_estudios').val(id_asignacion_plan_estudios);
        $('#modal_asignar_curso #id_usuario').val(id_usuario);
        $('#modal_asignar_curso #id_plan_estudios').val(id_plan_estudios);
        List_AsignarCurso();
        $('#modal_asignar_curso #nom_ciclo').val(null).trigger('change');

    }   


    function List_AsignarCurso(){
        var objGeneral = fnDataGeneral();

        var id_asignacion_plan_estudios = $('#modal_asignar_curso #id_asignacion_plan_estudios').val();

        $('#Lista_cursos_usu_tbl').dataTable().fnDestroy();

        $('#Lista_cursos_usu_tbl').DataTable({
                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                "pageLength": 10,
                "processing": false,
                "serverSide": false,
                "ajax": { url : objGeneral.__wurl + "Mirar_asignar_curso/"+id_asignacion_plan_estudios,  type : 'POST' },
                "responsive": true,
                columns:    [   {
                                    data: 'NOMBRE', width: "90%"
                                }, 
                                {
                                    data: 'ACCION', width: "10%"
                                }                                
                            ],
        });

        var parametros = {
                        "id_plan_estudios": $('#modal_asignar_curso #id_plan_estudios').val(),
                        "id_asignacion_plan_estudios": id_asignacion_plan_estudios
        };

        $.ajax({
        type  : "POST",
        url: url_restapi+'lista_ciclos_by_plan_estudios_asignar',
        headers: {
                        "X-API-KEY":api_key
        },
        data  : parametros, 
        })
        .done(function(data) {
                    var ciclo='';

                    $.each(data[0], function(index, value) {
                            ciclo += '<option  value="'+value['nom_ciclo']+'['+value['id_ciclo']+'['+value['id_curso']+'"   >'+value['nom_ciclo'] + ' - ' + value['nom_curso'] +'</option>';
                    });

                    $('#modal_asignar_curso #nom_ciclo').html(ciclo);
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            someErrorFunction();
        }).always(function() {});    
    }   


    function AddAsignarCurso(){
        var id_asignacion_plan_estudios = $('#modal_asignar_curso #id_asignacion_plan_estudios').val();
        var nom_ciclo =$('#modal_asignar_curso #nom_ciclo').val();
        var docente_id =$('#modal_asignar_curso #id_usuario').val();
        

        var objGeneral = fnDataGeneral();
        
        if(nom_ciclo.length == 0 ){
            $.toast({
                heading: 'Error',
                text: 'Seleccione al menos un ciclo' ,
                position: 'top-right',
                icon: 'error',
                stack: false
            })
            return false;

        }
        
        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "Se asignarán los cursos seleccionados al plan de estudio y se crearan los syllabus para el usuario respectivamente",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, agreguelo!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Insertar_AsignacionCursos',
                    data: {
                        'id_asignacion_plan_estudios':id_asignacion_plan_estudios,
                        'nom_ciclo':nom_ciclo,
                        'docente_id':docente_id
                    },
                    success:function () {
                        List_AsignarCurso();
                        $('#modal_asignar_curso #nom_ciclo').val(null).trigger('change');
                        Swal.fire(
                        'Agregado!',
                        'El registro ha sido agregado a la tabla',
                        'success'
                        )
                    }
                });

            }
        })      
    }

    function Eliminar_CursoAsignado(id_asignacion_cursos,nom_ciclo){
        var id_asignacion_cursos = id_asignacion_cursos;  
        var objGeneral = fnDataGeneral();
        
        
        Swal.fire({
        title: '¿Esta Seguro de continuar?',
        text: "Se eliminará el curso del plan de estudio, al igual que el syllabu creado para el usuario",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, elimínelo!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type:"POST",
                    url:  objGeneral.__wurl+'Eliminar_AsignacionCurso',
                    data: {'id_asignacion_cursos':id_asignacion_cursos},
                    success:function () {
                        List_AsignarCurso();
                        Swal.fire(
                        'Agregado!',
                        'El registro ha sido eliminado a la tabla',
                        'success'
                        )
                    }
                });

            }
        })

    }   
</script>