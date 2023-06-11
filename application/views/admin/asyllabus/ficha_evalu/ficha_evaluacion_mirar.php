            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">FICHA DE ACTIVIDADES EVALUADAS </h4>
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
                                    <li class="breadcrumb-item"><a href="<?= site_url($this->url.$this->opcion.'/Asyllabus_resumen/'.$id_syllabus) ?>"  ><b>Atrás</b> </a> </li>
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
                <input type="hidden" name="id_ciclo_ficha_eval" id="id_ciclo_ficha_eval" value="<?php echo $data_silabus[0]['id_ciclo']; ?>">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_1" id="id_eval_1" value="<?php echo $ficha_eval_1[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_1" id="ids_competencias_1" value="<?php  if($ficha_eval_1[0]["ids_competencias"] == ''){ echo ''; }else{ echo $ficha_eval_1[0]["ids_competencias"]; } ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                                Actividad Evaluada 1: Evaluación Diagnóstica (Individual) 
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_1" name="semana_eval_1" value="<?php if(isset($ficha_eval_1[0]["semana_eval"])){ echo $ficha_eval_1[0]["semana_eval"];}else{ echo '2'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Diagnóstica</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_1" id="defin_eval_1" cols="30" rows="2"><?php if(isset($ficha_eval_1[0]["defin_eval"])){echo $ficha_eval_1[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_1" id="descrip_eval_1" cols="30" rows="2"><?php if(isset($ficha_eval_1[0]["descrip_eval"])){echo $ficha_eval_1[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_1" id="criterios_eval_1" cols="30" rows="2"><?php if(isset($ficha_eval_1[0]["criterios_eval"]) ){echo $ficha_eval_1[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"   class="form-control" multiple="multiple" id="competencias_1" name="competencias_1[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_1" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               

                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_1" id="coment_eval_1" cols="50" rows="8"><?php if($ficha_eval_1[0]["coment_eval"]!=''){echo $ficha_eval_1[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                              
                                            </div>
                                        </div>       
                                        
                                        
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_2" id="id_eval_2" value="<?php echo $ficha_eval_2[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_2" id="ids_competencias_2" value="<?php  if($ficha_eval_2[0]["ids_competencias"] != ''){ echo $ficha_eval_2[0]["ids_competencias"]; }else{ echo '';} ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                                    Actividad Evaluada 2: Evaluación continua 1 
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_2" name="semana_eval_2" value="<?php if(isset($ficha_eval_2[0]["semana_eval"])){ echo $ficha_eval_2[0]["semana_eval"];}else{ echo '5'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Continua 1</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_2" id="defin_eval_2" cols="30" rows="2"><?php if(isset($ficha_eval_2[0]["defin_eval"])){echo $ficha_eval_2[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_2" id="descrip_eval_2" cols="30" rows="2"><?php if(isset($ficha_eval_2[0]["descrip_eval"])){echo $ficha_eval_2[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_2" id="criterios_eval_2" cols="30" rows="2"><?php if(isset($ficha_eval_2[0]["criterios_eval"]) ){echo $ficha_eval_2[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"  class="form-control" multiple="multiple" id="competencias_2" name="competencias_2[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_2" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               

                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_2" id="coment_eval_2" cols="50" rows="8"><?php if($ficha_eval_2[0]["coment_eval"]!=''){echo $ficha_eval_2[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                              
                                            </div>
                                        </div>            
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>           

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_3" id="id_eval_3" value="<?php echo $ficha_eval_3[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_3" id="ids_competencias_3" value="<?php  if($ficha_eval_3[0]["ids_competencias"] != ''){ echo $ficha_eval_3[0]["ids_competencias"]; }else{ echo '';} ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                            Actividad Evaluada 3: Evaluación Parcial
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_3" name="semana_eval_3" value="<?php if(isset($ficha_eval_3[0]["semana_eval"])){ echo $ficha_eval_3[0]["semana_eval"];}else{ echo '8'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Parcial</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_3" id="defin_eval_3" cols="30" rows="2"><?php if(isset($ficha_eval_3[0]["defin_eval"])){echo $ficha_eval_3[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_3" id="descrip_eval_3" cols="30" rows="2"><?php if(isset($ficha_eval_3[0]["descrip_eval"])){echo $ficha_eval_3[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_3" id="criterios_eval_3" cols="30" rows="2"><?php if(isset($ficha_eval_3[0]["criterios_eval"]) ){echo $ficha_eval_3[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"  class="form-control" multiple="multiple" id="competencias_3" name="competencias_3[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_3" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               

                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_3" id="coment_eval_3" cols="50" rows="8"><?php if($ficha_eval_3[0]["coment_eval"]!=''){echo $ficha_eval_3[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>            
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>

                
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_4" id="id_eval_4" value="<?php echo $ficha_eval_4[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_4" id="ids_competencias_4" value="<?php  if($ficha_eval_4[0]["ids_competencias"] != ''){ echo $ficha_eval_4[0]["ids_competencias"]; }else{ echo '';} ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                            Actividad Evaluada 4: Evaluación continua 2 (Individual)
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_4" name="semana_eval_4" value="<?php if(isset($ficha_eval_4[0]["semana_eval"])){ echo $ficha_eval_4[0]["semana_eval"];}else{ echo '11'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Continua 2</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_4" id="defin_eval_4" cols="30" rows="2"><?php if(isset($ficha_eval_4[0]["defin_eval"])){echo $ficha_eval_4[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_4" id="descrip_eval_4" cols="30" rows="2"><?php if(isset($ficha_eval_4[0]["descrip_eval"])){echo $ficha_eval_4[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_4" id="criterios_eval_4" cols="30" rows="2"><?php if(isset($ficha_eval_4[0]["criterios_eval"]) ){echo $ficha_eval_4[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"  class="form-control" multiple="multiple" id="competencias_4" name="competencias_4[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_4" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               

                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_4" id="coment_eval_4" cols="50" rows="8"><?php if($ficha_eval_4[0]["coment_eval"]!=''){echo $ficha_eval_4[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                              
                                            </div>
                                        </div>             
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
               
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_5" id="id_eval_5" value="<?php echo $ficha_eval_5[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_5" id="ids_competencias_5" value="<?php  if($ficha_eval_5[0]["ids_competencias"] != ''){ echo $ficha_eval_5[0]["ids_competencias"]; }else{ echo '';} ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                                Actividad Evaluada 5: Evaluación continua 3 (Individual)
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_5" name="semana_eval_5" value="<?php if(isset($ficha_eval_5[0]["semana_eval"])){ echo $ficha_eval_5[0]["semana_eval"];}else{ echo '15'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Continua 3</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_5" id="defin_eval_5" cols="30" rows="2"><?php if(isset($ficha_eval_5[0]["defin_eval"])){echo $ficha_eval_5[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_5" id="descrip_eval_5" cols="30" rows="2"><?php if(isset($ficha_eval_5[0]["descrip_eval"])){echo $ficha_eval_5[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_5" id="criterios_eval_5" cols="30" rows="2"><?php if(isset($ficha_eval_5[0]["criterios_eval"]) ){echo $ficha_eval_5[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"  class="form-control" multiple="multiple" id="competencias_5" name="competencias_5[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_5" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               

                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_5" id="coment_eval_5" cols="50" rows="8"><?php if($ficha_eval_5[0]["coment_eval"]!=''){echo $ficha_eval_5[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>              
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                    
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">

                                        <input type="hidden" name="id_eval_6" id="id_eval_6" value="<?php echo $ficha_eval_6[0]["id_ficha_eval"] ?>">
                                        <input type="hidden" name="ids_competencias_6" id="ids_competencias_6" value="<?php  if($ficha_eval_6[0]["ids_competencias"] != ''){ echo $ficha_eval_6[0]["ids_competencias"]; }else{ echo '';} ?>">

                                        <div class="col-md-3 text-center"></div>
                                        <div class="col-md-6 ">
                                            <h4 class="card-title text-center">
                                                Actividad Evaluada 6: Evaluación final 
                                            </h4>
                                        </div>
                                        <div class="col-md-3 text-center"></div>

                                        <div class="col-md-5 text-center"> </div>
                                        <div class="col-md-2 text-center">
                                            Semana <input type="text" disabled class="form-control"    id="semana_eval_6" name="semana_eval_6" value="<?php if(isset($ficha_eval_6[0]["semana_eval"])){ echo $ficha_eval_6[0]["semana_eval"];}else{ echo '16'; ?><?php } ?>">
                                        </div>
                                        <div class="col-md-5 text-center"></div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title">Evaluación Final</h4>                     
                                            <textarea disabled class="form-control" name="defin_eval_6" id="defin_eval_6" cols="30" rows="2"><?php if(isset($ficha_eval_6[0]["defin_eval"])){echo $ficha_eval_6[0]["defin_eval"];}?></textarea>
                                        </div>

                                        <div class="col-md-12 mt-3">
                                            <h4 class="card-title mt-sm-0">Descripción de la actividad </h4>
                                            <textarea disabled class="form-control" name="descrip_eval_6" id="descrip_eval_6" cols="30" rows="2"><?php if(isset($ficha_eval_6[0]["descrip_eval"])){echo $ficha_eval_6[0]["descrip_eval"]; }?></textarea>
                                        </div>

                                        <div class="col-lg-12 mt-3 tbt_main">
                                                    <h4 class="card-title">Criterios de evaluación</h4>
                                                    <h6 class="card-subtitle">
                                                        <textarea disabled class="form-control" name="criterios_eval_6" id="criterios_eval_6" cols="30" rows="2"><?php if(isset($ficha_eval_6[0]["criterios_eval"]) ){echo $ficha_eval_6[0]["criterios_eval"]; }?></textarea>
                                                    </h6>
                                                    <div class="table-responsive">

                                                        <div class="card-body" style="background: #C6D9F1;">
                                                            Competencias: <br>
                                                            <select disabled onChange="Agregar_Competencia(this,this.value)"  class="form-control" multiple="multiple" id="competencias_6" name="competencias_6[]">
                                                            </select>
                                                        </div>
                                                        <div class="card-body  texto" style="background: #C6D9F1;">
                                                        
                                                            
                                                        </div>

                                                        <table id="tbl_6" class="table table-hover table-info" >
                                                            <thead style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                                                                    <th width="25%" scope="col">LOGRADO</th>
                                                                    <th width="25%" scope="col">EN PROCESO</th>
                                                                    <th width="25%" scope="col">NO LOGRADO</th>
                                                                    <th width="5%" scope="col">   
                                                                        
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                            <tfoot style="background: #C6D9F1;" class=" text-dark">
                                                                <tr>
                                                                    <td>Puntaje total</td>
                                                                    <td>16-20</td>
                                                                    <td>13-15,9</td>
                                                                    <td>0-12,9</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                        </div>                               
                                        <div class="col-md-12 mt-3">
                                            <div class="row">

                                                <label class="col-md-12 text-center">Comentarios</label>
                                                <div class="col-md-12">
                                                    <div class="text-center">
                                                        <textarea class="form-control" name="coment_eval_6" id="coment_eval_6" cols="50" rows="8"><?php if($ficha_eval_6[0]["coment_eval"] !=''){echo $ficha_eval_6[0]["coment_eval"];}?></textarea>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>             
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-body-->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->


<script>

        function Insert_Update_comentario(number,thi){
            
            var valor =$('#coment_eval_'+number).val();
            var parametros1 = { 
                "coment_eval": valor,
                "id_ficha_eval":$('#id_eval_'+number).val()
            };

            $.ajax({
                type  : "POST",
                url: url_restapi+'update_comentarios_ficha_eval',
                headers: { "X-API-KEY":api_key},
                data  : parametros1, 
            }).done(function(result) {

                Swal.fire(
                    '¡Datos actualizados!',
                    '',
                    'success'
                ).then(function() {                                  

                });

                                                                    
            }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});                       

        }



        function Listar_ficha_eval(id_ficha_eval,number){

                    var id_ciclo_ficha_eval = $('#id_ciclo_ficha_eval').val() ;
                    var parametros = { "id_ciclo": id_ciclo_ficha_eval };


                    var datos_select='';
                    $.ajax({
                        type  : "POST",
                        url: url_restapi+'lista_compet_asocia_ficha_eval',
                        headers: { "X-API-KEY":api_key},
                        data  : parametros, 
                    })
                    .done(function(data) {
                            var datos_select=data;

                            var htmldata = '';

                            var parametros1 = { "id_ficha_eval": id_ficha_eval};

                            $.ajax({
                                type  : "POST",
                                url: url_restapi+'listar_criterios_eval',
                                headers: { "X-API-KEY":api_key},
                                data  : parametros1, 
                            }).done(function(result) {

                                $(result).each(function(index0, element0) {

                                            var competencias ='<select readonly class="form-control mt-25"> <option value="">Seleccion</option>';    

                                            if( datos_select[0]['competencia_general_1'] != null ){
                                                competencias  += '<option '+(element0['id_compet']==datos_select[0]['compet_gene_uno'] ? 'selected' : '' )+'  value="'+datos_select[0]['compet_gene_uno']+'">'+ datos_select[0]['competencia_general_1'] +'</option>';
                                            }
                                            if( datos_select[0]['competencia_general_2'] != null ){
                                                competencias  += '<option  '+(element0['id_compet']==datos_select[0]['compet_gene_dos'] ? 'selected' : '' )+'  value="'+datos_select[0]['compet_gene_dos']+'">'+ datos_select[0]['competencia_general_2'] +'</option>';
                                            }
                                            if( datos_select[0]['competencia_espec_1'] != null ){
                                                competencias  += '<option  '+(element0['id_compet']==datos_select[0]['compet_espec_uno'] ? 'selected' : '' )+'  value="'+datos_select[0]['compet_espec_uno']+'">'+ datos_select[0]['competencia_espec_1'] +'</option>';
                                            }
                                            if( datos_select[0]['competencia_espec_2'] != null ){
                                                competencias  += '<option  '+(element0['id_compet']==datos_select[0]['compet_espec_dos'] ? 'selected' : '' )+'  value="'+datos_select[0]['compet_espec_dos']+'">'+ datos_select[0]['competencia_espec_2'] +'</option>';
                                            }        
                                            if( datos_select[0]['competencia_espec_3'] != null ){
                                                competencias  += '<option  '+(element0['id_compet']==datos_select[0]['compet_espec_tres'] ? 'selected' : '' )+'  value="'+datos_select[0]['compet_espec_tres']+'">'+ datos_select[0]['competencia_espec_3'] +'</option>';
                                            }

                                            competencias  +='</select>';

                                    htmldata += `
                                            <tr id_criti="${element0['id_criterio_eval']}" id="ln_main" >
                                                <td rowspan=2>${competencias}</td>
                                                <td puntaje="${element0['puntaje_1']}"> <textarea disabled class="form-control" cols="30" rows="2">${element0['logrado']}</textarea> </td>
                                                <td puntaje="${element0['puntaje_2']}"> <textarea disabled class="form-control" cols="30" rows="2">${element0['en_proceso']}</textarea> </td>
                                                <td puntaje="${element0['puntaje_3']}"> <textarea disabled class="form-control" cols="30" rows="2">${element0['no_logrado']}</textarea> </td>
                                                <td rowspan=2> 
                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input placeholder="Puntaje" disabled onkeyup="Puntaje_write(this,1,this.value)" value="${element0['puntaje_1']}"  type="text" class="form-control"></td>
                                                <td> <input placeholder="Puntaje" disabled  onkeyup="Puntaje_write(this,2,this.value)"  value="${element0['puntaje_2']}"  type="text" class="form-control"></td>
                                                <td> <input placeholder="Puntaje" disabled onkeyup="Puntaje_write(this,3,this.value)"  value="${element0['puntaje_3']}"  type="text" class="form-control"></td>
                                            </tr>
                                                `;   
                                });

                                $('#tbl_'+number+' tbody').html(htmldata);


                                                                                    
                            }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});                       

                    }).fail(function(jqXHR, textStatus, errorThrown) {someErrorFunction();}).always(function() {});    

        }

        $(document).ready(function() {
                                    
            setTimeout(function () {
            
                Listar_ficha_eval($('#id_eval_'+1).val(),1);
                Listar_ficha_eval($('#id_eval_'+2).val(),2);
                Listar_ficha_eval($('#id_eval_'+3).val(),3);
                Listar_ficha_eval($('#id_eval_'+4).val(),4);
                Listar_ficha_eval($('#id_eval_'+5).val(),5);
                Listar_ficha_eval($('#id_eval_'+6).val(),6);
                
            }, 1000);

        });

</script>




        <script>
            $(document).ready(function() {

                                   
                        $('#coment_eval_1').summernote('disable'); 
                                                                  
                        $('#coment_eval_2').summernote('disable'); 
                                   
                        $('#coment_eval_3').summernote('disable'); 

                        $('#coment_eval_4').summernote('disable'); 

                        $('#coment_eval_5').summernote('disable'); 
                                        
                        $('#coment_eval_6').summernote('disable'); 

           
                    });
        
        </script>
        
        