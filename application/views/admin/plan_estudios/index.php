<?php 
$sesion =  $_SESSION['usuario'][0];
defined('BASEPATH') OR exit('No direct script access allowed');
//$rol = $_SESSION['usuario'][0]['ROLASISTENCIA'];
?>
<style>
    <?php echo '#tbl'.$abrev; ?> .rueda_focus:focus {
    background-color:  #f3f1f1 ;
    border-radius:20px;
    }


  
    .rueda_pdf{
        background-color:  #f3f1f1 ;
        border-radius:20px;
    }
    .rueda_pdf:focus{
        background-color:  #c38490 ;
        border-radius:20px;
    }

    .select_cursord{
        cursor:not-allowed;
        height: 35px!important;
    }

    .cursord{
        cursor:not-allowed;
    }


    .table-dark {
    color: #141313!important;
    }

   
</style>

<style>



        .spinner_seccion {
        border: 4px solid rgba(0, 0, 0, 0.1);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border-left-color: #09f;

        animation: spin 1s ease infinite;
        }

        @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
        }


</style>

            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $tituloSecundario1; ?>  

                        </h4>
                    </div>
                    <div class="col-1 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1" >
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#info-excel">
                                <i data-toggle="tooltip" data-placement="top" title="Información especifica sobre la importación excel de los planes de estudio" class="fas fa-info-circle"></i> 
                            </button>
                        </h4>
                    </div>


                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                        
                            <?php  if($_SESSION['usuario'][0]['id_nivel'] != 4){ ?>
                                <button type="button"  class="btn btn-primary btn-icon-text btn-rounded" onclick="fn_AbrirModal('I','','','Insert_Update_<?php echo $opcion; ?>')" >     
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                                Nuevo Plan de estudios
                                </button>
                            <?php } ?>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="customize-input">
                        
                                <form method="post" enctype="multipart/form-data" class="mt-4">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file"    onchange="checkfile(this);" class="custom-file-input" id="import_file_excel">
                                            <label class="custom-file-label" id="import_file_excel_title" for="import_file_excel">Escoger archivo Excel</label>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>

                    <div class="col-5">
                       
                    </div>

                    <div class="col-2">
                        <div class="customize-input">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" onclick="fn_ImportarExcel(this)" id="import_form" type="button">Subir</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-5">
                       
                    </div>

                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">                 
                    
                    <div class="col-12">
                        <div class="card" id="cargando_">
                         
                            <div class='row col-12 h-100 m-0 p-3 table-responsive '>
                                <table id="tbl<?php echo $abrev; ?>" class="table table-striped table-bordered table-hover table-primary" style="width:100%" role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                           
                                            <td align="center" ><b>ID_PLAN_ESTUDIOS</b></td>
                                            <td align="center" ><b>NOMBRE DE PLAN ESTUDIOS</b></td>
                                            <td align="center" ><b>AÑO</b></td>

                                            <td align="center" ><b>FACULTAD</b></td>
                                            <td align="center"><b>CARRERA</b></td>
                                            <td align="center"><b>CÓDIGO</b></td>
                                            <!-- <td align="center"><b>CURSO</b></td> -->
                                            <td align="center"><b>MODALIDAD</b></td>
                                            <td align="center"><b>GRADO OTORGADO</b></td>
                                            <td align="center"><b>TITULO PROFESIONAL</b></td>
                                            <td align="center"><b>ESTADO</b></td>
                                            <td align="center"><b>ESTADO_ID</b></td>
                                            <td align="center"><b>NOM_CARRERA</b></td>
                                            <td align="center"><b>TIPO_ESTUDIOS</b></td>
                                            <td align="center"><b>Acciones</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>

                         

            
            <!-- Full width modal content -->
            <div id="cursos_electivos_modal" class="modal fade"  data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-scrollable modal-full-width">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h4 class="modal-title" id="fullWidthModalLabel_titulo"> Cursos Electivos</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                <form id="formulario_plan_estudios_electivos" method="POST" enctype="multipart/form-data"><input name="id_plan_estudios" type="hidden" id="id_plan_estudios" value="">
                                    <div class="col-md-12 row">
                                            <input name="id_plan_estudios" type="hidden" id="id_plan_estudios" value="">
                                            <input name="id_carrera" type="hidden" id="id_carrera" value="">





                                            <div class="form-group col-md-12">
                                                <label>NOMBRE PLAN DE ESTUDIOS: <b id="nombre_plan_estudios_text"></b> </label>
                                            </div>           
                                            <div class="form-group col-md-12">
                                                <label>CÓDIGO PLAN DE ESTUDIOS: <b id="codigo_plan_estudios_text"></b> </label>
                                            </div>        
                                            <div class="form-group col-md-12">
                                                <label>MODALIDAD: <b id="modalidad_text" ></b> </label>
                                            </div>            
                                            <div class="form-group col-md-12">
                                                <label>GRADO QUE OTORGA: <b id="grado_otorga_text" ></b> </label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>TÍTULO PROFESIONAL:  <b id="titulo_prof_text" ></b></label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>CARRERA: <b id="carrera_text"></b> </label>
                                            </div>
                   



                                            <div class="form-group col-md-12 text-center">
                                                    <label><button type="button" id="boton_agregar_electivo" onClick="Cantidad_Electivos_Agregar(this)"  class="btn waves-effect waves-light btn-outline-info">AGREGAR CICLO ELECTIVO</button></label>
                                            </div>   
                                            
                                            <div class="form-group col-md-12">
                                                <label>Filtros de cursos en los ciclos 
                                                <button type="button" class="btn btn-secondary" data-container="body" title="" data-toggle="popover" data-placement="top" data-content="Este combobox no tiene otra función mas que ayudar a filtrar la aparición de los cursos en los selects de curso que estan en las filas de los ciclos, no se tendra registro de los datos al guardar" data-original-title="OJO" aria-describedby="popover60662">
                                                    <i class="fas fa-eye"></i>
                                                </button>:
                                     <input onclick="Selec_Todo_Ciclo_electivo(this);"  id="chkall_ciclo_electivo" type="checkbox" >Selecionar todas las carreras del filtro</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <?= cbx_basicos_multiple('id_carrera_electivo',0,false,'lista_carrera_filtro',null,'id_carrera','nom_carrera'); ?>
                                            </div>

                                            <div class="form-group col-md-12" id="curso_electivo_capa">

                                            </div>

                                            <hr>
                                        

                                    </div>
                                </form>
                        </div>


                        <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-primary" onclick="GuardarElectivo();" >Guardar Cambios</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



            <?php modal_xl_largo_full( $abrev ,false, __DIR__ ,'Insert_Update_'.$opcion,$formPrincipal,'modal_data',true); ?> 


            <?php modal_xl_largo_full( $abrev.'_articulacion' ,false, __DIR__ ,'Insert_Update_'.$opcion,$formPrincipal.'_articulacion','articulacion_modal',false); ?> 


            <!-- Long Content Scroll Modal -->
            <div class="modal fade" id="info-excel" role="dialog"  data-backdrop="static" data-keyboard="false"
                aria-labelledby="scrollableModalTitle" aria-hidden="true">
                <div class="modal-dialog  modal-full-width modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="scrollableModalTitle">Información sobre la subida del excel</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>TRATE DE ESCRIBIR TAL CUAL LOS DATOS EN EL ESTOS CAMPOS ESPECIFICOS DEL EXCEL.</p>
                            <hr>

                            <form action="#" class="pl-3 pr-3">

                                <div class="form-group">
                                    <label for="emailaddress1">TIPOS DE ESTUDIOS</label>
                                    <input class="form-control" type="text"
                                    disabled value="CPE">
                                    <br>
                                    <input class="form-control" type="text"
                                    disabled value="PRE-GRADO">
                                    <br>
                                    <input class="form-control" type="text"
                                    disabled value="POST-GRADO">
                                </div>

                                <div class="form-group">
                                    <label for="emailaddress1">MODALIDAD</label>
                                    <input class="form-control" type="text"
                                    disabled value="PRESENCIAL">
                                    <br>
                                    <input class="form-control" type="text"
                                    disabled value="A DISTANCIA">
                                    <br>
                                    <input class="form-control" type="text"
                                    disabled value="SEMI-PRESENCIAL">
                                </div>


                                <div class="form-group">
                                    <label for="emailaddress1">CARRERAS</label>

                                    <div class="form-group col-md-12">
                                        <?= cbx_basicos('id_carrera_info','0',false,'lista_carreras',null,'id_carrera','nom_carrera'); ?>
                                    </div>
                                </div>

                            </form>
                                <p>RECOMENDACIONES:</p>
                            <hr>

                            <div class="text-center mt-2 mb-4">
                                <img class="img-fluid" src="<?= base_url() ?>assets/images/plan_estudios/excel-data.PNG" alt="" height="18">
                                <p>Escriba los nombres tal cual lo especifica para evitar errores</p>

                            </div>
                            <div class="text-center mt-2 mb-4">
                                <img class="img-fluid" src="<?= base_url() ?>assets/images/plan_estudios/horas_cred_auto.PNG" alt="" height="18">
                            </div>
                            
                            <div class="text-center mt-2 mb-4">
                                <img class="img-fluid" src="<?= base_url() ?>assets/images/plan_estudios/req-data.PNG" alt="" height="18">
                                <p>Los requisitos son en si cursos de ciclos anteriores.Escriba los nombres de los requisitos tal como lo escribieron en los cursos de los ciclos anteriores</p>
                            </div>
                            <div class="text-center mt-2 mb-4">
                                <img class="img-fluid" src="<?= base_url() ?>assets/images/plan_estudios/elect.PNG" alt="" height="18">
                            </div>

                            <div class="text-center mt-2 mb-4">
                                <a class="btn waves-effect waves-light btn-success" href="<?= base_url() ?>assets/images/plan_estudios/formato_plan_estudios.xlsx"
                                download="modelo-plan-estudios.xlsx" role="button">Descargar Excel</a>
                            
                            </div>

                           

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

                                
