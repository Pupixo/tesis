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
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Syllabus Porcentajes de Avance</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="<?= site_url($this->url.$this->opcion) ?>"  ><b>atras</b> </a> </li>
                                    

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
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">DATOS DEL SYLLABUS</h4>
                                <form action="#">
                                    <div class="form-body">

                                        <div class="user-info-list">

                                            <div class="">
                                                <ul class="contacts-block list-unstyled">

                                                
                                                    <li class="contacts-block__item mt-3">
                                                        <b>Nombre Sílabus:</b> <br>  <?= $data_silabus[0]['nom_curso'];  ?>
                                                    </li>
                                                    <li class="contacts-block__item mt-3">
                                                        <b>Fecha de creación:</b>   <br> 
                                                        <?php  echo $CI->fechaespanol->datetimeFriendly(strtotime($data_silabus[0]['fecha_reg_version'])); ?> 
                                                    </li>
                                                    <li class="contacts-block__item mt-3">
                                                        <b>Fecha de Aprobación(finalización):</b>   <br> 

                                                        <?php  echo ($data_silabus[0]['fech_aprob'] == '' ? '' : $CI->fechaespanol->datetimeFriendly(strtotime($data_silabus[0]['fech_aprob'])) );  ?> 

                                                    </li>
                                                    <li class="contacts-block__item mt-3"> 
                                                        <b>Periodo:</b>  <br>  <?=  $data_silabus[0]['periodo_anio']. ' ' .  $data_silabus[0]['periodo_ciclo']    ?> 
                                                    </li>
                                                
                                                    <li class="contacts-block__item mt-3"> 
                                                       <b>Carrera:</b>  <br>  <?=  $data_silabus[0]['nom_carrera']    ?>
                                                    </li>        
                                                    <li class="contacts-block__item mt-3"> 
                                                        <b>Curso:</b>  <br>  <?=    $data_silabus[0]['nom_curso']    ?> 
                                                    </li>
                                                    <li class="contacts-block__item mt-3">
                                                       <b>Plan de Estudios:</b>  <br>  <?=  $data_silabus[0]['nom_plan_estudios']    ?>
                                                    </li>
                                                    <li class="contacts-block__item mt-3">
                                                       <b>Tipo de Estudio: </b>  <br>  <?=  $data_silabus[0]['nom_tipo_estudios']    ?>
                                                    </li>
                                                   
                                                </ul>
                                            </div>                                    
                                        </div>

                                      
                                        <div class="row">

                                            <!-- Column -->
                                            <div class="col-md-6 col-lg-6 col-xlg-3">
                                                <div class="card card-hover">
                                                    <div class="p-2 bg-primary text-center">
                                                        <h1 class="font-light text-white"> <b><?= $data_silabus[0]['total_version']; ?></b> </h1>
                                                        <h6 class="text-white">TOTAL DE VERSIONES</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Column -->
                                            <div class="col-md-6 col-lg-6 col-xlg-3">
                                                <div class="card card-hover">
                                                    <div class="p-2 bg-cyan text-center">
                                                        <h1 class="font-light text-white" > <b><?= $data_silabus[0]['numero_version']; ?></b> </h1>
                                                        <h6 class="text-white">VERSION PRINCIPAL</h6>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                        </div>
                                        
                                    </div>
                                  
                                </form>
                            </div>
                        </div>

                    </div>


                    
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Versiones del syllabus
                                        <a type='button' title='Nueva Versión'   onclick='Nueva_Version(<?= $data_silabus[0]["id_syllabus"] ?>)' class='btn'>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M14 16h2v-2h2v-2h-2v-2h-2v2h-2v2h2v2ZM4 20q-.825 0-1.413-.588T2 18V6q0-.825.588-1.413T4 4h6l2 2h8q.825 0 1.413.588T22 8v10q0 .825-.588 1.413T20 20H4Z"/></svg>
                                        </a>
                                </h4>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 17V8H7v9h14m0-14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1V1h2v2h8V1h2v2h1M3 21h14v2H3a2 2 0 0 1-2-2V9h2v12m16-6h-4v-4h4v4Z"/></svg>
                                    <code>=> </code> Convierte la versión en la principal 
                                    </br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9c-1.7 0-3 1.3-3 3s1.3 3 3 3s3-1.3 3-3s-1.3-3-3-3m6 9.5l1.8-1.8c-.5-.4-1.1-.7-1.8-.7c-1.4 0-2.5 1.1-2.5 2.5S16.6 21 18 21c.8 0 1.5-.4 2-1h1.7c-.6 1.5-2 2.5-3.7 2.5c-2.2 0-4-1.8-4-4s1.8-4 4-4c1.1 0 2.1.4 2.8 1.2l1.2-1.2v4h-4m-5.9 1s-.1 0 0 0C7 19.5 2.7 16.4 1 12c1.7-4.4 6-7.5 11-7.5s9.3 3.1 11 7.5c-.2.4-.4.9-.6 1.3c-1.1-.8-2.4-1.3-3.9-1.3c-.5 0-1 .1-1.5.2V12c0-2.8-2.2-5-5-5s-5 2.2-5 5s2.2 5 5 5h.2c-.1.5-.2 1-.2 1.5c0 .3 0 .7.1 1Z"/></svg>
                                    <code>=> </code> Se visualiza la versión  
                                    </br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 17V8H7v9h14m0-14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1V1h2v2h8V1h2v2h1M3 21h14v2H3a2 2 0 0 1-2-2V9h2v12m16-6h-4v-4h4v4Z"/></svg>
                                    <code>=> </code> Ver historial de cambios                                    

                                </h6>
                                </br>  </br>
                                <div class="table-responsive" style=" height: 460px;">
                                    <table id="tabla_version" class="table table-hover table-dark" style=" overflow: scroll;">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th scope="col">Version</th>
                                                <th scope="col">Estado</th>
                                                <th scope="col">Acción</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php  foreach ($data_silabus_version as $key => $row) { ?>

                                                <tr <?=  (($row['id_version_sy']==$data_silabus[0]['version_principal'])?  'style="background: #01caf1!important;"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Versión Principal"' : '')   ?> >
                                                
                                                    <td>  
                                                        <!-- <input type="text" name="" id="" value="<?php echo $row['nom_version_sy']; ?> "> -->
                                                        <?php echo $row['nom_version_sy']; ?>
                                                    </td>

                                                    <td scope="row">    
                                                        <?php echo $row['nom_est_syllabus']; ?>   
                                                    </td>

                                                    <td>
                                                                                                                                                                            
                                                        <div class="btn-group" role="group" aria-label="" style="width: 100%; justify-content: flex-end;">
                                                                <div class="btn-group" role="group">
                                                                    <button id="btnGroupDropSyllabusVersion" type="button"  class="btn bg-accion dropdown-toggle rueda_focus" data-toggle="dropdown"   aria-haspopup="true" aria-expanded="false" style="width: auto">
                                                                        <span class="fa fa-gear"></span>
                                                                    </button>
                                                                    <div 
                                                                    style="
                                                                    background: none 0% 0% repeat scroll rgb(215, 211, 211);border-radius: 48px;position: absolute;will-change: transform;min-width: 2rem !important;top: 0px;left: 0px;transform: translate3d(-46px, -115px, 0px);
                                                                    "
                                                                        class="dropdown-menu rueda-accion color-0" aria-labelledby="btnGroupDropSyllabusVersion" x-placement="bottom-start">
                                                                                                                                                                
                                                                            <a  title='Hacer versión esta PRINCIPAL' <?=  (($row['id_version_sy']==$data_silabus[0]['version_principal'])?  'style="background: aqua;cursor: pointer;border-radius: 44%;"' :   'style="cursor: pointer;border-radius: 44%;;"')   ?> 
                                                                                onclick='Hacer_version_principal(<?php echo $row["id_syllabus"] ?>,<?php echo $row["id_version_sy"] ?>,<?php echo $row["numero_version"] ?>,<?php echo $row["estado"] ?>)' 
                                                                                class="dropdown-item delay-toogle btn-table-modal" >
                                                                                    <span>
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="m10.6 16.2l7.05-7.05l-1.4-1.4l-5.65 5.65l-2.85-2.85l-1.4 1.4l4.25 4.25ZM5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h14q.825 0 1.413.588T21 5v14q0 .825-.588 1.413T19 21H5Zm0-2h14V5H5v14ZM5 5v14V5Z"/></svg>                                                    
                                                                                    </span>
                                                                            </a>

                                                                            <a style="cursor: pointer;border-radius: 44%;"
                                                                                title='TRABAJAR y VER esta versión'   onclick='Ver_version(<?php echo $row["id_syllabus"] ?>,<?php echo $row["id_version_sy"] ?>,<?php echo $row["numero_version"] ?>)'
                                                                                class="dropdown-item delay-toogle btn-table-modal" >
                                                                                    <span>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9c-1.7 0-3 1.3-3 3s1.3 3 3 3s3-1.3 3-3s-1.3-3-3-3m6 9.5l1.8-1.8c-.5-.4-1.1-.7-1.8-.7c-1.4 0-2.5 1.1-2.5 2.5S16.6 21 18 21c.8 0 1.5-.4 2-1h1.7c-.6 1.5-2 2.5-3.7 2.5c-2.2 0-4-1.8-4-4s1.8-4 4-4c1.1 0 2.1.4 2.8 1.2l1.2-1.2v4h-4m-5.9 1s-.1 0 0 0C7 19.5 2.7 16.4 1 12c1.7-4.4 6-7.5 11-7.5s9.3 3.1 11 7.5c-.2.4-.4.9-.6 1.3c-1.1-.8-2.4-1.3-3.9-1.3c-.5 0-1 .1-1.5.2V12c0-2.8-2.2-5-5-5s-5 2.2-5 5s2.2 5 5 5h.2c-.1.5-.2 1-.2 1.5c0 .3 0 .7.1 1Z"/></svg>                                                                                                </span>
                                                                            </a>

                                                                            <?php  if($_SESSION['usuario'][0]['id_nivel'] == 4 || $_SESSION['usuario'][0]['id_nivel'] == 1 ){ ?>

                                                                                    <a style="cursor: pointer;border-radius: 44%;" target="_blank" title='Historial' class="dropdown-item delay-toogle btn-table-modal" 
                                                                                        href="<?= site_url($this->url.$this->opcion.'/Historial_version_sy/'. $row['id_version_sy']) ?>">
                                                                                        <span>
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21 17V8H7v9h14m0-14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h1V1h2v2h8V1h2v2h1M3 21h14v2H3a2 2 0 0 1-2-2V9h2v12m16-6h-4v-4h4v4Z"/></svg>
                                                                                        </span>
                                                                                    </a>

                                                                            <?php }?>

                                                                    </div>
                                                                </div>
                                                        </div>

                                                    </td>
                                                </tr>

                                            <?php }?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="p-2 bg-warning text-center" id="tiempo_sy_text">
                                                <?php 

                                                        $date1 = new DateTime($data_silabus[0]['fecha_reg_version']);
                                                        $date2 = new DateTime($data_silabus[0]['fech_aprob']);
                                                        $diff = $date1->diff($date2);
                                                        $fech_diferencia = formato_resta($diff);
                                                    if($data_silabus[0]['fech_aprob'] == ''){
                                                        echo "<h6 class=' text-dark'  >TIEMPO ACTUAL TRANSCURRIDO DESDE LA CREACIÓN DEL SYLLABUS</h6>";
                                            
                                                    }else{
                                                        echo "<h6 class='text-dark' >TIEMPO TOTAL QUE SE EMPLEÓ PARA LA CREACIÓN DEL SYLLABUS</h6>";

                                                    }                         
                                                ?>
                                            <h5 class="font-light text-white"  id="tiempo_sy_diff"><?= $fech_diferencia; ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                        

                    <div class="col-sm-12 col-md-4">
                            <div class="card-body text-right">
                                <h4 class="card-title"> <b></b> </h4>
                            </div>
                    </div>

                    <div class="col-sm-12 col-md-4">
                            <div class="card-body text-center"  id="version_nombre">
                                    <h1> Versión  <?php echo  $data_silabus[0]['numero_version'];  ?> 
                                        </br> <h6>Actualmente es la Versión Principal</h6>
                                    </h1>
                            </div>
                    </div>
                           
                    <div class="col-sm-12 col-md-4">
                            <div class="card-body text-left">
                                <h4 class="card-title"> <b></b> </h4>
                            </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body" id="seccion_version_sy" >
                               

                                <h4 class="card-title">SECCIONES    SYLLABUS  </br>

                                    <?php 
                                                $botones='';
                                                if($_SESSION['usuario'][0]['id_nivel'] == 4 ){
                                                    $botones .='<a target="_blank" id="revision_data" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_revision/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                    .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                        .'<path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17l-.59.59l-.58.58V4h16v12zm-9.5-2H18v-2h-5.5zm3.86-5.87c.2-.2.2-.51 0-.71l-1.77-1.77c-.2-.2-.51-.2-.71 0L6 11.53V14h2.47l5.89-5.87z"/>'
                                                                    .'</svg>'
                                                                .'</a>';

                                                                echo $botones ;

                                                }else if($_SESSION['usuario'][0]['id_nivel']==1){

                                                    $botones .='<a target="_blank" id="revision_data" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_revision/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                    .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                        .'<path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17l-.59.59l-.58.58V4h16v12zm-9.5-2H18v-2h-5.5zm3.86-5.87c.2-.2.2-.51 0-.71l-1.77-1.77c-.2-.2-.51-.2-.71 0L6 11.53V14h2.47l5.89-5.87z"/>'
                                                                    .'</svg>'
                                                                .'</a>'
                                                                .'<a target="_blank"  id="vista_data" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                    .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">'
                                                                        .'<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>'
                                                                    .'</svg>'
                                                                .'</a>';

                                                    $botones .='<a target="_blank" id="mirar_data"   href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_mirar/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                .'<path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/>'
                                                                .'</svg>'
                                                            .'</a>';

                                                    echo $botones ;

                                                }else if($_SESSION['usuario'][0]['id_nivel']==5){

                                                    echo $botones ;

                                                } else{

                                                    $botones .='<a target="_blank"   id="vista_data" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data/'. $id_syllabus.'/'.$data_silabus[0]['version_principal'] ).'" class="mt-2 edit-profile">'
                                                                    .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">'
                                                                        .'<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>'
                                                                    .'</svg>'
                                                                .'</a>';

                                                    $botones .='<a  target="_blank" id="mirar_data"  href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_mirar/'. $id_syllabus.'/'.$data_silabus[0]['version_principal'] ).'" class="mt-2 edit-profile">'
                                                                    .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                    .'<path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/>'
                                                                    .'</svg>'
                                                                .'</a>';

                                                    echo $botones ;
                                                }

                                    ?>

                                </h4>

                                    <br>

                                <form action="#">
                                    <div class="form-body">
                                        <div class="row">

                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">DATOS GENERALES </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar" id="datos_gene"
                                                                 style="width: <?=   $valor_porcentajes_syllabus_dg."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">

                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_dg ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_dg."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">COMPETENCIAS ASOCIADAS AL CURSO (No se cuenta en la sumatoria)</h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar"  id="comp_aso_cur"
                                                            style="width: <?=   $valor_porcentajes_syllabus_ac."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title " valor="<?= $valor_porcentajes_syllabus_ac ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_ac."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">SUMILLA  (No se cuenta en la sumatoria)</h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar"  id="sumilla"
                                                                style="width: <?=   $valor_porcentajes_syllabus_sumilla."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title " valor="<?= $valor_porcentajes_syllabus_sumilla ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=   $valor_porcentajes_syllabus_sumilla."%"  ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        

                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">RESULTADO GENERAL DE APRENDIZAJE   (Más de 100 palabras sera el 100%)</h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar"  id="result_gene_apr"
                                                                style="width: <?=   $valor_porcentajes_syllabus_result_ga."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_result_ga ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=   $valor_porcentajes_syllabus_result_ga."%"  ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">ORGANIZACIÓN DEL APRENDIZAJE </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar"  id="org_apre"
                                                                style="width: <?=   $valor_porcentajes_syllabus_oa."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_oa ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_oa."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">ESTRATEGIAS DIDÁCTICAS  (Más de 100 palabras sera el 100%) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar"  id="estra_didac"
                                                                style="width: <?=   $valor_porcentajes_syllabus_estrate_didac."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_estrate_didac ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?=   $valor_porcentajes_syllabus_estrate_didac."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">FORMA Y HERRAMIENTAS DE EVALUACIÓN  </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar" id="form_herr"
                                                             style="width: <?=   $valor_porcentajes_syllabus_fhe."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_fhe ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_fhe."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">ACTIVIDADES PRINCIPALES  </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar" id="act_prin"
                                                            style="width: <?=   $valor_porcentajes_syllabus_ap."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ap ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_ap."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">PLATAFORMAS Y HERRAMIENTAS  </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar" id="plataf_herra" 
                                                            style="width: <?=   $valor_porcentajes_syllabus_ph."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ph ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_ph."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 ml-auto">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth ">REFERENCIAS BIBLIOGRÁFICAS  </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary" role="progressbar" id="refer_bibli"  
                                                                style="width: <?=   $valor_porcentajes_syllabus_bibli."%"  ?>" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_bibli ?>">
                                                                    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=   $valor_porcentajes_syllabus_bibli."%"  ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                     
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-body" id="seccion_version_ficha">
                              
                                <h4 class="card-title">SECCIONES   FICHA DE EVALUACIÒN   </br>
                                    <?php 
                                            
                                            $botones='';
                                            if($_SESSION['usuario'][0]['id_nivel'] == 4 ){
                                                $botones .='<a target="_blank" id="revision_data_ficha" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_revision_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                    .'<path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17l-.59.59l-.58.58V4h16v12zm-9.5-2H18v-2h-5.5zm3.86-5.87c.2-.2.2-.51 0-.71l-1.77-1.77c-.2-.2-.51-.2-.71 0L6 11.53V14h2.47l5.89-5.87z"/>'
                                                                .'</svg>'
                                                            .'</a>';

                                                            echo $botones ;

                                            }else if($_SESSION['usuario'][0]['id_nivel']==1){

                                                $botones .='<a target="_blank" id="revision_data_ficha" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_revision_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                    .'<path fill="currentColor" d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17l-.59.59l-.58.58V4h16v12zm-9.5-2H18v-2h-5.5zm3.86-5.87c.2-.2.2-.51 0-.71l-1.77-1.77c-.2-.2-.51-.2-.71 0L6 11.53V14h2.47l5.89-5.87z"/>'
                                                                .'</svg>'
                                                            .'</a>'
                                                            .'<a target="_blank"  id="vista_data_ficha" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">'
                                                                    .'<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>'
                                                                .'</svg>'
                                                            .'</a>';

                                                $botones .='<a target="_blank" id="mirar_data_ficha"   href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_mirar_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal']).'" class="mt-2 edit-profile">'
                                                            .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                            .'<path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/>'
                                                            .'</svg>'
                                                        .'</a>';

                                                echo $botones ;

                                            }else if($_SESSION['usuario'][0]['id_nivel']==5){

                                                echo $botones ;

                                            } else{

                                                $botones .='<a target="_blank"   id="vista_data_ficha" href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal'] ).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3">'
                                                                    .'<path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>'
                                                                .'</svg>'
                                                            .'</a>';

                                                $botones .='<a  target="_blank" id="mirar_data_ficha"  href="'.site_url($this->url.$this->opcion.'/Asyllabus_data_mirar_ficha_eval/'. $id_syllabus.'/'.$data_silabus[0]['version_principal'] ).'" class="mt-2 edit-profile">'
                                                                .'<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">'
                                                                .'<path fill="currentColor" d="M12 6.5a9.77 9.77 0 0 1 8.82 5.5c-1.65 3.37-5.02 5.5-8.82 5.5S4.83 15.37 3.18 12A9.77 9.77 0 0 1 12 6.5m0-2C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 5a2.5 2.5 0 0 1 0 5a2.5 2.5 0 0 1 0-5m0-2c-2.48 0-4.5 2.02-4.5 4.5s2.02 4.5 4.5 4.5s4.5-2.02 4.5-4.5s-2.02-4.5-4.5-4.5z"/>'
                                                                .'</svg>'
                                                            .'</a>';

                                                echo $botones ;
                                            }


                                    ?>

                                </h4>

                                    <br>

                                <form  action="#">
                                    <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 1: Evaluación Diagnóstica (Individual) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar" id="ficha_evaluno" style="width: <?=   $valor_porcentajes_syllabus_ficha_eval1."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval1 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval1."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 2: Evaluación continua 1  (Individual) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar" id="ficha_evaldos"  style="width: <?=   $valor_porcentajes_syllabus_ficha_eval2."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval2 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval2."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 3: Evaluación Parcial (Grupal)  </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar"  id="ficha_evaltres"  style="width: <?=   $valor_porcentajes_syllabus_ficha_eval3."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval3 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval3."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 4: Evaluación continua 2 (Individual) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar" id="ficha_evalcuatro"  style="width: <?=   $valor_porcentajes_syllabus_ficha_eval4."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval4 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval4."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 5: Evaluación continua 3 (Individual) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar"  id="ficha_evalcinco"  style="width: <?=   $valor_porcentajes_syllabus_ficha_eval5."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval5 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval5."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h6 class="col-md-12 text-rigth "> Actividad Evaluada 6: Evaluación final (Individual) </h6>
                                                        <div class="progress br-30" style="background-color: rgb(0 0 0 / 25%);">
                                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"
                                                                role="progressbar"   id="ficha_evalseis" style="width: <?=   $valor_porcentajes_syllabus_ficha_eval6."%"  ?>" 
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                                <div class="progress-title progress-title-aceptados" valor="<?= $valor_porcentajes_syllabus_ficha_eval6 ?>">
                                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=   $valor_porcentajes_syllabus_ficha_eval6."%"  ?></span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-md-12"  >
                        <div class="card">
                            <div class="card-body">
                                <form class="mt-3">
                                    <div class="row">
                                        <div class="col-md-12" id="progress_bar_datos_generales">

                                                <input type="hidden" name="id_syllabus" id="id_syllabus" value="<?=  $id_syllabus; ?>">
                                                <input type="hidden" name="periodo" id="periodo" value="<?=  $data_silabus[0]['periodo_anio']. ' ' .  $data_silabus[0]['periodo_ciclo']; ?>">
                                                <input type="hidden" name="fecha" id="fecha" value="<?=  $data_silabus[0]['fec_reg']; ?>">

                                                <input type="hidden" name="nom_syll" id="nom_syll" value="<?=   $data_silabus[0]['nombre_syllabus']; ?>">
                                                <input type="hidden" name="carrera" id="carrera" value="<?=  $data_silabus[0]['nom_carrera'];  ?>">
                                                <input type="hidden" name="plan_estudios" id="plan_estudios" value="<?=  $data_silabus[0]['nom_plan_estudios'];  ?>">
                                                <input type="hidden" name="nom_usu_registro" id="nom_usu_registro" value="<?=  $data_silabus[0]['nom_usu_registro'];  ?>">                                      
                                                <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?=  $data_silabus[0]['version_principal'];  ?>">                                      
                                                <input type="hidden" name="nom_tipo_estudios" id="nom_tipo_estudios" value="<?=  $data_silabus[0]['nom_tipo_estudios'];   ?>">      

                                                <input type="hidden" name="nom_curso" id="nom_curso" value="<?=   $data_silabus[0]['nom_curso'];   ?>">      

                                                <input type="hidden" name="es_principal" id="es_principal" value="true">      

                                                <?php 
                                                    
                                                        $botone_mail='';
                                                        if($_SESSION['usuario'][0]['id_nivel'] == 1 || $_SESSION['usuario'][0]['id_nivel'] ==3 ){

                                                            $botone_mail .='<div class="row">'
                                                                                .'<div class="col-md-12 ml-auto">'
                                                                                    .'<div class="form-group">'
                                                                                        .'<h6 class="col-md-12 text-center "> <b>*Se activará el botón cuando todas las secciones esten al 100% y se seleccione l versión principal</b> </h6>'
                                                                                        .'<div class="form-group  text-center ">'
                                                                                            .'<button type="button" id="enviar_correro" class="btn btn-info">ENVIAR CORREO PARA REVISIÓN</button>'
                                                                                        .'</div>'
                                                                                .'</div>'
                                                                                .'</div>'
                                                                            .'</div>';

                                                            echo $botone_mail ;

                                                        } else{
                                                    
                                                            echo $botone_mail ;

                                                        }

                                                ?>

                                        </div>
                                  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <script>

                        var wurl = "<?php echo base_url('index.php?'.$url.$opcion)."/"; ?>";

                        var identi_id_plan_estudios=  <?= (isset($data_silabus[0]["id_plan_estudios"])) ?  $data_silabus[0]["id_plan_estudios"] :  '"0"'  ?>;

                        var identi_carrera=  <?= (isset($data_silabus[0]["id_carrera"])) ?  $data_silabus[0]["id_carrera"] :  '"0"'  ?>;

                        var identi_nom_ciclo=  '<?= (isset($data_silabus[0]["nom_ciclo"] )) ?  $data_silabus[0]["nom_ciclo"]  :  '"0"'  ?>';

                        var identi_id_curso= <?= (isset($data_silabus[0]["id_curso"])) ?  $data_silabus[0]["id_curso"] :  '"0"'  ?>;

                </script>

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


