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
                                            Nuevo Usuario
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
                                <table id="tbl<?php echo $abrev; ?>" class="table table-striped table-bordered  table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info">
                                    <thead>
                                        <tr>
                                            <td align="center" ><b>Nombre</b></td>
                                            <td align="center" ><b>Nivel</b></td>
                                            <td align="center" ><b>Estado</b></td>
                                            <td align="center"><b> Nivel id </b></td>
                                            <td align="center"><b>Estado id</b></td>
                                            <td align="center"><b>Paterno</b></td>
                                            <td align="center"><b>Materno</b></td>
                                            <td align="center"><b>Usuario</b></td>
                                            <td align="center"><b>Password</b></td>
                                            <td align="center"><b>Mail</b></td>
                                            <td align="center"><b>Celular</b></td>

                                            <td align="center"><b>ID_PLAN_ESTUDIOS</b></td>
                                            <td align="center"><b>CICLO_NUM</b></td>

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
            <div id="modal_asignar_plan_estudio_usu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h4 class="modal-title" >ASIGNAR PLANES DE ESTUDIOS</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                    <div class="col-md-12 row">
                                           
                                            <input name="id_usuario" type="hidden" id="id_usuario" value="">        
        
                                            <div class="form-group col-md-12">
                                                <label>PLANES DE ESTUDIOS :</label>
                                            </div>
                                            <div class="form-group col-md-9">


                                                <select class="form-control" id="cbx_basicos_id_plan_estudios" name="cbx_basicos_id_plan_estudios" >
                                                    <option value="0">Seleccionar</option>
                                                </select>

                                            </div>

                                            <div class="form-group col-md-3">
                                                    <button type="button" onclick="AddAsignarPlanEstudios()"  class="btn waves-effect waves-light btn-outline-info">
                                                            Agregar plan de estudios
                                                    </button>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>Lista de Planes agregados al usuario</label>
                                            </div>


                                            <div class="form-group col-md-12">

                                            <div class="row col-12 h-100 m-0 p-3 table-responsive" >
                                                <table id="Lista_plan_estudios_usu_tbl"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">NOMBRE PLAN ESTUDIOS</th>
                                                            <th class="text-center">ACCIÓN</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="lista_asignacion_plan_estudos_usu">
                                                    </tbody>
                                                </table>
                                            </div>

                                            </div>

                                    </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->








            
            <!-- Full width modal content -->
            <div id="modal_asignar_curso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary">
                            <h4 class="modal-title" >ASIGNAR CURSOS</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                                    <div class="col-md-12 row">
                                           
                                            <input name="id_asignacion_plan_estudios" type="hidden" id="id_asignacion_plan_estudios" value="">    
                                            <input name="id_plan_estudios" type="hidden" id="id_plan_estudios" value="">    

                                            
                                            <div class="form-group col-md-12">
                                                <label>Ciclo:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <select class="form-control" id="nom_ciclo" name="nom_ciclo" onchange="Ciclo(this)">
                                                    <option value="0">Seleccionar</option>
                                                </select>
                                            </div>

                                             
                                            <div class="form-group col-md-12">
                                                <label>Curso ciclo:</label>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <select class="form-control" id="id_curso" name="id_curso">
                                                    <option value="0">Seleccionar</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3">

                                                    <button type="button" onclick="AddAsignarCurso()"  class="btn waves-effect waves-light btn-outline-info">
                                                            Agregar Curso
                                                    </button>

                                            </div>

                                             
                                            <br>
                                        <br>

                                            <div class="form-group col-md-12">
                                                <label>Lista de Cursos agregados al usuario</label>
                                            </div>


                                            <div class="form-group col-md-12">

                                            <div class="row col-12 h-100 m-0 p-3 table-responsive" >
                                                <table id="Lista_cursos_usu_tbl"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">NOMBRE DE CURSO</th>
                                                         
                                                            <th class="text-center">ACCIÓN</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="lista_asignacion_curso_usu">
                                                    </tbody>
                                                </table>
                                            </div>

                                            </div>

                                    </div>
                        </div>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->





            <?php modal_largo( $abrev ,false, __DIR__ ,'Insert_Update_'.$opcion,$formPrincipal); ?> 




            