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
    <title>Syllabus</title>

        <style>
                /* 1 */
                table {
                width: 100%;
                border: 1px solid black;
                padding: 10px 10px 10px 10px;
                font-size: 10px;
                }
                table thead tr th {
                text-align: left;
                }
                .subtitulo{
                    font-size: 10px;
                    font-weight: 100;
                }
                caption{
                    text-align: left;
                }

                /* 2 */

                .tabla2   {
                   border: 1px solid black;
                    border-collapse: collapse;
                }

                /* 3 */
                #tabla3   {
                    border: 0px solid black !important;
                }

                /* 4 */
                #tabla4   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }

                /* 5 */
                .tabla5   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }

                /* 6 */
                    #tabla6   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }

                /* 7 y _7 */

                #tabla7   {
                    padding: 0px 0px 0px 0px !important;

                }

                #tabla_7   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }
                
                /* 8 */

                /* 9 */
                #tabla9   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }

                /* 10 */
                #tabla10   {
                    border: 0px solid black !important;
                    padding: 0px 0px 0px 0px !important;

                }



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
                    border: 0px solid black !important;

                }

                .mayusculas{
                    text-transform: uppercase;
                }


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


    <?php echo datos_sillabus($id_version_sy,'nombre_syllabus'); ?>   


        <p class="subtitulo" style = "font-size:12px; text-align:left;">SÍLABO <?php  echo datos_sillabus($id_version_sy,'periodo_anio'); ?>-<?php echo datos_sillabus($id_version_sy,'periodo_ciclo'); ?> / <?php echo datos_sillabus($id_version_sy,'nom_tipo_estudios'); ?> </p>
    </h6>

</div>


