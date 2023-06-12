<script>
  
    var url_general = "<?php echo base_url().'index.php?'; ?>";

    function fnDataGeneral(){
        /* VARIABLES POR DEFECTO A CARGAR, pueden agregarse mas segun el programador */
        var abrev = "<?php echo $abrev; ?>";
        var opcion = "<?php echo $tituloPrincipal; ?>";

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
                {"data": "ID_RECURSOS_AULA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},

                {"data": "MODALIDAD"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_MODALIDAD"},

                {"data": "CODIGO_LOCAL"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "SEDE"},

                {"data": "NUM_RECURSO"},
                {"data": "CODIGO_RECURSO"},
                {"data": "NOM_RECURSO"},
                {"data": "TIPO_RECURSO"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_TIPO_RECURSO"},

                {"data": "TIPO_LICENCIA"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "NOM_TIPO_LICENCIA"},

                {"data": "CANT_ANIOS_LICENCIA"},
                {"data": "RECURSOS_DESCRIP"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "CANT_PROGRAMAS"},
                {"data": "RECURSOS_COMENT"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                {"data": "ANALISIS_PERTINENCIA"  , "className": "never", "autoWidth": true, "orderable": false, "visible": false},



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

        $("#cbx_basicos_id_status").select2({
            width: 'resolve',
        });

    });

    function fn_limpiarPopup(){
        var objGeneral = fnDataGeneral();

        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val('0');
        $(objGeneral.modal_principal+" "+'#codigo_local').val('0');
        $(objGeneral.modal_principal+" "+'#num_recurso').val('');
        $(objGeneral.modal_principal+" "+'#codigo_recurso').val('');
        $(objGeneral.modal_principal+" "+'#nom_recurso').val('');
        $(objGeneral.modal_principal+" "+'#tipo_recurso').val('0');
        $(objGeneral.modal_principal+" "+'#tipo_licencia').val('0');
        $(objGeneral.modal_principal+" "+'#cant_anios_licencia').val('');
        $(objGeneral.modal_principal+" "+'#recurso_descrip').val('');
        $(objGeneral.modal_principal+" "+'#cant_programas').val('');
        $(objGeneral.modal_principal+" "+'#analisis_pertinencia').val('');
        $(objGeneral.modal_principal+" "+'#recurso_coment').val('');




        $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(0);
        $(objGeneral.modal_principal+" "+"#cbx_basicos_id_status").trigger("change");

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
                $(objGeneral.modal_principal+" "+"#titulo_modal_lg").text('Actualizar '+objGeneral._nombre +' ' +data['NOM_RECURSO']);
                /*id para actualizar */
                $(objGeneral.modal_principal+" "+'#id_'+objGeneral._abrev).val(id_row);               
                //---

                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val(data['MODALIDAD']);
                $(objGeneral.modal_principal+" "+'#codigo_local').val(data['CODIGO_LOCAL']);
                $(objGeneral.modal_principal+" "+'#num_recurso').val(data['NUM_RECURSO']);
                $(objGeneral.modal_principal+" "+'#codigo_recurso').val(data['CODIGO_RECURSO']);
                $(objGeneral.modal_principal+" "+'#nom_recurso').val(data['NOM_RECURSO']);
                $(objGeneral.modal_principal+" "+'#tipo_recurso').val(data['TIPO_RECURSO']);
                $(objGeneral.modal_principal+" "+'#tipo_licencia').val(data['TIPO_LICENCIA']);
                $(objGeneral.modal_principal+" "+'#cant_anios_licencia').val(data['CANT_ANIOS_LICENCIA']);
                $(objGeneral.modal_principal+" "+'#recurso_descrip').val(data['RECURSOS_DESCRIP']);
                $(objGeneral.modal_principal+" "+'#cant_programas').val(data['CANT_PROGRAMAS']);
                $(objGeneral.modal_principal+" "+'#analisis_pertinencia').val(data['ANALISIS_PERTINENCIA']);
                $(objGeneral.modal_principal+" "+'#recurso_coment').val(data['RECURSOS_COMENT']);



                $(objGeneral.modal_principal+" "+'#cbx_basicos_id_status').val(data['ESTADO']);
                $(objGeneral.modal_principal+" "+"#cbx_basicos_id_status").trigger("change");


        }else{            
       
        }
        $(objGeneral.modal_principal).modal({show:true});
    }
    
    function Valida_<?php echo $opcion; ?>() {
        var objGeneral = fnDataGeneral();

        if($(objGeneral.modal_principal+" "+'#cbx_basicos_id_curso_forma_estudio').val().trim() === '0') {
            msgDate = 'Debe ingresar un modalidad';
            inputFocus = '#cbx_basicos_id_curso_forma_estudio';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#codigo_local').val().trim() === '0') {
            msgDate = 'Debe seleccionar el codigo local';
            inputFocus = '#codigo_local';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#num_recurso').val().trim() === '') {
            msgDate = 'Debe ingresar un número de recurso';
            inputFocus = '#num_recurso';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#codigo_recurso').val().trim() === '') {
            msgDate = 'Debe ingresar un codigo de recurso';
            inputFocus = '#codigo_recurso';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#nom_recurso').val().trim() === '') {
            msgDate = 'Debe ingresar un nombre de recurso';
            inputFocus = '#nom_recurso';
            return false;
        }

        if($(objGeneral.modal_principal+" "+'#tipo_recurso').val().trim() === '0') {
            msgDate = 'Debe seleccionar el tipo de recurso';
            inputFocus = '#tipo_recurso';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#tipo_licencia').val().trim() === '0') {
            msgDate = 'Debe seleccionar el tipo de licencia';
            inputFocus = '#tipo_licencia';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#cant_anios_licencia').val().trim() === '') {
            msgDate = 'Debe ingresar un cantidad de años de licencia';
            inputFocus = '#cant_anios_licencia';
            return false;
        }


        if($(objGeneral.modal_principal+" "+'#recurso_descrip').val().trim() === '') {
            msgDate = 'Debe ingresar la descripción del recurso';
            inputFocus = '#recurso_descrip';
            return false;
        }


        
        if($(objGeneral.modal_principal+" "+'#cant_programas').val().trim() === '') {
            msgDate = 'Debe ingresar la cantidad de programas del recurso';
            inputFocus = '#cant_programas';
            return false;
        }

          

        if($(objGeneral.modal_principal+" "+'#recurso_coment').val().trim() === '') {
            msgDate = 'Debe ingresar comentario sobre el recurso';
            inputFocus = '#recurso_coment';
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