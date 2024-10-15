<script>
  
    var url_general = "<?php echo base_url().'index.php?'; ?>";

    var api_key =  <?php echo "'".API_KEY_SISTEMA."'";  ?>  ;
    var url_restapi = "<?php echo site_url(); ?>rest/Restapi/";


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
            "processing": false,
            "serverSide": false,
            "ajax": { url : objGeneral.__wurl + "cargar_tabla_plan_estudios",  type : 'POST' },
            "responsive": true,
            "columns": [
                {"data": "ID_PLAN_ESTUDIOS" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_PLAN_ESTUDIOS"},
                {"data": "ANIO"},


                {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "CODIGO_PLAN_ES" },
                // {"data": "ID_CURSO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "MODALIDAD" },
                {"data": "GRADO_OTORGA" },
                {"data": "TITULO_PROFE"},
                {"data": "NOM_ESTATUS_PLAN_EST" },
                {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "NOM_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "TIPO_ESTUDIOS" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
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
        cargarTabla<?php echo $opcion; ?>();
        var msgDate = '';
        var inputFocus = '';    
        

        /*Adicional**/

         /**select2*/
            var datos_Generales = fnDataGeneral();
            $(datos_Generales.modal_principal+" "+"#cbx_multiple_id_carrera").select2();

            $(datos_Generales.modal_principal+" "+"#cbx_basicos_periodo_anio").select2({
                width: 'resolve',
                dropdownParent: $(datos_Generales.modal_principal+' '+datos_Generales.formulario_principal)
            });

            $("#cbx_basicos_id_carrera_original").select2({
                dropdownParent: $(datos_Generales.modal_principal+' '+datos_Generales.formulario_principal)
            });
            console.log("🚀 ~ file: plan_estudios.js.php:119 ~ $ ~ datos_Generales.modal_principal:", datos_Generales.modal_principal)

            $("#info-excel"+" "+"#cbx_basicos_id_carrera_info").select2();

    });


    function checkfile(sender) {
        var validExts = new Array(".xlsx", ".xls");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
                alert("Archivo no válido seleccionado, los archivos válidos son de " +
                validExts.toString() + " tipos.");
                $('#import_file_excel').val('');
                
                setTimeout(function(){  
                    $('#import_file_excel_title').text('Escoger archivo Excel')
                }, 1000);

                
        return false;
        }
        else return true;
    }

    function fn_ImportarExcel(){
        var objGeneral = fnDataGeneral();
        $('#import_form').prop('disabled', true);

        var datafile  = $('input#import_file_excel[type=file]')[0].files[0];

        switch (datafile) { 
            case undefined: 

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '!Debes cargar un archivo¡',
                })
                $('#import_form').prop('disabled', false);

                break;
            case '': 
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '!Debes cargar un archivo¡',
                })
                $('#import_form').prop('disabled', false);

                break;
            default:
            $('.preloader').show();

                var formData = new FormData();
                formData.append('excel_file', $('input#import_file_excel[type=file]')[0].files[0]); 

                $.ajax({
                    url:objGeneral.__wurl + "PlanEstudios_excel_importar",
                    method:"POST",
                    data:formData,
                    contentType:false,
                    cache:false,
                    processData:false,
                    success:function(data){
                        setTimeout(function(){  
                            $('#import_file_excel_title').text('Escoger archivo Excel');
                            $('#import_form').prop('disabled', false);
                            $('#import_file_excel').val('');
                            $(objGeneral._tabla).DataTable().ajax.reload();
                            $('.preloader').hide();

                        }, 1000);
                    }
                })

        }
        //outputs "jQuery Wins!"


	}



    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();
        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(0)

        $(objGeneral.modal_principal+" "+"#cbx_multiple_id_carrera > option").removeAttr("selected");
        $(objGeneral.modal_principal+" "+"#cbx_multiple_id_carrera").trigger("change");
        
        $(objGeneral.modal_principal+" "+'#codigo_plan_estudios').val('');

        $(objGeneral.modal_principal+" "+"#cbx_multiple_id_carrera").val("");
        $(objGeneral.modal_principal+" "+"#cbx_multiple_id_carrera").trigger("change");

		$(objGeneral.modal_principal+" "+'#plan_estudios').val('');
    	$(objGeneral.modal_principal+" "+'#grado_otorga').val('');
        $(objGeneral.modal_principal+" "+'#titulo_prof').val('');
        $(objGeneral.modal_principal+" "+'#modalidad').val(0);

        $(objGeneral.modal_principal+" "+"#cbx_basicos_id_carrera_original").val(0);
        $(objGeneral.modal_principal+" "+"#cbx_basicos_id_carrera_original").trigger("change");

        $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val(0);



        /*id para actualizar */
        $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val('');

        $(objGeneral.modal_principal+" "+'#vista_ciclo').empty();


	}

    const Agrupar_por = (array, key) => {
        return array.reduce((result, currentValue) => {
            (result[currentValue[key]] = result[currentValue[key]] || []).push(
                currentValue
            );
                return result;
        }, {}); 
    };

    function fn_AbrirModal(Accion,id_row,fila,funcion_name){

        var objGeneral = fnDataGeneral();
        fn_limpiarPopup();
        $(objGeneral.modal_principal+" "+".modal-footer").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>\
        <button type='button' class='btn btn-primary' onclick="+funcion_name+"('"+Accion+"');>Guardar</button>");
        

        $(objGeneral.modal_principal+" "+'#chkall_ciclo').prop( "checked", false );
        $(objGeneral.modal_principal+" "+'#chkall_ciclo' ).trigger("click");


        if( Accion === 'I'){

            $(objGeneral.modal_principal+" "+"#titulo_modal_xl_full").text('Registrar Plan de Estudios');

        }else if(Accion === 'A') {

                var data = $(objGeneral._tabla).DataTable().row(fila).data();
                /* Poner data en modal */
                $(objGeneral.modal_principal+" "+"#titulo_modal_xl_full").text('Actualizar Plan de Estudios '+data['NOM_PLAN_ESTUDIOS']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);


                
                $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val(data['ANIO']).trigger("change");

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera_original').val(data['ID_CARRERA']).trigger("change");
                $(objGeneral.modal_principal+" "+'#codigo_plan_estudios').val(data['CODIGO_PLAN_ES']);
                $(objGeneral.modal_principal+" "+'#modalidad').val(data['MODALIDAD']);
                $(objGeneral.modal_principal+" "+'#titulo_prof').val(data['TITULO_PROFE']);
                $(objGeneral.modal_principal+" "+'#grado_otorga').val(data['GRADO_OTORGA']);
                $(objGeneral.modal_principal+" "+'#plan_estudios').val(data['NOM_PLAN_ESTUDIOS']);
                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(data['TIPO_ESTUDIOS'])

                $(objGeneral.modal_principal+" "+'#vista_ciclo').empty();

                $(objGeneral.modal_principal+" "+'button#boton_agregar_ciclo_edit').prop('disabled', true);

                $(objGeneral.modal_principal+" "+'#vista_ciclo').html(`
                        <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                            <div class="spinner_seccion"></div>

                        </div>
                `);   

                            var parametros = {
                                "ID_PLAN_ESTUDIOS":data['ID_PLAN_ESTUDIOS'],
                                "carreras_ids":data['ID_CARRERA']
                            };

                            $.ajax({
                                type  : "POST",
                                url   : objGeneral.__wurl+'List_byid_<?php echo $opcion; ?>',
                                data  : parametros, 
                            })
                            .done(function(obj) {

                                var data = JSON.parse(obj);

                                var num_ciclo = Agrupar_por(data['DATA_MAIN'], 'nom_ciclo'); 
                                var num_ciclo_data_tratada =Object.entries(num_ciclo);

                                var htmldata='';
                                
                                $.each(num_ciclo_data_tratada, function(index, value) {
                                    
                                         htmldata+=  `
                                                        <div class="card ciclo">
                                                            <div class="card-body" style="padding: 0px !important;">
                                                                        <div class="row"  num_ciclo_capa="${value[0].replace("ciclo ", "")}">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <h4 class="card-title"> CICLO <input class="form-control" style="width: 100px;display: initial !important;" type="number" name="num_ciclo" id="num_ciclo" value="${value[0].replace("ciclo ", "")}">   &nbsp;&nbsp;&nbsp;
                                                                                    <button style="width: 30px;height: 30px;padding: 0px;" class="btn btn-secondary waves-effect waves-light" onclick="AgregarCICLO_fila(this)" title='Agregar fila Ciclo'type="button">
                                                                                        <span class="btn-label"><i class="fas fa-plus"></i></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 text-right">
                                                                                <div class="form-group">
                                                                                
                                                                                    <button class="btn btn-danger waves-effect waves-light" onclick="EliminarCICLO(this)" title='Eliminar Ciclo'type="button">
                                                                                        <span class="btn-label"><i class="fas fa-window-minimize"></i></span>
                                                                                    </button>                                               
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-hover table-dark display no-wrap ">
                                                                        <thead class="bg-dark text-white">

                                                                            <tr>

                                                                                    <th colspan="4" class="text-center"></th>
                                                                                    <th colspan="2" class="text-center">HORAS TEORÍA VIRTUAL</th>
                                                                                    <th class="text-center"></th>
                                                                                    <th colspan="2" class="text-center">HORAS PRÁCTICA VIRTUAL</th>

                                                                                    <th colspan="9"  class="text-center"></th>
                                                                                                                             

                                                                            </tr>

                                                                            <tr>

                                                                                <th class="text-center"></th>
                                                                                <th class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                                                <th class="text-center">
                                                                   
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                CURSO
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                             
                                                                                </th>

                                                                                <th class="text-center">HORAS TEORÍA PRESENCIAL</th>
                                                                                <th class="text-center">SINCRONAS</th>
                                                                                <th class="text-center">ASINCRONAS</th>
                                                                                <th class="text-center">HORAS DE PRÁCTICA PRESENCIAL</th>
                                                                                <th class="text-center">SINCRONAS</th>
                                                                                <th class="text-center">ASINCRONAS</th>

                                                                                <th class="text-center" >HORAS TOTALES</th>

                                                                                <th class="text-center" >CRÉDITOS PRESENCIALES</th>
                                                                                <th class="text-center" >CRÉDITOS VIRTUALES</th>
                                                                                <th class="text-center" >CRÉDITOS</th>

                                                                    
                                                                                <th class="text-center" >
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                REQUISITO
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </th>
                                                                                <th class="text-center" >TIPO DE CURSO</th>
                                                                                <th class="text-center" >PRESENCIALIDAD</th>
                                                                                <th class="text-center" >OBLIGATORIEDAD</th>
                                                                                <th class="text-center" ></th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="border border-success">
                                                                        `;

                                                                            $.each(value[1], function(index1, value1) {
                                                                   


                                                                                
                                                                                var cursos='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSOS'], function(index, value) {

                                                                                    if(value1.id_curso == value['id_curso']){
                                                                                        cursos += '<option  selected value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }else{
                                                                                        cursos += '<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }

                                                                                });

                                                                                var curso_forma_estudio='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSO_FORMA_ESTUDIO'], function(index, value) {

                                                                                    if(value1.presencialidad==value['id_curso_forma_estudio']){
                                                                                        curso_forma_estudio += '<option selected value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';
                                                                                    }else{
                                                                                        curso_forma_estudio += '<option value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';

                                                                                    }


                                                                                });

                                                                                var tipo_curso='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['TIPO_CURSO'], function(index, value) {

                                                                                    if(value1.tipo_curso==value['id_tipo_curso']){
                                                                                        tipo_curso+='<option selected value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';
                                                                                    }else{
                                                                                        tipo_curso+='<option value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';

                                                                                    }



                                                                                });

                                                                                var curso_importancia='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSO_IMPORTANCIA'], function(index, value) {

                                                                                    if(value1.obligatoriedad==value['id_curso_importancia']){
                                                                                        curso_importancia+='<option selected value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';
                                                                                    }else{
                                                                                        curso_importancia+='<option value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';

                                                                                    }
                                                                                });


                                                                                var requisitos_array = value1.requisitos.split(',');


                                                                                var curso_requisito='';
                                                                                $.each(data['CURSO_REQUISITOS'], function(index, value) {

                                                                                    if ($.inArray(value['id_curso'], requisitos_array) >= 0) {
                                                                                        curso_requisito+='<option selected value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';

                                                                                    } else {
                                                                                        curso_requisito+='<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';

                                                                                    }

                                                                                });


                                                                                htmldata+= 
                                                                                `  
                                                                                <tr>

                                                                                        <td>
                                                                                            <button onClick="Activarselect2(this)" 
                                                                                            title="Buscador Avanzado" type="button" 
                                                                                            class="btn btn-success btn-outline detectar_fila"
                                                                                            data-idciclo="${value1.id_ciclo}">
                                                                                                <i class="fas fa-search"></i>
                                                                                            </button>
                                                                                        </td>

                                                                                        <td><input type="text" value="${value1.codigo}" class="form-control fila_disabled cursord" name="codigo" id="codigo" disabled></td>
                                                                                    
                                                                                        <td>
                                                                                            <select onChange="Recoger_data_curso(this)"   class="custom-select mw-100 cursos_plan_est fila_select_disabled select_cursord"  name="curso" id="curso" disabled>
                                                                                            ${cursos}
                                                                                            </select>
                                                                                        </td>
                                                                                        

                                                                                        <td><input type="number"   min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_teoricas_presencial"  value="${value1.horas_teoricas_presencial}"  id="horas_teoricas_presencial" disabled></td>
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_sincronas_teoricas"  value="${value1.horas_sincronas_teoricas}"  id="horas_sincronas_teoricas" disabled></td>
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_asincronas_teoricas"  value="${value1.horas_asincronas_teoricas}"  id="horas_asincronas_teoricas" disabled></td>
                                                                                        
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_practicas_presencial"  value="${value1.horas_practicas_presencial}"  id="horas_practicas_presencial" disabled></td>
                                                                                        <td><input type="number"   min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_sincronas_practicas"  value="${value1.horas_sincronas_practicas}"  id="horas_sincronas_practicas" disabled></td>
                                                                                        <td><input type="number"   min=0 onkeyup="Sumar_Creditos(this)"   class="form-control fila_disabled cursord" name="horas_asincronas_practicas"  value="${value1.horas_asincronas_practicas}"  id="horas_asincronas_practicas" disabled></td>
                                                                                        
                                                                                        
                                                                                        <td><input type="number"  readonly min=0   class="form-control fila_disabled cursord" name="horastotal"  value="${value1.horas_totales}"  id="horastotal" disabled></td>
                                                                                        
                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos_presencial" value="${value1.creditos_presencial}" id="creditos_presencial" disabled></td>
                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos_virtual" value="${value1.creditos_virtual}" id="creditos_virtual" disabled></td>

                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos" value="${value1.creditos}" id="creditos" disabled></td>


                                                                                        <td>
                                                                                         
                                                                                            <select class="form-control fila_select_disabled select_cursord" name="requisito[]" id="requisito" multiple disabled>
                                                                                            ${curso_requisito}
                                                                                            </select>


                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="tipocurso" id="tipocurso" disabled>
                                                                                              ${tipo_curso}
  
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="presencialidad" id="presencialidad" disabled>
                                                                                                ${curso_forma_estudio}

                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="obligatoriedad" id="obligatoriedad" disabled>
                                                                                                ${curso_importancia}
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <a style="cursor: pointer;" onclick="Eliminar_Fila_Ciclo(this)" id="delete" role="button" class="dropdown-item delay-toogle btn-table-modal" title="Eliminar usuario">
                                                                                                <span>
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                                </path>
                                                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                                                <line x1="14" y1="11" x2="14" y2="17">
                                                                                                </line>
                                                                                                </svg></span>
                                                                                            </a>
                                                                                        </td>
                                                                                </tr>
                                                                                `  
                                                                            });

                                                                        
                                         htmldata+= `                   </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `;


                                });

                                setTimeout(function(){  
                                                        
                                    $(objGeneral.modal_principal+" "+'#vista_ciclo').empty();
                                    $(objGeneral.modal_principal+" "+'button#boton_agregar_ciclo_edit').prop('disabled', false);

                                    $(objGeneral.modal_principal+" #vista_ciclo" ).append(htmldata);
                                }, 4000);
                              
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                someErrorFunction();
                            })
                            .always(function() {});

        }else{            
            
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_<?php echo $opcion; ?>() {
        var objGeneral = fnDataGeneral();


       

         
        if( $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val() == 0) {
            msgDate = 'Debe seleccionar el Año';
            inputFocus = '#cbx_basicos_periodo_anio';
            return false;
        }
        
        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val() == 0) {
            msgDate = 'Debe seleccionar tipo de estudio';
            inputFocus = '#cbx_basicos_id_tipo_estudios';
            return false;
        }
        
        if($(objGeneral.modal_principal+" "+'#plan_estudios').val().trim() === '') {
            msgDate = 'Debe ingresar el nombre del  plan de estudios';
            inputFocus = '#plan_estudios';
            return false;
        }

         if($(objGeneral.modal_principal+" "+'#codigo_plan_estudios').val().trim() === '') {
            msgDate = 'Debe ingresar el código del plan de estudios';
            inputFocus = '#codigo_plan_estudios';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#modalidad').val() == 0) {
            msgDate = 'Debe ingresar la modalidad';
            inputFocus = '#modalidad';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#grado_otorga').val().trim() === '') {
            msgDate = 'Debe ingresar el grado que otorga el plan de estudios';
            inputFocus = '#grado_otorga';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#titulo_prof').val().trim() === '') {
            msgDate = 'Debe ingresar el nombre del titulo profesional';
            inputFocus = '#titulo_prof';
            return false;
        }

        if( $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera_original').val() == 0) {
            msgDate = 'Debe seleccionar una carrera';
            inputFocus = '#cbx_basicos_id_carrera_original';
            return false;
        }

       
        var carreras_ids_combo = $(objGeneral.modal_principal+" "+'#cbx_basicos_id_carrera_original').val(); 
        let carreras_ids = carreras_ids_combo.toString();


        var Obj_data = {	
            id_plan_estudios:$(objGeneral.modal_principal+" "+'#id_plan_estudios').val(),
            codigo_plan_estudios:$(objGeneral.modal_principal+" "+'#codigo_plan_estudios').val(),
            id_tipo_estudios:$(objGeneral.modal_principal+" "+'#cbx_basicos_id_tipo_estudios').val(),
            plan_estudios:$(objGeneral.modal_principal+" "+'#plan_estudios').val(),
            modalidad:$(objGeneral.modal_principal+" "+'#modalidad').val(),
            grado_otorga:$(objGeneral.modal_principal+" "+'#grado_otorga').val(),
            titulo_prof: $(objGeneral.modal_principal+" "+'#titulo_prof').val(),
            anio:  $(objGeneral.modal_principal+" "+'#cbx_basicos_periodo_anio').val(),
            id_carrera: carreras_ids,
            ciclo: [],
            accion:'I',
            ciclo_electivo:1
        };


        var fila_ciclo = 0;
        var ciclos_validacion_data = 0;
        var ciclos_validacion_data_orden = 0;


        var nombre_ciclo = '';

        $(objGeneral.modal_principal+" "+"#vista_ciclo table tbody").each(function(index0, element0) {

            nombre_ciclo = $(element0).parent().parent().parent().find('.row').find('#num_ciclo').val();
            
            if( nombre_ciclo === '' || parseInt(nombre_ciclo) == 0 ){

                if(nombre_ciclo === '' ){
                    msgDate =  `Porfavor ingrese el nombre no lo deje vacio`;
                }else if(parseInt(nombre_ciclo ) == 0 ){
                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo `;
                }
                fila_ciclo ++;
                inputFocus = '#cbx_multiple_id_carrera';

                return false;

            }else{
                nom_ciclo = nombre_ciclo;                      
            }


            ciclos_validacion_data = $(element0).find('tr').length;
            ciclos_validacion_data_orden = index0+1;


            $(element0).find('tr').each(function(index1, element) {
                        var num_columna = 0;

                        id_ciclo = $(element).find('td').eq(num_columna).find('button').attr('data-idciclo');                     


                         num_columna += 1;


                        if( $(element).find('td').eq(16).find("select").val() === '2'){
                            codigo= null;
                        }else{
                            if( $(element).find('td').eq(num_columna).find("input:text").val() === '' || parseInt($(element).find('td').eq(num_columna).find("input:text").val()) == 0 ){


                                if($(element).find('td').eq(num_columna).find("input:text").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna} </strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("input:text").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna} </strong>    `;

                                }

                                inputFocus = $(element).find('td').eq(num_columna).find("input:text");
                                fila_ciclo ++;
                                return false;
                            }else{

                                codigo = $(element).find('td').eq(num_columna).find('input:text').val() ;                      

                            }                        

                        }

                        

                        num_columna += 1;
                        //---2



                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0){


                            if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;
                            }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>    `;

                            } 


                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;


                        }else{

                            id_curso = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }



                        //---
                        //---
                        //---3
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                           
                        
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_teoricas_presencial  = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //---4
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;


                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_sincronas_teoricas = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //---5
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            


                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                             horas_asincronas_teoricas= $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----6
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_practicas_presencial   = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----7
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                      

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_sincronas_practicas   = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----8
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_asincronas_practicas= $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----9
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            
                           
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_totales = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        
                        //----10
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos_presencial = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----11
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            
                          
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos_virtual = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----12
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }



                        num_columna += 1;

                        //---
                        //---13
                        //---

                        if( $(element).find('td').eq(num_columna).find("select").val().length == 0 ){

                            msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;
                         
                            inputFocus = $(element).find('td').eq(num_columna).find("select");
                            fila_ciclo ++;
                            return false;

                        }else{

                            requisitos = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }

                        num_columna += 1;


                        //---14

                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){


                            if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;
                            }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>    `;

                            } 


                            inputFocus = $(element).find('td').eq(num_columna).find("select");
                            fila_ciclo ++;
                            return false;


                        }else{
                            tipo_curso = $(element).find('td').eq(num_columna).find('select').val() ;                      
                        }

                        num_columna += 1;

                        //_-----15
                        
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){


                                if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>    `;

                                } 


                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;


                        }else{

                            presencialidad = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }

                        num_columna += 1;

                        //------16
                               
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){


                                if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>    `;

                                } 


                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;


                        }else{

                            obligatoriedad = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }


                        var horas_teoricas= parseInt(parseFloat(horas_sincronas_teoricas) + parseFloat(horas_asincronas_teoricas) + parseFloat(horas_teoricas_presencial));
                        var horas_practicas= parseInt(parseFloat(horas_sincronas_practicas) + parseFloat(horas_asincronas_practicas) + parseFloat(horas_practicas_presencial));


                        data__fila = {
                            'id_ciclo':id_ciclo,
                            'orden_ciclo':index0+1,
                            'codigo':codigo,
                            'id_curso':id_curso,
                            'creditos':creditos,

                            'creditos_presencial':creditos_presencial,
                            'creditos_virtual':creditos_virtual,

                            'horas_teoricas':horas_teoricas,
                            'horas_practicas':horas_practicas,

                            'horas_sincronas_teoricas':horas_sincronas_teoricas,
                            'horas_asincronas_teoricas':horas_asincronas_teoricas,
                            'horas_teoricas_presencial':horas_teoricas_presencial,

                            'horas_sincronas_practicas':horas_sincronas_practicas,
                            'horas_asincronas_practicas':horas_asincronas_practicas,
                            'horas_practicas_presencial':horas_practicas_presencial,

                            'horas_totales':horas_totales,
                            'requisitos':requisitos,
                            'tipo_curso':tipo_curso,
                            'presencialidad':presencialidad,
                            'obligatoriedad':obligatoriedad,



                        };

                        var arrays_filas = {	
                            nombre:'ciclo '+nombre_ciclo,
                            num_ciclo:nombre_ciclo,
                            data__fila: data__fila,
                        };

                        Obj_data['ciclo'].push(arrays_filas)

      
            
            });

        });

 
        if(fila_ciclo==0){


            if(Obj_data['ciclo'].length === 0){
                
                    msgDate = 'Debe generar subdata en los ciclos creados para guardar el plan de estudios';
                    inputFocus = '#cbx_multiple_id_carrera';
                    return false;

            }else{

                if(ciclos_validacion_data == 0){
                    msgDate = 'Debe generar subdata en el ciclo '+ nombre_ciclo +' que tiene el orden '+ciclos_validacion_data_orden+' para guardar el plan de estudios ';
                    inputFocus = '#cbx_multiple_id_carrera';
                    return false;

                }else{



                    return Obj_data;
                }
            }
        }else{
                return false;
        }

    }

    function Insert_Update_<?php echo $opcion; ?>(Accion){
        var objGeneral = fnDataGeneral();
        var dataString = $(objGeneral.modal_principal+" "+objGeneral.formulario_principal).serialize();

                if (Valida_<?php echo $opcion; ?>()) {

                    obj= (Valida_<?php echo $opcion; ?>());

                    // return;
                    if(Accion === "A"){
                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Update_<?php echo $opcion; ?>',
                            data  : obj, 
                            })
                            .done(function(data) {
                                swal.fire(
                                    'Actualización Exitosa!',
                                    'Haga clic en el botón!',
                                    'success'
                                    ).then(function() {
                                        //return false;
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
                            data  : obj, 
                            })
                            .done(function(data) {
                                swal.fire(
                                        'Registo Exitoso!',
                                        'Haga clic en el botón!',
                                        'success'
                                    ).then(function() {
                                       // return false;

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
                    url:  objGeneral.__wurl+'Delete_PlanEstudios',
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

    function Cambiar_Estado_PlanEstudios(id){
        var objGeneral = fnDataGeneral();

        
        var id = id;
     
                            Swal.fire({
                                title: 'Seleccione el estado ha cambiar',
                                input: 'select',
                                inputOptions: {
                                    'Estado': {
                                    anuado: 'Anulado',
                                    revision: 'En revisión',
                                    activado: 'Activado'
                                   }
                                },
                                inputPlaceholder: 'Seleccione el estado',
                                showCancelButton: true,
                                inputValidator: (value) => {
                                    return new Promise((resolve) => {
                                        if (value === 'anuado') {

                                            $.ajax({
                                                type:"POST",
                                                url:  objGeneral.__wurl+'CambioEstado',
                                                data: {'id_plan_estudios':id,'estado':1},
                                                success:function () {
                                                    Swal.fire(
                                                        'Estado Cambiado!',
                                                        'El registro ha sido actualizado a estado Anulado.',
                                                        'success'
                                                    ).then(function() {
                                                        window.location = objGeneral.__wurl;
                                                    });
                                                }
                                            });


                                        } else if(value === 'revision'){

                                            $.ajax({
                                                type:"POST",
                                                url:  objGeneral.__wurl+'CambioEstado',
                                                data: {'id_plan_estudios':id,'estado':2},
                                                success:function () {
                                                    Swal.fire(
                                                        'Estado Cambiado!',
                                                        'El registro ha sido actualizado a estado En revisión.',
                                                        'success'
                                                    ).then(function() {
                                                        window.location = objGeneral.__wurl;
                                                    });
                                                }
                                            });


                                        }else if(value === 'activado'){
                                            
                                            $.ajax({
                                                type:"POST",
                                                url:  objGeneral.__wurl+'CambioEstado',
                                                data: {'id_plan_estudios':id,'estado':3},
                                                success:function () {
                                                    Swal.fire(
                                                        'Estado Cambiado!',
                                                        'El registro ha sido actualizado a estado activado.',
                                                        'success'
                                                    ).then(function() {
                                                        window.location = objGeneral.__wurl;
                                                    });
                                                }
                                            });


                                        }
                                    })
                                }
                            })

    }

    $(document).on("hidden.bs.modal", ".bootbox.modal", function (e) {

        jQuery("body").addClass("modal-open");
    });

    
    function Sumar_Creditos(th){

        var fila_tr =$(th).parent().parent();

        var objGeneral = fnDataGeneral();

        var horas_teoricas_presencial = ( ( $(fila_tr).find("td").eq(3).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(3).find('input').val()); 
        var horas_sincronas_teoricas = ( ( $(fila_tr).find("td").eq(4).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(4).find('input').val()); 
        var horas_asincronas_teoricas = ( ( $(fila_tr).find("td").eq(5).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(5).find('input').val());   

        var horas_practicas_presencial = ( ( $(fila_tr).find("td").eq(6).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(6).find('input').val());
        var horas_sincronas_practicas = ( ( $(fila_tr).find("td").eq(7).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(7).find('input').val());
        var horas_asincronas_practicas = ( ( $(fila_tr).find("td").eq(8).find('input').val() === '') ? 0 : $(fila_tr).find("td").eq(8).find('input').val());

        var horas_totales = parseFloat(horas_teoricas_presencial)+ parseFloat(horas_sincronas_teoricas)+ parseFloat(horas_asincronas_teoricas)  + parseFloat(horas_practicas_presencial) + parseFloat(horas_sincronas_practicas)+ parseFloat(horas_asincronas_practicas);

        $(fila_tr).find("td").eq(9).find('input').val(horas_totales);  

        var total_virtual= parseInt(( ( parseFloat(horas_sincronas_practicas) +  parseFloat(horas_asincronas_practicas) ) /32 )+( ( parseFloat(horas_sincronas_teoricas) + parseFloat(horas_asincronas_teoricas) )/16)  );
        var total_presencial= parseInt((parseFloat(horas_teoricas_presencial)/16)+(parseFloat(horas_practicas_presencial)/32));

        var sum_creditos = parseFloat(total_virtual)+ parseFloat(total_presencial) ;

        $(fila_tr).find("td").eq(10).find('input').val(total_presencial);  
        $(fila_tr).find("td").eq(11).find('input').val(total_virtual);  
        $(fila_tr).find("td").eq(12).find('input').val(sum_creditos);   
    }


    function Selec_Todo_Ciclo(th){
        var objGeneral = fnDataGeneral();

        if($(th).is(':checked')){

            $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera > option').prop("selected", "selected");
            $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera' ).trigger("change");
        } else {

            $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera > option').prop('selected', false);;
            $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera' ).trigger("change");
        }
    }


    /********************************************************/

    function AgregarCICLO(){
        /* CICLO */
        var objGeneral = fnDataGeneral();
        

        var ciclos = $(objGeneral.modal_principal+" .ciclo"); 

        var Cantidad_ciclo = ciclos.length +1;
        
        $(objGeneral.modal_principal+" #vista_ciclo" ).append(`
                        <div class="card ciclo">
                            <div class="card-body" style="padding: 0px !important;">
                                        <div class="row" num_ciclo_capa="" >
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h4 class="card-title"> CICLO <input class="form-control" style="width: 100px;display: initial !important;" type="number" name="num_ciclo" id="num_ciclo" value="${Cantidad_ciclo}">   &nbsp;&nbsp;&nbsp;
                                                    <button style="width: 30px;height: 30px;padding: 0px;" class="btn btn-secondary waves-effect waves-light" onclick="AgregarCICLO_fila(this)" title='Agregar fila Ciclo'type="button">
                                                        <span class="btn-label"><i class="fas fa-plus"></i></span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <div class="form-group">
                                                
                                                    <button class="btn btn-danger waves-effect waves-light" onclick="EliminarCICLO(this)" title='Eliminar Ciclo'type="button">
                                                        <span class="btn-label"><i class="fas fa-window-minimize"></i></span>
                                                    </button>                                               
                                                </div>
                                            </div>
                                        </div>
                                    

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-dark table-hover display no-wrap">
                                        <thead class="bg-dark text-white">
                                           
                                        <tr>

                                                <th colspan="4" class="text-center"></th>
                                                <th colspan="2" class="text-center">HORAS TEORÍA VIRTUAL</th>
                                                <th class="text-center"></th>
                                                <th colspan="2" class="text-center">HORAS PRÁCTICA VIRTUAL</th>

                                                <th colspan="9"  class="text-center"></th>
                                                                                        

                                                </tr>

                                                <tr>

                                                <th class="text-center"></th>
                                                <th class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th class="text-center">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                CURSO
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>

                                                <th class="text-center">HORAS TEORÍA PRESENCIAL</th>
                                                <th class="text-center">SINCRONAS</th>
                                                <th class="text-center">ASINCRONAS</th>
                                                <th class="text-center">HORAS DE PRÁCTICA PRESENCIAL</th>
                                                <th class="text-center">SINCRONAS</th>
                                                <th class="text-center">ASINCRONAS</th>

                                                <th class="text-center" >HORAS TOTALES</th>

                                                <th class="text-center" >CRÉDITOS PRESENCIALES</th>
                                                <th class="text-center" >CRÉDITOS VIRTUALES</th>
                                                <th class="text-center" >CRÉDITOS</th>


                                                <th class="text-center" >
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                REQUISITO
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="text-center" >TIPO DE CURSO</th>
                                                <th class="text-center" >PRESENCIALIDAD</th>
                                                <th class="text-center" >OBLIGATORIEDAD</th>
                                                <th class="text-center" ></th>

                                        </tr>


                                        </thead>
                                        <tbody class="border border-success">
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>`
        );
        
    }

    function AgregarCICLO_fila(th){
        var objGeneral = fnDataGeneral();
        var carreras_ids_combo = $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera').val(); 
        let carreras_ids = carreras_ids_combo.toString();
    
        var ciclo_div =$(th).parent().parent().parent().parent().parent();
        var parametros = {
            "id_ciclo": 0,
            "carreras_ids":0
        };
                $.ajax({
                type  : "POST",
                url: url_restapi+'listar_cursos_tipo_prese_obli',
                headers: {
                                "X-API-KEY":api_key
                },
                data  : parametros, 
                })
                .done(function(data) {


                    var cursos='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSOS'], function(index, value) {
                        cursos += '<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                    });


                    var curso_forma_estudio='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSO_FORMA_ESTUDIO'], function(index, value) {
                        curso_forma_estudio += '<option value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';
                    });


                    var tipo_curso='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['TIPO_CURSO'], function(index, value) {
                        tipo_curso+='<option value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';
                    });


                    var curso_importancia='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSO_IMPORTANCIA'], function(index, value) {
                        curso_importancia+='<option value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';
                    });



                    var curso_requisito='';
                    $.each(data['CURSO_REQUISITOS'], function(index, value) {
                        curso_requisito+='<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                    });





                    $(ciclo_div).find('table').find('tbody').append(
                        `       <tr>

                                    <td>
                                        <button onClick="Activarselect2(this)" 
                                        title="Buscador Avanzado" type="button" 
                                        class="btn btn-success btn-outline detectar_fila"
                                        data-idciclo="">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </td>
                                    <td><input type="text" class="form-control  fila_disabled cursord" name="codigo" id="codigo" disabled></td>
                             
                                    <td>
                                    <select onChange="Recoger_data_curso(this)"   class="custom-select mw-100 cursos_plan_est fila_select_disabled select_cursord"  name="curso" id="curso" disabled>
                                    ${cursos}
                                        </select>
                                    </td> 
                                    

                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_teoricas_presencial"  value=""  id="horas_teoricas_presencial" disabled></td>
                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_sincronas_teoricas"  value=""  id="horas_sincronas_teoricas" disabled></td>
                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_asincronas_teoricas"  value=""  id="horas_asincronas_teoricas" disabled></td>
                                    
                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_practicas_presencial"  value=""  id="horas_practicas_presencial" disabled></td>
                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_sincronas_practicas"  value=""  id="horas_sincronas_practicas" disabled></td>
                                    <td><input type="number"    min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_asincronas_practicas"  value=""  id="horas_asincronas_practicas" disabled></td>
                                                                                        
                                    <td><input type="number"  readonly  min=0     class="form-control fila_disabled cursord" name="horastotal" id="horastotal" disabled></td>
                                    
                                    <td><input type="number" readonly  min=0   class="form-control fila_disabled cursord" name="creditos_presencial" value="" id="creditos_presencial" disabled></td>
                                    <td><input type="number" readonly  min=0   class="form-control fila_disabled cursord" name="creditos_virtual" value="" id="creditos_virtual" disabled></td>
                                    <td><input type="number" readonly  min=0    class="form-control fila_disabled cursord" name="creditos" id="creditos" disabled></td>     

                                    
                                    <td>
                                        <select class="form-control fila_select_disabled select_cursord" name="requisito[]" id="requisito" multiple disabled>
                                           ${curso_requisito}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="tipocurso" id="tipocurso" disabled>
                                    ${tipo_curso}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="presencialidad" id="presencialidad" disabled>
                                    ${curso_forma_estudio}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="obligatoriedad" id="obligatoriedad" disabled>
                                    ${curso_importancia}
                                        </select>
                                    </td>
                                    <td>
                                        <a style="cursor: pointer;" onclick="Eliminar_Fila_Ciclo(this)" id="delete" role="button" class="dropdown-item delay-toogle btn-table-modal" title="Eliminar usuario">
                                            <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17">
                                            </line>
                                            </svg></span>
                                        </a>
                                    </td>
                                </tr>
                        `            
                    );


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    someErrorFunction();
                })
                .always(function() {});     
            

          
    
    }

    function EliminarCICLO(th){
        var ciclo_div =$(th).parent().parent().parent();
        
        var num_ciclo =$(ciclo_div).attr('num_ciclo_capa');
        
        var objGeneral = fnDataGeneral();
        var id_plan_estudios =$(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val();

        // return false;

        if(num_ciclo===''){

                Swal.fire({
                    //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
                    title: '¿Realmente desea eliminar el Ciclo '+num_ciclo,
                    text: "El registro será eliminado permanentemente",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.value) {
                        var ciclo =$(th).parent().parent().parent().parent().parent();

                        ciclo.remove();
                    }
                });
                    
        }else{


                Swal.fire({
                    //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
                    title: '¿Realmente desea eliminar el Ciclo '+num_ciclo +'que existe en la base de datos',
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
                            url:  objGeneral.__wurl+'Delete_Ciclo_Completo',
                            data: {
                                
                                'id_plan_estudios':id_plan_estudios,
                             'num_ciclo':num_ciclo,

                                    },
                            success:function () {
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then(function() {

                                    var ciclo =$(th).parent().parent().parent().parent().parent();

                                    ciclo.remove();

                                });
                            }
                        });


                   
                    }
                });
            


        }

      





    }
    
    function Eliminar_Fila_Ciclo(th){
        var fila_tr =$(th).parent().parent();
        id_ciclo = $(fila_tr).find('td').eq(0).find('button').attr('data-idciclo');                     
        var objGeneral = fnDataGeneral();

        // return false;
        if(id_ciclo===''){
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
                        url:  objGeneral.__wurl+'Delete_Ciclo',
                        data: {'id_ciclo':id_ciclo},
                        success:function () {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado satisfactoriamente.',
                                'success'
                            ).then(function() {
                                fila_tr.remove();
                            });
                        }
                    });
                }
            })
        }

    }

    function Activarselect2(th){

        $('.detectar_fila').css({"background-color": "#1ca96b", "border": "1px solid #1b9e64"});
        var objGeneral = fnDataGeneral();


        $(objGeneral.modal_principal+" "+"table .fila_select_disabled").prop("disabled", true); 
        $(objGeneral.modal_principal+" "+"table .fila_select_disabled").addClass("select_cursord");

        $(objGeneral.modal_principal+" "+"table .fila_disabled").prop("disabled", true); 
        $(objGeneral.modal_principal+" "+"table .fila_disabled").addClass("cursord");

        var carreras_ids_combo = $(objGeneral.modal_principal+" "+'#cbx_multiple_id_carrera').val(); 
        var carreras_ids = carreras_ids_combo.toString();

        var fila_tr = $(th).parent().parent().find("td").eq(2).find('select');
        var fila_tr_mult = $(th).parent().parent().find("td").eq(13).find('select');

        $(th).css({"background-color": "brown", "border": "1px solid red"});

        var fila_tr_vista =$(th).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();

        /** */
        let timerInterval
        Swal.fire({
            title: '!Analizando data de los filtros seleccionados!',
            html: 'El proceso terminará en <b></b> millisegundos.',
            timer: 500,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {

                if(carreras_ids==''){

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '¡No se encontro ninguna data para filtrar los cursos de esta fila!',
                        footer: 'Escoge los filtros que necesites para crear el plan de estudios'
                    });

                    $(fila_tr).select2({
                    width: 'resolve',
                    });

                    $(fila_tr).select2('destroy'); 
                    
                }else{
           
                    $(fila_tr).prop("disabled", false); 
                    $(fila_tr_mult).prop("disabled", false); 

                    $(fila_tr).removeClass("select_cursord");
                    $(fila_tr_mult).removeClass("select_cursord");


                        $(fila_tr).select2({
                            width: 'resolve',
                            placeholder: 'Seleccionar curso',
                            allowClear: true,
                            dropdownParent: $(fila_tr_vista),
                            ajax: { 
                                    url: url_restapi+'listar_cursos',
                                        headers: {
                                        "X-API-KEY":api_key
                                        },
                                    type: "post",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            carreras_ids:carreras_ids,
                                            searchTerm: params.term
                                        };
                                    },
                                    processResults: function (response) {
                                        return {
                                            results: response
                                        };
                                    },
                                    cache: true
                            }
                        });

                        $(fila_tr_mult).select2({ 
                            width: 'resolve',
                            placeholder: 'Seleccionar curso requisito',
                            allowClear: true,
                             dropdownParent: $(fila_tr_vista),                            
                        }
                        );


                        $(th).parent().parent().find("td").eq(1).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(3).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(4).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(5).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(6).find('input').prop("disabled", false);

                        $(th).parent().parent().find("td").eq(7).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(8).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(9).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(10).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(11).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(12).find('input').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(13).find('input').prop("disabled", false);

                        $(th).parent().parent().find("td").eq(14).find('select').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(15).find('select').prop("disabled", false);
                        $(th).parent().parent().find("td").eq(16).find('select').prop("disabled", false);

                    //-------------------------------------------------------------------------------------------

                        $(th).parent().parent().find("td").eq(1).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(3).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(4).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(5).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(6).find('input').removeClass("cursord");


                        $(th).parent().parent().find("td").eq(7).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(8).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(9).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(10).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(11).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(12).find('input').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(13).find('input').removeClass("cursord");

                        $(th).parent().parent().find("td").eq(14).find('select').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(15).find('select').removeClass("cursord");
                        $(th).parent().parent().find("td").eq(16).find('select').removeClass("cursord");
                }  
            }
        })
    }

    function Recoger_data_curso(th){       
 
        var texto_nombre =th.options[th.selectedIndex].text

        var id= th.value;
        var fila_tr =$(th).parent().parent();


        if(texto_nombre === 'ELECTIVO 1' || texto_nombre === 'ELECTIVO 2' ||  texto_nombre === 'ELECTIVO 3' ||  texto_nombre === 'ELECTIVO' ){

            $(fila_tr).find("td").eq(1).find('input:text').val('').prop( "disabled", true );;

            $(fila_tr).find("td").eq(3).find('input').val(0);
            $(fila_tr).find("td").eq(4).find('input').val(0);
            $(fila_tr).find("td").eq(5).find('input').val(0);
            $(fila_tr).find("td").eq(6).find('input').val(0);
            $(fila_tr).find("td").eq(7).find('input').val(0);
            $(fila_tr).find("td").eq(8).find('input').val(0);

            $(fila_tr).find("td").eq(9).find('input').val(0);  

            $(fila_tr).find("td").eq(10).find('input').val(0);  
            $(fila_tr).find("td").eq(11).find('input').val(0);  

            $(fila_tr).find("td").eq(12).find('input').val(0);  
            
            $(fila_tr).find("td").eq(13).find('select').val('')
            $(fila_tr).find("td").eq(13).find('select').trigger("change");

            $(fila_tr).find("td").eq(14).find('select').val(0);   
            $(fila_tr).find("td").eq(15).find('select').val(0);   
            $(fila_tr).find("td").eq(16).find('select').val(2).prop( "disabled", true );

        }else{

                $.ajax({
                    type  : "POST",
                    headers: {
                        "X-API-KEY":api_key
                    },
                    url: url_restapi+'listar_cursos_by_id',
                    data: {'id_curso':id},
                })
                .done(function(data) {

                        $(fila_tr).find("td").eq(1).find('input:text').val(data[0]['codigo']).prop( "disabled", false );;

                        $(fila_tr).find("td").eq(3).find('input').val(data[0]['horas_teoricas_presencial']);
                        $(fila_tr).find("td").eq(4).find('input').val(data[0]['horas_sincronas_teoricas']);
                        $(fila_tr).find("td").eq(5).find('input').val(data[0]['horas_asincronas_teoricas']);
                        $(fila_tr).find("td").eq(6).find('input').val(data[0]['horas_practicas_presencial']);
                        $(fila_tr).find("td").eq(7).find('input').val(data[0]['horas_sincronas_practicas']);
                        $(fila_tr).find("td").eq(8).find('input').val(data[0]['horas_asincronas_practicas']);

                    $(fila_tr).find("td").eq(9).find('input').val(data[0]['horas_totales']);  

                    $(fila_tr).find("td").eq(10).find('input').val(data[0]['creditos_presencial']);  
                    $(fila_tr).find("td").eq(11).find('input').val(data[0]['creditos_virtual']);  

                        $(fila_tr).find("td").eq(12).find('input').val(data[0]['creditos']);   


                    /*select multiple */
                    var ids_cursos = data[0]['requisitos'];
                        var ids_cursos_data = ids_cursos.split(','); 
                            $.each(ids_cursos_data, function(index, value) {
                                $(fila_tr).find("td").eq(13).find('select').val(value).prop("selected","selected")
                                $(fila_tr).find("td").eq(13).find('select').trigger("change");
                            });
                    /* */

                        $(fila_tr).find("td").eq(14).find('select').val(data[0]['tipo_curso']);   
                    $(fila_tr).find("td").eq(15).find('select').val(data[0]['presencialidad']);   
                        $(fila_tr).find("td").eq(16).find('select').val(data[0]['obligatoriedad']).prop( "disabled", false );
                    
                }).fail(function(jqXHR, textStatus, errorThrown) { }).always(function() {});


        }
                           
    }

    //--------------- 
    // CURSOS ELECTIVOS-------------------------------------------------------------------------------------------------------------------
    //-----
    var modal_nombre_elec = '#cursos_electivos_modal';

    function Electivos_<?php echo $opcion; ?>(id,id_carrera,fila){
            $(modal_nombre_elec).modal('show');       
            var objGeneral = fnDataGeneral();

            $(modal_nombre_elec+" "+'#chkall_ciclo_electivo').prop( "checked", false );
            $(modal_nombre_elec+" "+'#chkall_ciclo_electivo' ).trigger("click");

            $( modal_nombre_elec+' #formulario_plan_estudios_electivos #curso_electivo_capa').empty();

            $(modal_nombre_elec+" "+'#curso_electivo_capa').html(`
                        <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                            <div class="spinner_seccion"></div>
                        </div>
                `);   

            $(modal_nombre_elec+" "+'button#boton_agregar_electivo').prop('disabled', true);

            $( modal_nombre_elec+' #formulario_plan_estudios_electivos #id_plan_estudios').val(id);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos #id_carrera').val(id_carrera);

            var data = $(objGeneral._tabla).DataTable().row(fila).data();

            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#carrera_text').text(data['NOM_CARRERA']);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#codigo_plan_estudios_text').text(data['CODIGO_PLAN_ES']);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#modalidad_text').text(data['MODALIDAD']);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#titulo_prof_text').text(data['TITULO_PROFE']);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#grado_otorga_text').text(data['GRADO_OTORGA']);
            $( modal_nombre_elec+' #formulario_plan_estudios_electivos'+' '+'#nombre_plan_estudios_text').text(data['NOM_PLAN_ESTUDIOS']);


            var parametros =    {
                                    "ID_PLAN_ESTUDIOS":id,
                                    "carreras_ids": 0,
                                };

                            $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'List_byid_electivo_<?php echo $opcion; ?>',
                                    data  : parametros, 
                            })
                            .done(function(obj) {

                                var data = JSON.parse(obj);

                                var num_ciclo = Agrupar_por(data['DATA_MAIN'], 'ciclo_num'); 
                                var num_ciclo_data_tratada =Object.entries(num_ciclo);
                                

                                var htmldata='';
                                
                                $.each(num_ciclo_data_tratada, function(index, value) {
                                    
                                         htmldata+=  `
                                                        <div class="card ciclo">
                                                            <div class="card-body" style="padding: 0px !important;" >
                                                                        <div class="row" num_ciclo_capa="${value[0].replace("ciclo ", "")}">




                                                                                                        
                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <h4 class="card-title">
                                                                                            <input type="number" class="form-control"  placeholder="N° Orden" name="num_ciclo" id="num_ciclo" value="${value[0].replace("ciclo ", "")}"> 
                                                                                    </h4>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <div class="form-group">
                                                                                    <h6 class="card-title" style="font-size: 15px;">
                                                                                        CURSOS ELECTIVOS POR ORIENTACIÓN :
                                                                                    </h6>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <h4 class="card-title">
                                                                                        <input class="form-control" placeholder="Nombre de cursos electivos"  type="text" name="nom_ciclo" id="nom_ciclo" value="${value[1][0]['nom_ciclo']}">   
                                                                                    </h4>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-1 text-right">
                                                                                <div class="form-group">
                                                                                
                                                                                    <button style="width: 23px;height: 25px;padding: 0px;" class="btn btn-secondary waves-effect waves-light" onclick="AgregarCICLO_ELECTIVO_fila(this)" title="Agregar fila Ciclo Electivo" type="button">
                                                                                        <span class="btn-label"><i class="fas fa-plus"></i></span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>


                                                                            <div class="col-md-1 text-right">
                                                                                <div class="form-group">
                                                                                    <button class="btn btn-danger waves-effect waves-light" onclick="EliminarCICLO_Electivo(this)" title='Eliminar Ciclo Electivo'type="button">
                                                                                        <span class="btn-label"><i class="fas fa-window-minimize"></i></span>
                                                                                    </button>                                               
                                                                                </div>
                                                                            </div>



                                                                            
                                                                        </div>
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-bordered table-dark table-hover display no-wrap ">
                                                                        <thead class="bg-dark text-white">

                                                                            <tr>

                                                                                    <th colspan="4" class="text-center"></th>
                                                                                    <th colspan="2" class="text-center">HORAS TEORÍA VIRTUAL</th>
                                                                                    <th class="text-center"></th>
                                                                                    <th colspan="2" class="text-center">HORAS PRÁCTICA VIRTUAL</th>

                                                                                    <th colspan="9"  class="text-center"></th>
                                                                                                                             

                                                                            </tr>

                                                                            <tr>

                                                                                <th class="text-center"></th>
                                                                                <th class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                                                <th class="text-center">
                                                                   
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                CURSO
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                             
                                                                                </th>

                                                                                <th class="text-center">HORAS TEORÍA PRESENCIAL</th>
                                                                                <th class="text-center">SINCRONAS</th>
                                                                                <th class="text-center">ASINCRONAS</th>
                                                                                <th class="text-center">HORAS DE PRÁCTICA PRESENCIAL</th>
                                                                                <th class="text-center">SINCRONAS</th>
                                                                                <th class="text-center">ASINCRONAS</th>

                                                                                <th class="text-center" >HORAS TOTALES</th>

                                                                                <th class="text-center" >CRÉDITOS PRESENCIALES</th>
                                                                                <th class="text-center" >CRÉDITOS VIRTUALES</th>
                                                                                <th class="text-center" >CRÉDITOS</th>

                                                                    
                                                                                <th class="text-center" >
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                REQUISITO
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                </th>
                                                                                <th class="text-center" >TIPO DE CURSO</th>
                                                                                <th class="text-center" >PRESENCIALIDAD</th>
                                                                                <th class="text-center" >OBLIGATORIEDAD</th>
                                                                                <th class="text-center" ></th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="border border-success">
                                                                        `;

                                                                            $.each(value[1], function(index1, value1) {

                                                                                var cursos='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSOS'], function(index, value) {

                                                                                    if(value1.id_curso == value['id_curso']){
                                                                                        cursos += '<option  selected value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }else{
                                                                                        cursos += '<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }

                                                                                });

                                                                                var curso_forma_estudio='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSO_FORMA_ESTUDIO'], function(index, value) {

                                                                                    if(value1.presencialidad==value['id_curso_forma_estudio']){
                                                                                        curso_forma_estudio += '<option selected value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';
                                                                                    }else{
                                                                                        curso_forma_estudio += '<option value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';

                                                                                    }


                                                                                });


                                                                                var tipo_curso='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['TIPO_CURSO'], function(index, value) {

                                                                                    if(value1.tipo_curso==value['id_tipo_curso']){
                                                                                        tipo_curso+='<option selected value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';
                                                                                    }else{
                                                                                        tipo_curso+='<option value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';

                                                                                    }



                                                                                });



                                                                                var curso_importancia='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                                                                                $.each(data['CURSO_IMPORTANCIA'], function(index, value) {

                                                                                    if(value1.obligatoriedad==value['id_curso_importancia']){
                                                                                        curso_importancia+='<option selected value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';
                                                                                    }else{
                                                                                        curso_importancia+='<option value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';

                                                                                    }


                                                                                });


                                                                                var curso_requisito='';
                                                                                $.each(data['CURSO_REQUISITOS'], function(index, value) {
                                                                                
                                                                                    if(value1.requisitos==value['id_curso']){
                                                                                        curso_requisito+='<option selected value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }else{
                                                                                        curso_requisito+='<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                                                                    }


                                                                                });


                                                                                htmldata+= 
                                                                                `  
                                                                                <tr>

                                                                                        <td>
                                                                                     

                                                                                            <button onClick="Activarselect2_electivo(this)" 
                                                                                                title="Desbloquear fila" 
                                                                                                type="button" 
                                                                                                class="btn btn-success btn-outline detectar_fila"
                                                                                                data-idciclo="${value1.id_ciclo}">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M12 2c1.091 0 2.117.292 3 .804a1 1 0 1 1-1 1.73A4 4 0 0 0 8 8l11 .001a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1a6 6 0 0 1 6-6Zm7 8H5v10h14V10Zm-7 2a2 2 0 0 1 1.134 3.647l-.134.085V17a1 1 0 0 1-1.993.117L11 17v-1.268A2 2 0 0 1 12 12Zm7.918-6.979l.966.26a1 1 0 0 1-.518 1.93l-.965-.258a1 1 0 0 1 .517-1.932ZM18.633 2.09a1 1 0 0 1 .707 1.225l-.129.482a1 1 0 1 1-1.932-.517l.13-.483a1 1 0 0 1 1.224-.707Z"/></g></svg>
                                                                                            </button>

                                                                                        </td>

                                                                                        <td><input type="text" value="${value1.codigo}" class="form-control fila_disabled cursord" name="codigo" id="codigo" disabled></td>
                                                                                    
                                                                                        <td>
                                                                                            <select onChange="Recoger_data_curso(this)"   class="custom-select mw-100 cursos_plan_est fila_select_disabled select_cursord"  name="curso" id="curso" disabled>
                                                                                            ${cursos}
                                                                                            </select>
                                                                                        </td>
                                                                                        

                                                                                        <td><input type="number"   min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_teoricas_presencial"  value="${value1.horas_teoricas_presencial}"  id="horas_teoricas_presencial" disabled></td>
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_sincronas_teoricas"  value="${value1.horas_sincronas_teoricas}"  id="horas_sincronas_teoricas" disabled></td>
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_asincronas_teoricas"  value="${value1.horas_asincronas_teoricas}"  id="horas_asincronas_teoricas" disabled></td>
                                                                                        
                                                                                        <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_practicas_presencial"  value="${value1.horas_practicas_presencial}"  id="horas_practicas_presencial" disabled></td>
                                                                                        <td><input type="number"   min=0  onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_sincronas_practicas"  value="${value1.horas_sincronas_practicas}"  id="horas_sincronas_practicas" disabled></td>
                                                                                        <td><input type="number"   min=0 onkeyup="Sumar_Creditos(this)"   class="form-control fila_disabled cursord" name="horas_asincronas_practicas"  value="${value1.horas_asincronas_practicas}"  id="horas_asincronas_practicas" disabled></td>
                                                                                        
                                                                                        
                                                                                        <td><input type="number"  readonly min=0   class="form-control fila_disabled cursord" name="horastotal"  value="${value1.horas_totales}"  id="horastotal" disabled></td>
                                                                                        
                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos_presencial" value="${value1.creditos_presencial}" id="creditos_presencial" disabled></td>
                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos_virtual" value="${value1.creditos_virtual}" id="creditos_virtual" disabled></td>

                                                                                        <td><input type="number" readonly min=0   class="form-control fila_disabled cursord" name="creditos" value="${value1.creditos}" id="creditos" disabled></td>


                                                                                        <td>
                                                                                         
                                                                                            <select class="form-control fila_select_disabled select_cursord" name="requisito[]" id="requisito" multiple disabled>
                                                                                            ${curso_requisito}
                                                                                            </select>


                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="tipocurso" id="tipocurso" disabled>
                                                                                              ${tipo_curso}
  
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="presencialidad" id="presencialidad" disabled>
                                                                                                ${curso_forma_estudio}

                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="obligatoriedad" id="obligatoriedad" disabled>
                                                                                                ${curso_importancia}
                                                                                            </select>
                                                                                        </td>
                                                                                        <td>
                                                                                            <a style="cursor: pointer;" onclick="Eliminar_Fila_Ciclo(this)" id="delete" role="button" class="dropdown-item delay-toogle btn-table-modal" title="Eliminar usuario">
                                                                                                <span>
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                                                </path>
                                                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                                                <line x1="14" y1="11" x2="14" y2="17">
                                                                                                </line>
                                                                                                </svg></span>
                                                                                            </a>
                                                                                        </td>
                                                                                </tr>
                                                                                `  
                                                                            });

                                                                        
                                         htmldata+= `                   </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    `;


                                });

                                setTimeout(function(){  
                                    $( modal_nombre_elec+' #formulario_plan_estudios_electivos #curso_electivo_capa').empty();
                                                        $(modal_nombre_elec+" "+'button#boton_agregar_electivo').prop('disabled', false);
                                                        $(modal_nombre_elec+" #curso_electivo_capa" ).append(htmldata);
                                }, 4000);
                              
                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {
                                someErrorFunction();
                            })
                            .always(function() {});


    }


    $(document).ready(function() {

            $(modal_nombre_elec+" #formulario_plan_estudios_electivos"+" "+"#cbx_multiple_id_carrera_electivo").select2();
        
    });
    
    function Cantidad_Electivos_Agregar(th){

        var cant = th.value;
        
        var ciclos = $(modal_nombre_elec+" #formulario_plan_estudios_electivos  .ciclo"); 

        var Cantidad_ciclo = ciclos.length +1;


        // $('#cursos_electivos_modal #curso_electivo_capa').empty();

            $(modal_nombre_elec+" #formulario_plan_estudios_electivos #curso_electivo_capa" ).append(`
                <div class="card ciclo">
                    <div class="card-body" style="padding: 0px !important;">
                                <div class="row" num_ciclo_capa="" >


                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 class="card-title">
                                                                <input type="number" class="form-control"  placeholder="N° Orden" name="num_ciclo" id="num_ciclo" value="${Cantidad_ciclo}"> 
                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h6 class="card-title" style="font-size: 15px;">
                                                            CURSOS ELECTIVOS POR ORIENTACIÓN :
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h4 class="card-title">
                                                            <input class="form-control" placeholder="Nombre de cursos electivos"  type="text" name="nom_ciclo" id="nom_ciclo" value="">   
                                                        </h4>
                                                    </div>
                                                </div>


                                                <div class="col-md-1 text-right">
                                                    <div class="form-group">
                                                       
                                                        <button style="width: 23px;height: 25px;padding: 0px;" class="btn btn-secondary waves-effect waves-light" onclick="AgregarCICLO_ELECTIVO_fila(this)" title="Agregar fila Ciclo Electivo" type="button">
                                                            <span class="btn-label"><i class="fas fa-plus"></i></span>
                                                        </button>
                                                    </div>
                                                </div>


                                                <div class="col-md-1 text-right">
                                                    <div class="form-group">
                                                        <button class="btn btn-danger waves-effect waves-light" onclick="EliminarCICLO_Electivo(this)" title='Eliminar Ciclo Electivo'type="button">
                                                            <span class="btn-label"><i class="fas fa-window-minimize"></i></span>
                                                        </button>                                               
                                                    </div>
                                                </div>


                                </div>
                            

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered  table-dark table-hover display no-wrap ">
                                <thead class="bg-dark text-white">
                                
                                        <tr>

                                                <th colspan="4" class="text-center"></th>
                                                <th colspan="2" class="text-center">HORAS TEORÍA VIRTUAL</th>
                                                <th class="text-center"></th>
                                                <th colspan="2" class="text-center">HORAS PRÁCTICA VIRTUAL</th>

                                                <th colspan="9"  class="text-center"></th>
                                                                                

                                        </tr>

                                        <tr>

                                                <th class="text-center"></th>
                                                <th class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CODIGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th class="text-center">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            CURSO
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>

                                                <th class="text-center">HORAS TEORÍA PRESENCIAL</th>
                                                <th class="text-center">SINCRONAS</th>
                                                <th class="text-center">ASINCRONAS</th>
                                                <th class="text-center">HORAS DE PRÁCTICA PRESENCIAL</th>
                                                <th class="text-center">SINCRONAS</th>
                                                <th class="text-center">ASINCRONAS</th>

                                                <th class="text-center" >HORAS TOTALES</th>

                                                <th class="text-center" >CRÉDITOS PRESENCIALES</th>
                                                <th class="text-center" >CRÉDITOS VIRTUALES</th>
                                                <th class="text-center" >CRÉDITOS</th>


                                                <th class="text-center" >
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        REQUISITO
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="text-center" >TIPO DE CURSO</th>
                                                <th class="text-center" >PRESENCIALIDAD</th>
                                                <th class="text-center" >OBLIGATORIEDAD</th>
                                                <th class="text-center" ></th>

                                        </tr>


                                </thead>
                                <tbody class="border border-success">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>`
            );

        
    }

    function AgregarCICLO_ELECTIVO_fila(th){
        var objGeneral = fnDataGeneral();
        var carreras_ids_combo = $(modal_nombre_elec+" #formulario_plan_estudios_electivos "+'#cbx_multiple_id_carrera_electivo').val(); 
        let carreras_ids = carreras_ids_combo.toString();
    
        var ciclo_div =$(th).parent().parent().parent().parent().parent();
        var parametros = {
            "id_ciclo": 0,
            "carreras_ids":0
        };
                $.ajax({
                type  : "POST",
                url: url_restapi+'listar_cursos_tipo_prese_obli',
                headers: {
                                "X-API-KEY":api_key
                },
                data  : parametros, 
                })
                .done(function(data) {


                    var cursos='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSOS'], function(index, value) {
                        cursos += '<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                    });


                    var curso_forma_estudio='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSO_FORMA_ESTUDIO'], function(index, value) {
                        curso_forma_estudio += '<option value="'+value['id_curso_forma_estudio']+'">'+value['nom_curso_forma_estudio'] +'</option>';
                    });


                    var tipo_curso='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['TIPO_CURSO'], function(index, value) {
                        tipo_curso+='<option value="'+value['id_tipo_curso']+'">'+value['nom_tipo_curso'] +'</option>';
                    });


                    var curso_importancia='<option value="'+0+'" selected>'+ 'Seleccionar' +'</option>';
                    $.each(data['CURSO_IMPORTANCIA'], function(index, value) {
                        curso_importancia+='<option value="'+value['id_curso_importancia']+'">'+value['nom_curso_importancia'] +'</option>';
                    });


                    var curso_requisito='';
                    $.each(data['CURSO_REQUISITOS'], function(index, value) {
                        curso_requisito+='<option value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                    });


                    $(ciclo_div).find('table').find('tbody').append(
                        `       <tr>

                                    <td>
                                        <button onClick="Activarselect2_electivo(this)" 
                                        title="Desbloquear fila" 
                                        type="button" 
                                        class="btn btn-success btn-outline detectar_fila"
                                        data-idciclo="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none"><path d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"/><path fill="currentColor" d="M12 2c1.091 0 2.117.292 3 .804a1 1 0 1 1-1 1.73A4 4 0 0 0 8 8l11 .001a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2h1a6 6 0 0 1 6-6Zm7 8H5v10h14V10Zm-7 2a2 2 0 0 1 1.134 3.647l-.134.085V17a1 1 0 0 1-1.993.117L11 17v-1.268A2 2 0 0 1 12 12Zm7.918-6.979l.966.26a1 1 0 0 1-.518 1.93l-.965-.258a1 1 0 0 1 .517-1.932ZM18.633 2.09a1 1 0 0 1 .707 1.225l-.129.482a1 1 0 1 1-1.932-.517l.13-.483a1 1 0 0 1 1.224-.707Z"/></g></svg>
                                        </button>
                                    </td>
                                    <td><input type="text" class="form-control  fila_disabled cursord" name="codigo" id="codigo" disabled></td>
                             
                                    <td>
                                    <select onChange="Recoger_data_curso(this)"   class="custom-select mw-100 cursos_plan_est fila_select_disabled select_cursord"  name="curso" id="curso" disabled>
                                    ${cursos}
                                        </select>
                                    </td> 
                                    

                                    <td><input type="number"  min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_teoricas_presencial"  value=""  id="horas_teoricas_presencial" disabled></td>
                                    <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_sincronas_teoricas"  value=""  id="horas_sincronas_teoricas" disabled></td>
                                    <td><input type="number"  min=0 onkeyup="Sumar_Creditos(this)"  class="form-control fila_disabled cursord" name="horas_asincronas_teoricas"  value=""  id="horas_asincronas_teoricas" disabled></td>
                                    
                                    <td><input type="number"  min=0 onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_practicas_presencial"  value=""  id="horas_practicas_presencial" disabled></td>
                                    <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_sincronas_practicas"  value=""  id="horas_sincronas_practicas" disabled></td>
                                    <td><input type="number"  min=0  onkeyup="Sumar_Creditos(this)" class="form-control fila_disabled cursord" name="horas_asincronas_practicas"  value=""  id="horas_asincronas_practicas" disabled></td>
                                                                                        
                                    <td><input type="number"  min=0  readonly   class="form-control fila_disabled cursord" name="horastotal" id="horastotal" disabled></td>
                                    
                                    
                                    
                                    <td><input type="number" min=0  readonly  class="form-control fila_disabled cursord" name="creditos" id="creditos" disabled></td>     
                                    <td><input type="number" min=0 readonly  class="form-control fila_disabled cursord" name="creditos_presencial" value="" id="creditos_presencial" disabled></td>
                                    <td><input type="number" min=0   readonly class="form-control fila_disabled cursord" name="creditos_virtual" value="" id="creditos_virtual" disabled></td>

                                    
                                    <td>
                                        <select class="form-control fila_select_disabled select_cursord" name="requisito[]" id="requisito" multiple disabled>
                                           ${curso_requisito}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="tipocurso" id="tipocurso" disabled>
                                    ${tipo_curso}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="presencialidad" id="presencialidad" disabled>
                                    ${curso_forma_estudio}
                                        </select>
                                    </td>
                                    <td><select style="width: 250px;" class="custom-select mw-100 fila_disabled cursord" name="obligatoriedad" id="obligatoriedad" disabled>
                                    ${curso_importancia}
                                        </select>
                                    </td>
                                    <td>
                                        <a style="cursor: pointer;" onclick="Eliminar_Fila_ELECTIVO_Ciclo(this)" id="delete" role="button" class="dropdown-item delay-toogle btn-table-modal" title="Eliminar usuario">
                                            <span>

                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 text-danger">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17">
                                            </line>
                                            </svg>
                                            
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                        `            
                    );


                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    someErrorFunction();
                })
                .always(function() {});     
            

          
    
    }

    function EliminarCICLO_Electivo(th){
        var ciclo_div =$(th).parent().parent().parent();
        var objGeneral = fnDataGeneral();

        var num_ciclo =$(ciclo_div).attr('num_ciclo_capa');
        
        var id_plan_estudios =$(modal_nombre_elec+' #formulario_plan_estudios_electivos #id_plan_estudios').val();

        // return false;

        if(num_ciclo===''){

                Swal.fire({
                    //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
                    title: '¿Realmente desea eliminar el Ciclo '+num_ciclo,
                    text: "El registro será eliminado permanentemente",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.value) {
                        var ciclo =$(th).parent().parent().parent().parent().parent();

                        ciclo.remove();
                    }
                });
                    
        }else{


                Swal.fire({
                    //title: '¿Realmente quieres eliminar el registro de '+ nombre +'?',
                    title: '¿Realmente desea eliminar el Ciclo '+num_ciclo +'que existe en la base de datos',
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
                            url:  objGeneral.__wurl+'Delete_Ciclo_Completo',
                            data: {
                                
                                'id_plan_estudios':id_plan_estudios,
                             'num_ciclo':num_ciclo,

                                    },
                            success:function () {
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then(function() {

                                    var ciclo =$(th).parent().parent().parent().parent().parent();

                                    ciclo.remove();

                                });
                            }
                        });


                   
                    }
                });
            


        }

    }

    function Eliminar_Fila_ELECTIVO_Ciclo(th){
        var fila_tr =$(th).parent().parent();
        id_ciclo = $(fila_tr).find('td').eq(0).find('button').attr('data-idciclo');                     
        var objGeneral = fnDataGeneral();

        // return false;
        if(id_ciclo===''){
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
                        url:  objGeneral.__wurl+'Delete_Ciclo',
                        data: {'id_ciclo':id_ciclo},
                        success:function () {
                            Swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado satisfactoriamente.',
                                'success'
                            ).then(function() {
                                fila_tr.remove();
                            });
                        }
                    });
                }
            })
        }


    }
    
    function Activarselect2_electivo(th){

            $('.detectar_fila').css({"background-color": "#1ca96b", "border": "1px solid #1b9e64"});
            var objGeneral = fnDataGeneral();


            $(modal_nombre_elec+" "+"table .fila_select_disabled").prop("disabled", true); 
            $(modal_nombre_elec+" "+"table .fila_select_disabled").addClass("select_cursord");

            $(modal_nombre_elec+" "+"table .fila_disabled").prop("disabled", true); 
            $(modal_nombre_elec+" "+"table .fila_disabled").addClass("cursord");

            var carreras_ids_combo = $(modal_nombre_elec+" "+"  #formulario_plan_estudios_electivos #cbx_multiple_id_carrera_electivo").val(); 
            var carreras_ids = carreras_ids_combo.toString();

            var fila_tr = $(th).parent().parent().find("td").eq(2).find('select');
            var fila_tr_mult = $(th).parent().parent().find("td").eq(13).find('select');

            $(th).css({"background-color": "brown", "border": "1px solid red"});

            var fila_tr_vista =$(th).parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent().parent();

            /** */
            let timerInterval
            Swal.fire({
                title: '!Analizando data de los filtros seleccionados!',
                html: 'El proceso terminará en <b></b> millisegundos.',
                timer: 500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {clearInterval(timerInterval)}}).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {

                                if(carreras_ids==''){

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '¡No se encontro ninguna data para filtrar los cursos de esta fila!',
                                        footer: 'Escoge los filtros que necesites para crear el plan de estudios'
                                    });

                                    $(fila_tr).select2({
                                    width: 'resolve',
                                    });

                                    $(fila_tr).select2('destroy'); 

                                }else{
                        
                                    $(fila_tr).prop("disabled", false); 
                                    $(fila_tr_mult).prop("disabled", false); 

                                    $(fila_tr).removeClass("select_cursord");
                                    $(fila_tr_mult).removeClass("select_cursord");


                                        $(fila_tr).select2({
                                            width: 'resolve',
                                            placeholder: 'Seleccionar curso',
                                            allowClear: true,
                                            dropdownParent: $(fila_tr_vista),
                                            ajax: { 
                                                    url: url_restapi+'listar_cursos',
                                                        headers: {
                                                        "X-API-KEY":api_key
                                                        },
                                                    type: "post",
                                                    dataType: 'json',
                                                    delay: 250,
                                                    data: function (params) {
                                                        return {
                                                            carreras_ids:carreras_ids,
                                                            searchTerm: params.term
                                                        };
                                                    },
                                                    processResults: function (response) {
                                                        return {
                                                            results: response
                                                        };
                                                    },
                                                    cache: true
                                            }
                                        });

                                        $(fila_tr_mult).select2({ 
                                            width: 'resolve',
                                            placeholder: 'Seleccionar curso requisito',
                                            allowClear: true,
                                            dropdownParent: $(fila_tr_vista),                                            
                                        }
                                        );


                                        $(th).parent().parent().find("td").eq(1).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(3).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(4).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(5).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(6).find('input').prop("disabled", false);

                                        $(th).parent().parent().find("td").eq(7).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(8).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(9).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(10).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(11).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(12).find('input').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(13).find('input').prop("disabled", false);

                                        $(th).parent().parent().find("td").eq(14).find('select').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(15).find('select').prop("disabled", false);
                                        $(th).parent().parent().find("td").eq(16).find('select').prop("disabled", false);

                                    //-------------------------------------------------------------------------------------------

                                        $(th).parent().parent().find("td").eq(1).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(3).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(4).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(5).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(6).find('input').removeClass("cursord");


                                        $(th).parent().parent().find("td").eq(7).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(8).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(9).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(10).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(11).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(12).find('input').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(13).find('input').removeClass("cursord");

                                        $(th).parent().parent().find("td").eq(14).find('select').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(15).find('select').removeClass("cursord");
                                        $(th).parent().parent().find("td").eq(16).find('select').removeClass("cursord");
                                }  
                        }
                })
    }

    function GuardarElectivo(){
        var objGeneral = fnDataGeneral();
        var dataString = $(modal_nombre_elec+" #formulario_plan_estudios_electivos").serialize();

                if (Valida_Electivo_<?php echo $opcion; ?>()) {

                    obj= (Valida_Electivo_<?php echo $opcion; ?>());

                    // return false;


                            $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Update_<?php echo $opcion; ?>',
                            data  : obj, 
                            })
                            .done(function(data) {
                                swal.fire(
                                    'Cambios Guardados Exitosamente!',
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

    function Valida_Electivo_<?php echo $opcion; ?>() {
      
        var Obj_data = {	
            id_plan_estudios:$(modal_nombre_elec+' #formulario_plan_estudios_electivos #id_plan_estudios').val(),
            id_carrera:  $(modal_nombre_elec+' #formulario_plan_estudios_electivos '+'#id_carrera').val(),

            ciclo: [],
            ciclo_electivo:2

        };


        var fila_ciclo = 0;
        var ciclos_validacion_data = 0;
        var ciclos_validacion_data_orden = 0;


        var num_ciclo = '';
        var nom_ciclo = '';

        $("#cursos_electivos_modal #formulario_plan_estudios_electivos "+"#curso_electivo_capa table tbody").each(function(index0, element0) {

            numer_ciclo = $(element0).parent().parent().parent().find('.row').find('#num_ciclo').val();
            nombre_ciclo = $(element0).parent().parent().parent().find('.row').find('#nom_ciclo').val();


                        if( numer_ciclo === '' || parseInt(numer_ciclo) == 0 ){

                                if(numer_ciclo === '' ){
                                    msgDate =  `Porfavor ingrese el numero de orden no lo deje vacio`;
                                }else if(parseInt(numer_ciclo ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo `;
                                }
                                fila_ciclo ++;
                                inputFocus = '#cbx_multiple_id_carrera';

                                return false;
                        }else{
                            num_ciclo = numer_ciclo;                      
                        }

                        if( nombre_ciclo === '' || parseInt(nombre_ciclo) == 0 ){

                            if(nombre_ciclo === '' ){
                                msgDate =  `Porfavor ingrese el nombre no lo deje vacio`;
                            }else if(parseInt(nombre_ciclo ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo `;
                            }
                            fila_ciclo ++;
                            inputFocus = '#cbx_multiple_id_carrera';

                            return false;

                        }else{
                            nom_ciclo = nombre_ciclo;                      
                        }

            ciclos_validacion_data = $(element0).find('tr').length;
            ciclos_validacion_data_orden = index0+1;


            $(element0).find('tr').each(function(index1, element) {
                        var num_columna = 0;

                        id_ciclo = $(element).find('td').eq(num_columna).find('button').attr('data-idciclo');                     
                         num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input:text").val() === '' || parseInt($(element).find('td').eq(num_columna).find("input:text").val()) == 0 ){


                                if($(element).find('td').eq(num_columna).find("input:text").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna} </strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("input:text").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna} </strong>    `;

                                }


                                    inputFocus = $(element).find('td').eq(num_columna).find("input:text");
                                    fila_ciclo ++;
                                    return false;


                        }else{

                            codigo = $(element).find('td').eq(num_columna).find('input:text').val() ;                      

                        }
                        num_columna += 1;
                        //---2
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0){


                            if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;
                            }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>    `;

                            } 


                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;


                        }else{

                            id_curso = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }
                        //---
                        //---
                        //---3
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                           
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;

                        }else{

                            horas_teoricas_presencial  = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //---4
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;


                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{
                            horas_sincronas_teoricas = $(element).find('td').eq(num_columna).find('input').val() ;                      
                        }
                        //---5
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            


                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                             horas_asincronas_teoricas= $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----6
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_practicas_presencial   = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----7
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                      

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_sincronas_practicas   = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----8
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_asincronas_practicas= $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----9
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            
                           
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            horas_totales = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }                        
                        //----10
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){

                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos_presencial = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----11
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            
                          
                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos_virtual = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        //----12
                        num_columna += 1;
                        if( $(element).find('td').eq(num_columna).find("input").val() === '' ){


                            
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna ${num_columna}  </strong>  `;
                            

                                inputFocus = $(element).find('td').eq(num_columna).find("input");
                                fila_ciclo ++;
                                return false;


                        }else{

                            creditos = $(element).find('td').eq(num_columna).find('input').val() ;                      

                        }
                        num_columna += 1;
                        //---
                        //---13
                        //---

                        if( $(element).find('td').eq(16).find("select").val() === '2'){

                          

                            requisitos = null;

                        }else{

                            if( $(element).find('td').eq(num_columna).find("select").val().length == 0 ){

                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;

                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;

                            }else{

                                requisitos = $(element).find('td').eq(num_columna).find('select').val() ;                      

                            }

                        }
                       
                        num_columna += 1;
                        //---14
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){

                            if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>  `;
                            }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna} </strong>    `;

                            } 

                            inputFocus = $(element).find('td').eq(num_columna).find("select");
                            fila_ciclo ++;
                            return false;


                        }else{
                            tipo_curso = $(element).find('td').eq(num_columna).find('select').val() ;                      
                        }
                        num_columna += 1;
                        //_-----15
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){


                                if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>    `;

                                } 


                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;


                        }else{
                            presencialidad = $(element).find('td').eq(num_columna).find('select').val() ;                      
                        }
                        num_columna += 1;
                        //------16
                        if( $(element).find('td').eq(num_columna).find("select").val() === '' || parseInt($(element).find('td').eq(num_columna).find("select").val()) == 0  ){

                                if($(element).find('td').eq(num_columna).find("select").val() === '' ){
                                    msgDate =  `Porfavor rellene el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>  `;
                                }else if(parseInt($(element).find('td').eq(num_columna).find("select").val() ) == 0 ){
                                    msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo que esta en la tabla  <b> ${index0+1}</b> especificamente en la <strong>fila:${index1+1}</strong> </br> en la <strong> columna  ${num_columna}</strong>    `;

                                } 

                                inputFocus = $(element).find('td').eq(num_columna).find("select");
                                fila_ciclo ++;
                                return false;
                        }else{

                            obligatoriedad = $(element).find('td').eq(num_columna).find('select').val() ;                      

                        }

                        // var horas_teoricas= horas_sincronas_teoricas + horas_asincronas_teoricas + horas_teoricas_presencial;
                        // var horas_practicas= horas_sincronas_practicas + horas_asincronas_practicas +horas_practicas_presencial;

                        
                        var horas_teoricas= parseInt(parseFloat(horas_sincronas_teoricas) + parseFloat(horas_asincronas_teoricas) + parseFloat(horas_teoricas_presencial));
                        var horas_practicas= parseInt(parseFloat(horas_sincronas_practicas) + parseFloat(horas_asincronas_practicas) + parseFloat(horas_practicas_presencial));


                        data__fila = {
                            'id_ciclo':id_ciclo,
                            'orden_ciclo':index0+1,
                            'codigo':codigo,
                            'id_curso':id_curso,
                            'creditos':creditos,

                            'creditos_presencial':creditos_presencial,
                            'creditos_virtual':creditos_virtual,

                            'horas_teoricas':horas_teoricas,
                            'horas_practicas':horas_practicas,

                            'horas_sincronas_teoricas':horas_sincronas_teoricas,
                            'horas_asincronas_teoricas':horas_asincronas_teoricas,
                            'horas_teoricas_presencial':horas_teoricas_presencial,

                            'horas_sincronas_practicas':horas_sincronas_practicas,
                            'horas_asincronas_practicas':horas_asincronas_practicas,
                            'horas_practicas_presencial':horas_practicas_presencial,

                            'horas_totales':horas_totales,
                            'requisitos':requisitos,
                            'tipo_curso':tipo_curso,
                            'presencialidad':presencialidad,
                            'obligatoriedad':obligatoriedad,
                        };

                        var arrays_filas = {	
                            nombre:nom_ciclo,
                            num_ciclo:num_ciclo,
                            data__fila: data__fila,
                        };

                        Obj_data['ciclo'].push(arrays_filas)

      
            
            });

        });

 
        if(fila_ciclo==0){


            if(Obj_data['ciclo'].length === 0){
                
                    msgDate = 'Debe generar subdata en los ciclos creados para guardar el plan de estudios';
                    inputFocus = '#cbx_multiple_id_carrera_electivo';
                    return false;

            }else{

                if(ciclos_validacion_data == 0){
                    msgDate = 'Debe generar subdata en el ciclo '+ nombre_ciclo +' que tiene el orden '+ciclos_validacion_data_orden+' para guardar el plan de estudios ';
                    inputFocus = '#cbx_multiple_id_carrera_electivo';
                    return false;

                }else{



                    return Obj_data;
                }
            }
        }else{
                return false;
        }

    }

    
    function Selec_Todo_Ciclo_electivo(th){

        if($(th).is(':checked')){
            $(modal_nombre_elec+" "+'#cbx_multiple_id_carrera_electivo > option').prop("selected", "selected");
            $(modal_nombre_elec+" "+'#cbx_multiple_id_carrera_electivo' ).trigger("change");
        } else {
            $(modal_nombre_elec+" "+'#cbx_multiple_id_carrera_electivo > option').prop('selected', false);
            $(modal_nombre_elec+" "+'#cbx_multiple_id_carrera_electivo' ).trigger("change");
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------

    var modal_articulacion = '#modal_xl_largo_plan_estudios_articulacion';
    
    function Articulacion_<?php echo $opcion; ?>(id,fila,boton){
            var objGeneral = fnDataGeneral();
            $(modal_articulacion).modal('show');       

            $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion  #vista_articula").html(`
                <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                    <div class="spinner_seccion"></div>
                </div>
            `);   


            $(modal_articulacion+" "+"#titulo_modal_xl_full").text('Seleccion de competencias de Plan de Estudios');

            $( modal_articulacion+' '+objGeneral.formulario_principal+'_articulacion #id_plan_estudios_articulacion').val(id);

            var data = $(objGeneral._tabla).DataTable().row(fila).data();
            $( modal_articulacion+' '+objGeneral.formulario_principal+'_articulacion'+' '+'#nombre_plan_estudios_text').text(data['NOM_PLAN_ESTUDIOS']);

            var parametros =    {  "ID_PLAN_ESTUDIOS":id  };

            $.ajax({
                    type  : "POST",
                    url   : objGeneral.__wurl+'List_byid_PlanEstudios_articulacion',
                    data  : parametros, 
            })
            .done(function(obj) {

                $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion  #vista_articula").html(`
                    
                        <table id="tabla_articulacion" class="table table-hover table-info mb-0">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th colspan="1"></th>
                                    <th colspan="4" class="text-center" style="background: cadetblue;border-bottom: 1px solid black; border-left: 1px solid black; border-top: 1px solid black;">Competencias Generales</th>
                                    <th colspan="6" class="text-center"  style="background: chocolate;border-bottom: 1px solid black; border-left: 4px solid black; border-top: 1px solid black;border-right: 1px solid black;">Competencias Especificas</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">CURSO</th>


                                    <th scope="col" class="text-center" style="background: #006e8f; border-bottom: 1px solid black; border-left: 1px solid black; border-top: 1px solid black; ">Competencia nombre</th>
                                    <th scope="col" class="text-center" style="background: #006e8f; border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col" class="text-center"  style="background: #006e8f; border-bottom: 1px solid black; border-left: 2px solid black; border-top: 1px solid black; ">Competencia nombre</th>
                                    <th scope="col" class="text-center" style="background: #006e8f; border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col" class="text-center"  style="background: #c49b14; border-bottom: 1px solid black; border-left: 4px solid black; border-top: 1px solid black; ">Competencia nombre</th>
                                    <th scope="col" class="text-center" style="background: #c49b14; border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col" class="text-center"  style="background: #c49b14; border-bottom: 1px solid black; border-left: 2px solid black; border-top: 1px solid black;">Competencia nombre</th>
                                    <th scope="col" class="text-center" style="background: #c49b14; border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col" class="text-center"  style="background: #c49b14; border-bottom: 1px solid black; border-left: 2px solid black; border-top: 1px solid black;">Competencia nombre</th>
                                    <th scope="col" class="text-center" style="background: #c49b14; border-bottom: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">Nivel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th scope="col" class="text-center">Acción </th>

                                </tr>
                            </thead>
                            <tbody>
                            ${obj}
                            </tbody>
                        </table>

                `);   
                               
                // $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion #vista_articula" ).empty();

                // $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion #tabla_articulacion tbody" ).append(obj);

                
                // $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion #tabla_articulacion").dataTable( {
                //     "searching": false
                // } );
                
                $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion #tabla_articulacion").find('select.custom-select').select2({
                    dropdownParent: $(modal_articulacion+' '+objGeneral.formulario_principal+"_articulacion #tabla_articulacion")                
                })

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});


    }

    function Guardar_Articulacion_Fila(id_curso,th,id_ciclo){


         
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

            
                    var fila_tr =$(th).parent().parent();

                    id_ciclo = id_ciclo;    

                    id_compet_detalle = $(fila_tr).attr('data-id');                     

                    comp_general_uno = $(fila_tr).find('td').eq(1).find('select').val();                     
                    niveles_comp_general_uno = $(fila_tr).find('td').eq(2).find('select').val();                     

                    comp_general_dos = $(fila_tr).find('td').eq(3).find('select').val();                     
                    niveles_comp_general_dos = $(fila_tr).find('td').eq(4).find('select').val();                     

                    ///----
                    comp_especifica_uno = $(fila_tr).find('td').eq(5).find('select').val();                     
                    niveles_comp_especif_uno = $(fila_tr).find('td').eq(6).find('select').val();                     


                    comp_especifica_dos = $(fila_tr).find('td').eq(7).find('select').val();                     
                    niveles_comp_especif_dos = $(fila_tr).find('td').eq(8).find('select').val();                     


                    comp_especifica_tres = $(fila_tr).find('td').eq(9).find('select').val();                     
                    niveles_comp_especif_tres = $(fila_tr).find('td').eq(10).find('select').val();                     


                    var parametros =    {
                            "comp_general_uno":comp_general_uno,
                            "niveles_comp_general_uno":niveles_comp_general_uno,
                            
                            "comp_general_dos":comp_general_dos,
                            "niveles_comp_general_dos":niveles_comp_general_dos,

                            "comp_especifica_uno":comp_especifica_uno,
                            "niveles_comp_especif_uno":niveles_comp_especif_uno,

                            "comp_especifica_dos":comp_especifica_dos,
                            "niveles_comp_especif_dos":niveles_comp_especif_dos,

                            "comp_especifica_tres":comp_especifica_tres,
                            "niveles_comp_especif_tres":niveles_comp_especif_tres,

                            "id_ciclo":id_ciclo,
                            "id_compet_detalle":id_compet_detalle
                        };

                    var objGeneral = fnDataGeneral();

                    $.ajax({
                            type  : "POST",
                            url   : objGeneral.__wurl+'Guardar_PlanEstudios_articulacion',
                            data  : parametros, 
                    })
                    .done(function(obj) {

                        
                          Swal.fire(
                            (id_compet_detalle == 0 ? 'Guardado!' : 'Actualizado'),
                                'El registro ha sido '+(id_compet_detalle ==='' ? 'guardado' : 'actualizado')+' satisfactoriamente.',
                                'success'
                            ).then(function() {
                              
                                $(fila_tr).find("td").eq(11).find("button").html(
                                    ` 
                                        <i class="fa fa-pencil"></i>
                                    `
                                );

                            });
    
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});


            }
        }) 






    }


</script>