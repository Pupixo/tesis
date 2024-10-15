<?php 
$sesion =  "eee";
//$rol = $_SESSION['usuario'][0]['ROLASISTENCIA'];
// $id_version_sy;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>public/web/img/logo_.png">
    <title>Ficha de Evaluación</title>
        <style>
                /* 1 */
               
                /* */
                .imagen_header {
                    display: block;
                    margin-left: 0;
                    margin-right: auto;
                    width: 230px;
                    height: 150px;
                    margin-top: 0;
                    margin-bottom: 0;


                }
                .todo_ancho{
                    width: 100%;
                }
                .border_cero   {
                    border: 0px solid #ff0000 !important;

                }

                .mayusculas{
                    text-transform: uppercase;
                } */


        </style>
</head>
<body>
  
<htmlpageheader name="MyHeader1">
    <div style="text-align: right">
        <img class="imagen_header" src="<?= base_url() ?>public/web/img/logo_univer.png" alt="ucsur">
    </div>

</htmlpageheader>

<htmlpagefooter name="MyFooter1">
    <table width="100%" class="border_cero">
        <tr>
            <!-- <td width="33%"><span style="font-weight: bold; font-style: italic;">{DATE j-m-Y}</span></td> -->
            <td width="100%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td>
        </tr>
    </table>
</htmlpagefooter>


<sethtmlpageheader name="MyHeader1" value="on" show-this-page="1" />
<sethtmlpagefooter name="MyFooter1" value="on" />




<div class="container"  style = "width: 450px">
    <h6 class="mayusculas" style = "font-size:18px; text-align:left;margin-bottom: 0px " >

    <!-- <?php echo datos_sillabus($id_version_sy,'nombre_syllabus'); ?>    -->
    <?php echo datos_sillabus($id_version_sy,'nom_curso'); ?>


    <p class="subtitulo" style = "font-size:12px; text-align:left;">Ficha de Evaluación <?php  echo datos_sillabus($id_version_sy,'periodo_anio'); ?>-<?php echo datos_sillabus($id_version_sy,'periodo_ciclo'); ?>  / <?php  echo datos_sillabus($id_version_sy,'nom_tipo_estudios'); ?> </p>
    </h6>

</div>



<div class="container">


    <!-- font-size: 20px; -->
    <h3 style="width: 100%; text-align: center;" > Actividad Evaluada 1: Evaluación Diagnóstica  </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_1[0]['semana_eval']; ?>  </b>  </h3> 
    <table id="tabla1" > <tr><td>Evaluación Diagnóstica</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_1[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_1[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_1[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_1; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_1 as $key => $valor) { ?>                           
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>    
    <br>
    <br>

    <h3 style="width: 100%; text-align: center;" >  Actividad Evaluada 2: Evaluación continua 1 (Individual)  </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_2[0]['semana_eval']; ?>  </b>  </h3> 
    <table id="tabla1" > <tr><td>Evaluación Continua 1</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_2[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_2[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_2[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_2; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_2 as $key => $valor) { ?>                      
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>
    <br>
    <br>


    <h3 style="width: 100%; text-align: center;" >  Actividad Evaluada 3: Evaluación Parcial (Grupal)   </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_3[0]['semana_eval']; ?>  </b>  </h3> 
    <table id="tabla1" > <tr><td>Evaluación Parcial</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_3[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_3[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_3[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_3; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_3 as $key => $valor) { ?>                      
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>
    <br>
    <br>

    

    <h3 style="width: 100%; text-align: center;" >Actividad Evaluada 4: Evaluación continua 2 (Individual)   </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_4[0]['semana_eval']; ?>  </b>  </h3> 
    <table id="tabla1" > <tr><td>Evaluación Continua 2</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_4[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_4[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_4[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_4; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_4 as $key => $valor) { ?>                      
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>
    <br>
    <br>

    
    <h3 style="width: 100%; text-align: center;" >Actividad Evaluada 5: Evaluación continua 3 (Individual)    </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_5[0]['semana_eval']; ?>  </b>  </h3> 
    <table id="tabla1" > <tr><td>Evaluación Continua 3</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_5[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_5[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_5[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_5; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_5 as $key => $valor) { ?>                      
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>
    <br>
    <br>

       
    <h3 style="width: 100%; text-align: center;" >Actividad Evaluada 6: Evaluación final (Individual)    </h3>  </br> 
    <h3 style="width: 100%;color: #A5A09F;text-align: center;"> <b  > <?php  echo 'Semana '.$ficha_eval_6[0]['semana_eval']; ?>  </b>  </h3> 



    <table id="tabla1" > <tr><td>Evaluación Final</td> </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_6[0]['defin_eval']; ?> </td></tr></table>
    <table id="tabla1" >  <tr> <td> Descripción de la actividad </td>  </tr> </table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_6[0]['descrip_eval']; ?></td></tr></table>
    <table id="tabla1" ><tr><td> Criterios de evaluación </td></tr></table>
    <table width="100%" id="tabla1" border="1" > <tr><td><?php  echo $ficha_eval_6[0]['criterios_eval']; ?></td></tr> </table>
    <br>
    <table style="background: #C6D9F1;" width="100%" id="tabla1" border="1" > <tr><td>  <b>COMPETENCIA (S):</b> </td> </tr> <tr><td><?php  echo $competencias_text_6; ?></td></tr> </table>
    <!-- .. -->
    <table id="tbl_1" border="1"  style="background: #C6D9F1;" >
            <thead>
                <tr>
                    <th width="25%" scope="col">CRITERIO A EVALUAR</th>
                    <th width="25%" scope="col">LOGRADO</th>
                    <th width="25%" scope="col">EN PROCESO</th>
                    <th width="25%" scope="col">NO LOGRADO</th>
                </tr>
            </thead>
            <tbody>
                    <?php  foreach ($listar_criterio_6 as $key => $valor) { ?>                      
                        <tr>
                            <td rowspan="2">
                            <?php  echo $valor['nom_compet']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['logrado']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['en_proceso']; ?> 
                            </td>
                            <td>
                            <?php  echo $valor['no_logrado']; ?> 
                            </td>
                           
                        </tr>
                        <tr>
                            <td> 
                            <?php  echo $valor['puntaje_1']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_2']; ?> 
                            </td>
                            <td> 
                            <?php  echo $valor['puntaje_3']; ?> 
                            </td>
                        </tr>    
                    <?php  } ?>
            </tbody>
            <tfoot class=" text-dark">
                    <tr>
                        <td>Puntaje total</td>
                        <td>16-20</td>
                        <td>13-15,9</td>
                        <td>0-12,9</td>
                    </tr>
            </tfoot>
    </table>
    <br>
    <br>
</div>
  
</body>
</html>