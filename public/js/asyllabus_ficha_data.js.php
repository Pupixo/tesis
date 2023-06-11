<script>
  
            var url_general = "<?php echo base_url().'index.php?'; ?>";
            var api_key =  <?php echo "'".API_KEY_SISTEMA."'";  ?>  ;
            var url_restapi = "<?php echo site_url(); ?>rest/Restapi/";

            function fnDataGeneral(){
                /* VARIABLES POR DEFECTO A CARGAR, pueden agregarse mas segun el programador */
                var abrev = "<?php echo $abrev; ?>";
                var form_1 ="<?php echo $formulario_eval_1; ?>";
                var form_2 ="<?php echo $formulario_eval_2; ?>";
                var form_3 ="<?php echo $formulario_eval_3; ?>";
                var form_4 ="<?php echo $formulario_eval_4; ?>";
                var form_5 ="<?php echo $formulario_eval_5; ?>";
                var form_6 ="<?php echo $formulario_eval_6; ?>";

                var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";
                var base_url = "<?= base_url() ?>";

                var id_principal = "<?= $id_syllabus ?>";
                var id_version_sy = "<?= $id_version_sy ?>";

                var mydata = {
                    _abrev: abrev,
                    __wurl: wurl,
                    form_1: "#"+form_1,
                    form_2: "#"+form_2,
                    form_3: "#"+form_3,
                    form_4: "#"+form_4,
                    form_5: "#"+form_5,
                    form_6: "#"+form_6,
          
                    _tabla1 :'#tbl1'+abrev,
                    _id_principal  : id_principal,
                    _id_version_sy  : id_version_sy,
                    
                    _base_url :base_url
                };

                return mydata;
            }
        
            function Validacion(number,thi) {
                var objGeneral = fnDataGeneral();
             
                if($('#semana_eval_'+number).val().trim() === '') {
                    msgDate = 'Debe ingresar el número de semana  ';
                    inputFocus = '#semana_eval_'+number;
                    return false;
                }       
             
                if($('#defin_eval_'+number).val().trim() === '') {
                    msgDate = 'Debe ingresar la definición de la evaluación';
                    inputFocus = '#defin_eval_'+number;
                    return false;
                }       
             
                if($('#descrip_eval_'+number).val().trim() === '') {
                    msgDate = 'Debe ingresar la descripción de la evaluación';
                    inputFocus = '#descrip_eval_'+number;
                    return false;
                }       

                if($('#criterios_eval_'+number).val().trim() === '') {
                    msgDate = 'Debe ingresar los criterios  de la evaluación';
                    inputFocus = '#criterios_eval_'+number;
                    return false;
                }      

                if(  $('#competencias_'+number).val().length == 0 ) {
                    msgDate = 'Debe ingresar las competencias asociadas a la evaluación';
                    inputFocus = '#competencias_'+number;
                    return false;
                }      


                var fila_ciclo = 0;

                var Obj_data = {
                    "id_version_sy": objGeneral._id_version_sy,
                    "semana_eval": $('#semana_eval_'+number).val(),
                    "defin_eval": $('#defin_eval_'+number).val(),
                    "descrip_eval": $('#descrip_eval_'+number).val(),
                    "criterios_eval": $('#criterios_eval_'+number).val(),
                    "id_eval": $('#id_eval_'+number).val(),        
                    
                    "ids_competencias":$('#competencias_'+number).val(),
                    "number": number,
                    "criterio": [],
                };

                var validacion_data = 0;

        
                $(thi).parent().parent().parent().parent().parent().find('.tbt_main').find('table tbody tr#ln_main').each(function(index0, element0) {  

                                //-------------------------------------------------------------
                                        if(  $(element0).find('td').eq(0).find("select").val() == 0 ) {
                                            msgDate = 'Debe seleccionar la competencia en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }      
                                        if( $(element0).find('td').eq(1).find("textarea").val() === '' ) {
                                            msgDate = 'Debe ingresar la competencia a lograr en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }     
                                        if( $(element0).find('td').eq(1).attr("puntaje") === '' || typeof $(element0).find('td').eq(1).attr("puntaje") === "undefined"  ) {
                                            msgDate = 'Debe ingresar el puntaje de la competencia a lograr en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }     
                                        if(  $(element0).find('td').eq(2).find("textarea").val() === '') {
                                            msgDate = 'Debe ingresar la competencia en proceso en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }     
                                        if( $(element0).find('td').eq(2).attr("puntaje") === ''  || typeof $(element0).find('td').eq(2).attr("puntaje")=== "undefined" ) {
                                            msgDate = 'Debe ingresar el puntaje de la competencia en proceso en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }     
                                        if(  $(element0).find('td').eq(3).find("textarea").val() === '') {
                                            msgDate = 'Debe ingresar la competencia no lograda en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }                        
                                        if( $(element0).find('td').eq(3).attr("puntaje") === '' || typeof $(element0).find('td').eq(3).attr("puntaje") === "undefined"  ) {
                                            msgDate = 'Debe ingresar el puntaje de la competencia no lograda en la fila ' + (index0+1);
                                            inputFocus = '#competencias_'+number;
                                            fila_ciclo ++;
                                            return false;
                                        }
                                //-------------------------------------------------------------

                            data__fila = {
                                            'id_criti':$(element0).attr('id_criti'),
                                            'id_compet':$(element0).find('td').eq(0).find("select").val(),
                                            'logrado': $(element0).find('td').eq(1).find("textarea").val(),
                                            'en_proceso': $(element0).find('td').eq(2).find("textarea").val(),
                                            'no_logrado':$(element0).find('td').eq(3).find("textarea").val(),
                                            'logrado_puntaje':$(element0).find('td').eq(1).attr("puntaje"),
                                            'en_proceso_puntaje':$(element0).find('td').eq(2).attr("puntaje"),
                                            'no_logrado_puntaje':$(element0).find('td').eq(3).attr("puntaje"),
                            };

                            Obj_data['criterio'].push(data__fila)
              
                    validacion_data = $(element0).length;


                });


                if(fila_ciclo==0){
                        // if(Obj_data['criterio'].length === 0){
                        //     console.log("tbl vacio");
                            
                        //         msgDate = 'Debe generar subdata para guardar la ficha de evaluación';
                        //         inputFocus = '#cbx_multiple_id_carrera_electivo';
                        //         return false;

                        // }else{

                      
                                return Obj_data;
                        
                        // }
                }else{
                    return false;
                }             
            }        

            function Insert_Update_form_eval(number,thi){
                var objGeneral = fnDataGeneral();
                if (Validacion(number,thi)) {
                    obj= (Validacion(number,thi));

                        $.ajax({
                        type  : "POST",
                        url   : objGeneral.__wurl+'Insert_Update_ficha_eval',
                        data  : obj, 
                        })
                        .done(function(data) {
                            
                            Swal.fire(
                                        '¡Datos actualizados!',
                                        '',
                                        'success'
                                    ).then(function() {                                    
                                        //window.location = objGeneral.__wurl;
                                        Listar_ficha_eval($('#id_eval_'+number).val(),number);
                                    });
                    
                        })
                        .fail(function(jqXHR, textStatus, errorThrown) { someErrorFunction(); })  .always(function() {});
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
        
            function combo_competencias_seleccion(numero,valor){
                console.log("🚀 ~ file: asyllabus_ficha_data.js.php:218 ~ combo_competencias_seleccion ~ valor:", valor)

                var id_ciclo_ficha_eval = $('#id_ciclo_ficha_eval').val() ;
                var parametros = { "id_ciclo": id_ciclo_ficha_eval };

                $.ajax({
                    type  : "POST",
                    url: url_restapi+'lista_compet_asocia_ficha_eval',
                    headers: { "X-API-KEY":api_key},
                    data  : parametros, 
                })
                .done(function(data) {

                    var competencias ='';    
                        if( data[0]['competencia_general_1'] != null ){
                            competencias  += '<option value="'+data[0]['compet_gene_uno']+'-'+data[0]['compet_gene_nivel_uno']+'">'+ data[0]['competencia_general_1'] +'</option>';
                        }
                        if( data[0]['competencia_general_2'] != null ){
                            competencias  += '<option  value="'+data[0]['compet_gene_dos']+'-'+data[0]['compet_gene_nivel_dos']+'">'+ data[0]['competencia_general_2'] +'</option>';
                        }
                        if( data[0]['competencia_espec_1'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_uno']+'-'+data[0]['compet_espec_nivel_uno']+'">'+ data[0]['competencia_espec_1'] +'</option>';
                        }
                        if( data[0]['competencia_espec_2'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_dos']+'-'+data[0]['compet_espec_nivel_dos']+'">'+ data[0]['competencia_espec_2'] +'</option>';
                        }        
                        if( data[0]['competencia_espec_3'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_tres']+'-'+data[0]['compet_espec_nivel_tres']+'">'+ data[0]['competencia_espec_3'] +'</option>';
                        }

                    $('#competencias_'+numero).html(competencias);
                    $("#competencias_"+numero).select2();

                    if(valor ==''){
                        $("#competencias_"+numero).val("");
                        $("#competencias_"+numero).trigger("change");
                    }else{

                        var ids_competencias = valor.split(','); 
                        $.each(ids_competencias, function(index, value) {
                            $("#competencias_"+numero+" > option[value='"+value+"']").prop("selected","selected");
                        });

                        setTimeout(function () {
                            $("#competencias_"+numero).trigger("change");
                        }, 100);
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});    


            }

            function Agregar_Competencia(that){
                var combo = $(that).val();
                var parametros = {"combo": combo};

                $.ajax({
                type  : "POST",
                url: url_restapi+'lista_get_diccionario',
                headers: { "X-API-KEY":api_key},
                data  : parametros, 
                })
                .done(function(data) {
                    var fila =$(that).parent().parent().find('.texto');   

                    var data_ht= '';
                    $.each(data, function(index, value) {
                        data_ht+= `<b>${value.nom_compet}:</b> ${value.nivel_text}<br><br>`; 
                    }); 

                    $(fila).html(data_ht);

                }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});    

            }
            
            function AgregarFila(that){
                var fila =$(that).parent().parent().parent().parent().find('tbody');;   

                var id_ciclo_ficha_eval = $('#id_ciclo_ficha_eval').val() ;
                var parametros = { "id_ciclo": id_ciclo_ficha_eval };
                $.ajax({
                    type  : "POST",
                    url: url_restapi+'lista_compet_asocia_ficha_eval',
                    headers: { "X-API-KEY":api_key},
                    data  : parametros, 
                })
                .done(function(data) {
                    var competencias ='<select class="form-control mt-25"> <option value="">Seleccion</option>';    

                        if( data[0]['competencia_general_1'] != null ){
                            competencias  += '<option value="'+data[0]['compet_gene_uno']+'">'+ data[0]['competencia_general_1'] +'</option>';
                        }
                        if( data[0]['competencia_general_2'] != null ){
                            competencias  += '<option  value="'+data[0]['compet_gene_dos']+'">'+ data[0]['competencia_general_2'] +'</option>';
                        }
                        if( data[0]['competencia_espec_1'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_uno']+'">'+ data[0]['competencia_espec_1'] +'</option>';
                        }
                        if( data[0]['competencia_espec_2'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_dos']+'">'+ data[0]['competencia_espec_2'] +'</option>';
                        }        
                        if( data[0]['competencia_espec_3'] != null ){
                            competencias  += '<option value="'+data[0]['compet_espec_tres']+'">'+ data[0]['competencia_espec_3'] +'</option>';
                        }



                        setTimeout(function () {

                            competencias  +='</select>';

                            var htmldata = '';
                            htmldata += `<tr id_criti="0" id="ln_main" >
                                    <td rowspan=2>${competencias}</td>
                                    <td> <textarea class="form-control" cols="30" rows="2"></textarea> </td>
                                    <td> <textarea class="form-control" cols="30" rows="2"></textarea> </td>
                                    <td> <textarea class="form-control" cols="30" rows="2"></textarea> </td>
                                    <td rowspan=2> <button type="button" onclick="EliminarFila(this)"  class="btn btn-warning btn-circle"><i class="fas fa-minus"></i></button>  </td>

                                </tr>
                                <tr>
                                    <td><input placeholder="Puntaje" onkeyup="Puntaje_write(this,1,this.value)" type="text" class="form-control"></td>
                                    <td> <input placeholder="Puntaje" onkeyup="Puntaje_write(this,2,this.value)" type="text" class="form-control"></td>
                                    <td> <input placeholder="Puntaje" onkeyup="Puntaje_write(this,3,this.value)" type="text" class="form-control"></td>

                                </tr>`;    

                                $(fila).append(htmldata);
                            
                        }, 100);
            
                }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});    

              
            }
            
            function EliminarFila(that){

                var id_criti =$(that).parent().parent().attr('id_criti');
                var parametros = { "id_criti": id_criti };


                if(id_criti==0){

                    var fila2 =$(that).parent().parent().next().remove();
                    var fila =$(that).parent().parent().remove();
                   
                }else{
                    
                    $.ajax({
                        type  : "POST",
                        url: url_restapi+'eliminar_fila_criterio',
                        headers: { "X-API-KEY":api_key},
                        data  : parametros, 
                    })
                    .done(function(data) {

                        var fila2 =$(that).parent().parent().next().remove();
                        var fila =$(that).parent().parent().remove();
                                
                    }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});    

                }
            }
    
            function Puntaje_write(that,number,valor){

                var id_criti =$(that).parent().parent().prev().find('td');
                $(id_criti).eq(number).attr('puntaje', valor);

            }
       
            $(document).ready(function() {
                var objGeneral = fnDataGeneral();
                var msgDate = '';
                var inputFocus = '';               


                                              
                setTimeout(function () {
                          
                    combo_competencias_seleccion(1,$('#ids_competencias_'+1).val());
                    combo_competencias_seleccion(2,$('#ids_competencias_'+2).val());
                    combo_competencias_seleccion(3,$('#ids_competencias_'+3).val());
                    combo_competencias_seleccion(4,$('#ids_competencias_'+4).val());
                    combo_competencias_seleccion(5,$('#ids_competencias_'+5).val());
                    combo_competencias_seleccion(6,$('#ids_competencias_'+6).val());
                            
                      }, 1000);



      
               
            });


</script>

