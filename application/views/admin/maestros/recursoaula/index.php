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
                            <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            Nuevo <?php echo $tituloPrincipal; ?>
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
                                            <td align="center" ><b>ID_RECURSOS_AULA</b></td>
                                            <td align="center" ><b>ID_MODALIDAD</b></td>

                                            <td align="center" ><b>MODALIDAD</b></td>
                                            <td align="center" ><b>CODIGO_LOCAL</b></td>
                                            <td align="center" ><b>SEDE</b></td>

                                            <td align="center" ><b>NUM_RECURSO</b></td>
                                            <td align="center" ><b>CODIGO_RECURSO</b></td>
                                            <td align="center" ><b>NOM_RECURSO</b></td>
                                            <td align="center" ><b>TIPO_RECURSO</b></td>
                                            <td align="center" ><b>NOM_TIPO_RECURSO</b></td>

                                            <td align="center" ><b>TIPO_LICENCIA</b></td>
                                            <td align="center" ><b>NOM_TIPO_LICENCIA</b></td>

                                            <td align="center" ><b>CANT_ANIOS_LICENCIA</b></td>
                                            <td align="center" ><b>RECURSOS_DESCRIP</b></td>
                                            <td align="center" ><b>CANT_PROGRAMAS</b></td>
                                            <td align="center" ><b>RECURSOS_COMENT</b></td>
                                            <td align="center" ><b>ANALISIS_PERTINENCIA</b></td>

                                            <td align="center"><b>ESTADO</b></td>
                                            <td align="center"><b>ID_ESTADO</b></td>
                                            <td align="center"><b>FEG_REG</b></td>
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


            <?php modal_largo( $abrev ,false, __DIR__ ,'Insert_Update_'.$opcion,$formPrincipal); ?> 








