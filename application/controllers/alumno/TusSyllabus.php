<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TusSyllabus extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Tus Syllabus';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Tus Syllabus';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Tus Syllabus ';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_tussyllabus';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'TusSyllabus';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'alumno/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->url_carpeta       = 'alumno/usuarios/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->abrev             = 'tussyllabus'; 
              
        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Admin_model');
        $this->load->model('Model_Syllabus');

        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->helper('download');
        $this->load->helper('form');
    }

    protected function jsonResponse($respuesta = array()) {
        $status = 200; // SUCCESS
        if (empty($respuesta)) {
            //$status = 400; // FAILURE
            $respuesta = array(
            'success' => false,
            'mensaje' => 'No hay nada'
            );
        }
        return $this->output
        ->set_content_type('application/json;charset=utf-8')
        ->set_status_header($status)
        ->set_output(json_encode($respuesta, JSON_UNESCAPED_UNICODE));
    }
    
    public function index()
    {
        if ($this->session->userdata('usuario')) {
            $datos   = obtenerDatosIndexNuevo($this);       
            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'index', $datos);
        }else{
            redirect('/login');
        }
    } 



    function cargar_tabla_tussyllabus($param,$paramdos){
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');
                $parametros = array(
                    'vACCION'        =>'LISTAR_SYLLABUS_CICLO',
                    'vID_SYLLABUS'         => '',
                    'vID_FACULTAD'       => '',
                    'vNOMBRE_SYLLABUS'     => '',
                    'vPERIODO_ANIO' => '',
                    'vPERIODO_CICLO' => $param,
                    'vID_DEPART_UNIVER'    => '',
                    'vID_CARRERA' => '',
                    'vID_CONDICION' => '',
                    'vCREDITOS' => '',
                    'vHORAS_TEORICAS' => '',
                    'vHORAS_PRACTICAS' => '',
                    'vID_DIRECTOR' => '',
                    'vID_DOCENTE' => '',
                    'vID_CURSO' => '',
                    'vID_PLAN_ESTUDIOS' => $paramdos,
                    'vREQUISITO' => '',
                    'vESTADO' => '',
                    'vID_USUARIO' => '',
                    'vNOM_CICLO' => '',
                    'vPRESENCIALIDAD' => '',
                    'vTIPOCICLO' => '',
                    'vTOTALHORAS' => '',
                    'vCICLOS' => '',
                    'vID_TIPO_ESTUDIOS' => '',
                    'vID_VERSION_PRINCIPAL' => '',
                    'vID_ASIGNACION_CURSO' => '',
                    'vID_USUARIO_ASIG' => ''
                );

            $data = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            // print_r($data);

            // exit();

                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {
                           
                            $estado = "<span class='".($row['estado'] == 1 ? 'pending':($row['estado'] == 2 ? 'accept':'reject' ))."'>".$row['nom_est_syllabus']."</span>";

                            $botones = "<center>"   
                                            . "<div class='btn-group' role='group' aria-label='' style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;width:0%; justify-content: flex-end;'>"

                                                    ."<div class='btn-group' >"
                                                    . "<a href='". site_url('admin/usuarios/Asyllabus/Asyllabus_pdf/'. $row['id_syllabus'] ) ."' target='_blank' id='verpdf_".$this->opcion."' type='button' class='btn bg-danger rueda_pdf ' style='width: auto'>"
                                                        . "<span  class='fas fa-file-pdf'></span>"
                                                    . "</a>"
                                                    ."</div>"     
                                                    
                                                    ."<div class='btn-group' >"
                                                    . "<a title='Ficha de Evalacuaci�n PDF' href='". site_url($this->url.$this->opcion.'/Ficha_eval_pdf/'. $row['id_syllabus'] ) ."' target='_blank' id='verpdf_ficha_".$this->opcion."' type='button' class='btn bg-cyan rueda_pdf_ficha ' style='width: auto'>"
                                                        . "<span  class='fas fa-file-pdf'></span>"
                                                    . "</a>"
                                                    ."</div>";
                                               

                                            $botones .="</div>"
                                        ."</center>";

                            $periodo = $row['periodo_anio'] .'-'.$row['periodo_ciclo'] ;
                    
                            $texto .= '{"ID_SILABUS":' . json_encode($row['id_syllabus']) . ','
                                . '"ID_FACULTAD":' . json_encode($row['id_facultad']) . ','
                                . '"NOMBRE_SILABUS":' .  json_encode($row['nombre_syllabus'])  . ','
                                . '"NOM_CURSO"                 :' . json_encode($row['nom_curso'])  . ','

                                . '"NOM_CICLO"                 :' . json_encode($row['nom_ciclo'])  . ','
                                . '"PERIODO":' . json_encode($periodo) . ','

                                . '"PERIODO_ANIO":' .  json_encode($row['periodo_anio'])  . ','
                                . '"PERIODO_CICLO":' .  json_encode($row['periodo_ciclo'])  . ','

                                . '"ID_DEPART_UNIVER":' .  json_encode($row['id_depart_univer'])  . ','
                                . '"ID_CARRERA":' .  json_encode($row['id_carrera'])  . ','
                                . '"ID_CONDICION":' .  json_encode($row['id_condicion'])  . ','
                                . '"CREDITOS":' .  json_encode($row['creditos'])  . ','
                                . '"HORAS_TEORICAS":' .  json_encode($row['horas_teoricas'])  . ','
                                . '"HORAS_PRACTICAS":' .  json_encode($row['horas_practicas'])  . ','
                                . '"ID_DIRECTOR":' .  json_encode($row['id_director'])  . ','
                                . '"ID_DOCENTE":' .  json_encode($row['id_docente'])  . ','
                                . '"ID_CURSO":' .  json_encode($row['id_curso'])  . ','
                                . '"ID_PLAN_ESTUDIOS":' .  json_encode($row['id_plan_estudios'])  . ','
                                . '"REQUISITO":' .  json_encode($row['requisito'])  . ','
                                . '"ESTADO":' .  json_encode($row['estado'])  . ','
                                . '"DURACION":"' .  $duracion_html  . '",'
                                . '"USER_REG":' .  json_encode($row['user_reg'])  . ','
                                . '"FEC_ACT":' .  json_encode($row['fec_act'])  . ','
                                . '"USER_ACT":' .  json_encode($row['user_act'])  . ','
                                
                                . '"ESTADO_SILABUS_HTML":"' .  $estado . '",'
                                
                                . '"ACCION"                 :"' . $botones . '",'
                                . '"VERSION_PRINCIPAL"                 :' . json_encode($row['version_principal'])  . ','
                                . '"FECHA_REG"                 :' . json_encode($row['fec_reg'])  . '},';




                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
           
    }
    /***********************************************************/


    public function Ficha_eval_pdf($id_syllabus){
        if ($this->session->userdata('usuario')) {
        
            $data_pdf['id_syllabus'] = $id_syllabus;

            
            $accion = 'LISTAR_SYLLABUS_ID';
        

            $parametros = array(
                $accion,
                $id_syllabus,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                ''
            );
        
            $data_pdf["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            // echo '<pre>';
            // print_r($data_pdf["data_silabus"][0]);
            // echo '</pre>';

            // exit();
            $data_pdf['id_version_sy'] = $data_pdf["data_silabus"][0]['version_principal'];

            
            $data_pdf["ficha_eval_1"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],1);
            $data_pdf["listar_criterio_1"] =$this->contenedor->listar_criterio($data_pdf["ficha_eval_1"][0]['id_ficha_eval']);

            if( $data_pdf["ficha_eval_1"][0]['ids_competencias'] !=''){

                $ids_competencias_1 = explode(",", $data_pdf["ficha_eval_1"][0]['ids_competencias'] );
                $fila_1 = array();
                foreach($ids_competencias_1 as $key => $valor) {
                    $porciones = explode("-", $valor);
                    $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                    array_push($fila_1,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
                }
                $commp_uno   = implode(",", $fila_1);                        
                $data_pdf['competencias_text_1'] = $commp_uno;
            }else{
                $data_pdf['competencias_text_1'] = '';
            }


            $data_pdf["ficha_eval_2"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],2);
            $data_pdf["listar_criterio_2"]  =$this->contenedor->listar_criterio($data_pdf["ficha_eval_2"][0]['id_ficha_eval']);

            if( $data_pdf["ficha_eval_2"][0]['ids_competencias'] !=''){

            $ids_competencias_2 = explode(",", $data_pdf["ficha_eval_2"][0]['ids_competencias'] );
            $fila_2 = array();
            foreach($ids_competencias_2 as $key => $valor) {
                $porciones = explode("-", $valor);
                $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                array_push($fila_2,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
            }
            $commp_uno   = implode(",", $fila_2);                        
            $data_pdf['competencias_text_2'] = $commp_uno;
            }else{
                $data_pdf['competencias_text_2'] = '';
            }
            


            $data_pdf["ficha_eval_3"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],3);
            $data_pdf["listar_criterio_3"]  =$this->contenedor->listar_criterio($data_pdf["ficha_eval_3"][0]['id_ficha_eval']);

            if( $data_pdf["ficha_eval_3"][0]['ids_competencias'] !=''){
                    $ids_competencias_3 = explode(",", $data_pdf["ficha_eval_3"][0]['ids_competencias'] );
                    $fila_3 = array();
                    foreach($ids_competencias_3 as $key => $valor) {
                        $porciones = explode("-", $valor);
                        $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                        array_push($fila_3,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
                    }
                    $commp_uno   = implode(",", $fila_3);                        
                    $data_pdf['competencias_text_3'] = $commp_uno;
            }else{
                    $data_pdf['competencias_text_3'] = '';
            }
        



            $data_pdf["ficha_eval_4"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],4);
            $data_pdf["listar_criterio_4"]  =$this->contenedor->listar_criterio($data_pdf["ficha_eval_4"][0]['id_ficha_eval']);

                if( $data_pdf["ficha_eval_4"][0]['ids_competencias'] !=''){

                            $ids_competencias_4 = explode(",", $data_pdf["ficha_eval_4"][0]['ids_competencias'] );
                            $fila_4 = array();
                            foreach($ids_competencias_4 as $key => $valor) {
                                $porciones = explode("-", $valor);
                                $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                                array_push($fila_4,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
                            }
                            $commp_uno   = implode(",", $fila_4);                        
                            $data_pdf['competencias_text_4'] = $commp_uno;
                }else{
                        $data_pdf['competencias_text_4'] = '';
                }


            $data_pdf["ficha_eval_5"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],5);
            $data_pdf["listar_criterio_5"]  =$this->contenedor->listar_criterio($data_pdf["ficha_eval_5"][0]['id_ficha_eval']);

                if( $data_pdf["ficha_eval_5"][0]['ids_competencias'] !=''){

                    $ids_competencias_5 = explode(",", $data_pdf["ficha_eval_5"][0]['ids_competencias'] );
                    $fila_5 = array();
                    foreach($ids_competencias_5 as $key => $valor) {
                        $porciones = explode("-", $valor);
                        $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                        array_push($fila_5,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
                    }
                    $commp_uno   = implode(",", $fila_5);                        
                    $data_pdf['competencias_text_5'] = $commp_uno;
                }else{
                    $data_pdf['competencias_text_5'] = '';
                }


            $data_pdf["ficha_eval_6"] = $this->Model_Syllabus->listar_ficha_eval($data_pdf["data_silabus"][0]['version_principal'],6);
            $data_pdf["listar_criterio_6"]  =$this->contenedor->listar_criterio($data_pdf["ficha_eval_6"][0]['id_ficha_eval']);

            if( $data_pdf["ficha_eval_6"][0]['ids_competencias'] !=''){

                    $ids_competencias_6 = explode(",", $data_pdf["ficha_eval_6"][0]['ids_competencias'] );
                    $fila_6 = array();
                    foreach($ids_competencias_6 as $key => $valor) {
                        $porciones = explode("-", $valor);
                        $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
                        array_push($fila_6,'<b>'.$fila[0]['nom_compet']. ':</b> '.$fila[0]['nivel_text'].'</br>' );
                    }
                    $commp_uno   = implode(",", $fila_6);                        
                    $data_pdf['competencias_text_6'] = $commp_uno;
            }else{
                $data_pdf['competencias_text_6'] = '';
            }

            // echo '<pre>';
            // print_r($data_pdf);
            // echo '</pre>';
            // exit();

            $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $mpdf = new \Mpdf\Mpdf([
                    'frutiger' => [
                        'R' => 'Frutiger-Normal.ttf',
                        'I' => 'FrutigerObl-Normal.ttf',
                    ]
            ]);

            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->setAutoBottomMargin = 'stretch';

            $html = $this->load->view('admin/asyllabus/pdf/ficha_eval.php',$data_pdf,true);
        
            $mpdf->WriteHTML($html);

            $mpdf->SetDisplayMode('fullpage');
            $mpdf->list_indent_first_level = 0; 

            $mpdf->SetWatermarkText('');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.1;


            $mpdf->Output();

        }
        else{
            redirect('/login');
        }        
    }



}