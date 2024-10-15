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

    .rueda_verperfil{
        background-color:  #ffffff ;
        border-radius:20px;
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
                        <div class="customize-input float-left">
                            <div class="form-group">               
                            
                            </div>
                        </div>
                        <div class="customize-input float-right">
                        
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
                         
                            <div class='row col-12 h-100 m-0 p-3 table-responsive ' id="limpiar_tabla">
                                <table id="tbl<?php echo $abrev; ?>"  class="table table-striped table-bordered table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info">
                                    <thead>
                                    <tr>
                                            <th class="text-center"> <b>ID_SILABUS </b></th>
                                            <th class="text-center"> <b>ID_FACULTAD </b></th>

                                            <th class="text-center"> <b>NOMBRE SILABUS </b></th>
                                            <th class="text-center"> <b>NOMBRE CURSO </b></th>

                                            <th class="text-center"> <b>NOMBRE CICLO </b></th>

                                            <th class="text-center"> <b>PERIODO</b></th>

                                            <th class="text-center"> <b>PERIODO ANIO</b></th>
                                            <th class="text-center"> <b>PERIODO_CICLO</b></th>

                                            <th class="text-center"> <b>ID_DEPART_UNIVER </b></th>
                                            <th class="text-center"> <b>ID_CARRERA </b></th>
                                            <th class="text-center"> <b>ID_CONDICION </b></th>

                                            <th class="text-center"> <b>CREDITOS </b></th>
                                            <th class="text-center"> <b>HORAS TEORICAS </b></th>
                                            <th class="text-center"> <b>HORAS PRACTICAS </b></th>

                                            <th class="text-center"> <b>ID_DIRECTOR </b></th>
                                            <th class="text-center"> <b>ID_DOCENTE </b></th>
                                            <th class="text-center"> <b>ID_CURSO </b></th>
                                            <th class="text-center"> <b>ID_PLAN_ESTUDIOS </b></th>
                                          
                                            <th class="text-center"> <b>REQUISITO </b></th>
                                          
                                            <th class="text-center"> <b>ESTADO </b></th>
                                          
                                            <th class="text-center"> <b>DURACIÓN DEL PROCESO DE CREACIÓN</b></th>
                                          
                                            <th class="text-center"> <b>USER_REG </b></th>
                                            <th class="text-center"> <b>FEC_ACT </b></th>
                                            <th class="text-center"> <b>USER_ACT </b></th>
                                          
                                            <th class="text-center"> <b>ESTADO SILABUS </b></th>

                                            <th class="text-center"> <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACCIONES</b></th>

                                            <th class="text-center"> <b>VERSION_PRINCIPAL </b></th>
                                            <th class="text-center"> <b>FECHA_REG </b></th>


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



