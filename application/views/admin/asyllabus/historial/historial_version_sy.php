<?php
$sesion =  $_SESSION['usuario'][0];
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->library('fechaespanol');

//$rol = $_SESSION['usuario'][0]['ROLASISTENCIA'];
?>

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




            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Gestor de cambios</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <!-- <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li> -->
                                    <!-- <li class="breadcrumb-item text-muted active" aria-current="page"><a href="<?= site_url($this->url.$this->opcion) ?>"  ><b>atras</b> </a> </li> -->
                                    <li class="breadcrumb-item"><a href="<?= site_url($this->url.$this->opcion.'/Asyllabus_resumen/'.$id_syllabus) ?>"  ><b>atrás</b> </a> </li>

                                </ol>
                            </nav>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datos de Versión</h4>

                                <h6>Versión Creada por :<?php echo $version_sy[0]['nombre_reg'];  ?> </h6>
                                <h6>Fecha de creación de versión :  <?php echo $CI->fechaespanol->datetimeFriendly(strtotime($version_sy[0]['fecha_reg_version'])); ?> </h6>


                                <h6>Estado: <?php echo $version_sy[0]['nom_est_syllabus'];  ?> </h6>


                                <?php
                                            // echo '<pre>';
                                            // print_r($version_sy[0]['id_version_sy'] );
                                            // echo '</pre>';
                                            // exit();
                                ?>


                          

                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title mb-3"></h4>

                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#syllabus_data" data-toggle="tab" aria-expanded="true"
                                            class="nav-link rounded-0 active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Syllabus</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#ficha_eval_vista" data-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0 ">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Ficha de Evaluación</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="#settings1" data-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0">
                                            <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Settings</span>
                                        </a>
                                    </li> -->
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane show active" id="syllabus_data">

                                                        <!-- 1 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios DATOS GENERALES</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_dg"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- 2-->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios COMPETENCIAS ASOCIADAS AL CURSO</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_cac"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- 3-->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios SUMILLA </h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_s"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--4 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios RESULTADO GENERAL DE APRENDIZAJE</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_rga"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--5 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios ORGANIZACIÓN DEL APRENDIZAJE</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_oa"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--6 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios ESTRATEGIAS DIDÁCTICAS</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_ed"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--7 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios FORMA Y HERRAMIENTAS DE EVALUACIÓN</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_fhe"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- 8-->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios ACTIVIDADES PRINCIPALES</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_ap"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- 9-->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios PLATAFORMAS Y HERRAMIENTAS</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_ph"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- 10 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios REFERENCIAS BIBLIOGRÁFICAS</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_rb"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                    </div>

                                    <div class="tab-pane" id="ficha_eval_vista">


                                                        <!-- 1 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 1</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval1"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- 2 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 2</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval2"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                         <!-- 3 -->
                                                         <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 3</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval3"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                           <!-- 4 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 4</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval4"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                                <!-- 5 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 5</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval5"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                                <!-- 6 -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Historial de cambios Eval 6</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="tbl_eval6"  class="table table-striped table-bordered  table-hover table-primary" style="width:100%" >
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ACCIÓN</th>
                                                                                        <th>USUARIO</th>
                                                                                        <th>FECHA</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                    </div>

                                    <!-- <div class="tab-pane" id="settings1">
                                        <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean
                                            commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et
                                            magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                                            ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                                            quis enim.</p>
                                        <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                                            dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                            elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                            porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                    </div> -->

                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row-->             


                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>

                                <!-- Full width modal content -->
                                <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-full-width">
                                        <div class="modal-content">
                                            <div class="modal-header modal-colored-header bg-primary">
                                                <h4 class="modal-title" id="fullWidthModalLabel_titulo"> </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Text in a modal</h6>
                                                <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                                                <hr>
                                                <h6>Overflowing text to show scroll behavior</h6>
                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio,
                                                    dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta
                                                    ac consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                                                    Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                                    auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo
                                                    cursus magna, vel scelerisque nisl consectetur et. Donec sed odio
                                                    dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                <script>

                    var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";
                    var id_version_sy="<?php echo $version_sy[0]['id_version_sy'] ?>";

                    $(document).ready(function() {

                        $('#tbl_eval1').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+1,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });

                        $('#tbl_eval2').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+2,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });


                        $('#tbl_eval3').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+3,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });


                        $('#tbl_eval4').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+4,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });


                        $('#tbl_eval5').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+5,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });

                        $('#tbl_eval6').DataTable({
                                "lengthMenu": [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial_ficha/"+id_version_sy+"/"+11+"/"+6,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });


                        $('#tbl_dg').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+1,  type : 'POST' },
                                "responsive": true,
                                columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                    

                                                        return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                             
                                            ],
                        });

                        $('#tbl_cac').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+2,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: null,
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_s').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+3,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_rga').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+4,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_oa').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+5,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_ed').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+6,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_fhe').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+7,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_ap').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                                "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+8,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_ph').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                              "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+9,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                        $('#tbl_rb').DataTable({
                                //lengthMenu: [[10, 25, 50, -1], ['10', '25', '50', 'Show all']],
                                "language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"},
                                "pageLength": 10,
                                "processing": false,
                                "serverSide": false,
                               "ajax": { url : wurl + "cargar_tabla_historial/"+id_version_sy+"/"+10,  type : 'POST' },
                                "responsive": true,
                                // "columns": [
                                //     {"data": "ID_CARRERA" , "className": "never", "autoWidth": true, "orderable": false, "visible": false},
                                //     {"data": "NOM_CARRERA"},
                                //     {"data": "ID_FACULTAD" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "ID_DIRECTOR" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "NOM_DIRECTOR" },
                                //     {"data": "NOM_ESTATUS" },
                                //     {"data": "ESTADO" , "className": "never", "autoWidth": true, "orderable": false, "visible": false },
                                //     {"data": "FEG_REG" },
                                //     {"data": "ACCION" }
                                    columns:    [   {
                                                    data: 'ACCION'
                                                }, 
                                                {
                                                    data: 'USUARIO'
                                                },
                                                {
                                                    data: 'FECHA'
                                                }, 
                                                {
                                                    data: 'ID_HISTORIAL',
                                                    render: function (data, type, row, meta) {
                                                          return  `<a onclick="Ver_datos_historial(${row.ID_HISTORIAL},'${row.ACCION}')" class="btn btn-sm btn-info">
                                                                        <i class="icon-eye"></i> 
                                                                </a>`;
                                                    }, "className": "never", "autoWidth": true, "orderable": false, "visible": false
                                                }
                                            ],
                        });

                    });


                    function Ver_datos_historial(id_historial,accion){
                                console.log("🚀 ~ file: historial_version_sy.php:807 ~ Ver_datos_historial ~ accion:", accion)
                                console.log("🚀 ~ file: historial_version_sy.php:810 ~ Ver_datos_historial ~ id_historial:", id_historial)

                                // var id_historial =id_historial;

                                $('#fullWidthModalLabel_titulo').html('Datos de '+accion);

                                $('#full-width-modal').modal('show');        

                                //                                 $('#myModal').modal('show');
                                // $('#myModal').modal('hide');

                                // $.ajax({
                                // type  : "POST",
                                // url   : wurl+'Data_historial',
                                // data  : {
                                //             'id_historial':id_historial
                                //         }, 
                                // })
                                // .done(function(data) {
                                 
                                // })
                                // .fail(function(jqXHR, textStatus, errorThrown) {
                                //     someErrorFunction();
                                // })
                                // .always(function() {});

                    }



                </script>

