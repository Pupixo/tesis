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
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $tituloSecundario1; ?>  

                        </h4>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <button type="button"  class="btn btn-primary btn-icon-text btn-rounded" onclick="fn_AbrirModal('I','','','Insert_Update_<?php echo $opcion; ?>')" >     
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i> Nuevo Curso </button>
                        </div>
                    </div>

                    <div class="col-6 align-self-center">
                        <div class="customize-input float-right">
                            <button type="button"  class="btn btn-info btn-icon-text btn-rounded" onclick="Competencia_data('')" >     
                                    <i class="fa far fa-book"></i>                                
                            </button>
                        </div>
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
                                            <td align="center" ><b>ID_CURSOS</b></td>
                                            <td align="center" ><b>NOMBRE DE CURSO</b></td>
                                            <td align="center" ><b>ID_FACULTAD</b></td>
                                            <td align="center"><b>ID_CARRERA</b></td>
                                            <td align="center"><b>CARRERA</b></td>
                                            <td align="center"><b>ID_PLAN_ESTUDIO</b></td>
                                            <td align="center"><b>CÓDIGO</b></td>
                                            <td align="center"><b>CREDITOS</b></td>
                                            <td align="center"><b>HORAS TEORICAS</b></td>
                                            <td align="center"><b>HORAS TOTALES</b></td>
                                            <td align="center"><b>HORAS PRACTICAS</b></td>
                                            <td align="center"><b>REQUISITOS</b></td>
                                            <td align="center"><b>TIPO_DE_CURSO_ID</b></td>
                                            <td align="center"><b>TIPO_DE_CURSO </b></td>
                                            <td align="center"><b>PRESENCIALIDAD_ID</b></td>
                                            <td align="center"><b>PRESENCIALIDAD </b></td>
                                            <td align="center"><b>OBLIGATORIEDAD_ID </b></td>
                                            <td align="center"><b>OBLIGATORIEDAD</b></td>
                                            <td align="center"><b>ESTADO</b></td>
                                            <td align="center"><b>ESTADO_ID</b></td>

                                            <td align="center"><b>HORAS_SINCRO_TEOR</b></td>
                                            <td align="center"><b>HORAS_ASINCRO_TEOR</b></td>
                                            <td align="center"><b>HORAS_PRESEN_TEOR</b></td>

                                            <td align="center"><b>HORAS_SINCRO_PRAC</b></td>
                                            <td align="center"><b>HORAS_ASINCRO_PRAC</b></td>
                                            <td align="center"><b>HORAS_PRESEN_PRAC</b></td>

                                            <td align="center"><b>CREDITOS_PRESENCIAL</b></td>
                                            <td align="center"><b>CREDITOS_VIRTUAL</b></td>

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
            <div id="modal_dicionario_curso" class="modal fade" data-backdrop="static" role="dialog"
            
            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h4 class="modal-title" id="fullWidthModalLabel_titulo">COMPETENCIAS ESPECIFICAS</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                <form id="formulario_dicionario_curso" method="POST" enctype="multipart/form-data">
                                    <div class="col-md-12 row">
                                            <input name="id_curso" type="hidden" id="id_curso" value="">
                                            <div class="form-group col-md-12 text-center">
                                                <label>
                                                    <button type="button" id="botonagregar"
                                                    class="btn waves-effect waves-light btn-outline-info">
                                                        AGREGAR
                                                    </button>
                                                </label>
                                            </div>       
                                            <hr style="width: 90%;">
                                        
                                            <div class="form-group col-md-12">
                                          
                                                <div class="table-responsive">
                                                  
                                                    <table id="tbl_tabla" class="table table-hover table-success">
                                                        <thead    class="bg-success text-white">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col" id="titulo_compet">COMPETENCIAS ESPECÍFICAS</th>
                                                                <th scope="col">NIVEL 1</th>
                                                                <th scope="col">NIVEL 2</th>
                                                                <th scope="col">NIVEL 3</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>   
                                        
                                    </div>
                                </form>
                        </div>

                        <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->



            <!-- Full width modal content -->
            <div id="modal_dicionario_sumilla" class="modal fade"  data-backdrop="static" data-keyboard="false" 
             role="dialog" 
            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h4 class="modal-title" id="fullWidthModalLabel_titulo_sumilla">SUMILLA DEL CURSO</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                <form id="formulario_dicionario_sumilla" method="POST" enctype="multipart/form-data">
                                    <div class="col-md-12 row">
                                        <input name="id_curso_sumilla" type="hidden" id="id_curso_sumilla" value="">    
                                        <input name="id_sumilla_curso" type="hidden" id="id_sumilla_curso" value="">        
    
                                            <div class="form-group col-md-12">
                                              <textarea class="form-group col-md-12" name="" id="descrip_sumilla_curso" cols="30" rows="10"></textarea>
                                            </div>   
                                    </div>
                                </form>
                        </div>


                        <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                                <button type="button" id="botonagregar_sumilla" class="btn waves-effect waves-light btn-outline-info">
                                        Guardar
                                </button>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


           

            <?php modal_largo( $abrev ,false, __DIR__ ,'Insert_Update_'.$opcion,$formPrincipal); ?> 