<div class="container">


    <h5   style = "margin-top: 0px">1.	DATOS GENERALES</h5>
    <table class="border_cero">   
        <tbody>
            <tr>
                <td>         </td>
                <td>         </td>

            </tr>
            <tr>
                <!-- <td> <b>DEPARTAMENTO</b> </td>
                <td>   </td> -->
            </tr>
            <tr>
                <td> <b>CARRERA</b> </td>
                <td> <?php echo datos_sillabus($id_version_sy,'nom_carrera'); ?>  </td>
            </tr>
            <tr>
                <td> <b>CONDICIÓN</b> </td>
                <td>   <?php  echo datos_sillabus($id_version_sy,'nom_curso_importancia'); ?>     </td>
            </tr>
            <tr>
                <td> <b>CRÉDITOS</b> </td>
                <td> <?php echo datos_sillabus($id_version_sy,'creditos'); ?> </td>
            </tr>
            <tr>
                <td> <b>HORAS TOTALES</b> </td>
                <td> <?php echo datos_sillabus($id_version_sy,'horas_totales'); ?>  </td>
            </tr>
            <tr>
                <td> <b>RESPONSABLE DEL CURSO</b> </td>
                <td> <?php echo datos_sillabus($id_version_sy,'nom_director'); ?>  </td>
            </tr>
            <tr>
                <td> <b>DOCENTES</b> </td>
                <td> <?php echo $docentes_text; ?> </td>
            </tr>
            <tr>
                <td> <b>REQUISITOS</b> </td>
                <td> <?php echo $requisitos_text; ?></td>
            </tr>       
        </tbody>
    </table>

    <h5>2.	COMPETENCIAS ASOCIADAS AL CURSO</h5>
    <table  border="1" >
        <thead >
            <tr>
            <th scope="col" colspan="2" style="width: 50%;font-size:15px;text-align:center;"> <b> COMPETENCIA </b> </th>
            <th scope="col" colspan="1" style="width: 50%;font-size:15px;text-align:center;"> DESCRIPCIÓN DEL NIVEL DE COMPETENCIA </th>
            </tr>
        </thead>
        <tbody >
            <tr >
                <td rowspan="2" style = "font-size:13px; text-align:center;" >   <b>General</b> </td>
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_gene"])) ?  $compt_asoci_curso[0]["compt_gene"] :  ''  ?></td>
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_gene_descr"])) ?  $compt_asoci_curso[0]["compt_gene_descr"] :  ''  ?></td>

            </tr>

            <tr >
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_gene_2"])) ?  $compt_asoci_curso[0]["compt_gene_2"] :  ''  ?></td>
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_gene_descr_2"])) ?  $compt_asoci_curso[0]["compt_gene_descr_2"] :  ''  ?></td>

            </tr>

            <tr >
                <td rowspan="3" style = "font-size:13px;text-align:center;">  <b>Específica</b> </td>
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_espec_1"])) ?  $compt_asoci_curso[0]["compt_espec_1"] :  ''  ?></td>
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_espec_descr_1"])) ?  $compt_asoci_curso[0]["compt_espec_descr_1"] :  ''  ?></td>
            </tr>
            <tr >                
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_espec_2"])) ?  $compt_asoci_curso[0]["compt_espec_2"] :  ''  ?></td>
                <td style = "font-size:12.5px"  ><?= (isset($compt_asoci_curso[0]["compt_espec_descr_2"])) ?  $compt_asoci_curso[0]["compt_espec_descr_2"] :  ''  ?></td>

            </tr>

            <tr >                
                <td style = "font-size:12.5px" ><?= (isset($compt_asoci_curso[0]["compt_espec_3"])) ?  $compt_asoci_curso[0]["compt_espec_3"] :  ''  ?></td>
                <td style = "font-size:12.5px"  ><?= (isset($compt_asoci_curso[0]["compt_espec_descr_3"])) ?  $compt_asoci_curso[0]["compt_espec_descr_3"] :  ''  ?></td>

            </tr>

        </tbody>
    </table>

  
    <h5>3.	SUMILLA </h5>

    <table id="tabla3">
       <tr>
            <td>

            <?= (isset($data_silabus[0]["desc_sumilla"])) ?  $data_silabus[0]["desc_sumilla"] :  ''  ?>

            </td>
       </tr>
    </table>

  
  
    <h5>4.	RESULTADO GENERAL DE APRENDIZAJE </h5>
    <table id="tabla4">
       <tr>
            <td>
                   <?= (isset($data_silabus[0]["desc_result_gen_apr"])) ?  $data_silabus[0]["desc_result_gen_apr"] :  ''  ?>            
            </td>
       </tr>
    </table>



    <h5>5.	ORGANIZACIÓN DEL APRENDIZAJE </h5>

        <?php  foreach ($lista_org_aprendizaje as $key => $valor) { ?>
            <table class="tabla5" border="1">

                    <tr>
                        <td>#</td>
                        <td> <?php  echo $valor['modulo_num_orden'];  ?> </td>
                    </tr>
                    <tr>
                        <td>MÓDULO DE APRENDIZAJE </td>
                        <td> <?php  echo $valor['modulo_aprendizaje'];  ?> </td>
                    </tr>

                    <tr>
                        <td>RESULTADO DE APRENDIZAJE</td>
                        <td>  <?php  echo $valor['result_aprendizaje'];  ?>  </td>
                    </tr>

                    <tr>
                        <td>SEMANAS</td>
                        <td>  Semana <?php  echo $valor['semanas_aprendizaje_ini'];  ?>  - Semana <?php  echo $valor['semanas_aprendizaje_fin'];  ?>  </td>
                    </tr>

                    <tr>
                        <td>CONTENIDOS INVOLUCRADOS </td>
                        <td> <?php  echo $valor['conten_aprendizaje'];  ?>   </td>
                    </tr>

            </table>

            <br>

        <?php  } ?>


    <h5>6.	ESTRATEGIAS DIDÁCTICAS </h5>
    <table id="tabla6">
       <tr>
           <td>
           <?= (isset($data_silabus[0]["desc_estrateg_didact"])) ?  $data_silabus[0]["desc_estrateg_didact"] :  ''  ?>

            </td>
       </tr>
    </table>


    <h5>7.	FORMA Y HERRAMIENTAS DE EVALUACIÓN </h5>
    <table id="tabla7" border="1">
        <thead>
            <tr>
            <th scope="col" colspan="1"> <b> EVALUACIÓN </b> </th>
            <th scope="col" colspan="1"> <b> CÓD </b> </th>
            <th scope="col" colspan="1"> <b> DETALLE </b> </th>

            <th scope="col" colspan="1"> <b> SEMANA </b> </th>
            <th scope="col" colspan="1"> <b> PESO </b> </th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Evaluación diagnóstica</td>
                <td>ED</td>
                <td>
                <?= (isset($forma_herrami_eval[0]["eval_diag_detalle"])) ?  $forma_herrami_eval[0]["eval_diag_detalle"] :  ''  ?>
                </td>
                <td>semana <?=  (isset($forma_herrami_eval[0]["eval_diag_sem"])) ? $forma_herrami_eval[0]["eval_diag_sem"] :  '' ?></td>
                <td><?= (isset($forma_herrami_eval[0]["eval_diag_peso"])) ?  $forma_herrami_eval[0]["eval_diag_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación continua 1</td>
                <td>EC1</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont1_detalle"])) ?  $forma_herrami_eval[0]["eval_cont1_detalle"] :  ''  ?></td>
                <td>semana  <?=  (isset($forma_herrami_eval[0]["eval_cont1_sem"])) ? $forma_herrami_eval[0]["eval_cont1_sem"] :  '' ?></td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont1_peso"])) ?  $forma_herrami_eval[0]["eval_cont1_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación continua 2</td>
                <td>EC2</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont2_detalle"])) ?  $forma_herrami_eval[0]["eval_cont2_detalle"] :  ''  ?></td>
                <td>semana <?=  (isset($forma_herrami_eval[0]["eval_cont2_sem"])) ? $forma_herrami_eval[0]["eval_cont2_sem"] :  '' ?> </td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont2_peso"])) ?  $forma_herrami_eval[0]["eval_cont2_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación Parcial</td>
                <td>EP</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_parcial_detalle"])) ?  $forma_herrami_eval[0]["eval_parcial_detalle"] :  ''  ?></td>
                <td>semana  <?=  (isset($forma_herrami_eval[0]["eval_parcial_sem"])) ?  $forma_herrami_eval[0]["eval_parcial_sem"]:  '' ?> </td>
                <td><?= (isset($forma_herrami_eval[0]["eval_parcial_peso"])) ?  $forma_herrami_eval[0]["eval_parcial_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación continua 3</td>
                <td>EC3</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont3_detalle"])) ?  $forma_herrami_eval[0]["eval_cont3_detalle"] :  ''  ?></td>
                <td>semana  <?=  (isset($forma_herrami_eval[0]["eval_cont3_sem"])) ? $forma_herrami_eval[0]["eval_cont3_sem"] :  '' ?></td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont3_peso"])) ?  $forma_herrami_eval[0]["eval_cont3_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación continua 4</td>
                <td>EC4</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont4_detalle"])) ?  $forma_herrami_eval[0]["eval_cont4_detalle"] :  ''  ?></td>
                <td>semana <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? $forma_herrami_eval[0]["eval_cont4_sem"] :  '' ?> </td>
                <td><?= (isset($forma_herrami_eval[0]["eval_cont4_peso"])) ?  $forma_herrami_eval[0]["eval_cont4_peso"] :  ''  ?> %</td>
            </tr>
            <tr>
                <td>Evaluación Final</td>
                <td>EF</td>
                <td><?= (isset($forma_herrami_eval[0]["eval_final_detalle"])) ?  $forma_herrami_eval[0]["eval_final_detalle"] :  ''  ?></td>
                <td>semana <?=  (isset($forma_herrami_eval[0]["eval_cont4_sem"])) ? $forma_herrami_eval[0]["eval_cont4_sem"] :  '' ?></td>
                <td><?= (isset($forma_herrami_eval[0]["eval_final_peso"])) ?  $forma_herrami_eval[0]["eval_final_peso"] :  ''  ?> %</td>
            </tr>
        </tbody>
    </table>

    <table id="tabla_7">
       <tr>
           <td>Donde la fórmula es: </td>
       </tr>
       <tr>
           <td>ED(0.05) + EC1(0.10) + EP(0.20) + EC2(0.15) + EC3(0.30) + EF(0.20) </td>
       </tr>
       <tr>
            <td> Todas las evaluaciones se realizan, a través de las siguientes plataformas: Zoom y Aula Virtual Moodle</td>
       </tr>
    </table>


    <h5>8.	ACTIVIDADES PRINCIPALES</h5>

    <?php  foreach ($modulos as $key => $valor) { ?>

        <table  border="1" >
            <?php  if ($key == 0) { ?>
            <caption style="font-size:11px;text-align:left;" >El curso se desarrollará a través de actividades sincrónicas mediante el sistema de videoconferencias.</caption>
            <?php  } ?>

            
            <thead >
                <tr>
                    <th scope="col" colspan="4" style="width: 5%;font-size:15px;text-align:center;">  <?php  echo  'Nombre de Módulo: '.$valor['groupeddata'][0]['modulo_aprendizaje'];  ?>  </th>
                    <th scope="col" colspan="2" style="width: 60%;font-size:15px;text-align:center;"> ACTIVIDADES PRINCIPALES </th>
                </tr>
                <tr>
                    <th scope="col" colspan="1" style="width: 5%;font-size:15px;text-align:center;"> <b> MÓDULO </br> DE </br> APRENDIZAJE </b> </th>
                    <th scope="col" colspan="1" style="width: 5%;font-size:15px;text-align:center;"> SEMANA </th>
                    <th scope="col" colspan="1" style="width: 5%;font-size:15px;text-align:center;"> SESIÓN </th>
                    <th scope="col" colspan="1" style="width: 25%;font-size:15px;text-align:center;"> TEMAS </th>
                    <th scope="col" colspan="1" style="width: 30%;font-size:15px;text-align:center;"> ACTIVIDADES EN INTERACCIÓN CON EL DOCENTE (Aprendizaje sincrónico: Zoom) </th>
                    <th scope="col" colspan="1" style="width: 30%;font-size:15px;text-align:center;"> ACTIVIDADES DE TRABAJO AUTÓNOMO (Aprendizaje asincrónico: Aula Virtual) </th>
                </tr>
            </thead>
            <tbody >

                    <tr>
                        <td  style = "font-size:12.5px; text-align: center;"   rowspan="<?php echo  count($valor['groupeddata']); ?>" >
                            <?php   echo 'N° '.$valor['num_modulo'];   ?> 
                        </td>
                        <td style = "font-size:12.5px;text-align:center;" > <?php  echo $valor['groupeddata'][0]['num_semana'];  ?>   </td>
                        <td style = "font-size:12.5px;text-align:center;" > <?php  echo $valor['groupeddata'][0]['num_sesion'];   ?>  </td>
                        <td style = "font-size:12.5px;text-align:center;" > <?php  echo $valor['groupeddata'][0]['desc_tema'];  ?>  </td>
                        <td style = "font-size:12.5px;text-align:center;" > <?php  echo $valor['groupeddata'][0]['descr_iteracc_docente'];   ?> </td>
                        <td style = "font-size:12.5px;text-align:center;" > <?php  echo $valor['groupeddata'][0]['descr_trabajo_autor'];  ?>  </td>

                    </tr>


                <?php  foreach ($valor['groupeddata'] as $key => $filas) { ?>

                    <?php    if($key != 0) { ?>
                        <tr>

                            <td style = "font-size:12.5px;text-align:center;" > <?php  echo $filas['num_semana'];  ?>   </td>
                            <td style = "font-size:12.5px;text-align:center;" > <?php  echo $filas['num_sesion'];  ?>  </td>
                            <td style = "font-size:12.5px;text-align:center;" > <?php  echo $filas['desc_tema'];  ?>  </td>
                            <td style = "font-size:12.5px;text-align:center;" > <?php  echo $filas['descr_iteracc_docente'];  ?> </td>
                            <td style = "font-size:12.5px;text-align:center;" > <?php  echo $filas['descr_trabajo_autor'];  ?>  </td>

                        </tr>
                    <?php  } ?>

                <?php  } ?>

            </tbody>
        </table>

    <?php  } ?>






    <h5>9.	PLATAFORMAS Y HERRAMIENTAS</h5>
    <table id="tabla9">
            <tr>
                <td>
                    •	Plataforma Zoom: Plataforma online utilizada por la Universidad, que permite realizar videoconferencia, chat y pantalla compartida, entre otras opciones. Tiene almacenamiento de grabación en la nube.
                </td>
            </tr>
            <tr>
                <td>
                •	Plataforma Aula Virtual Moodle: Plataforma de gestión de aprendizaje usada en la Universidad para la publicación de materiales y actividades de aprendizaje online.
                </td>
            </tr>
       <?php  foreach ($plataforma_herramienta as $key => $valor) { ?>

            <tr>
                <td>
                    <?php if($key == 0) { ?>

                        •	Herramientas: <?php  echo  $valor['nom_plataformas_herramientas'] ; ?>         
                    <?php }else{ ?>

                    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <?php  echo  $valor['nom_plataformas_herramientas'] ; ?>         
                    <?php  } ?>

                </td>
            </tr>

        <?php  } ?>


     
    </table>


                    </br>
                    </br>
                    </br>
                    </br>  </br>
                    </br>

    <h5>10.	REFERENCIAS BIBLIOGRÁFICAS</h5>
    <table id="tabla10">
       <tr style = "font-size:13px; text-align:center;">
           <th >OBLIGATORIAS</th>
        </tr>

        <?php  foreach ($biblio_obliga as $key => $valor) { ?>
        
            <tr>
                <td> 
                    <?php  echo $valor['nom_referencias_bibliograficas'] ; ?>
                </td>
            </tr>

        <?php  } ?>
        <tr >
            <th >  </th>
        </tr>
        <tr >
            <th >  </th>
        </tr>
        <tr >
            <th >  </th>
        </tr>
        <tr >
            <th >  </th>
        </tr> 
        <tr >
            <th >  </th>
        </tr>
           
        <tr style = "font-size:13px; text-align:center;">
            <th >DE CONSULTA</th>
        </tr>

        <?php  foreach ($biblio_consult as $key => $valor) { ?>
        
            <tr>
                <td> 
                    <?php  echo $valor['nom_referencias_bibliograficas'] ; ?>
                </td>
            </tr>

        <?php  } ?>

    </table>
    

</div>
  
</body>
</html>