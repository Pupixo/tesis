<script>

            var url_general = "<?php echo base_url().'index.php?'; ?>";
            var api_key =  <?php echo "'".API_KEY_SISTEMA."'";  ?>  ;
            var url_restapi = "<?php echo site_url(); ?>rest/Restapi/";


            $(document).ready(function() {
                var objGeneral = fnDataGeneral();


                if( $(objGeneral.form_1+" "+'#cbx_multiple_id_docente').is( ":disabled" ) == true) {
                    cargar_tabla_org_aprendizaje_revision();

                }else{
                    cargar_tabla_org_aprendizaje();

                }

                var msgDate = '';
                var inputFocus = '';

            });

            function fnDataGeneral(){
                /* VARIABLES POR DEFECTO A CARGAR, pueden agregarse mas segun el programador */
                var abrev = "<?php echo $abrev; ?>";
                var form_1 ="<?php echo $form_1; ?>";
                var form_2 ="<?php echo $form_2; ?>";
                var form_3 ="<?php echo $form_3; ?>";
                var form_4 ="<?php echo $form_4; ?>";
                var form_5 ="<?php echo $form_5; ?>";
                var form_6 ="<?php echo $form_6; ?>";
                var form_7 ="<?php echo $form_7; ?>";
                var form_8 ="<?php echo $form_8; ?>";
                var form_9 ="<?php echo $form_9; ?>";
                var form_10 ="<?php echo $form_10; ?>";

                var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";
                var base_url = "<?= base_url() ?>";

                var id_principal = "<?= $id_syllabus ?>";
                var id_version_sy = "<?= $id_version_sy ?>";

                var mydata = {
                    _abrev      : abrev,
                    __wurl          : wurl,
                    form_1: "#"+form_1,
                    form_2: "#"+form_2,
                    form_3: "#"+form_3,
                    form_4: "#"+form_4,
                    form_5: "#"+form_5,
                    form_6: "#"+form_6,
                    form_7: "#"+form_7,
                    form_8: "#"+form_8,
                    form_9: "#"+form_9,
                    form_10: "#"+form_10,
                    _tabla1 :'#tbl1'+abrev,
                    _id_principal  : id_principal,
                    _id_version_sy  : id_version_sy,


                    _base_url :base_url
                };

                return mydata;
            }

            function Valida_form_1() {
                var objGeneral = fnDataGeneral();



                // if($(objGeneral.form_1+" "+'#nom_syllabus').val().trim() === '') {
                //     msgDate = 'Debe ingresar un nombre para el syllabus ';
                //     inputFocus =objGeneral.form_1+" "+ '#nom_syllabus';
                //     return false;
                // }
                if($(objGeneral.form_1+" "+'#cbx_basicos_periodo_anio').val() === '') {
                    msgDate = 'Debe ingresar el año ';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_periodo_anio';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#numero_ciclo').val() === '') {
                    msgDate = 'Debe ingresar el numero de ciclo ';
                    inputFocus =objGeneral.form_1+" "+ '#numero_ciclo';
                    return false;
                }



                if($(objGeneral.form_1+" "+'#cbx_basicos_id_plan_estudios').val().trim() === '0') {
                    msgDate = 'Debe ingresar un plan de Estudios ';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_plan_estudios';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#cbx_basicos_id_carrera').val().trim() === '0') {
                    msgDate = 'Debe ingresar una carrera';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_carrera';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#nom_ciclo').val().trim() === '') {
                    msgDate = 'Debe ingresar nombre de ciclo';
                    inputFocus =objGeneral.form_1+" "+ '#nom_ciclo';
                    return false;
                }

                if($(objGeneral.form_1+" "+'#cbx_basicos_id_curso').val().trim() === '0') {
                    msgDate = 'Debe ingresar el curso';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_curso';
                    return false;
                }


                if($(objGeneral.form_1+" "+'#creditos').val().trim() === '') {
                    msgDate = 'Debe ingresar los creditos';
                    inputFocus =objGeneral.form_1+" "+ '#creditos';
                    return false;
                }

                if($(objGeneral.form_1+" "+'#horas_practicas').val().trim() === '') {
                    msgDate = 'Debe ingresar las horas practicas';
                    inputFocus =objGeneral.form_1+" "+ '#horas_practicas';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#horas_teoricas').val().trim() === '') {
                    msgDate = 'Debe ingresar las horas teoricas';
                    inputFocus =objGeneral.form_1+" "+ '#horas_teoricas';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#horas_totales').val().trim() === '') {
                    msgDate = 'Debe ingresar las horas totlaes';
                    inputFocus =objGeneral.form_1+" "+ '#horas_totales';
                    return false;
                }


                if($(objGeneral.form_1+" "+'#requisito').val().length == 0) {
                    msgDate = 'Debe ingresar requisitos';
                    inputFocus =objGeneral.form_1+" "+ '#requisito';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val().trim() === '0') {
                    msgDate = 'Debe ingresar el tipo de curso';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_tipo_curso';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim() === '0') {
                    msgDate = 'Debe ingresar la presencialidad del curso';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_curso_forma_estudio';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val().trim() === '0') {
                    msgDate = 'Debe ingresar las condicion';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_curso_importancia';
                    return false;
                }



                if($(objGeneral.form_1+" "+'#cbx_basicos_id_director').val().trim() === '0') {
                    msgDate = 'Debe ingresar al responsable del curso';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_basicos_id_director';
                    return false;
                }
                if($(objGeneral.form_1+" "+'#cbx_multiple_id_docente').val().length == 0) {
                    msgDate = 'Debe ingresar a los docentes';
                    inputFocus =objGeneral.form_1+" "+ '#cbx_multiple_id_docente';
                    return false;
                }


                return true;
            }

            function Update_form_1(){
                var objGeneral = fnDataGeneral();

                // $(objGeneral.form_1+" "+'#nom_syllabus').val().trim()
                                var dataString = {

                                    'id_version_sy': $(objGeneral.form_1+" "+'#id_version_sy').val().trim() ,
                                    'estado_sillabus': $(objGeneral.form_1+" "+'#estado_sillabus').val().trim() ,

                                    "id_syllabus": objGeneral._id_principal,
                                    "version_sy_principal":  $(objGeneral.form_1+" "+'#version_sy_principal').val().trim() ,

                                    'nom_syllabus':'',
                                    'anio': $(objGeneral.form_1+" "+'#cbx_basicos_periodo_anio').val() ,
                                    'numero_ciclo': $(objGeneral.form_1+" "+'#numero_ciclo').val(),

                                    'cbx_basicos_id_plan_estudios': $(objGeneral.form_1+" "+'#cbx_basicos_id_plan_estudios').val().trim() ,
                                    'cbx_basicos_id_carrera': $(objGeneral.form_1+" "+'#cbx_basicos_id_carrera').val().trim(),
                                    'nom_ciclo': $(objGeneral.form_1+" "+'#nom_ciclo').val().trim(),
                                    'cbx_basicos_id_curso': $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').val().trim() ,

                                    'creditos' :$(objGeneral.form_1+" "+'#creditos').val().trim(),
                                    'horas_practicas' :$(objGeneral.form_1+" "+'#horas_practicas').val().trim(),
                                    'horas_teoricas':$(objGeneral.form_1+" "+'#horas_teoricas').val().trim(),
                                    'horas_totales':$(objGeneral.form_1+" "+'#horas_totales').val().trim(),

                                    'requisito':$(objGeneral.form_1+" "+'#requisito').val(),
                                    'cbx_basicos_id_tipo_curso':$(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val().trim(),
                                    'cbx_basicos_id_curso_forma_estudio':$(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim(),
                                    'cbx_basicos_id_curso_importancia':$(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val().trim(),

                                    'cbx_basicos_id_director':$(objGeneral.form_1+" "+'#cbx_basicos_id_director').val().trim(),
                                    'cbx_multiple_id_docente':$(objGeneral.form_1+" "+'#cbx_multiple_id_docente').val(),

                                    'id_ciclo':$(objGeneral.form_1+" "+'#cbx_basicos_id_curso').find('option:selected').attr('id-ciclo'),
                                    'id_tipo_estudios':$(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_estudios').val(),

                                    'id_compt_asoci_curso':$(objGeneral.form_2+" "+'#id_compt_asoci_curso').val(),

                                };


                        if (Valida_form_1()) {

                            // return false;
                                    $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Update_Asyllabus_datos_generales',
                                    data  : dataString,
                                    })
                                    .done(function(data) {
                                        swal.fire(
                                            'Actualización Exitosa!',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {
                                                var datos = data.split(',');

                                                        $('#nombre_syllabus').html(datos[0]);
                                                        $('#periodo_anio_ciclo').html(datos[1]+'-'+datos[2]);

                                                //window.location = objGeneral.__wurl;
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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }

            $(document).ready(function() {
                        var objGeneral = fnDataGeneral();

                        $(objGeneral.form_1+" "+"#cbx_multiple_id_docente").select2();

                        setTimeout(function(){
                            $(objGeneral.form_1+" "+'#cbx_basicos_id_plan_estudios').val(identi_id_plan_estudios).trigger('change');
                        },1000);

                        setTimeout(function(){
                            $(objGeneral.form_1+" "+'#cbx_basicos_id_carrera').val(identi_carrera).trigger('change');
                        }, 3000);

                        setTimeout(function(){
                            $(objGeneral.form_1+" "+'#nom_ciclo').val(identi_nom_ciclo).trigger('change');
                        }, 5000);

                        setTimeout(function(){
                            $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').val(identi_id_curso).trigger('change');
                        }, 8000);
                        $(objGeneral.form_1+" "+"#cbx_multiple_id_docente").select2();

                        $(objGeneral.form_1+" "+"#requisito").select2();
            });


            //-------------------------------------------------------------------------------------------



            function Valida_form_2() {
                var objGeneral = fnDataGeneral();
                if($(objGeneral.form_2+" "+'#compt_gene').val().trim() === '') {
                    msgDate = 'Debe ingresar una competencia general ';
                    inputFocus =objGeneral.form_2+" "+ '#compt_gene';
                    return false;
                }
                if($(objGeneral.form_2+" "+'#compt_gene_descr').val().trim() === '') {
                    msgDate = 'Debe ingresar una descripción de la competencia general';
                    inputFocus =objGeneral.form_2+" "+ '#compt_gene_descr';
                    return false;
                }
                if($(objGeneral.form_2+" "+'#compt_espec_1').val().trim() === '') {
                    msgDate = 'Debe ingresar una primera competencia especifica';
                    inputFocus =objGeneral.form_2+" "+ '#compt_espec_1';
                    return false;
                }
                if($(objGeneral.form_2+" "+'#compt_espec_descr_1').val().trim() === '') {
                    msgDate = 'Debe ingresar los primera descripcion competencia especifica';
                    inputFocus =objGeneral.form_2+" "+ '#compt_espec_descr_1';
                    return false;
                }
                if($(objGeneral.form_2+" "+'#compt_espec_2').val().trim() === '') {
                    msgDate = 'Debe ingresar una segunda competencia especifica';
                    inputFocus =objGeneral.form_2+" "+ '#compt_espec_2';
                    return false;
                }
                if($(objGeneral.form_2+" "+'#compt_espec_descr_2').val().trim() === '') {
                    msgDate = 'Debe ingresar una segunda descripcion competencia especifica';
                    inputFocus =objGeneral.form_2+" "+ '#compt_espec_descr_2';
                    return false;
                }

                return true;
            }

            function Insert_Update_form_2(accion){
                var objGeneral = fnDataGeneral();
                var dataString = $(objGeneral.form_2).serialize();

                        if (Valida_form_2()) {

                            //return false;
                                    $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Update_Asyllabus_compt_asoci_curso',
                                    data  : dataString,
                                    })
                                    .done(function(data) {
                                        swal.fire(
                                    (accion ==='I') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {
                                                if(accion ==='I'){
                                                    $(objGeneral.form_2+" "+' #boton').attr('onclick','Insert_Update_form_2("E")')
                                                    $(objGeneral.form_2+" "+' #id_compt_asoci_curso').val(data);
                                                    $(objGeneral.form_2+" "+' #accion').val("E");
                                                }

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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }


            function Actualizar_compet_curso(){
                var objGeneral = fnDataGeneral();
                var dataString = {
                        "id_version_sy": objGeneral._id_version_sy,
                        'id_ciclo':$(objGeneral.form_1+" "+'#cbx_basicos_id_curso').find('option:selected').attr('id-ciclo'),
                        'id_compt_asoci_curso':$(objGeneral.form_2+" "+'#id_compt_asoci_curso').val(),
                        'cbx_basicos_id_curso': $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').val().trim() ,
                    };

                    $(objGeneral.form_2+" "+'#cuerpo_aso_cur').html(`
                        <div style="height: 30pc; display: flex;   justify-content: center; align-items: center;">
                            <div class="spinner_seccion"></div>
                        </div>
                    `);


                $.ajax({
                type  : "POST",
                url   : objGeneral.__wurl+'Actualizar_compet_curso',
                data  : dataString,
                })
                .done(function(data) {

                    const jsonArray = JSON.parse(data);
                    
                    swal.fire(
                        'Se actualizó las comptenecias con éxito ',
                        '!Se trajó las últimas actualizaciones de las competenecias del curso ¡',
                        'success'
                        ).then(function() {

           
                            $(objGeneral.form_2+" "+'#cuerpo_aso_cur').html(`

                                
                                <div class="form-group row">
                                            <label class="col-md-6  text-center">COMPETENCIA </label>
                                            <label class="col-md-6  text-center">DESCRIPCIÓN DEL NIVEL DE COMPETENCIA </label>
                                            <label class="col-md-2">General </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                                <textarea class="form-control" readonly name="compt_gene" id="compt_gene" cols="30" rows="5">${jsonArray[0]['compt_gene']}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_gene_descr" id="compt_gene_descr" cols="30" rows="5">${jsonArray[0]['compt_gene_descr']}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                                <textarea class="form-control" readonly name="compt_gene_2" id="compt_gene_2" cols="30" rows="5">${jsonArray[0]['compt_gene_2']} </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_gene_descr_2" id="compt_gene_descr_2" cols="30" rows="5"> ${jsonArray[0]['compt_gene_descr_2']} </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-2">Especifica </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_1" id="compt_espec_1" cols="30" rows="5">  ${jsonArray[0]['compt_espec_1']} </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_2" id="compt_espec_2" cols="30" rows="5"> ${jsonArray[0]['compt_espec_2']} </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_3" id="compt_espec_3" cols="30" rows="5"> ${jsonArray[0]['compt_espec_3']} </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_descr_1" id="compt_espec_descr_1" cols="30" rows="5">  ${jsonArray[0]['compt_espec_descr_1']} </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_descr_2" id="compt_espec_descr_2" cols="30" rows="5">  ${jsonArray[0]['compt_espec_descr_2']} </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" readonly name="compt_espec_descr_3" id="compt_espec_descr_3" cols="30" rows="5">  ${jsonArray[0]['compt_espec_descr_3']}  </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                            `);


                      

                        });
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    someErrorFunction();
                })
                .always(function() {});
            }

            function Actualizar_sumilla_curso(){
                var objGeneral = fnDataGeneral();
                var dataString = {
                        "id_version_sy": objGeneral._id_version_sy,
                        'id_ciclo':$(objGeneral.form_1+" "+'#cbx_basicos_id_curso').find('option:selected').attr('id-ciclo'),
                        'id_compt_asoci_curso':$(objGeneral.form_2+" "+'#id_compt_asoci_curso').val(),
                        'cbx_basicos_id_curso': $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').val().trim() ,
                    };


                $.ajax({
                type  : "POST",
                url   : objGeneral.__wurl+'Actualizar_sumilla_curso',
                data  : dataString,
                })
                .done(function(data) {
                    var jsonArray = JSON.parse(data);

                    swal.fire(
                        'Se actualizó la sumilla con éxito ',
                        '!Se trajó las últimas actualizaciones de la sumilla del curso¡',
                        'success'
                        ).then(function() {
                         
                            $('#desc_sumilla').val(jsonArray[0]['desc_sumilla']);

                        });
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    someErrorFunction();
                })
                .always(function() {});
            }

            //-------------------------------

                function Update_form_sumilla(){
                    var objGeneral = fnDataGeneral();

                    var id=$('#id_sumilla').val() ;
                    var parametros = {
                        "id_version_sy": objGeneral._id_version_sy,
                        "desc_sumilla": $('#desc_sumilla').val(),
                        "id_sumilla":id,
                    };


                    if($('#desc_sumilla').val().trim() === '') {
                        msgDate = 'Debe ingresar una descripción de sumilla ';
                        inputFocus =objGeneral.form_2+" "+ '#compt_gene';

                                bootbox.alert(msgDate)
                                var input = $(inputFocus).parent();

                                $(input).addClass("has-error");

                                $(input).on("change", function () {
                                    if ($(input).hasClass("has-error")) {
                                        $(input).removeClass("has-error");
                                    }
                                });
                                $('.modal').animate({scrollTop:0}, 500, 'swing');
                    }else{



                            $.ajax({
                                        type  : "POST",
                                        url   : objGeneral.__wurl+'Insert_Update_Asyllabus_sumilla',
                                        data  : parametros,
                                        })
                                        .done(function(data) {


                                                swal.fire(
                                                    (id ==='') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                                    'Haga clic en el botón!',
                                                    'success'
                                                ).then(function() {
                                                    if(id ===''){
                                                        $(' #id_sumilla').val(data);
                                                    }

                                                });




                                        })
                                        .fail(function(jqXHR, textStatus, errorThrown) {
                                            someErrorFunction();
                                        })
                                        .always(function() {});


                    }
                }

                function Update_form_result_general_apren(){
                    var objGeneral = fnDataGeneral();
                    var id= $('#id_result_gen_apr').val() ;

                    var parametros = {
                        "id_version_sy": objGeneral._id_version_sy,
                        "desc_result_gen_apr": $('#desc_result_gen_apr').val(),
                        "id_result_gen_apr":id,

                    };


                    if($('#desc_result_gen_apr').val().trim() === '') {
                        msgDate = 'Debe ingresar una descripción de resultado general de aprendizaje';
                        inputFocus =objGeneral.form_2+" "+ '#compt_gene';

                                bootbox.alert(msgDate)
                                var input = $(inputFocus).parent();

                                $(input).addClass("has-error");

                                $(input).on("change", function () {
                                    if ($(input).hasClass("has-error")) {
                                        $(input).removeClass("has-error");
                                    }
                                });
                                $('.modal').animate({scrollTop:0}, 500, 'swing');
                    }else{

                                        $.ajax({
                                        type  : "POST",
                                        url   : objGeneral.__wurl+'Insert_Update_Asyllabus_desc_result_gen_apr',
                                        data  : parametros,
                                        })
                                        .done(function(data) {




                                            swal.fire(
                                                    (id ==='') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                                    'Haga clic en el botón!',
                                                    'success'
                                                ).then(function() {
                                                    if(id ===''){
                                                        $(' #id_result_gen_apr').val(data);
                                                    }

                                                });


                                        })
                                        .fail(function(jqXHR, textStatus, errorThrown) {
                                            someErrorFunction();
                                        })
                                        .always(function() {});
                    }
                }

                function Update_form_estrategias_didacticas(){
                    var objGeneral = fnDataGeneral();
                    var id=  $('#id_estrateg_didact').val() ;

                    var parametros = {
                        "id_version_sy": objGeneral._id_version_sy,
                        "desc_estrateg_didact": $('#desc_estrateg_didact').val(),
                        "id_estrateg_didact": id,
                    };


                    if($('#desc_estrateg_didact').val().trim() === '') {
                        msgDate = 'Debe ingresar una descripción de estrategias didácticas';
                        inputFocus =objGeneral.form_2+" "+ '#compt_gene';

                                bootbox.alert(msgDate)
                                var input = $(inputFocus).parent();

                                $(input).addClass("has-error");

                                $(input).on("change", function () {
                                    if ($(input).hasClass("has-error")) {
                                        $(input).removeClass("has-error");
                                    }
                                });
                                $('.modal').animate({scrollTop:0}, 500, 'swing');
                    }else{

                                        $.ajax({
                                        type  : "POST",
                                        url   : objGeneral.__wurl+'Insert_Update_Asyllabus_estrategias_didacticas',
                                        data  : parametros,
                                        })
                                        .done(function(data) {


                                            swal.fire(
                                                    (id ==='') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                                    'Haga clic en el botón!',
                                                    'success'
                                                ).then(function() {
                                                    if(id ===''){
                                                        $(' #id_estrateg_didact').val(data);
                                                    }

                                                });

                                        })
                                        .fail(function(jqXHR, textStatus, errorThrown) {
                                            someErrorFunction();
                                        })
                                        .always(function() {});
                    }
                }

            //---------------------------------------------------------


            function loading_tabla(flag) {
                var objGeneral = fnDataGeneral();

                // setTimeout(function(){
                //     $(objGeneral.form_3+"_tbl"+'_wrapper .row:nth-child(2) .col-sm-12').addClass( "altura_tabla-unopx" )
                //     }, 100);

                // if (flag) {

                //     $(objGeneral.form_3+"_tbl"+'_wrapper .row:nth-child(2)').prepend('<div class="content-loading" >\
                //     <img style="width: 100px;height: 100px;" src="'+objGeneral._base_url+'assets/images/loading-tabla.gif" />\
                // </div>');



                //     setTimeout(function(){
                //         $(objGeneral.form_3+"_tbl").removeClass("invisible ");
                //     }, 700);

                // } else {
                // setTimeout(function(){
                //     $( ".content-loading" ).remove();
                //     $(objGeneral.form_3+"_tbl"+'_wrapper .row:nth-child(2) .col-sm-12').removeClass( "altura_tabla-unopx" )

                // }, 500);
                // }
            }


            function cargar_tabla_org_aprendizaje(){
                var objGeneral = fnDataGeneral();

                $(objGeneral.form_3+"_tbl").dataTable().fnDestroy();

                $(objGeneral.form_3+"_tbl").on('processing.dt', function (e, settings, processing) {
                processing ? loading_tabla(true) : loading_tabla(false);
                }).dataTable({
                // "dom": 'B<"clear"><"float-left"i><"float-right"f>t<"float-left"l><"float-right"p><"clearfix">',
                //"dom": 'BClfrtip',
                    "dom": 'frtip',
                    lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Mostrar todo']],
                    "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json",
                },
                    //"pageLength": 10,
                    //"scrollX": true,
                    "processing": false,
                    "serverSide": false,
                    "ajax": { url : objGeneral.__wurl + "cargar_tabla_org_aprendizaje/"+objGeneral._id_version_sy,
                    type : 'POST', data: {
                        },
                        error: function (e) {
                            console.log(e.responseText);
                        }
                    },
                    "bDestroy": true,
                    "responsive": true,
                    "bInfo": true,
                    //"iDisplayLength": 10,
                    "order": [[2, "asc"]],
                    //"order": [[ 2, "desc" ]],
                    /*
                        "initComplete": function () {
                            this.api().columns().every( function () {
                                var that = this;

                                $( 'input', this.footer() ).on( 'keyup change', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                        }
                                });
                            })
                        },
                    */
                    "columns": [
                        {"data": "ID_ORG_APRENDIZAJE", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                        {"data": "ID_VERSION_SY" , "className": "never", "autoWidth": true, "orderable": false, "visible": false  },
                        {"data": "ORDEN","width": "20%" },

                        {"data": "MODULO_APRENDIZAJE","width": "20%" },
                        {"data": "RESULT_APRENDIZAJE" ,"width": "20%" },
                        {"data": "SEMANAS","width": "20%"  },
                        {"data": "CONTEN_APRENDIZAJE","width": "20%"  },
                        {"data": "ACCION", "orderable": false }
                    ]
                    /*,  'columnDefs': [{
                                "targets": [0, 1],
                                "className": "text-center"
                            },
                            {
                                "targets": [0, 2],
                                "className": "text-center",
                                "width": "20%"
                            },
                            {
                                "targets": [0, 3],
                                "className": "text-center",
                                "width": "20%"
                            },
                            {
                                "targets": [0, 4],
                                "className": "text-center",
                                "width": "20%"
                            }
                        ],
                    */
                });
                return false;
            }

            function Valida_form_3(accion) {
                var objGeneral = fnDataGeneral();
                if($(objGeneral.form_3+" "+'#modulo_aprendizaje').val().trim() === '') {
                    msgDate = 'Debe ingresar el modulo de aprendizaje ';
                    inputFocus =objGeneral.form_3+" "+ '#modulo_aprendizaje';
                    return false;
                }
                if($(objGeneral.form_3+" "+'#result_aprendizaje').val().trim() === '') {
                    msgDate = 'Debe ingresar el resultado de aprendizaje';
                    inputFocus =objGeneral.form_3+" "+ '#result_aprendizaje';
                    return false;
                }

                if(accion ==='I'){
                    if($(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val().trim() === '') {
                    msgDate = 'Debe ingresar la semanas de aprendizaje de inicio';
                    inputFocus =objGeneral.form_3+" "+ '#semanas_aprendizaje_ini';
                        return false;
                    }
                    if($(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val() == 0) {
                    msgDate = 'Debe ingresar la semanas de aprendizaje de inicio un valor superior a 0';
                    inputFocus =objGeneral.form_3+" "+ '#semanas_aprendizaje_ini';
                        return false;
                    }
                    if($(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val() == 0) {
                        msgDate = 'Debe ingresar en semanas de aprendizaje de termino un valor superior a 0';
                        inputFocus =objGeneral.form_3+" "+ '#semanas_aprendizaje_fin';
                        return false;
                    }
                    if($(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val().trim() === '') {
                        msgDate = 'Debe ingresar la semanas de aprendizaje de termino';
                        inputFocus =objGeneral.form_3+" "+ '#semanas_aprendizaje_fin';
                        return false;
                    }
                }

                if($(objGeneral.form_3+" "+'#conten_aprendizaje').val().trim() === '') {
                    msgDate = 'Debe ingresar los contenidos involucrados';
                    inputFocus =objGeneral.form_3+" "+ '#conten_aprendizaje';
                    return false;
                }
                return true;
            }

            function Editar_form3(accion,id_org_aprendizaje,modulo_aprendizaje,result_aprendizaje,semanas_aprendizaje_ini,semanas_aprendizaje_fin,conten_aprendizaje,modulo_num_orden){
                var objGeneral = fnDataGeneral();

                $(objGeneral.form_3+" "+' #boton').attr('onclick','Insert_Update_form_3("'+accion+'")')
                $(objGeneral.form_3+" "+' #boton').text('Editar')

                $(objGeneral.form_3+" "+' #id_org_aprendizaje').val(id_org_aprendizaje);
                $(objGeneral.form_3+" "+' #accion').val(accion);

                modulo_aprendizajestring = modulo_aprendizaje.replace(/_/g," "); //quitar todos los _
                $(objGeneral.form_3+" "+'#modulo_aprendizaje').val(modulo_aprendizajestring);
                result_aprendizajestring = result_aprendizaje.replace(/_/g," "); //quitar todos los _
                $(objGeneral.form_3+" "+'#result_aprendizaje').val(result_aprendizajestring);
                $(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val(semanas_aprendizaje_ini);
                $(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val(semanas_aprendizaje_fin);
                $(objGeneral.form_3+" "+'#modulo_num_orden').val(modulo_num_orden);

                conten_aprendizajestring = conten_aprendizaje.replace(/_/g," "); //quitar todos los _
                $(objGeneral.form_3+" "+'#conten_aprendizaje').val(conten_aprendizajestring);

                $(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').prop("readonly", true);
                $(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').prop("readonly", true);

            }

            function Limpiar_form_3(){
                var objGeneral = fnDataGeneral();

                var val1 =$(objGeneral.form_3+" "+'#modulo_aprendizaje').val();
                var val2 =$(objGeneral.form_3+" "+'#result_aprendizaje').val();
                var val3 =$(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val();
                var val4 =$(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val();

                var val5 =$(objGeneral.form_3+" "+'#conten_aprendizaje').val();
                var val6 =$(objGeneral.form_3+" "+'#modulo_num_orden').val();


                if(val1 =="" && val2 =="" && val3 =="" && val4 =="" && val5 =="" && val6 ===""){
                    msgDate = 'No hay nada que Limpiar';
                            bootbox.alert(msgDate)

                }else{
                    $(objGeneral.form_3+" "+' #boton').attr('onclick','Insert_Update_form_3("I")')
                    $(objGeneral.form_3+" "+' #boton').text('Agregar')

                    $(objGeneral.form_3+" "+' #id_org_aprendizaje').val('');
                    $(objGeneral.form_3+" "+' #accion').val("I" );

                    $(objGeneral.form_3+" "+'#modulo_aprendizaje').val('');
                    $(objGeneral.form_3+" "+'#result_aprendizaje').val('');
                    $(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val('');
                    $(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val('');
                    $(objGeneral.form_3+" "+'#conten_aprendizaje').val('');
                    $(objGeneral.form_3+" "+'#modulo_num_orden').val('');


                }
                $(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').prop("readonly", false);
                $(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').prop("readonly", false);

            }

            function between(x, min, max) {
                return x >= min && x <= max;
            }

            function Insert_Update_form_3(accion){
                var objGeneral = fnDataGeneral();


                var dataString = $(objGeneral.form_3).serializeArray();

                if(accion ==='I'){
                    var tablecountfilas = $(objGeneral.form_3+"_tbl").DataTable().data().count()
                    var dataString = dataString.filter((item) => item.name !== 'modulo_num_orden')
                    dataString.push({
                        name: "modulo_num_orden",
                        value: tablecountfilas+1
                    });
                    dataString = jQuery.param(dataString);
                    var modulo_num_orden =tablecountfilas;

                }else{
                    var modulo_num_orden =$(objGeneral.form_3+" "+'#modulo_num_orden').val();

                }



                        if (Valida_form_3(accion)) {

                            const semana_ini =$(objGeneral.form_3+" "+'#semanas_aprendizaje_ini').val();
                            var id_version_sy =$(objGeneral.form_3+" "+'#id_version_sy').val();
                            const semana_fin =$(objGeneral.form_3+" "+'#semanas_aprendizaje_fin').val();


                            $.ajax({
                                type  : "POST",
                                url: url_restapi+'org_aprendizaje_validar_numero_orden',
                                headers: {
                                "X-API-KEY":api_key
                                },
                                data  : {
                                            id_version_sy:id_version_sy,
                                            modulo_num_orden:modulo_num_orden
                                        }
                            })
                            .done(function(respuesta_cant) {

                                // if(respuesta_cant !== 0){
                                //     $.toast({
                                //             heading: 'Error',
                                //             text: 'Ya existe el número de orden '+modulo_num_orden+' base de datos' ,
                                //             position: 'top-right',
                                //             icon: 'error',
                                //             stack: false
                                //         })
                                //         return false;
                                // }


                            if(accion ==='I'){
                                    $.ajax({
                                    url: url_restapi+'org_aprendizaje_validar_semana',
                                    type: 'POST',
                                    headers: {
                                    "X-API-KEY":api_key
                                    },
                                    data: {
                                        id_version_sy:id_version_sy,
                                        semana_ini:semana_ini,
                                        semana_fin:semana_fin
                                    }
                                    })
                                    .done(function(data) {


                                        if(data.length > 0){

                                            var encontrar_ini = data.filter(v => v.semanas_aprendizaje_ini === semana_ini );
                                            var encontrar_fin = data.filter(v => v.semanas_aprendizaje_fin === semana_fin );

                                            if(encontrar_ini.length > 0 &&  encontrar_fin.length > 0 ){
                                                $.toast({
                                                    heading: 'Error',
                                                    text: 'Ya existe la semana de inicio '+semana_ini+' y la semana de fin '+semana_fin+' registrada en la base de datos' ,
                                                    position: 'top-right',
                                                    icon: 'error',
                                                    stack: false
                                                })
                                                return false;

                                            }else if(encontrar_ini.length > 0 ){
                                                $.toast({
                                                    heading: 'Error',
                                                    text: 'Ya existe la semana de inicio '+semana_ini+' registrada en la base de datos' ,
                                                    position: 'top-right',
                                                    icon: 'error',
                                                    stack: false
                                                })
                                                return false;

                                            }else if(encontrar_fin.length > 0 ){
                                                $.toast({
                                                    heading: 'Error',
                                                    text: 'Ya existe la semana de fin '+semana_fin+' registrada en la base de datos' ,
                                                    position: 'top-right',
                                                    icon: 'error',
                                                    stack: false
                                                })
                                                return false;
                                            
                                            }else{

                                                var encontrar_ini_alreves = data.filter(v => v.semanas_aprendizaje_ini === semana_fin);
                                                var encontrar_fin_alreves = data.filter(v => v.semanas_aprendizaje_fin === semana_ini);


                                                if(encontrar_ini_alreves.length > 0 &&  encontrar_fin_alreves.length > 0 ){
                                                    $.toast({
                                                        heading: 'Error',
                                                        text: 'Ya existe la semana de inicio '+semana_fin+' y la semana de fin '+semana_ini+' registrada en la base de datos' ,
                                                        position: 'top-right',
                                                        icon: 'error',
                                                        stack: false
                                                    })
                                                    return false;

                                                }else if(encontrar_ini_alreves.length > 0 ){
                                                    $.toast({
                                                        heading: 'Error',
                                                        text: 'Ya existe la semana de inicio '+semana_fin+' registrada en la base de datos' ,
                                                        position: 'top-right',
                                                        icon: 'error',
                                                        stack: false
                                                    })
                                                    return false;

                                                }else if(encontrar_fin_alreves.length > 0 ){
                                                    $.toast({
                                                        heading: 'Error',
                                                        text: 'Ya existe la semana de fin '+semana_ini+' registrada en la base de datos' ,
                                                        position: 'top-right',
                                                        icon: 'error',
                                                        stack: false
                                                    })
                                                    return false;

                                                }

                                            }

                                        }else{


                                            $.ajax({
                                                type  : "POST",
                                                url: url_restapi+'tabla_org_aprendizaje_for_range',
                                                headers: {
                                                "X-API-KEY":api_key
                                                },
                                                data  :  {
                                                        id_version_sy:id_version_sy
                                                    }
                                            })
                                            .done(function(respuesta) {

                                                        let existe_ini_rangos = respuesta.filter(restp => parseInt(semana_ini) >= parseInt(restp.semanas_aprendizaje_ini) && parseInt(semana_ini)<= parseInt(restp.semanas_aprendizaje_fin)  );

                                                        let existe_fin_rangos = respuesta.filter(restp => parseInt(semana_fin) >= parseInt(restp.semanas_aprendizaje_ini) && parseInt(semana_fin) <= parseInt(restp.semanas_aprendizaje_fin)  );


                                                        if(existe_ini_rangos.length > 0 && existe_fin_rangos.length > 0 ){
                                                            $.toast({
                                                                heading: 'Error',
                                                                text: 'La semana de inicio '+semana_ini+' y fin '+semana_fin+'  estan dentro de un rango de una de las semanas ya registradas en la base de datos' ,
                                                                position: 'top-right',
                                                                icon: 'error',
                                                                stack: false
                                                            })
                                                            return false;

                                                        }else if(existe_ini_rangos.length > 0 ){
                                                            $.toast({
                                                                heading: 'Error',
                                                                text: 'La semana de inicio '+semana_ini+' esta dentro de un rango de una de las semanas ya registradas en la base de datos' ,
                                                                position: 'top-right',
                                                                icon: 'error',
                                                                stack: false
                                                            })

                                                            return false;

                                                        }else if(existe_fin_rangos.length > 0 ){
                                                            $.toast({
                                                                heading: 'Error',
                                                                text: 'La semana de fin '+semana_fin+' esta dentro de un rango de una de las semanas ya registradas en la base de datos' ,
                                                                position: 'top-right',
                                                                icon: 'error',
                                                                stack: false
                                                            })

                                                            return false;

                                                        }else{
                                                            console.log("🚀 ~ file: asyllabus_data.js.php:1124 ~ .done ~ semana_fin < semana_ini:", semana_fin < semana_ini)
                                                            console.log("🚀 ~ file: asyllabus_data.js.php:1124 ~ .done ~ semana_fin < semana_fin:", semana_fin )
                                                            console.log("🚀 ~ file: asyllabus_data.js.php:1124 ~ .done ~ semana_fin < semana_ini:", semana_ini )
                                                            var semana_finn = parseFloat(semana_fin);
                                                            var semana_inii = parseFloat(semana_ini);


                                                            if( semana_finn < semana_inii ){
                                                                $.toast({
                                                                    heading: 'Error',
                                                                    text: 'El número de la semana de inicio '+semana_ini+' es mayor que la semana de fin '+semana_fin ,
                                                                    position: 'top-right',
                                                                    icon: 'error',
                                                                    stack: false
                                                                })
                                                                return false;

                                                            }

                                                                $.ajax({
                                                                    type  : "POST",
                                                                    url   : objGeneral.__wurl+'Insert_Update_Asyllabus_org_aprendizaje',
                                                                    data  : dataString,
                                                                })
                                                                .done(function(data) {
                                                                    swal.fire(
                                                                        (accion ==='I') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                                                        'Haga clic en el botón!',
                                                                        'success'
                                                                        ).then(function() {
                                                                            Limpiar_form_3();
                                                                            Listar_form_5();

                                                                            Listar_creados_form_5();
                                                                            $(objGeneral.form_3+"_tbl").DataTable().ajax.reload();
                                                                        });
                                                                })
                                                                .fail(function(jqXHR, textStatus, errorThrown) {
                                                                    someErrorFunction();
                                                                })
                                                                .always(function() {});
                                                        }

                                            })
                                            .fail(function(jqXHR, textStatus, errorThrown) {
                                                someErrorFunction();
                                            })
                                            .always(function() {});


                                        }

                                    })
                                    .fail(function(jqXHR, textStatus, errorThrown) {
                                        someErrorFunction();
                                    })
                                    .always(function() {});
                            }else{

                                    $.ajax({
                                        type  : "POST",
                                        url   : objGeneral.__wurl+'Insert_Update_Asyllabus_org_aprendizaje',
                                        data  : dataString,
                                    }).done(function(data) {
                                        swal.fire(
                                            (accion ==='I') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {
                                                Limpiar_form_3();
                                                Listar_form_5();
                                                Listar_creados_form_5();
                                                $(objGeneral.form_3+"_tbl").DataTable().ajax.reload();
                                            });
                                    })
                                    .fail(function(jqXHR, textStatus, errorThrown) {
                                        someErrorFunction();
                                    })
                                    .always(function() {});

                            }



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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }

            function Eliminar_form_3(id){
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
                            url:  objGeneral.__wurl+'/Delete_Asyllabus_form_3',
                            data: {'id_org_aprendizaje':id},
                            success:function () {
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then(function() {
                                    $(objGeneral.form_3+"_tbl").DataTable().ajax.reload();
                                    Limpiar_form_3();
                                                        Listar_form_5()

                                    //window.location = objGeneral.__wurl;
                                });
                            }
                        });
                    }
                })
            }


            //------------------------------------------------------------------

            function Valida_form_4() {
                var objGeneral = fnDataGeneral();


                if($(objGeneral.form_4+" "+'#eval_diag_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación diagnostica ';
                    inputFocus =objGeneral.form_4+" "+ '#eval_diag_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_diag_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación diagnostica';
                    inputFocus =objGeneral.form_4+" "+ '#eval_diag_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_diag_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la evaluación diagnostica';
                    inputFocus =objGeneral.form_4+" "+ '#eval_diag_peso';
                    return false;
                }





                if($(objGeneral.form_4+" "+'#eval_cont1_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación continua 1 ';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont1_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont1_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación continua 1';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont1_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont1_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la evaluación continua 1';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont1_peso';
                    return false;
                }




                if($(objGeneral.form_4+" "+'#eval_parcial_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación parcial';
                    inputFocus =objGeneral.form_4+" "+ '#eval_parcial_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_parcial_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación parcial';
                    inputFocus =objGeneral.form_4+" "+ '#eval_parcial_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_parcial_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la la evaluación parcial';
                    inputFocus =objGeneral.form_4+" "+ '#eval_parcial_peso';
                    return false;
                }




                if($(objGeneral.form_4+" "+'#eval_cont2_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación continua 2 ';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont2_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont2_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación continua 2';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont2_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont2_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la evaluación continua 2';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont2_peso';
                    return false;
                }





                if($(objGeneral.form_4+" "+'#eval_cont3_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación continua 3';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont3_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont3_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación continua 3';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont3_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_cont3_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la la evaluación continua 3';
                    inputFocus =objGeneral.form_4+" "+ '#eval_cont3_peso';
                    return false;
                }




                // if($(objGeneral.form_4+" "+'#eval_cont4_detalle').val().trim() === '') {
                //     msgDate = 'Debe ingresar el detalle de la evaluación continua 4';
                //     inputFocus =objGeneral.form_4+" "+ '#eval_cont4_detalle';
                //     return false;
                // }
                // if($(objGeneral.form_4+" "+'#eval_cont4_sem').val().trim() === '0') {
                //     msgDate = 'Debe ingresar la semana de la evaluación continua 4';
                //     inputFocus =objGeneral.form_4+" "+ '#eval_cont4_sem';
                //     return false;
                // }
                // if($(objGeneral.form_4+" "+'#eval_cont4_peso').val().trim() === '') {
                //     msgDate = 'Debe ingresar el peso de la la evaluación continua 4';
                //     inputFocus =objGeneral.form_4+" "+ '#eval_cont4_peso';
                //     return false;
                // }


                if($(objGeneral.form_4+" "+'#eval_final_detalle').val().trim() === '') {
                    msgDate = 'Debe ingresar el detalle de la evaluación final';
                    inputFocus =objGeneral.form_4+" "+ '#eval_final_detalle';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_final_sem').val().trim() === '0') {
                    msgDate = 'Debe ingresar la semana de la evaluación final';
                    inputFocus =objGeneral.form_4+" "+ '#eval_final_sem';
                    return false;
                }
                if($(objGeneral.form_4+" "+'#eval_final_peso').val().trim() === '') {
                    msgDate = 'Debe ingresar el peso de la la evaluación final';
                    inputFocus =objGeneral.form_4+" "+ '#eval_final_peso';
                    return false;
                }


                return true;
            }

            function Insert_Update_form_4(accion){
                var objGeneral = fnDataGeneral();
                var dataString = $(objGeneral.form_4).serialize();

                        if (Valida_form_4()) {

                            //return false;
                                    $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Update_Asyllabus_forma_herrami_eval',
                                    data  : dataString,
                                    })
                                    .done(function(data) {
                                        swal.fire(
                                    (accion ==='I') ? 'Registro Exitoso': 'Actualización Exitosa'+' !',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {
                                                if(accion ==='I'){
                                                    $(objGeneral.form_4+" "+' #boton').attr('onclick','Insert_Update_form_4("E")')
                                                    $(objGeneral.form_4+" "+' #id_forma_herrami_eval').val(data);
                                                    $(objGeneral.form_4+" "+' #accion').val("E");
                                                }

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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }

            //-------------------------------------------------------------------


            function GENERARCONTENEDORESEMANAS_ACT(fila_modulo,num_semana_numbers_data_tratada) {

                $.each(num_semana_numbers_data_tratada, function(index, value) {

                    $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo).append(
                        `   <tbody>
                                    <tr>
                                        <td class="primera_columna" width="10%" style="font-size:11px;"  >
                                            SEMANA <br>

                                            <input value="${value[0]}" readonly class="form-control semana_valor" titulo_input="Número de semana" type="text" pattern="[0-9]+" maxlength="2" name="num_semana_${index+1}" id="num_semana_${index+1}">
                                            <br>
                                        </td>
                                        <td class="segunda_columna"  style="padding: 0px;"  id="tbl_Ctnsesiones_${index+1}" >
                                        </td>
                                        <br>
                                    </tr>
                            </tbody>`
                    );

                GENERARCONTENEDORESESIONES_ACT(fila_modulo,value[1],index+1)

                });
            }

            function GENERARCONTENEDORESESIONES_ACT(fila_modulo,sesiones_array,num) {
                $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).empty();


                $.each(sesiones_array, function(index, value) {
                    $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).append(
                        ` <tbody>

                            <tr >
                                    <th class="dentrofila_${num}"  style="text-align: center;font-size:13px;"  width="10%"    rowspan="3">
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            Sesión
                                        <input class="form-control" classs="fila_${num}" indicef="${index}"  value="${value.num_sesion}" titulo_input="Número de sesión de la subfila ${index+1} que pertenece a la fila ${num}"  style="width:70px"  type="number" min="1" max="20" name="fila${num}_num_sesion_${index+1}" id="fila${num}_num_sesion_${index+1}">
                                        <input value="${value.id_sesion_modulo}"  type="hidden" name="fila${num}_num_sesion_${index+1}" id="fila${num}_num_sesion_${index+1}">
                                    </th>
                                    <th style="text-align: center;font-size:13px;"  rowspan="2">TEMA </th>
                                    <th style="text-align: center;font-size:13px;"  colspan=2>ACTIVIDADES VIRTUALES PRINCIPALES</th>
                            </tr>

                            <tr>
                                <th style="text-align: center;font-size:13px;" >ACTIVIDADES EN INTERACCION CON EL DOCENTE (Aprendizaje sincrónico: Zoom) </th>
                                <th style="text-align: center;font-size:13px;" >ACTIVIDADES DE TRABAJO AUTÓNOMO (Aprendizaje asincrónico: Aula Virtual) </th>
                            </tr>

                            <tr>
                                <td width="30%"> <textarea  cols="20" class="form-control" titulo_input="Descripción tema de la subfila ${index+1} que pertenece a la fila ${num}" rows="10" name="fila${num}_desc_tema_${index+1}" id="desc_tema_${index+1}">${value.desc_tema}</textarea> </td>
                                <td><textarea cols="20"  rows="10" class="form-control"  titulo_input="Descripción de actividades del docente de la subfila ${index+1} que pertenece a la fila ${num}"   name="fila${num}_descr_iteracc_docente_${index+1}" id="fila${num}_descr_iteracc_docente_${index+1}">${value.descr_iteracc_docente}</textarea></td>
                                <td><textarea cols="20" rows="10" class="form-control"  titulo_input="Descripción de actividades de trabajo autónomo de la subfila ${index+1} que pertenece a la fila ${num}"  name="fila${num}_descr_trabajo_autor_${index+1}" id="fila${num}_descr_trabajo_autor_${index+1}">${value.descr_trabajo_autor}</textarea></td>
                            </tr>

                        </tbody>`
                    );

                });

            }

            function GENERARCONTENEDORESEMANAS(fila_modulo,semana_inicio) {
                var num_sem_valor =parseInt(semana_inicio);

                var objGeneral = fnDataGeneral();

                CONT_NUM = parseInt($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+ "#cant_semanas").val());
                $('#tblCtnsemanas_'+fila_modulo).empty();
                for (let i = 0; i < CONT_NUM; i++) {
                    $('#tblCtnsemanas_'+fila_modulo).append(
                        ` <tbody> <tr>
                            <td class="primera_columna" width="10%" style="font-size:11px;"  >
                                SEMANA <br>

                                <input value="${num_sem_valor}" readonly class="form-control semana_valor" titulo_input="Número de semana" type="text" pattern="[0-9]+" maxlength="2" name="num_semana_${i+1}" id="num_semana_${i+1}">
                                <br><br>
                                <label  title="Cantidad de sesiones que se crearán para la semana">#SESIONES  </label>
                                <br>
                                <input class="form-control"  titulo_input="Cantidad de sesiones"   oninput="GENERARCONTENEDORESESIONES(${i+1},this.value,${fila_modulo})" type="text"  maxlength="2" name="cant_sesiones_${i+1}" id="cant_sesiones_${i+1}">

                            </td>
                            <td class="segunda_columna"  style="padding: 0px;"  id="tbl_Ctnsesiones_${i+1}" >
                            </td>
                            <br>
                        </tr> </tbody>`
                    );
                    ++num_sem_valor
                }
            }

            function GENERARCONTENEDORESESIONES(num,valor_input,fila_modulo) {
                CONT_NUM = parseInt(valor_input);
                $('#tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).empty();
                for (let i = 0; i < CONT_NUM; i++) {

                    $('#tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).append(
                        ` <tbody>

                            <tr >
                                    <th class="dentrofila_${num}"  style="text-align: center;font-size:13px;"  width="10%"    rowspan="3">
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        Sesión
                                        <input classs="fila_${num}" indicef="${i}"  titulo_input="Número de sesión de la subfila ${i+1} que pertenece a la fila ${num}"  style="width:70px" class="form-control"  type="number" min="1" max="20"  name="fila${num}_num_sesion_${i+1}" id="fila${num}_num_sesion_${i+1}">
                                    </th>
                                    <th style="text-align: center;font-size:13px;"  rowspan="2">TEMA </th>
                                    <th style="text-align: center;font-size:13px;"  colspan=2>ACTIVIDADES VIRTUALES PRINCIPALES</th>
                            </tr>

                            <tr>
                                <th style="text-align: center;font-size:13px;" >ACTIVIDADES EN INTERACCION CON EL DOCENTE (Aprendizaje sincrónico: Zoom) </th>
                                <th style="text-align: center;font-size:13px;" >ACTIVIDADES DE TRABAJO AUTÓNOMO (Aprendizaje asincrónico: Aula Virtual) </th>
                            </tr>

                            <tr>
                                <td width="30%" > <textarea cols="20" titulo_input="Descripción tema de la subfila ${i+1} que pertenece a la fila ${num}" rows="10" name="fila${num}_desc_tema_${i+1}" id="desc_tema_${i+1}"></textarea> </td>
                                <td><textarea cols="20" rows="10" titulo_input="Descripción de actividades del docente de la subfila ${i+1} que pertenece a la fila ${num}"   name="fila${num}_descr_iteracc_docente_${i+1}" id="fila${num}_descr_iteracc_docente_${i+1}"></textarea></td>
                                <td><textarea cols="20" rows="10" titulo_input="Descripción de actividades de trabajo autónomo de la subfila ${i+1} que pertenece a la fila ${num}"  name="fila${num}_descr_trabajo_autor_${i+1}" id="fila${num}_descr_trabajo_autor_${i+1}"></textarea></td>
                            </tr>

                        </tbody>`
                    );
                }
            }

            $(document).ready(function() {3
                var objGeneral = fnDataGeneral();

                if( $(objGeneral.form_1+" "+'#cbx_multiple_id_docente').is( ":disabled" ) == true) {
                    Listar_creados_form_5_revision();

                }else{
                    Listar_form_5();
                    Listar_creados_form_5();


                }


                /*
                $(objGeneral.form_5+" "+"#cant_semanas").on("input", function(){
                    //$("#txtCtrIns").val($(this).val());
                    GENERARCONTENEDORESEMANAS();
                });

                */

            });

            function esPrimero(valor, indice, lista) {
                return (lista.indexOf(valor) === indice);
            }

            function noEsPrimero(valor, indice, lista) {
                return !(lista.indexOf(valor) === indice);
            }

            function Valida_form_5(fila_modulo) {
                var objGeneral = fnDataGeneral();
                var id_org_aprendizaje =$(objGeneral.form_5+" "+'#id_org_aprendizaje').val();

                var Obj_data_semana = {
                    cant_semanas: [],
                    cant_sesiones: [],
                    cant_modulos: '',
                    id_org_aprendizaje:id_org_aprendizaje,
                    accion:'I'
                };



                if($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#num_modulo').val().trim()  === '' || parseInt($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#num_modulo').val().trim()) == 0 || isNaN($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#num_modulo').val().trim()) ) {
                        msgDate = 'Debe ingresar el número de módulo de la fila '+fila_modulo;
                        inputFocus =objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+ '#num_modulo';
                        return false;
                }else{
                    Obj_data_semana['cant_modulos'] = $(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#num_modulo').val();
                    Obj_data_semana['id_org_aprendizaje'] = $(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#id_org_aprendizaje').val();

                }

                if($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#cant_semanas').val().trim()  === '' || parseInt($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#cant_semanas').val().trim()) == 0 || isNaN($(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#cant_semanas').val().trim()) ) {
                        msgDate = 'Debe ingresar la cantidad de semanas'+fila_modulo;
                        inputFocus =objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+ '#cant_semanas';
                        return false;
                }

                console.log("🚀 ~ file: asyllabus_data.js.php:1634 ~ Valida_form_5 ~ Obj_data_semana:", Obj_data_semana)

                var fila_semanas = 0;


                let lista_semana = new Array();

                $(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#tblCtnsemanas_'+fila_modulo+" "+'tbody tr td.primera_columna').each(function(index, element) {
                    if( $(element).find("input:text#num_semana_"+(index+1)).val() === '' || parseInt($(element).find("input:text#num_semana_"+(index+1)).val() ) == 0 || isNaN($(element).find("input:text#num_semana_"+(index+1)).val()) ){

                            if($(element).find("input:text#num_semana_"+(index+1)).val() === '' ){
                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("input:text#num_semana_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;
                            }else if(parseInt($(element).find("input:text#num_semana_"+(index+1)).val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo <b>`+$(element).find("input:text#num_semana_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;

                            } else if(isNaN($(element).find("input:text#num_semana_"+(index+1)).val())){
                                msgDate =  `Porfavor  procure poner solo valores numéricos el campo 1 <b>`+$(element).find("input:text#num_semana_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;
                            }
                        inputFocus = $(element).find("input:text#num_semana_"+(index+1));
                        fila_semanas ++;
                        return false;
                    }else{
                        data_sem = { "num_semana": $(element).find("input:text#num_semana_"+(index+1)).val() };
                        lista_semana.push($(element).find("input:text#num_semana_"+(index+1)).val());
                        Obj_data_semana['cant_semanas'].push(data_sem);
                    }

                    console.log("🚀 ~ file: asyllabus_data.js.php:1668 ~ $ ~ Obj_data_semana:", Obj_data_semana)

                    if( $(element).find("input:text#cant_sesiones_"+(index+1)).val() === '' || parseInt($(element).find("input:text#cant_sesiones_"+(index+1)).val() ) == 0 || isNaN($(element).find("input:text#cant_sesiones_"+(index+1)).val()) ){

                            if($(element).find("input:text#cant_sesiones_"+(index+1)).val() === '' ){
                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("input:text#cant_sesiones_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;

                            }else if(parseInt($(element).find("input:text#cant_sesiones_"+(index+1)).val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo <b>`+$(element).find("input:text#cant_sesiones_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;

                            } else if(isNaN($(element).find("input:text#cant_sesiones_"+(index+1)).val())){
                                msgDate =  `Porfavor  procure poner solo valores numéricos el campo 2 <b>`+$(element).find("input:text#cant_sesiones_"+(index+1)).attr("titulo_input")+`</b> de la <strong>fila:${index+1}</strong> </br>  `;
                            }
                        inputFocus = $(element).find("input:text#cant_sesiones_"+(index+1));
                        fila_semanas ++;
                        return false;
                    }else{
                    }


                });


                if(fila_semanas==0){
                   
                    var existe_repetidos = lista_semana.some(noEsPrimero)
                    if(existe_repetidos){
                        msgDate =  `<strong>VALORES REPETIDOS</strong> </br> Se ha descubierto "SEMANAS" con el mismo valor </br> Porfavor corregir ese ello`;
                        inputFocus = '';
                        return false;
                    }

                }else{
                    return false;
                }

                var fila_sesiones = 0;
                var lista_sesion = {
                };

                $(objGeneral.form_5+" "+'.form-body#lista1_fila_modulo_'+fila_modulo+" "+'#tblCtnsemanas_'+fila_modulo+" "+'tbody tr td.segunda_columna tbody').each(function(index, element) {
              

                    if( $(element).find("tr").eq(0).find('input').val() === '' || parseInt($(element).find("tr").eq(0).find('input').val() ) == 0 || isNaN($(element).find("tr").eq(0).find('input').val()) ){

                            if($(element).find("tr").eq(0).find('input').val() === '' ){
                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(0).find('input').attr("titulo_input");

                            }else if(parseInt($(element).find("tr").eq(0).find('input').val() ) == 0 ){
                                msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo <b>`+$(element).find("tr").eq(0).find('input').attr("titulo_input");

                            } else if(isNaN($(element).find("tr").eq(0).find('input').val())){
                                msgDate =  `Porfavor  procure poner solo valores numéricos el campo 3 <b>`+$(element).find("tr").eq(0).find('input').attr("titulo_input");
                            }
                        inputFocus = $(element).find("tr").eq(0).find('input');
                        fila_sesiones ++;
                        return false;
                    }else{
                        num_sesion = $(element).find("tr").eq(0).find('input').val() ;
                        fila_nombre =  $(element).find("tr").eq(0).find('input').attr("classs");
                        indicef =  $(element).find("tr").eq(0).find('input').attr("indicef");

                        if(indicef == 0){
                            lista_sesion[fila_nombre]  = [] ;
                            lista_sesion[fila_nombre].push(num_sesion);
                        }else{
                            lista_sesion[fila_nombre].push(num_sesion);
                        }
                    }

                    if( $(element).find("tr").eq(2).find("td").eq(0).find('textarea').val() === '' ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(0).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(0).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        desc_tema = $(element).find("tr").eq(2).find("td").eq(0).find('textarea').val() ;
                    }

                    if( $(element).find("tr").eq(2).find("td").eq(1).find('textarea').val() === ''  ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(1).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(1).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        descr_iteracc_docente = $(element).find("tr").eq(2).find("td").eq(1).find('textarea').val() ;
                    }

                    if( $(element).find("tr").eq(2).find("td").eq(2).find('textarea').val() === '' ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(2).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(2).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        descr_trabajo_autor = $(element).find("tr").eq(2).find("td").eq(2).find('textarea').val() ;
                    }

                    var semana_pertenece =$(element).parent().parent().find(".primera_columna").find(".semana_valor").val();
                    data_sesion_semana = {'num_sesion':num_sesion, 'desc_tema':desc_tema, 'descr_iteracc_docente':descr_iteracc_docente,'descr_trabajo_autor':descr_trabajo_autor,'semana_pertenece':semana_pertenece};
                    Obj_data_semana['cant_sesiones'].push(data_sesion_semana)
                    console.log("🚀 ~ file: asyllabus_data.js.php:1775 ~ $ ~ Obj_data_semana:", Obj_data_semana)

                });

                if(fila_sesiones==0){
                }else{
                    return false;
                }
                        // var nombres_no_repetidos = nombres_filas.filter( (ele,pos)=>nombres_filas.indexOf(ele) == pos);
                var fila_sesiones_repet = 0;
                $.each(lista_sesion, function(index, value) {

                        var existe_repetidos_sesiones = value.some(noEsPrimero)

                        if(existe_repetidos_sesiones){

                            msgDate =  `<strong>VALORES REPETIDOS EN LA ${(index.replace("_", " ")).toUpperCase()}</strong> </br> Se ha descubierto "SESIONES" con el mismo valor </br> Porfavor corregir ese ello`;
                            inputFocus = '';
                            fila_sesiones_repet++
                            return false;
                        }
                });

                if(fila_sesiones_repet==0){
                    return Obj_data_semana;
                }else{
                    return false;
                }

            }

            function Insert_Update_form_5(accion,fila_modulo){
                var objGeneral = fnDataGeneral();
                var dataString = $(objGeneral.form_5).serialize();

                        if (accion === 'I') {


                            if(Valida_form_5(fila_modulo)){
                                obj= (Valida_form_5(fila_modulo));
                                $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Update_Asyllabus_actividades_principales',
                                    data  : obj,
                                })
                                .done(function(data) {
                                    swal.fire(
                                        'Registro Exitoso !',
                                        'Haga clic en el botón!',
                                        'success'
                                        ).then(function() {
                                            Listar_form_5();
                                            Listar_creados_form_5();
                                        });
                                })
                                .fail(function(jqXHR, textStatus, errorThrown) {
                                    someErrorFunction();
                                })
                                .always(function() {});

                            }else{
                                bootbox.alert (  msgDate  );

                                var input = $(inputFocus).parent();

                                $(input).addClass("has-error");

                                $(input).on("change", function () {
                                    if ($(input).hasClass("has-error")) {
                                        $(input).removeClass("has-error");
                                    }
                                });
                                $('.modal').animate({scrollTop:0}, 500, 'swing');

                            }



                        }else if(accion ==='U'){

                            if(Valida_form_5_act(fila_modulo)){
                                obj= (Valida_form_5_act(fila_modulo));
                            // return false;
                                $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Update_Asyllabus_actividades_principales',
                                    data  : obj,
                                })
                                .done(function(data) {
                                    swal.fire(
                                        'Actualización Exitosa !',
                                        'Haga clic en el botón!',
                                        'success'
                                        ).then(function() {
                                            Listar_form_5();
                                            Listar_creados_form_5();
                                        });
                                })
                                .fail(function(jqXHR, textStatus, errorThrown) {
                                    someErrorFunction();
                                })
                                .always(function() {});

                            }else{
                                bootbox.alert (  msgDate  );

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
            }

            function restar_numeros(numero_menos,numero_mayor){
                return numero_menos-numero_mayor;
            }

            function Listar_form_5(){
                var objGeneral = fnDataGeneral();
                var parametros = {
                    "id_version_sy": objGeneral._id_version_sy,

                };
                    $.ajax({
                        type  : "POST",
                        url: url_restapi+'tabla_org_aprendizaje_for_act__main',
                        headers: {
                                        "X-API-KEY":api_key
                        },
                        data  : parametros,
                        })
                        .done(function(data) {
                        $('#crear_modulos').empty();


                        $.each(data, function(index, value) {

                            if(value.id_modulo == 0){
                                $('#crear_modulos').append(
                                `<div class="form-body" id="lista1_fila_modulo_${index+1}">

                                    <div class="form-actions">
                                        <div class="text-right">
                                            <button type="button" id="boton" onclick="Insert_Update_form_5('I',${index+1})"  class="btn btn-info">Agregar</button>

                                        </div>
                                    </div>


                                    <div class="form-group row modulos">

                                        <h6 class="card-subtitle col-md-12">
                                        MÓDULO DE APRENDIZAJE: ${value.modulo_aprendizaje.toUpperCase()}
                                        </h6>
                                        <label class="col-md-2">Módulo </label>
                                                <div class="col-md-4">
                                                    <input class="form-control" type="text" disabled value="${value.modulo_num_orden}" pattern="[0-9]+" maxlength="2" name="num_modulo" id="num_modulo">
                                                    <input type="hidden" name="id_org_aprendizaje" id="id_org_aprendizaje" value="${value.id_org_aprendizaje}">

                                                </div>
                                        <label  title="Cantidad de semanas que se crearán para el módulo" class="col-md-2"># Semanas </label>
                                                <div class="col-md-4">
                                                    <input  title="Click para actualizar la tabla" class="form-control" readonly type="text" pattern="[0-9]+" maxlength="2" value="${(restar_numeros(value.semanas_aprendizaje_fin,value.semanas_aprendizaje_ini))+1}"   name="cant_semanas" id="cant_semanas">
                                                </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="table-responsive">
                                            <table id="tblCtnsemanas_${index+1}" class="table table-bordered">


                                            </table>
                                        </div>
                                    </div>

                                </div>`
                                );

                                //onclick="GENERARCONTENEDORESEMANAS(${index+1},this.value,${value.semanas_aprendizaje_ini})"
                            //$("#fila_modulo_"+(index+1)+" "+".modulos .col-md-4").find("#cant_semanas").trigger("click");
                            GENERARCONTENEDORESEMANAS(index+1,value.semanas_aprendizaje_ini);

                            }else{

                            }

                        });


                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});
            }

            const Agrupar_por = (array, key) => {
                return array.reduce((result, currentValue) => {
                    (result[currentValue[key]] = result[currentValue[key]] || []).push(
                        currentValue
                    );
                        return result;
                }, {});
            };

            function Listar_creados_form_5(){
                var objGeneral = fnDataGeneral();
                var parametros = {
                    "id_version_sy": objGeneral._id_version_sy,
                };
                    $.ajax({
                        type  : "POST",
                        url: url_restapi+'tabla_org_aprendizaje_for_act__main_creados',
                        headers: {
                                        "X-API-KEY":api_key
                        },
                        data  : parametros,
                        })
                        .done(function(data) {

                        var num_modulo_numbers = Agrupar_por(data, 'num_modulo');
                        num_modulo_numbers_data_tratada =Object.entries(num_modulo_numbers);
                        console.log("🚀 ~ file: asyllabus_data.js.php:2005 ~ .done ~ num_modulo_numbers_data_tratada:", num_modulo_numbers_data_tratada)

                        //return false;
                        $('#listar_modulos_creados').empty();

                        $('#listar_modulos_creados').append(
                                    `
                                    </br>
                                    </br>
                                    <h1 style="text-aling:center;" class="card-subtitle col-md-12">
                                        Lista de las Actividades Principales de los Módulos
                                    </h1>  `);

                        $.each(num_modulo_numbers_data_tratada, function(index, value) {

                                $('#listar_modulos_creados').append(
                                    `
                                    <div class="form-body" id="lista2_fila_modulo_${index+1}">

                                        <div class="form-actions">
                                            <div class="text-right">
                                                <button type="button" id="boton" onclick="Insert_Update_form_5('U',${index+1})"  class="btn btn-info">Editar</button>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-2 modulos" style="    border: 1px solid #e8eef3;
                                                padding-right: 0px;
                                                padding-left: 0px;
                                            ">

                                                <div class="col-md-12">
                                                    MÓDULO <input class="form-control" type="text" readonly value="${value[0]}" pattern="[0-9]+" maxlength="2" name="num_modulo" id="num_modulo">
                                                    </br> ${value[1][0].modulo_aprendizaje}

                                                </div>
                                            </div>

                                            <div class="table-responsive col-md-10" style="
                                                padding-right: 0px;
                                                padding-left: 0px;
                                            ">
                                                <table id="tblCtnsemanas_${index+1}" class="table table-bordered" style=" margin-bottom: 0px !important;">


                                                </table>
                                            </div>
                                        </div>

                                    </div>`
                                );

                                var num_semana_numbers = Agrupar_por(value[1], 'num_semana');
                                num_semana_numbers_data_tratada =Object.entries(num_semana_numbers)

                            GENERARCONTENEDORESEMANAS_ACT(index+1,num_semana_numbers_data_tratada);
                        });


                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});
            }

            function Valida_form_5_act(fila_modulo) {
                var objGeneral = fnDataGeneral();

                var Obj_data_semana = {
                    cant_sesiones: [],
                    accion:'U'
                };

                var fila_sesiones = 0;
                var lista_sesion = {
                };

                $(objGeneral.form_5+" "+'.form-body#lista2_fila_modulo_'+fila_modulo+" "+'#tblCtnsemanas_'+fila_modulo+" "+'tbody tr td.segunda_columna tbody').each(function(index, element) {


                    if( $(element).find("tr").eq(0).find('input:text').val() === '' || parseInt($(element).find("tr").eq(0).find('input:text').val() ) == 0 || isNaN($(element).find("tr").eq(0).find('input:text').val()) ){

                        if($(element).find("tr").eq(0).find('input:text').val() === '' ){
                            msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(0).find('input:text').attr("titulo_input");

                        }else if(parseInt($(element).find("tr").eq(0).find('input:text').val() ) == 0 ){
                            msgDate =  `Porfavor  procure poner un valor diferente a cero en el campo <b>`+$(element).find("tr").eq(0).find('input:text').attr("titulo_input");

                        } else if(isNaN($(element).find("tr").eq(0).find('input:text').val())){
                            msgDate =  `Porfavor  procure poner solo valores numéricos el campo 4 <b>`+$(element).find("tr").eq(0).find('input:text').attr("titulo_input");
                        }
                        inputFocus = $(element).find("tr").eq(0).find('input:text');
                        fila_sesiones ++;
                        return false;
                    }else{
                        num_sesion = $(element).find("tr").eq(0).find('input:text').val() ;
                        fila_nombre =  $(element).find("tr").eq(0).find('input:text').attr("classs");
                        indicef =  $(element).find("tr").eq(0).find('input:text').attr("indicef");

                        if(indicef == 0){
                        lista_sesion[fila_nombre]  = [] ;
                        lista_sesion[fila_nombre].push(num_sesion);
                        }else{
                        lista_sesion[fila_nombre].push(num_sesion);
                        }
                    }


                    if( $(element).find("tr").eq(2).find("td").eq(0).find('textarea').val() === '' ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(0).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(0).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        desc_tema = $(element).find("tr").eq(2).find("td").eq(0).find('textarea').val() ;
                    }

                    if( $(element).find("tr").eq(2).find("td").eq(1).find('textarea').val() === ''  ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(1).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(1).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        descr_iteracc_docente = $(element).find("tr").eq(2).find("td").eq(1).find('textarea').val() ;
                    }

                    if( $(element).find("tr").eq(2).find("td").eq(2).find('textarea').val() === '' ){

                                msgDate =  `Porfavor rellene el campo  <b>`+$(element).find("tr").eq(2).find("td").eq(2).find('textarea').attr("titulo_input");

                        inputFocus = $(element).find("tr").eq(2).find("td").eq(2).find('textarea');
                        fila_sesiones ++;
                        return false;
                    }else{
                        descr_trabajo_autor = $(element).find("tr").eq(2).find("td").eq(2).find('textarea').val() ;
                    }

                    var id_sesion = $(element).find("tr").eq(0).find('input:hidden').val() ;
                    var semana_pertenece =$(element).parent().parent().find(".primera_columna").find(".semana_valor").val();
                    data_sesion_semana = {'num_sesion':num_sesion,'desc_tema':desc_tema, 'descr_iteracc_docente':descr_iteracc_docente,'descr_trabajo_autor':descr_trabajo_autor,'id_sesion':id_sesion};
                    Obj_data_semana['cant_sesiones'].push(data_sesion_semana)

                });

                if(fila_sesiones==0){
                    //return Obj_data_semana;

                }else{
                    return false;
                }


                // var nombres_no_repetidos = nombres_filas.filter( (ele,pos)=>nombres_filas.indexOf(ele) == pos);
                var fila_sesiones_repet = 0;
                $.each(lista_sesion, function(index, value) {

                        var existe_repetidos_sesiones = value.some(noEsPrimero)

                        if(existe_repetidos_sesiones){

                            msgDate =  `<strong>VALORES REPETIDOS EN LA ${(index.replace("_", " ")).toUpperCase()}</strong> </br> Se ha descubierto "SESIONES" con el mismo valor </br> Porfavor corregir ese ello`;
                            inputFocus = '';
                            fila_sesiones_repet++
                            return false;
                        }
                });


                if(fila_sesiones_repet==0){
                    return Obj_data_semana;
                }else{
                    return false;
                }


            }


            //-----------------------------------------------------------


            function Listar_form_6(){
                var objGeneral = fnDataGeneral();
                var parametros = {
                    "id_version_sy": objGeneral._id_version_sy,

                };
                    $.ajax({
                        type  : "POST",
                        url   : objGeneral.__wurl+'Listar_plataformas_herramientas',
                        data  : parametros,
                        })
                        .done(function(data) {

                                $("#lista_plataformas_herramientas").html(data);

                                $.ajax({
                                    url: objGeneral.__wurl+'Combo_plataformas_herramientas',
                                    type: 'POST',
                                    data: parametros,
                                    success: function(data)
                                    {
                                        $(objGeneral.form_6+" "+'#comboboxcambiante').html(data);
                                    }
                                });



                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});
            }

            function Valida_form_6() {
                var objGeneral = fnDataGeneral();

                    if($(objGeneral.form_6+" "+'#cbx_basicos_nom_plataformas_herramientas').val().trim() === '') {
                    msgDate = 'Debe ingresar el nombre de la plataforma o herramienta ';
                    inputFocus =objGeneral.form_6+" "+ '#cbx_basicos_nom_plataformas_herramientas';
                    return false;
                }
                return true;
            }

            function Insert_form_6(){
                var objGeneral = fnDataGeneral();
                    var dataString = $(objGeneral.form_6).serialize();
                        if (Valida_form_6()) {

                                    $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Asyllabus_plataformas_herramientas',
                                    data  : dataString,
                                    })
                                    .done(function(data) {
                                        swal.fire(
                                            'Registro Exitoso !',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {

                                                    Listar_form_6();
                                                    $(objGeneral.form_6+" "+'#cbx_basicos_nom_plataformas_herramientas').val("");

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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }

            function Editar_plataformas_herramientas(id_valor,th){
                var objGeneral = fnDataGeneral();

                var id = id_valor;
                var texto = $(th).parent().parent().find('td').eq(0).find('input').val();


                var datos = {

                    nom_plataformas_herramientas:texto,
                    id_plataformas_herramientas:id,

                }



                    $.ajax({
                    type  : "POST",
                    url   : objGeneral.__wurl+'Editar_Asyllabus_plataformas_herramientas',
                    data  : datos,
                    })
                    .done(function(data) {
                        swal.fire(
                            'Se editó Exitosamente !',
                            'Haga clic en el botón!',
                            'success'
                            ).then(function() {

                                    Listar_form_6();
                            });
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});

            }


            function Eliminar_Herramienta(id){
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
                            url:  objGeneral.__wurl+'Delete_Asyllabus_form_6',
                            data: {'id_plataformas_herramientas':id},
                            success:function () {
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then(function() {

                                                        Listar_form_6();

                                    //window.location = objGeneral.__wurl;
                                });
                            }
                        });
                    }
                })
            }


            //--------------------------------------------

            function Valida_form_7_8(tipo) {
                var objGeneral = fnDataGeneral();
                if(tipo==1){

                    if($(objGeneral.form_7+" "+'#nom_referencias_bibliograficas').val().trim() === '') {
                        msgDate = 'Debe ingresar el nombre de la referencia bibliografica obligatoria ';
                        inputFocus =objGeneral.form_7+" "+ '#nom_referencias_bibliograficas';
                        return false;
                    }
                }else{

                    if($(objGeneral.form_8+" "+'#nom_referencias_bibliograficas').val().trim() === '') {
                        msgDate = 'Debe ingresar el nombre de la referencia bibliografica de consulta ';
                        inputFocus =objGeneral.form_8+" "+ '#nom_referencias_bibliograficas';
                        return false;
                    }
                }
                return true;
            }

            function Insert_form_7_8(tipo){
                var objGeneral = fnDataGeneral();
                if(tipo==1){
                    var dataString = $(objGeneral.form_7).serialize();

                }else{
                    var dataString = $(objGeneral.form_8).serialize();

                }
                        if (Valida_form_7_8(tipo)) {

                                    $.ajax({
                                    type  : "POST",
                                    url   : objGeneral.__wurl+'Insert_Asyllabus_referencias_bibliograficas',
                                    data  : dataString,
                                    })
                                    .done(function(data) {
                                        swal.fire(
                                            'Registro Exitoso !',
                                            'Haga clic en el botón!',
                                            'success'
                                            ).then(function() {

                                                if(tipo==1){
                                                    Listar_form_7_8("obligatorio");
                                                    $(objGeneral.form_7+" "+'#nom_referencias_bibliograficas').summernote("reset");

                                                }else{
                                                    Listar_form_7_8("consulta");
                                                    $(objGeneral.form_8+" "+'#nom_referencias_bibliograficas').summernote("reset");

                                                }

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
                            $('.modal').animate({scrollTop:0}, 500, 'swing');

                        }
            }

            function Listar_form_7_8(tipo_bibliografia){
                var objGeneral = fnDataGeneral();
                var parametros = {
                    "id_version_sy": objGeneral._id_version_sy,

                    "tipo_bibliografia": tipo_bibliografia
                };
                    $.ajax({
                        type  : "POST",
                        url   : objGeneral.__wurl+'Listar_referencias_bibliograficas',
                        data  : parametros,
                        })
                        .done(function(data) {

                            if(tipo_bibliografia === "obligatorio"){
                                $("#lista_Referencias_obligatorias").html(data);

                            }else{
                                $("#lista_Referencias_consultas").html(data);

                            }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});
            }

            function Eliminar_Refer(id){
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
                            url:  objGeneral.__wurl+'/Delete_ReferObli',
                            data: {'id_referencias_bibliograficas':id},
                            success:function () {
                                Swal.fire(
                                    'Eliminado!',
                                    'El registro ha sido eliminado satisfactoriamente.',
                                    'success'
                                ).then(function() {

                                    Listar_form_7_8("obligatorio");
                                    Listar_form_7_8("consulta");
                                    //window.location = objGeneral.__wurl;
                                });
                            }
                        });
                    }
                })
            }


            function Editar_Refer(id_valor,th,tipo_bibliografia){
                var objGeneral = fnDataGeneral();

                var id = id_valor;
                var texto = $(th).parent().parent().find('td').eq(0).html();

                if(tipo_bibliografia === "obligatorio"){
                    $(objGeneral.form_7+" "+"#nom_referencias_bibliograficas").summernote('code',texto);
                    $('#boton_7_refer').attr('onclick','Update_formul_7_8('+id+',"'+tipo_bibliografia+'")')
                    $('#boton_7_refer').text('Editar')
                }else{
                    $(objGeneral.form_8+" "+"#nom_referencias_bibliograficas").summernote('code',texto);
                    $('#boton_8_refer').attr('onclick','Update_formul_7_8('+id+',"'+tipo_bibliografia+'")')
                    $('#boton_8_refer').text('Editar')
                }

            }

            function Update_formul_7_8(id_valor,tipo_bibliografia){
                var objGeneral = fnDataGeneral();


                $(objGeneral.form_8+" "+'#nom_referencias_bibliograficas').val()
                if(tipo_bibliografia === "obligatorio"){
                    texto= $(objGeneral.form_7+" "+"#nom_referencias_bibliograficas").val();
                }else{

                    texto= $(objGeneral.form_8+" "+"#nom_referencias_bibliograficas").val();
                }

                var id = id_valor;

                var datos = {
                    nom_biblio:texto,
                    id_referencias_bibliograficas:id,
                }

                    $.ajax({
                    type  : "POST",
                    url   : objGeneral.__wurl+'Editar_Asyllabus_bibliografi',
                    data  : datos,
                    })
                    .done(function(data) {
                        swal.fire(
                            'Se editó Exitosamente !',
                            'Haga clic en el botón!',
                            'success'
                            ).then(function() {

                                if(tipo_bibliografia === "obligatorio"){
                                    $(objGeneral.form_7+" "+"#nom_referencias_bibliograficas").summernote('code','');
                                    Listar_form_7_8("obligatorio");
                                    $('#boton_7_refer').attr('onclick','Insert_form_7_8(1)')
                                    $('#boton_7_refer').text('Agregar')
                                }else{
                                    $(objGeneral.form_8+" "+"#nom_referencias_bibliograficas").summernote('code','');
                                    Listar_form_7_8("consulta");
                                    $('#boton_8_refer').attr('onclick','Insert_form_7_8(2)')
                                    $('#boton_8_refer').text('Agregar')
                                }
                            });
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        someErrorFunction();
                    })
                    .always(function() {});

            }


            //----------------------------------------------------
            $(document).ready(function() {
                var objGeneral = fnDataGeneral();

                    if( $(objGeneral.form_1+" "+'#cbx_multiple_id_docente').is( ":disabled" ) == true) {
                        Listar_form_6_revision();
                        Listar_form_7_8_revision("obligatorio");
                        Listar_form_7_8_revision("consulta");
                    }else{
                        Listar_form_6();
                        Listar_form_7_8("obligatorio");
                        Listar_form_7_8("consulta");

                    }

            });

            $(function () {
                    $('[data-toggle="tooltip"]').tooltip()
            })

            function Plan_estudios(th){
                    var objGeneral = fnDataGeneral();

                    var extra_id = $(th).find(':selected').attr('data-id-extra')

                    var id_plan_estudios = th.value;

                    if(id_plan_estudios == 0){


                                $(objGeneral.form_1+" "+'#cbx_basicos_id_carrera').html('<option value="0" selected>'+ 'Seleccione ' +'</option>');
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_director').html('<option value="0" selected>'+ 'Seleccione ' +'</option>');
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').html('<option value="0" selected>'+ 'Seleccione ' +'</option>');

                                $(objGeneral.form_1+" "+'#nom_ciclo').html('<option value="0" selected>'+ 'Seleccione ' +'</option>');

                                $(objGeneral.form_1+" "+'#creditos').val('');
                                $(objGeneral.form_1+" "+'#horas_totales').val('');
                                $(objGeneral.form_1+" "+'#horas_practicas').val('');
                                $(objGeneral.form_1+" "+'#horas_teoricas').val('');
                                $(objGeneral.form_1+" "+'#requisito').html('');


                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val(0);
                                // $(objGeneral.form_1+" "+'#cbx_basicos_id_docente').html('');cbx_multiple_id_docente
                                // $(objGeneral.form_1+" "+'#tipo_estudios_texto').html('<option value="" selected>'+ 'Seleccione ' +'</option>');
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_estudios').val(0);


                    }else{

                        var parametros = {
                                "id_plan_estudios": id_plan_estudios,
                                "id_asignacion_plan_estudios":extra_id,

                            };

                            $.ajax({
                            type  : "POST",
                            url: url_restapi+'lista_carreras_by_plan_estudios',
                            headers: {
                                "X-API-KEY":api_key
                            },
                            data  : parametros,
                            })
                            .done(function(data) {


                                var carrera='<option value="" >'+ 'Seleccione Carrera' +'</option>';
                                $.each(data[0], function(index, value) {
                                    //el cero es general en plan de estudios
                                    if(value['id'] == 0){
                                    // carrera += '<option value="'+value['id']+'">General</option>';
                                    }else{
                                        carrera += '<option selected value="'+value['id']+'">'+value['nombre'] +'</option>';
                                    }
                                });

                                $(objGeneral.form_1+" "+'#cbx_basicos_id_carrera').html(carrera);

                                var ciclo='<option value="0" selected>'+ 'Seleccionar Ciclo' +'</option>';
                                $.each(data[1], function(index, value) {
                                        ciclo += '<option id_extra="'+value['id_asignacion_plan_estudios']+'" value="'+value['nom_ciclo']+'">'+value['nom_ciclo'] +'</option>';
                                });


                                $(objGeneral.form_1+" "+'#nom_ciclo').html(ciclo);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_estudios').val(data[2]);


                            })
                            .fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});
                    }
            }

            function Carrera(th){
                var objGeneral = fnDataGeneral();

                    var id_carrera = th.value ;

                    if(id_carrera == 0){


                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').html('<option value="0" selected>'+ 'Seleccione' +'</option>');
                                $(objGeneral.form_1+" "+'#creditos').val('');
                                $(objGeneral.form_1+" "+'#horas_totales').val('');
                                $(objGeneral.form_1+" "+'#horas_practicas').val('');
                                $(objGeneral.form_1+" "+'#horas_teoricas').val('');
                                $(objGeneral.form_1+" "+'#requisito').html('');


                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val(0);
                                // $(objGeneral.form_1+" "+'#cbx_basicos_id_docente').html('');

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
                        .done(function(data){

                            $(objGeneral.form_1+" "+'#cbx_basicos_id_director').html('');

                            var directores='';
                            $.each(data, function(index, value) {
                                    directores += '<option value="'+value['id_director']+'">'+value['nom_director'] +'</option>';
                            });

                            $(objGeneral.form_1+" "+'#cbx_basicos_id_director').html(directores);

                            $(objGeneral.form_1+" "+'#cbx_basicos_id_director').trigger('change');



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
                        var  id_plan_estudios= $(objGeneral.form_1+" "+"#cbx_basicos_id_plan_estudios").val();

                        if(num_ciclo == 0){

                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').html('<option value="0" selected>'+ 'Seleccione' +'</option>');
                                $(objGeneral.form_1+" "+'#creditos').val('');
                                $(objGeneral.form_1+" "+'#horas_totales').val('');
                                $(objGeneral.form_1+" "+'#horas_practicas').val('');
                                $(objGeneral.form_1+" "+'#horas_teoricas').val('');
                                $(objGeneral.form_1+" "+'#requisito').html('');

                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val(0);
                                // $(objGeneral.form_1+" "+'#cbx_basicos_id_docente').html('');

                        }else{

                                var parametros = {
                                    "num_ciclo": num_ciclo,
                                    "id_plan_estudios":id_plan_estudios,
                                    "id_asignacion_plan_estudios":extra_id

                                };

                                $.ajax({
                                type  : "POST",
                                // url: url_restapi+'lista_cursos_by_ciclo_by_carrera',
                                url: url_restapi+'lista_cursos_by_ciclo_by_carrera_asing_usu',
                                headers: {
                                                "X-API-KEY":api_key
                                },
                                data  : parametros,
                                })
                                .done(function(data) {


                                var curso='<option value="0" id-ciclo="" selected>'+ 'Seleccionar' +'</option>';
                                $.each(data, function(index, value) {
                                    //el cero es general en plan de estudios
                                        curso += '<option id-ciclo="'+value['id_ciclo']+'" value="'+value['id_curso']+'">'+value['nom_curso'] +'</option>';
                                });

                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso').html(curso);

                                })
                                .fail(function(jqXHR, textStatus, errorThrown) {
                                    someErrorFunction();
                                })
                                .always(function() {});
                        }
            }

            function Curso(th){

                var id_ciclo =  $(th).find('option:selected').attr('id-ciclo');

                var id_ciclo = id_ciclo; //th.value ;

                var objGeneral = fnDataGeneral();

                        // var id_curso = th.value ;

                        var  id_plan_estudios= $(objGeneral.form_1+" "+"#cbx_basicos_id_plan_estudios").val();

                        if(id_ciclo == 0 ){


                                $(objGeneral.form_1+" "+'#creditos').val('');
                                $(objGeneral.form_1+" "+'#horas_totales').val('');
                                $(objGeneral.form_1+" "+'#horas_practicas').val('');
                                $(objGeneral.form_1+" "+'#horas_teoricas').val('');
                                $(objGeneral.form_1+" "+'#requisito').html('');


                                $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val(0);
                                $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val(0);
                                // $(objGeneral.form_1+" "+'#cbx_basicos_id_docente').html('');

                        }else{

                            if(id_plan_estudios == 0 ){
                                return false;
                            }

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

                                    $(objGeneral.form_1+" "+'#creditos').val(data['DATAMAIN'][0]['creditos']);
                                    $(objGeneral.form_1+" "+'#horas_teoricas').val(data['DATAMAIN'][0]['horas_teoricas']);
                                    $(objGeneral.form_1+" "+'#horas_practicas').val(data['DATAMAIN'][0]['horas_practicas']);
                                    $(objGeneral.form_1+" "+'#horas_totales').val(data['DATAMAIN'][0]['horas_totales']);


                                    $(objGeneral.form_1+" "+'#requisito').html('');

                                        var requisito_select='';
                                        $.each(data['REQUISITOS'], function(index, value) {
                                            //el cero es general en plan de estudios
                                                requisito_select += '<option value="'+value['id_curso']+'" selected>'+value['nom_curso'] +'</option>';
                                        });

                                        $(objGeneral.form_1+" "+'#requisito').html(requisito_select);

                                    $(objGeneral.form_1+" "+'#cbx_basicos_id_tipo_curso').val(data['DATAMAIN'][0]['id_tipo_curso']);
                                    $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_forma_estudio').val(data['DATAMAIN'][0]['id_curso_forma_estudio']);

                                    $(objGeneral.form_1+" "+'#cbx_basicos_id_curso_importancia').val(data['DATAMAIN'][0]['id_curso_importancia']);

                                })
                                .fail(function(jqXHR, textStatus, errorThrown) {
                                    someErrorFunction();
                                })
                                .always(function() {});

                        }

            }



    //------------ revisor vista-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

    function cargar_tabla_org_aprendizaje_revision(){
             var objGeneral = fnDataGeneral();

            $(objGeneral.form_3+"_tbl").dataTable().fnDestroy();

            $(objGeneral.form_3+"_tbl").on('processing.dt', function (e, settings, processing) {
            processing ? loading_tabla(true) : loading_tabla(false);
            }).dataTable({
                "dom": 'frtip',
                lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Mostrar todo']],
                "language": {"url": "https://cdn.datatables.net/plug-ins/1.11.4/i18n/es_es.json",
            },
                "processing": false,
                "serverSide": false,
                "ajax": { url : objGeneral.__wurl + "cargar_tabla_org_aprendizaje_revision/"+objGeneral._id_version_sy,
                type : 'POST', data: {
                    },
                    error: function (e) {
                        console.log(e.responseText);
                    }
                },
                "bDestroy": true,
                "responsive": true,
                "bInfo": true,
                "order": [[2, "asc"]],

                "columns": [
                    {"data": "ID_ORG_APRENDIZAJE", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                    {"data": "ID_VERSION_SY" , "className": "never", "autoWidth": true, "orderable": false, "visible": false  },

                    {"data": "ORDEN","width": "20%" },

                    {"data": "MODULO_APRENDIZAJE","width": "20%" },
                    {"data": "RESULT_APRENDIZAJE" ,"width": "20%" },
                    {"data": "SEMANAS","width": "20%"  },
                    {"data": "CONTEN_APRENDIZAJE","width": "20%"  },
                ]

            });
            return false;

    }

    function Listar_form_6_revision(){
        var objGeneral = fnDataGeneral();
        var parametros = {
            "id_version_sy": objGeneral._id_version_sy,


        };
            $.ajax({
                type  : "POST",
                url   : objGeneral.__wurl+'Listar_plataformas_herramientas_revision',
                data  : parametros,
                })
                .done(function(data) {

                        $("#lista_plataformas_herramientas").html(data);

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});
    }

    function Listar_creados_form_5_revision(){
        var objGeneral = fnDataGeneral();
        var parametros = {
            "id_version_sy": objGeneral._id_version_sy,

        };
            $.ajax({
                type  : "POST",
                url: url_restapi+'tabla_org_aprendizaje_for_act__main_creados',
                headers: {
                                "X-API-KEY":api_key
                },
                data  : parametros,
                })
                .done(function(data) {
                var num_modulo_numbers = Agrupar_por(data, 'num_modulo');
                num_modulo_numbers_data_tratada =Object.entries(num_modulo_numbers);

                //return false;
                $('#listar_modulos_creados').empty();

                $('#listar_modulos_creados').append(
                            `
                            </br>
                            </br>
                            <h1 style="text-aling:center;" class="card-subtitle col-md-12">
                                Lista de las Actividades Principales de los Módulos
                            </h1>  `);

                $.each(num_modulo_numbers_data_tratada, function(index, value) {

                        $('#listar_modulos_creados').append(
                            `
                            <div class="form-body" id="lista2_fila_modulo_${index+1}">

                                <div class="form-group row">
                                    <div class="col-md-2 modulos" style="    border: 1px solid #e8eef3;
                                        padding-right: 0px;
                                        padding-left: 0px;
                                    ">

                                        <div class="col-md-12">
                                            MÓDULO <input class="form-control" type="text" readonly value="${value[0]}" pattern="[0-9]+" maxlength="2" name="num_modulo" id="num_modulo">
                                            </br> ${value[1][0].modulo_aprendizaje}

                                        </div>
                                    </div>

                                    <div class="table-responsive col-md-10" style="
                                        padding-right: 0px;
                                        padding-left: 0px;
                                    ">
                                        <table id="tblCtnsemanas_${index+1}" class="table table-bordered" style=" margin-bottom: 0px !important;">


                                        </table>
                                    </div>
                                </div>

                            </div>`
                        );

                        var num_semana_numbers = Agrupar_por(value[1], 'num_semana');
                        num_semana_numbers_data_tratada =Object.entries(num_semana_numbers)

                    GENERARCONTENEDORESEMANAS_ACT_revi(index+1,num_semana_numbers_data_tratada);
                });


            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});
    }

    function GENERARCONTENEDORESEMANAS_ACT_revi(fila_modulo,num_semana_numbers_data_tratada) {

        $.each(num_semana_numbers_data_tratada, function(index, value) {

            $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo).append(
                `   <tbody>
                            <tr>
                                <td class="primera_columna" width="10%" style="font-size:11px;"  >
                                    SEMANA <br>

                                    <input value="${value[0]}" readonly class="form-control semana_valor" titulo_input="Número de semana" type="text" pattern="[0-9]+" maxlength="2" name="num_semana_${index+1}" id="num_semana_${index+1}">
                                    <br>
                                </td>
                                <td class="segunda_columna"  style="padding: 0px;"  id="tbl_Ctnsesiones_${index+1}" >
                                </td>
                                <br>
                            </tr>
                    </tbody>`
            );

        GENERARCONTENEDORESESIONES_ACT_revi(fila_modulo,value[1],index+1)

    });
    }

    function GENERARCONTENEDORESESIONES_ACT_revi(fila_modulo,sesiones_array,num) {
        $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).empty();


        $.each(sesiones_array, function(index, value) {
            $('#listar_modulos_creados #tblCtnsemanas_'+fila_modulo+' '+'#tbl_Ctnsesiones_'+num).append(
                ` <tbody>

                    <tr >
                            <th class="dentrofila_${num}"  style="text-align: center;font-size:13px;"  width="10%"    rowspan="3">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    Sesión
                                <input class="form-control" disabled classs="fila_${num}" indicef="${index}"  value="${value.num_sesion}" titulo_input="Número de sesión de la subfila ${index+1} que pertenece a la fila ${num}"  style="width:70px"  type="number" min="1" max="20"  name="fila${num}_num_sesion_${index+1}" id="fila${num}_num_sesion_${index+1}">
                                <input value="${value.id_sesion_modulo}" disabled type="hidden" name="fila${num}_num_sesion_${index+1}" id="fila${num}_num_sesion_${index+1}">
                            </th>
                            <th style="text-align: center;font-size:13px;"  rowspan="2">TEMA </th>
                            <th style="text-align: center;font-size:13px;"  colspan=2>ACTIVIDADES VIRTUALES PRINCIPALES</th>
                    </tr>

                    <tr>
                        <th style="text-align: center;font-size:13px;" >ACTIVIDADES EN INTERACCION CON EL DOCENTE (Aprendizaje sincrónico: Zoom) </th>
                        <th style="text-align: center;font-size:13px;" >ACTIVIDADES DE TRABAJO AUTÓNOMO (Aprendizaje asincrónico: Aula Virtual) </th>
                    </tr>

                    <tr>
                        <td width="30%"> <textarea disabled cols="20" class="form-control" titulo_input="Descripción tema de la subfila ${index+1} que pertenece a la fila ${num}" rows="10" name="fila${num}_desc_tema_${index+1}" id="desc_tema_${index+1}">${value.desc_tema}</textarea> </td>
                        <td><textarea cols="20" disabled rows="10" class="form-control"  titulo_input="Descripción de actividades del docente de la subfila ${index+1} que pertenece a la fila ${num}"   name="fila${num}_descr_iteracc_docente_${index+1}" id="fila${num}_descr_iteracc_docente_${index+1}">${value.descr_iteracc_docente}</textarea></td>
                        <td><textarea cols="20" disabled rows="10" class="form-control"  titulo_input="Descripción de actividades de trabajo autónomo de la subfila ${index+1} que pertenece a la fila ${num}"  name="fila${num}_descr_trabajo_autor_${index+1}" id="fila${num}_descr_trabajo_autor_${index+1}">${value.descr_trabajo_autor}</textarea></td>
                    </tr>

                </tbody>`
            );

        });

    }


    function Listar_form_7_8_revision(tipo_bibliografia){
        var objGeneral = fnDataGeneral();
        var parametros = {
            "id_version_sy": objGeneral._id_version_sy,

            "tipo_bibliografia": tipo_bibliografia
        };
            $.ajax({
                type  : "POST",
                url   : objGeneral.__wurl+'Listar_referencias_bibliograficas_revision',
                data  : parametros,
                })
                .done(function(data) {

                    if(tipo_bibliografia === "obligatorio"){
                        $("#lista_Referencias_obligatorias").html(data);

                    }else{
                        $("#lista_Referencias_consultas").html(data);

                    }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});
    }


    function Insert_Update_form_comentario(accion,campo){
        var objGeneral = fnDataGeneral();
        var parametros = {
            "id_version_sy": objGeneral._id_version_sy,
            "data_campo":$('#'+campo).val(),
            "campo": campo
        };
            $.ajax({
                type  : "POST",
                url   : objGeneral.__wurl+'Insert_Update_comentario_vers_sy',
                data  : parametros,
                })
                .done(function(data) {

                                Swal.fire(
                                    'Comentario hecho!',
                                    '',
                                    'success'
                                ).then(function() {                                    //window.location = objGeneral.__wurl;
                                });

            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                someErrorFunction();
            })
            .always(function() {});
    }



    //--------------------------------- HISTORIAL------------------------------------------------------------------------------------------



</script>


