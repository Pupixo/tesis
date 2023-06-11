<script>
  
    var url_general = "<?php echo base_url().'index.php?'; ?>";
    var ciclo = <?php echo   $_SESSION['usuario'][0]['ciclo_num'] ; ?>;
    var id_plan_estudios = <?php echo   $_SESSION['usuario'][0]['id_plan_estudios'] ; ?>;

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


    
    function cargarTablaAsyllabus(param,paramdos){
        console.log("🚀 ~ file: tussyllabus.js.php:28 ~ cargarTablaAsyllabus ~ paramdos:", paramdos)
        console.log("🚀 ~ file: tussyllabus.js.php:28 ~ cargarTablaAsyllabus ~ param:", param)
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
            "ajax": { url : objGeneral.__wurl + "cargar_tabla_tussyllabus/"+param+"/"+paramdos,  type : 'POST' },
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
                {"data": "REQUISITO" },
                {"data": "ESTADO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "FECHA_REG" },
                {"data": "USER_REG", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "FEC_ACT", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "USER_ACT", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                {"data": "ESTADO_SILABUS_HTML" , "className": "never", "autoWidth": true, "orderable": false, "visible": true},
                {"data": "ACCION" },
                {"data": "NOM_CICLO", "className": "never", "autoWidth": true, "orderable": false, "visible": false },
            ]          
        });
        return false;
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

    
    $(document).ready(function() {
        cargarTablaAsyllabus(ciclo,id_plan_estudios);
        var msgDate = '';
        var inputFocus = '';        
    });

    

    
</script> 