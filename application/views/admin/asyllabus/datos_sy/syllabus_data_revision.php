<?php 
$sesion =  $_SESSION['usuario'][0];
defined('BASEPATH') OR exit('No direct script access allowed');
//$rol = $_SESSION['usuario'][0]['ROLASISTENCIA'];
?>

<style>
    /*
    <?php echo '#'.$form_3."_tbl"; ?> tfoot input{
        width: 100% !important;
    }
    <?php echo '#'.$form_3."_tbl"; ?> tfoot {
        display: table-header-group !important;
    }
    */
    <?php echo '#'.$form_3."tbl"; ?> .rueda_focus:focus {
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

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $tituloSecundario2; ?></h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">CURSO: 
                                        <b id="nombre_syllabus" > <?php echo datos_sillabus($id_version_sy,'nom_curso'); ?> </b>  
                                    </li>
                                    <li class="breadcrumb-item text-muted active" aria-current="page"> 
                                        <b id="periodo_anio_ciclo"> <?php  echo datos_sillabus($id_version_sy,'periodo_anio'); ?>-<?php echo datos_sillabus($id_version_sy,'periodo_ciclo'); ?> </b>
                                    </li>
                                        <li class="breadcrumb-item text-muted active" aria-current="page"> 
                                        <b id="periodo_anio_ciclo"> <?php  echo datos_sillabus($id_version_sy,'nom_tipo_estudios'); ?> </b>
                                    </li>

                                </ol>
                                <ol class="breadcrumb m-0 p-0">
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
                                <h4 class="card-title">1.	DATOS GENERALES</h4>
                                <form action="#" id="<?php echo $form_1; ?>" method="POST" enctype="multipart/form-data">

                                    <input type="hidden" name="id_asyllabus" id="id_asyllabus" value="<?= (isset($id_syllabus)) ?  $id_syllabus :  ''  ?>">
                                    <input type="hidden" name="estado_sillabus" id="estado_sillabus" value="<?= (isset($data_silabus[0]["estado"])) ?  $data_silabus[0]["estado"] :  ''  ?>">

                                    <div class="form-body">



                                    
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Nombre Syllabus </label>

                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control"  disabled  id="nom_syllabus" name="nom_syllabus"   value="<?=  ((isset($data_silabus[0]["nombre_syllabus"])) ?  $data_silabus[0]["nombre_syllabus"] :  '' ) ?>" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">

                                                        <label class="col-md-3 text-center">Año </label>
                                                        <div class="col-md-3">

                                                            <?= cbx_basicos('periodo_anio',((isset($data_silabus[0]["periodo_anio"])) ?  $data_silabus[0]["periodo_anio"] :  '' ),true,'lista_anios_periodo',null,'periodo_anio','nom_periodo_anio','form-control','SELECCIONE',false,false); ?>


                                                        </div>

                                                        <label class="col-md-3 text-center">Ciclo</label>
                                                        <div class="col-md-3">

                                                        <select class="form-control" tabindex="-1" id="numero_ciclo" name="numero_ciclo" disabled>
                                                            <option value="" <?=  (($data_silabus[0]["periodo_ciclo"] === '' ) ?  'selected' :  '' ) ?> >SELECCIONE</option>
                                                            <option value="0" <?=  (($data_silabus[0]["periodo_ciclo"] === '0') ?  'selected' :  '' ) ?> >0</option>
                                                            <option value="1"  <?=  (($data_silabus[0]["periodo_ciclo"] === '1') ?  'selected' :  '' ) ?>  >1</option>
                                                            <option value="2"  <?=  (($data_silabus[0]["periodo_ciclo"] === '2') ?  'selected' :  '' ) ?>  >2</option>
                                                        </select>

                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Plan Estudios </label>

                                                        <div class="col-md-8">
                                                    
                                                            <?= cbx_basicos('id_plan_estudios', ((isset($data_silabus[0]["id_plan_estudios"])) ?  $data_silabus[0]["id_plan_estudios"] :  0 ) ,true,'lista_plan_estudios','Plan_estudios','id_plan_estudios','nom_plan_estudios','form-control','SELECCIONE',false,true); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Tipo de estudios </label>

                                                        <div class="col-md-8">

                                                            <!-- <label id="tipo_estudios_texto"></label> -->
                                                            <?= cbx_basicos('id_tipo_estudios',0,true,'tipo_estudios',null,'id_tipo_estudios','nom_tipo_estudios','form-control','SELECCIONE',false); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Carrera </label>

                                                        <div class="col-md-8">
                                                            
                                                            <?= cbx_basicos('id_carrera', ((isset($data_silabus[0]["id_carrera"])) ?  $data_silabus[0]["id_carrera"] :  0 ) ,true,'lista_carreras','Carrera','id_carrera','nom_carrera','form-control','SELECCIONE',false,true); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>             

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Ciclo </label>

                                                        <div class="col-md-8">
                                                      
                                                            <select class="form-control" id="nom_ciclo" name="nom_ciclo" onchange="Ciclo(this)" disabled>
                                                                <option value="0">Seleccionar</option>
                                                            </select>

                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Curso </label>

                                                        <div class="col-md-8">
                                                                
                                                        
                                                            <?= cbx_basicos('id_curso',0,true,'lista_cursos','Curso','id_curso','nom_curso','form-control','SELECCIONE',false,true); ?>


                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Créditos </label>

                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" disabled   id="creditos" name="creditos"   value=""
                                                                placeholder="">
                                                                <!-- <?=  ((isset($data_silabus[0]["creditos"])) ?  $data_silabus[0]["creditos"] :  '' ) ?> -->
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-2 text-center">Horas Totales </label>

                                                        <div class="col-md-2">
                                                            <input type="number"  min="0" disabled id="horas_totales" name="horas_totales"  class="form-control" value=""
                                                                placeholder="">
                                                                <!-- <?= ((isset($data_silabus[0]["horas_practicas"])) ?  $data_silabus[0]["horas_practicas"] :  0 )  +  ((isset($data_silabus[0]["horas_teoricas"])) ?  $data_silabus[0]["horas_teoricas"] :  0 ) ?> -->
                                                        </div>

                                                        <label class="col-md-2 text-center">Horas prácticas </label>

                                                        <div class="col-md-2">
                                                            <input type="number" min="0" disabled  class="form-control"  id="horas_practicas" name="horas_practicas"  value=""
                                                                placeholder="">
                                                                <!-- <?=  ((isset($data_silabus[0]["horas_practicas"])) ?  $data_silabus[0]["horas_practicas"] :  '' ) ?> -->
                                                        </div>
                                                        <label class="col-md-2 text-center">Horas teóricas </label>

                                                        <div class="col-md-2">
                                                            <input type="number" min="0"  disabled class="form-control"  id="horas_teoricas" name="horas_teoricas"  value=""
                                                                placeholder="">
                                                                <!-- <?=  ((isset($data_silabus[0]["horas_teoricas"])) ?  $data_silabus[0]["horas_teoricas"] :  '' ) ?> -->
                                                        </div>

                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Requisito </label>
                                                        <div class="col-md-8">
                                                      
                                                                <select class="form-control" id="requisito" name="requisito[]" disabled multiple >   </select>

                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Tipo de ciclo </label>
                                                        <div class="col-md-8">
                                                      
                                                            <?= cbx_basicos('id_tipo_curso',0,true,'lista_tipo_curso',null,'id_tipo_curso','nom_tipo_curso','form-control','SELECCIONE',false,true); ?>

                                                            <!-- ((isset($data_silabus[0]["tipo_ciclo"])) ?  $data_silabus[0]["tipo_ciclo"] :  0 ) -->
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Presencilidad </label>

                                                        <div class="col-md-8">
                                                      
                                                                <?= cbx_basicos('id_curso_forma_estudio',0,true,'lista_forma_estudio_curso',null,'id_curso_forma_estudio','nom_curso_forma_estudio','form-control','SELECCIONE',false,true); ?>
                                                                <!-- ((isset($data_silabus[0]["presencialidad"])) ?  $data_silabus[0]["presencialidad"] :  0 ) -->
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Condición </label>

                                                        <div class="col-md-8">
                                                      

                                                                <?= cbx_basicos('id_curso_importancia',0,true,'lista_importancia_curso',null,'id_curso_importancia','nom_curso_importancia','form-control','SELECCIONE',false,true); ?>
                                                                <!-- ((isset($data_silabus[0]["id_condicion"])) ?  $data_silabus[0]["id_condicion"] :  0 ) -->
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Director </label>

                                                        <div class="col-md-8">
                                                     
                                                                <?= cbx_basicos('id_director', 0,true,'lista_directores',null,'id_director','nom_director','form-control','SELECCIONE',false,true); ?>
                                                                <!-- ((isset($data_silabus[0]["id_director"])) ?  $data_silabus[0]["id_director"] :  0 )  -->
                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center">Docentes </label>
                                                        
                                                        <div class="col-md-8">
                                                            
                                                            <?= cbx_basicos_multiple('id_docente', ((isset($data_silabus[0]["id_docente"])) ?  $data_silabus[0]["id_docente"] :  0 ) ,true,'lista_docentes',null,'id_docente','nom_docente'); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                
                                            </div>
                                        </div>
                                     
                                    
                                    </div>
                                    
                                    <hr/>


                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                    <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                    <textarea class="form-control" name="comen_syllabu" id="comen_syllabu" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_syllabu"])){

                                                                                    echo $data_silabus[0]["comen_syllabu"];
                                                                                
                                                                                }else{?>
                                                                                                                                                                                                                                                        
                                                                                <?php } ?>
                                                                    </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_syllabu')" class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">2.	COMPETENCIAS ASOCIADAS AL CURSO</h4>
                                <form action="#" id="<?php echo $form_2; ?>" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?= (isset($id_version_sy)) ?  $id_version_sy :  ''  ?>">

                                                                    <input type="hidden" name="id_compt_asoci_curso" id="id_compt_asoci_curso" value="<?= (isset($compt_asoci_curso[0]["id_compt_asoci_curso"])) ?  $compt_asoci_curso[0]["id_compt_asoci_curso"] :  ''  ?>">
                                                                    <input type="hidden" name="accion" id="accion" value="<?=  (isset($compt_asoci_curso)) ? (count($compt_asoci_curso) > 0 ? 'E' : 'I' ):  '' ?>">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-6  text-center">COMPETENCIA </label>
                                            <label class="col-md-6  text-center">DESCRIPCIÓN DEL NIVEL DE COMPETENCIA </label>

                                            <label class="col-md-2">General </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          
                                                                <textarea class="form-control" disabled name="compt_gene" id="compt_gene" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_gene"])) ?  $compt_asoci_curso[0]["compt_gene"] :  ''  ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled name="compt_gene_descr" id="compt_gene_descr" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_gene_descr"])) ?  $compt_asoci_curso[0]["compt_gene_descr"] :  ''  ?></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- f -->

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                          
                                                                <textarea class="form-control" disabled name="compt_gene_2" id="compt_gene_2" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_gene_2"])) ?  $compt_asoci_curso[0]["compt_gene_2"] :  ''  ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control"  disabled name="compt_gene_descr_2" id="compt_gene_descr_2" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_gene_descr_2"])) ?  $compt_asoci_curso[0]["compt_gene_descr_2"] :  ''  ?></textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                               <!-- f -->

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2">Especifica </label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled name="compt_espec_1" id="compt_espec_1" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_1"])) ?  $compt_asoci_curso[0]["compt_espec_1"] :  ''  ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled name="compt_espec_2" id="compt_espec_2" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_2"])) ?  $compt_asoci_curso[0]["compt_espec_2"] :  ''  ?></textarea>
                                                        </div>

                                                        <!-- f -->

                                                            <div class="form-group">
                                                                <textarea class="form-control" disabled name="compt_espec_3" id="compt_espec_3" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_3"])) ?  $compt_asoci_curso[0]["compt_espec_3"] :  ''  ?></textarea>
                                                            </div>

                                                        <!-- f -->


                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled  name="compt_espec_descr_1" id="compt_espec_descr_1" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_descr_1"])) ?  $compt_asoci_curso[0]["compt_espec_descr_1"] :  ''  ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled name="compt_espec_descr_2" id="compt_espec_descr_2" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_descr_2"])) ?  $compt_asoci_curso[0]["compt_espec_descr_2"] :  ''  ?></textarea>
                                                        </div>

                                                           <!-- f -->

                                                        <div class="form-group">
                                                            <textarea class="form-control" disabled name="compt_espec_descr_3" id="compt_espec_descr_3" cols="30" rows="5"><?= (isset($compt_asoci_curso[0]["compt_espec_descr_3"])) ?  $compt_asoci_curso[0]["compt_espec_descr_3"] :  ''  ?></textarea>
                                                        </div>
                                                            <!-- f -->

                                                    </div>
                                                </div>
                                            </div>
                                          
                                        </div>
                                    </div>
                            
                                    
                                    <hr>

                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                    <textarea class="form-control" name="comen_compt_asoci_curso" id="comen_compt_asoci_curso" cols="30" rows="20">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_compt_asoci_curso"])){

                                                                                    echo $data_silabus[0]["comen_compt_asoci_curso"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                    
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_compt_asoci_curso')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>



                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">3.	SUMILLA </h4>
                                <form  method="POST" >


                                    <div class="form-body">
                                        <!-- <label> El curso de nombre del curso es de naturaleza teórica-práctica.
                                            Tiene como propósito permitir la exploración de diferentes tecnologías y 
                                            a su empleo como herramientas de apoyo para su actividad académica y para potenciar sus aprendizajes,
                                             siendo clave el desarrollo de los temas de: conectivismo, entornos virtuales de aprendizaje, 
                                             herramientas para la comunicación, colaboración e investigación en entornos virtuales.  
                                        </label> -->

                                        <textarea class="form-control" name="desc_sumilla" disabled id="desc_sumilla" cols="30" rows="20"><?= (isset($data_silabus[0]["desc_sumilla"])) ?  $data_silabus[0]["desc_sumilla"] :  ''  ?></textarea>

                                    </div>
                               

                                    <hr>


                                             

                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                            
                                                                
                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                    <textarea class="form-control" name="comen_sumilla" id="comen_sumilla" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_sumilla"])){

                                                                                    echo $data_silabus[0]["comen_sumilla"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                              
                                                                                       
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_sumilla')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>


                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">4.	RESULTADO GENERAL DE APRENDIZAJE </h4>
                                <form  method="POST" >

                                    <div class="form-body">
                                        <!-- <label> Al finalizar el curso, el estudiante construye 
                                             su portafolio digital de aprendizaje aplicando de manera eficaz,
                                              creativa y ética las tecnologías de la información y de la comunicación 
                                              para producir e integrar las evidencias de aprendizaje desarrolladas a lo largo del ciclo.
                                        </label> -->

                                        
                                        <textarea class="form-control" disabled name="desc_result_gen_apr" id="desc_result_gen_apr" cols="30" rows="20"> <?= (isset($data_silabus[0]["desc_result_gen_apr"])) ?  $data_silabus[0]["desc_result_gen_apr"] :  ''  ?></textarea>

                                    </div>

                                    <hr>
                            
                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                

                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                                                                        
                                                                                
                                                                    <textarea class="form-control" name="comen_result_general_apren" id="comen_result_general_apren" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_result_general_apren"])){

                                                                                    echo $data_silabus[0]["comen_result_general_apren"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                            
                                                                                       
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_result_general_apren')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">

                        <form action="#" id="<?php echo $form_3; ?>" method="POST" enctype="multipart/form-data">

                            <div class="card-body">
                                <h4 class="card-title">5.	ORGANIZACIÓN DEL APRENDIZAJE</h4>
                                                                        <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?= (isset($id_version_sy)) ?  $id_version_sy :  ''  ?>">

                                    <input type="hidden" name="id_org_aprendizaje" id="id_org_aprendizaje" value="">
                                    <input type="hidden" name="accion" id="accion" value="I">

                                    <br>            
                               
                            </div>

                               <!-- basic table -->
                              
                                    <div class="card">
                                        <div class="card-body"  id="cargando_">
                                            <h4 class="card-title">Lista de Semanas</h4>
                                          

                                            <div class="row col-12 h-100 m-0 p-3 table-responsive" id="limpiar_tabla"> 
                                                <table id="<?php echo $form_3; ?>_tbl"  class="table table-striped table-bordered table-hover table-primary" style="width:100%"  role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">ID_ORG_APRENDIZAJE</th>
                                                            <th class="text-center">ID_SYLLABUS</th>
                                                            <th class="text-center">N° ORDEN</th>

                                                            <th class="text-center">MÓDULO DE APRENDIZAJE</th>
                                                            <th class="text-center">RESULTADO DE APRENDIZAJE</th>
                                                            <th class="text-center">SEMANAS</th>
                                                            <th class="text-center">CONTENIDOS INVOLUCRADOS</th>

                                                        </tr>
                                                    </thead>
                                               
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-12 text-center">Comentarios </label>
                                                        
                                                        <div class="col-md-12">
                                                            

                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                                                                        
                                                                                <br>

                                                                <textarea class="form-control" name="comen_org_aprendizaje" id="comen_org_aprendizaje" cols="30" rows="5">
                                                                        <?php
                                                                        
                                                                            if(!is_null($data_silabus[0]["comen_org_aprendizaje"])){

                                                                                echo $data_silabus[0]["comen_org_aprendizaje"];
                                                                            
                                                                            }else{?>
                                                                            
                                                                        
                                                                                
                                                                                
                                                                            <?php } ?>
                                                                </textarea>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <label class="col-md-4 text-center"></label>
                                                        
                                                        <div class="col-md-12">
                                                            
                                                            <div class="text-center">
                                                                <button type="button" onclick="Insert_Update_form_comentario('E','comen_org_aprendizaje')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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



      
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">6.	ESTRATEGIAS DIDÁCTICAS </h4>
                                <form  method="POST" >

                                <div class="form-body">
                                        <!-- <label> (Explicación de las estrategias a utilizar)

                                            El curso se desarrollará a través de sesiones demostrativas de los contenidos con participación activa de los estudiantes mediante estrategias de aprendizaje colaborativo en el aula virtual de la Universidad Científica del Sur. El curso incluirá clases prácticas en el laboratorio de cómputo que les permitirá desarrollar habilidades en la gestión de la investigación con herramientas digitales y experiencias de diseño e implementación de clases mediadas por las TIC. 
                                            
                                            
                                            De acuerdo a nuestro Modelo Educativo, la estrategia de aprendizaje que se promueve en el curso es la de:
                                            
                                            •	Aprendizaje basado en problemas
                                            </label> -->

                                               
                                        <textarea class="form-control" disabled name="desc_estrateg_didact" id="desc_estrateg_didact" cols="30" rows="20"><?= (isset($data_silabus[0]["desc_estrateg_didact"])) ?  $data_silabus[0]["desc_estrateg_didact"] :  ''  ?></textarea>


                                    </div>
                                 

                                    
                                    <hr>


                                             

                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                

                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                                                                        
                                                                                <br>
                                                                    <textarea class="form-control" name="comen_desc_estrateg_didact" id="comen_desc_estrateg_didact" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_desc_estrateg_didact"])){

                                                                                    echo $data_silabus[0]["comen_desc_estrateg_didact"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                              
                                                                                       
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_desc_estrateg_didact')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">7.	FORMA Y HERRAMIENTAS DE EVALUACIÓN</h4>
                                <form  id="<?php echo $form_4; ?>" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?= (isset($id_version_sy)) ?  $id_version_sy :  ''  ?>">


                                    <input type="hidden" name="id_forma_herrami_eval" id="id_forma_herrami_eval" value="<?= (isset($forma_herrami_eval[0]["id_forma_herrami_eval"])) ?  $forma_herrami_eval[0]["id_forma_herrami_eval"] :  ''  ?>">
                                    <input type="hidden" name="accion" id="accion" value="<?=  (isset($forma_herrami_eval)) ? (count($forma_herrami_eval) > 0 ? 'E' : 'I' ):  '' ?>">

                            
                              
                                   
                                    <br>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="bg-warning text-white">
                                                <tr>
                                                    <th>EVALUACIÓN</th>
                                                    <th>COD</th>
                                                    <th>DETALLE</th>
                                                    <th>SEMANA</th>
                                                    <th>PESO</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Evaluación diagnóstica </td>
                                                    <td>ED</td>
                                                    <td><textarea class="form-control" disabled name="eval_diag_detalle" id="eval_diag_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_diag_detalle"])) ?  $forma_herrami_eval[0]["eval_diag_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select disabled  class="form-control"  name="eval_diag_sem" id="eval_diag_sem">
                                                                <option value="0" <?=  count($forma_herrami_eval) == 0 ? 'selected' : ''  ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? ($forma_herrami_eval[0]["eval_diag_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                        </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_diag_peso" id="eval_diag_peso" value="<?= (isset($forma_herrami_eval[0]["eval_diag_peso"])) ?  $forma_herrami_eval[0]["eval_diag_peso"] :  ''  ?>">%</td>

                                                </tr>

                                                <tr>
                                                    <td>Evaluación continua 1</td>
                                                    <td>EC1</td>
                                                    <td><textarea disabled class="form-control" name="eval_cont1_detalle" id="eval_cont1_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_cont1_detalle"])) ?  $forma_herrami_eval[0]["eval_cont1_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select  disabled class="form-control"  name="eval_cont1_sem" id="eval_cont1_sem">
                                                                <option value="0" <?=  count($forma_herrami_eval) == 0 ? 'selected' : ''  ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? ($forma_herrami_eval[0]["eval_cont1_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                        </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_cont1_peso" id="eval_cont1_peso" value="<?= (isset($forma_herrami_eval[0]["eval_cont1_peso"])) ?  $forma_herrami_eval[0]["eval_cont1_peso"] :  ''  ?>">%</td>

                                                </tr>   

                                                <tr>
                                                    <td>Evaluación continua 2</td>
                                                    <td>EC2</td>
                                                    <td><textarea  disabled class="form-control" name="eval_cont2_detalle" id="eval_cont2_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_cont2_detalle"])) ?  $forma_herrami_eval[0]["eval_cont2_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select disabled  class="form-control"  name="eval_cont2_sem" id="eval_cont2_sem">
                                                                <option value="0" <?=  count($forma_herrami_eval) == 0 ? 'selected' : '' ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? ($forma_herrami_eval[0]["eval_cont2_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                            </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_cont2_peso" id="eval_cont2_peso" value="<?= (isset($forma_herrami_eval[0]["eval_cont2_peso"])) ?  $forma_herrami_eval[0]["eval_cont2_peso"] :  ''  ?>">%</td>

                                                </tr>   
                                                                                                
                                                <tr>
                                                    <td>Evaluación Parcial</td>
                                                    <td>EP</td>
                                                    <td><textarea class="form-control" disabled name="eval_parcial_detalle" id="eval_parcial_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_parcial_detalle"])) ?  $forma_herrami_eval[0]["eval_parcial_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select   class="form-control" disabled  name="eval_parcial_sem" id="eval_parcial_sem">
                                                                <option value="0" <?=  count($forma_herrami_eval) == 0 ? 'selected' : ''  ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ? ($forma_herrami_eval[0]["eval_parcial_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                            </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_parcial_peso" id="eval_parcial_peso" value="<?= (isset($forma_herrami_eval[0]["eval_parcial_peso"])) ?  $forma_herrami_eval[0]["eval_parcial_peso"] :  ''  ?>">%</td>

                                                </tr>  

                                                <tr>
                                                    <td>Evaluación continua 3</td>
                                                    <td>EC3</td>
                                                    <td><textarea class="form-control" disabled name="eval_cont3_detalle" id="eval_cont3_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_cont3_detalle"])) ?  $forma_herrami_eval[0]["eval_cont3_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select   class="form-control" disabled name="eval_cont3_sem" id="eval_cont3_sem">
                                                                <option value="0" <?=   count($forma_herrami_eval) == 0 ? 'selected' : '' ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? ($forma_herrami_eval[0]["eval_cont3_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                            </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_cont3_peso" id="eval_cont3_peso" value="<?= (isset($forma_herrami_eval[0]["eval_cont3_peso"])) ?  $forma_herrami_eval[0]["eval_cont3_peso"] :  ''  ?>">%</td>

                                                </tr>  

                                                <tr>
                                                    <td>Evaluación continua 4</td>
                                                    <td>EC4</td>
                                                    <td><textarea class="form-control" disabled name="eval_cont4_detalle" id="eval_cont4_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_cont4_detalle"])) ?  $forma_herrami_eval[0]["eval_cont4_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select   class="form-control" disabled  name="eval_cont4_sem" id="eval_cont4_sem">
                                                                <option value="0" <?=   count($forma_herrami_eval) == 0 ? 'selected' : '' ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>
                                                            </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_cont4_peso" id="eval_cont4_peso" value="<?= (isset($forma_herrami_eval[0]["eval_cont4_peso"])) ?  $forma_herrami_eval[0]["eval_cont4_peso"] :  ''  ?>">%</td>

                                                </tr>  

                                                <tr>
                                                    <td>Evaluación Final</td>
                                                    <td>EF</td>
                                                    <td><textarea class="form-control" disabled name="eval_final_detalle" id="eval_final_detalle" cols="20" rows="2"><?= (isset($forma_herrami_eval[0]["eval_final_detalle"])) ?  $forma_herrami_eval[0]["eval_final_detalle"] :  ''  ?></textarea></td>
                                                    <td>
                                                        <select   class="form-control" disabled  name="eval_final_sem" id="eval_final_sem">
                                                                <option value="0" <?=  count($forma_herrami_eval) == 0 ? 'selected' : ''  ?>>ELIJA</option>
                                                                <option value="1" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 1 ? 'selected' : '' ):  '' ?>>SEMANA 1</option>
                                                                <option value="2" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 2 ? 'selected' : '' ):  '' ?>>SEMANA 2</option>
                                                                <option value="3" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 3 ? 'selected' : '' ):  '' ?>>SEMANA 3</option>
                                                                <option value="4" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 4 ? 'selected' : '' ):  '' ?>>SEMANA 4</option>
                                                                <option value="5" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 5 ? 'selected' : '' ):  '' ?>>SEMANA 5</option>
                                                                <option value="6" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 6 ? 'selected' : '' ):  '' ?>>SEMANA 6</option>
                                                                <option value="7" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 7 ? 'selected' : '' ):  '' ?>>SEMANA 7</option>
                                                                <option value="8" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 8 ? 'selected' : '' ):  '' ?>>SEMANA 8</option>
                                                                <option value="9" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 9 ? 'selected' : '' ):  '' ?>>SEMANA 9</option>
                                                                <option value="10" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 10 ? 'selected' : '' ):  '' ?>>SEMANA 10</option>
                                                                <option value="11" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 11 ? 'selected' : '' ):  '' ?>>SEMANA 11</option>
                                                                <option value="12" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 12 ? 'selected' : '' ):  '' ?>>SEMANA 12</option>
                                                                <option value="13" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 13 ? 'selected' : '' ):  '' ?>>SEMANA 13</option>
                                                                <option value="14" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 14 ? 'selected' : '' ):  '' ?>>SEMANA 14</option>
                                                                <option value="15" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 15 ? 'selected' : '' ):  '' ?>>SEMANA 15</option>
                                                                <option value="16" <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? ($forma_herrami_eval[0]["eval_cont4_sem"] == 16 ? 'selected' : '' ):  '' ?>>SEMANA 16</option>

                                                            </select>
                                                    </td>
                                                    <td style="display: flex;"><input type="number" disabled name="eval_final_peso" id="eval_final_peso" value="<?= (isset($forma_herrami_eval[0]["eval_final_peso"])) ?  $forma_herrami_eval[0]["eval_final_peso"] :  ''  ?>">%</td>

                                                </tr>  
                                            </tbody>
                                        </table>
                                    </div>




                                    <hr>


                                             

                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                

                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                                                                        
                                                                        
                                                                            
                                                                    <textarea class="form-control" name="comen_forma_herrami_eval" id="comen_forma_herrami_eval" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_forma_herrami_eval"])){

                                                                                    echo $data_silabus[0]["comen_forma_herrami_eval"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                               
                                                                                    
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_forma_herrami_eval')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">8.   ACTIVIDADES PRINCIPALES</h4>
                                <form action="#" id="<?php echo $form_5; ?>" method="POST" enctype="multipart/form-data">
                                                                        <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?= (isset($id_version_sy)) ?  $id_version_sy :  ''  ?>">

                                  
                                    <input type="hidden" name="id_modulo" id="id_modulo" value="">
                                    <input type="hidden" name="id_semana_modulo" id="id_semana_modulo" value="">
                                    <input type="hidden" name="id_sesion_modulo" id="id_sesion_modulo" value="">

                                    <input type="hidden" name="accion" id="accion" value="I">

                                    <div class="form-actions">
                                        <div class="text-right">
                                            El curso se desarrollará a través de actividades sincrónicas mediante el sistema de videoconferencias.
                                        </div>
                                    </div>
                                  

                                    <br>
                                    <!-- 
                                    <div id="crear_modulos">
                                      
                                    </div> -->

                            
                               

                                    <div id="listar_modulos_creados">

                                    </div>


                                    
                                    <hr>


                                             

                                    <div class="form-actions">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                            
                                                            <div class="col-md-12">
                                                                

                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                </div>
                                                                                        
                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                </div>

                                                                                                                        
                                                                                
                                                                    <textarea class="form-control" name="comen_actividades_pricipales" id="comen_actividades_pricipales" cols="30" rows="5">
                                                                            <?php
                                                                            
                                                                                if(!is_null($data_silabus[0]["comen_actividades_pricipales"])){

                                                                                    echo $data_silabus[0]["comen_actividades_pricipales"];
                                                                                
                                                                                }else{?>
                                                                                
                                                                               
                                                                                    
                                                                                    
                                                                                <?php } ?>
                                                                    </textarea>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <label class="col-md-4 text-center"></label>
                                                            
                                                            <div class="col-md-12">
                                                                
                                                                <div class="text-center">
                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_actividades_pricipales')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                </div>    
      
                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">9.	PLATAFORMAS Y HERRAMIENTAS </h4>
                                <for action="#">
                                    <div class="form-body">
                                        <label> 
                                            ·	Plataforma Zoom: Plataforma online utilizada por la Universidad, 
                                                que permite realizar videoconferencia, chat y pantalla compartida, entre otras opciones. Tiene almacenamiento de grabación en la nube.
                                                <br>
                                                <br>
                                            ·	Plataforma Aula Virtual Moodle: Plataforma de gestión de aprendizaje usada en la Universidad
                                                 para la publicación de materiales y actividades de aprendizaje online.

                                        </label>


                                        <br>
                                        <label for="">HERRAMIENTAS</label>



                                        <!-- basic table -->
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="table-responsive">
                                                        <table id="" class="table table-striped table-bordered no-wrap">
                                                           
                                                            <tbody id="lista_plataformas_herramientas">
                                                                


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                         
                                    <hr>


                                             

                                                <div class="form-actions">
                                                    <form action="#" id="<?php echo $form_6; ?>" method="POST" enctype="multipart/form-data">

                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <label class="col-md-12 text-center">Comentarios </label>
                                                                            
                                                                            <div class="col-md-12">
                                                                                
                                                                            <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                            <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                                </div>
                                                                                                        
                                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                                </div>

                                                                                                                                        
                                                                                                
                                                                                    <textarea class="form-control" name="comen_plataformas_herramientas" id="comen_plataformas_herramientas" cols="30" rows="5">
                                                                                            <?php
                                                                                            
                                                                                                if(!is_null($data_silabus[0]["comen_plataformas_herramientas"])){

                                                                                                    echo $data_silabus[0]['comen_plataformas_herramientas'];
                                                                                                
                                                                                                }else{?>
                                                                                                
                                                                                              
                                                                                                    
                                                                                                    
                                                                                                <?php } ?>
                                                                                    </textarea>

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <label class="col-md-4 text-center"></label>
                                                                            
                                                                            <div class="col-md-12">
                                                                                
                                                                                <div class="text-center">
                                                                                    <button type="button" onclick="Insert_Update_form_comentario('E','comen_plataformas_herramientas')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">10.	REFERENCIAS BIBLIOGRÁFICAS </h4>
                                    <div class="form-body">
                                   
                                    

                                        <br>
                                        <label for="">OBLIGATORIAS</label>

                                        <!-- basic table -->
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="table-responsive">
                                                        <table id="" class="table table-striped table-bordered no-wrap">
                                                           
                                                            <tbody id="lista_Referencias_obligatorias">
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         
                           
                                        <br>
                                        <label for="">DE CONSULTA</label>

                                                                         
                                        <!-- basic table -->
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="" class="table table-striped table-bordered no-wrap">
                                                           
                                                            <tbody id="lista_Referencias_consultas">
                                                             
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <hr>


                                             

                                            <div class="form-actions">
                                            <form action="#" id="<?php echo $form_7; ?>" method="POST" enctype="multipart/form-data">
                                                                                                            <input type="hidden" name="id_version_sy" id="id_version_sy" value="<?= (isset($id_version_sy)) ?  $id_version_sy :  ''  ?>">

                                                                        <input type="hidden" name="tipo_bibliografia" id="tipo_bibliografia" value="obligatorio">


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <label class="col-md-12 text-center">Comentarios </label>
                                                                        
                                                                        <div class="col-md-12">
                                                                            

                                                                                                <div class="alert alert-info bg-info text-white border-0" role="alert">
                                                                                                <strong>Estimado evaluador coloque su observaciónrespectiva.</strong>
                                                                                                </div>
                                                                                                        
                                                                                                <div class="alert alert-dark bg-dark text-white border-0 mb-0" role="alert">
                                                                                                    Use las herramientas de texto necesarias para expresar de manera clara sus ideas  
                                                                                                </div>

                                                                                                                                        
                                                                                                <br>

                                                                                <textarea class="form-control" name="comen_tipo_bibliografia" id="comen_tipo_bibliografia" cols="30" rows="5">
                                                                                        <?php
                                                                                        
                                                                                            if(!is_null($data_silabus[0]["comen_tipo_bibliografia"])){

                                                                                                echo $data_silabus[0]["comen_tipo_bibliografia"];
                                                                                            
                                                                                            }else{?>
                                                                                            
                                                                                  
                                                                                                
                                                                                                
                                                                                            <?php } ?>
                                                                                </textarea>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <label class="col-md-4 text-center"></label>
                                                                        
                                                                        <div class="col-md-12">
                                                                            
                                                                            <div class="text-center">
                                                                                <button type="button" onclick="Insert_Update_form_comentario('E','comen_tipo_bibliografia')"  class="btn btn-info">GUARDAR Y ACTUALIZAR</button>
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
                        </div>
                    </div>
                </div>


                <script>

                 

                    var identi_id_plan_estudios=  <?= (isset($data_silabus[0]["id_plan_estudios"])) ?  $data_silabus[0]["id_plan_estudios"] :  '""'  ?>;

                    var identi_carrera=  <?= (isset($data_silabus[0]["id_carrera"])) ?  $data_silabus[0]["id_carrera"] :  '""'  ?>;

                    var identi_nom_ciclo=  '<?= (isset($data_silabus[0]["nom_ciclo"] )) ?  $data_silabus[0]["nom_ciclo"]  :  '""'  ?>';

                    var identi_id_curso= <?= (isset($data_silabus[0]["id_curso"])) ?  $data_silabus[0]["id_curso"] :  '""'  ?>;



                    $(document).ready(function() {
                       

                                        
                                $('#comen_syllabu').summernote({
                                    height: 500, 
                                    placeholder: '',
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["table", ["table"]],
                                        ["insert", ["link"]],
                                        // ["view", ["fullscreen", "codeview", "help"]]
                                        ["view", ["fullscreen"]]
                                    ]
                                });


                                
                                $('#comen_compt_asoci_curso').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });

                                

                                $('#comen_sumilla').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });


                                
                                $('#comen_result_general_apren').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });

                                    
                                $('#comen_org_aprendizaje').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });

                                $('#comen_desc_estrateg_didact').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });


                                $('#comen_forma_herrami_eval').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });
                                        
                                
                                
                                $('#comen_actividades_pricipales').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });
                                        
                                

                                


                                $('#comen_plataformas_herramientas').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });


                                
                                $('#comen_tipo_bibliografia').summernote({
                                    height: 500, 
                                    lang: 'es-ES',
                                    toolbar: [
                                
                                        ["style", ["style"]],
                                        ["font", ["bold", "underline", "clear"]],
                                        ["fontname", ["fontname"]],
                                        ["color", ["color"]],
                                        ["para", ["ul", "ol", "paragraph"]],
                                        ["insert", ["link"]],
                                        ["table", ["table"]],

                                        ["view", ["fullscreen"]]
                                    ]
                                });
                                        
                        

                    });
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