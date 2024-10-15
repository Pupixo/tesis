<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Asyllabus extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo Administrador ::  Syllabus';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Syllabus';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Syllabus';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_asyllabus';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Asyllabus';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/usuarios/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'asyllabus';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/asyllabus/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        //php mailer datos
        // $this->CharSet       = 'utf-8';
        // $this->SMTPDebug       = 0;
        // $this->Host       = 'smtp.gmail.com'; 
        // $this->SMTPAuth       =  true; 
        // $this->Username       = 'pupixoxd@gmail.com';  
        // $this->Password       = 'ppufozjajyxavcpk';  
        $this->SMTPSecure     = 'tls'; 
        $this->Port       = 587;


            //php mailer datos
            $this->CharSet       = 'utf-8';
            // $this->SMTPDebug       = SMTP::DEBUG_SERVER; 
            $this->SMTPDebug       = 2;

            // $this->Host       = 'smtp.gmail.com'; 

            // $this->Host       = 'smtp-mail.outlook.com';                // Specify Outlook's SMTP server
            $this->Host ='smtp.office365.com'; // servidor outlook

            $this->SMTPAuth       =  true; 
            $this->Username       = 'acuario_16_sp@hotmail.com';  
            // $this->Password       = 'ulnwjgfxlqfdafel';  
            
            $this->Password       = 'ap2XAfuqUt';  

            // $this->SMTPSecure     = PHPMailer::ENCRYPTION_SMTPS; 
            // $this->SMTPSecure = "ssl";
    
            // $this->Port       = 465;


        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Model_Syllabus');
        $this->load->model('Model_Cursos');

        $this->load->library(array('session'));
        $this->load->helper(array('url'));
        $this->load->helper('download');
        $this->load->helper('form');
        $this->load->library("parser");
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
        }else{            redirect('/login');}
    }

    function cargar_tabla_asyllabus($param=null){
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

                if($_SESSION['usuario'][0]['id_nivel'] == 3){
                    $accion_text='LISTAR_SYLLABUS_USER';
                    $accion_text_esta='LISTAR_SYLLABUS_POR_ESTADOS_USER';
                }else{
                    $accion_text='LISTAR_SYLLABUS';
                    $accion_text_esta='LISTAR_SYLLABUS_POR_ESTADOS';
                }


                $parametros = array(
                    'vACCION'        =>$accion_text,
                    'vID_SYLLABUS'         => '',
                    'vID_FACULTAD'       => '',
                    'vNOMBRE_SYLLABUS'     => '',
                    'vPERIODO_ANIO' => '',
                    'vPERIODO_CICLO' => '',
                    'vID_DEPART_UNIVER'    => '',
                    'vID_CARRERA' => '',
                    'vID_CONDICION' => '',
                    'vCREDITOS' => '',
                    'vHORAS_TEORICAS' => '',
                    'vHORAS_PRACTICAS' => '',
                    'vID_DIRECTOR' => '',
                    'vID_DOCENTE' => '',
                    'vID_CURSO' => '',
                    'vID_PLAN_ESTUDIOS' => '',
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
                    'vID_ASIGNACION_CURSO'=> '',
                    'vID_USUARIO_ASIG'=> $_SESSION['usuario'][0]['id_usuario'],
                );

            if($param == 0){
            
            }else{
                $parametros['vACCION']=  $accion_text_esta;     
                $parametros['vESTADO']= $param;    
            }
                   
            $data = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {
                           
                            $estado = "<span class='".($row['estado'] == 1 ? 'pending':($row['estado'] == 2 ? 'accept':'reject' ))."'>".$row['nom_est_syllabus']."</span>";


                                $date1 = new DateTime($row['fecha_reg_version']);
                                $date2 = new DateTime($row['fech_aprob']);
                                $diff = $date1->diff($date2);
                                $fech_diferencia = formato_resta($diff);

                            $duracion_html= $fech_diferencia;

                            $botones = "<center >"   
                                            . "<div class='btn-group' role='group' aria-label='' style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px; justify-content: flex-end;'>"

                                                    ."<div class='btn-group' >"
                                                    . "<a  title='Syllabus PDF' href='". site_url($this->url.$this->opcion.'/Asyllabus_pdf/'. $row['id_syllabus'] ) ."' target='_blank' id='verpdf_".$this->opcion."' type='button' class='btn bg-danger rueda_pdf ' style='width: auto'>"
                                                        . "<span  class='fas fa-file-pdf'></span>"
                                                    . "</a>"
                                                    ."</div>"

                                                    ."<div class='btn-group' >"
                                                    . "<a title='Ficha de Evalacuación PDF' href='". site_url($this->url.$this->opcion.'/Ficha_eval_pdf/'. $row['id_syllabus'] ) ."' target='_blank' id='verpdf_ficha_".$this->opcion."' type='button' class='btn bg-cyan rueda_pdf_ficha ' style='width: auto'>"
                                                        . "<span  class='fas fa-file-pdf'></span>"
                                                    . "</a>"
                                                    ."</div>";

                                                    if($_SESSION['usuario'][0]['id_nivel'] == 4   ){


                                                        if($row['estado']!=2){
                                                            $botones .="<div class='btn-group' >"
                                                            . "<a type='button'  title='Cambiar Estado'  onclick='Cambiar_Estado_".$this->opcion."(".$row['id_syllabus'].",".$row['version_principal'].")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                                . "<span  class='fas fa-sync-alt'>"
                                                            . "</a>"
                                                            ."</div>";
                                                        }
                                                        

                                                            $botones .="<div class='btn-group' >"
                                                            . "<a title='Resumen de syllabus'   href='". site_url($this->url.$this->opcion.'/Asyllabus_resumen/'. $row['id_syllabus'] ) ."' target='_blank' id='verperfil_".$this->opcion."' type='button' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                                . "<span  class='far fa-id-badge'>"
                                                            . "</a>"
                                                            ."</div>";

                                                      

                                                    }else if($_SESSION['usuario'][0]['id_nivel'] == 3){

                                                        $botones .="<div class='btn-group' >"
                                                        . "<a  title='Resumen de syllabus'   href='". site_url($this->url.$this->opcion.'/Asyllabus_resumen/'. $row['id_syllabus'] ) ."' target='_blank' id='verperfil_".$this->opcion."' type='button' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                            . "<span  class='far fa-id-badge'>"
                                                        . "</a>"
                                                        ."</div>";

                                                    }else if($_SESSION['usuario'][0]['id_nivel'] == 1){

                                                        $botones .="<div class='btn-group' >"
                                                        . "<a type='button'  title='Cambiar Estado' onclick='Cambiar_Estado_".$this->opcion."(".$row['id_syllabus'].",".$row['version_principal'].")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                            . "<span  class='fas fa-sync-alt'>"
                                                        . "</a>"
                                                        ."</div>";

                                                        $botones .="<div class='btn-group' >"
                                                        . "<a   title='Resumen de syllabus'   href='". site_url($this->url.$this->opcion.'/Asyllabus_resumen/'. $row['id_syllabus'] ) ."' target='_blank' id='verperfil_".$this->opcion."' type='button' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                            . "<span  class='far fa-id-badge'>"
                                                        . "</a>"
                                                        ."</div>";

                                                    }else{}     

                                                    if($_SESSION['usuario'][0]['id_nivel'] == 4  ){
                                                     
                                                    }else if($_SESSION['usuario'][0]['id_nivel'] == 3) {
                                                     
                                                    }else{

                                                        $botones .="<div class='btn-group' role='group' >"
                                                            
                                                                . "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
                                                                    . "<span  class='fa fa-gear'></span>"
                                                                . "</button>"
                                                            
                                                                . "<div  style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;' class='dropdown-menu rueda-accion color-0' aria-labelledby='btnGroupDrop".$this->opcion."'>"
                                                            
                                                                                ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_syllabus'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"  	
                                                                                ."<span>"
                                                                                ." <svg xmlns='http://www.w3.org/2000/svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                                                ."Editar Fila</span>"
                                                                                ."</a>"

                                                                                ."<a style='cursor: pointer;' onclick='Eliminar_".$this->opcion."(".$row['id_syllabus'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                                                ."<span>"
                                                                                ." <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                                                ."Eliminar Fila</span>"
                                                                                ."</a>"
                                                                . "</div>"
                                                            ."</div>";
                                                            
                                                    }


                                            $botones .="</div></center>";

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

    public function Seleccionar_compt_aso($id_ciclo,$id_version_sy,$user_reg,$accion,$id_compt_asoci_curso='',$id_curso){
            $data_compt_det= $this->Model_Syllabus->listar_compet_detalle($id_ciclo);  
            
            
            if(!empty($data_compt_det)){

                $data_diccion = array();
                if($data_compt_det[0]['compet_gene_uno']== 0 || $data_compt_det[0]['compet_gene_nivel_uno'] === ''){
                    $data_diccion['general_uno']= array();
                }else{
                    $data_diccion['general_uno']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_gene_uno'],$data_compt_det[0]['compet_gene_nivel_uno']);
                }
                if($data_compt_det[0]['compet_gene_dos']== 0 ||$data_compt_det[0]['compet_gene_nivel_dos']=== ''){
                    $data_diccion['general_dos']= array();
                }else{
                    $data_diccion['general_dos']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_gene_dos'],$data_compt_det[0]['compet_gene_nivel_dos']);    
                }
                if($data_compt_det[0]['compet_espec_uno']== 0 || $data_compt_det[0]['compet_espec_nivel_uno']=== ''){
                    $data_diccion['especif_dos']= array();
                }else{
                    $data_diccion['especif_uno']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_espec_uno'],$data_compt_det[0]['compet_espec_nivel_uno']);    
                }
                if( $data_compt_det[0]['compet_espec_dos']== 0  || $data_compt_det[0]['compet_espec_nivel_dos']=== ''){
                    $data_diccion['especif_dos']= array();
                }else{
                    $data_diccion['especif_dos']= $this->Model_Syllabus->listar_diccionario_compte( $data_compt_det[0]['compet_espec_dos'],$data_compt_det[0]['compet_espec_nivel_dos']);      
                }
                if( $data_compt_det[0]['compet_espec_tres']== 0  || $data_compt_det[0]['compet_espec_nivel_tres']=== ''){
                    $data_diccion['especif_tres']= array();
                }else{
                    $data_diccion['especif_tres']= $this->Model_Syllabus->listar_diccionario_compte( $data_compt_det[0]['compet_espec_tres'],$data_compt_det[0]['compet_espec_nivel_tres']);
                }
                $compt_gene='';
                $compt_gene_descr='';
                $compt_espec_1='';
                $compt_espec_descr_1='';
                $compt_espec_2='';
                $compt_espec_descr_2='';
                $compt_gene_2='';
                $compt_gene_descr_2='';
                $compt_espec_3='';
                $compt_espec_descr_3='';
                if (!empty($data_diccion['general_uno'])) {
                    $compt_gene= $data_diccion['general_uno'][0]['nom_compet'];
                    $compt_gene_descr = (!isset($data_diccion['general_uno'][0]['nivel_uno']) ? '' : $data_diccion['general_uno'][0]['nivel_uno']).' '.(!isset($data_diccion['general_uno'][0]['nivel_dos']) ? '' : $data_diccion['general_uno'][0]['nivel_dos']).' '.(!isset($data_diccion['general_uno'][0]['nivel_tres']) ? '' : $data_diccion['general_uno'][0]['nivel_tres']);
                }
                if (!empty($data_diccion['general_dos'])) {
                    $compt_gene_2= $data_diccion['general_dos'][0]['nom_compet'];
                    $compt_gene_descr_2 = (!isset($data_diccion['general_dos'][0]['nivel_uno']) ? '' : $data_diccion['general_dos'][0]['nivel_uno']).' '.(!isset($data_diccion['general_dos'][0]['nivel_dos']) ? '' : $data_diccion['general_dos'][0]['nivel_dos']).' '.(!isset($data_diccion['general_dos'][0]['nivel_tres']) ? '' : $data_diccion['general_dos'][0]['nivel_tres']);
                }
                //------------------------------------            
                if (!empty($data_diccion['especif_uno'])) {
                    $compt_espec_1= $data_diccion['especif_uno'][0]['nom_compet'];
                    $compt_espec_descr_1 = (!isset($data_diccion['especif_uno'][0]['nivel_uno']) ? '' : $data_diccion['especif_uno'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_uno'][0]['nivel_dos']) ? '' : $data_diccion['especif_uno'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_uno'][0]['nivel_tres']) ? '' : $data_diccion['especif_uno'][0]['nivel_tres']);
                }
                if (!empty($data_diccion['especif_dos'])) {
                    $compt_espec_2= $data_diccion['especif_dos'][0]['nom_compet'];
                    $compt_espec_descr_2 = (!isset($data_diccion['especif_dos'][0]['nivel_uno']) ? '' : $data_diccion['especif_dos'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_dos'][0]['nivel_dos']) ? '' : $data_diccion['especif_dos'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_dos'][0]['nivel_tres']) ? '' : $data_diccion['especif_dos'][0]['nivel_tres']);
                }
                if (!empty($data_diccion['especif_tres'])) {
                    $compt_espec_3= $data_diccion['especif_tres'][0]['nom_compet'];
                    $compt_espec_descr_3 = (!isset($data_diccion['especif_tres'][0]['nivel_uno']) ? '' : $data_diccion['especif_tres'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_tres'][0]['nivel_dos']) ? '' : $data_diccion['especif_tres'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_tres'][0]['nivel_tres']) ? '' : $data_diccion['especif_tres'][0]['nivel_tres']);
                }

                // $parametros_ac = array(
                //     $accion,
                //     $id_version_sy,
                //     $compt_gene,
                //     $compt_gene_descr,
                //     $compt_espec_1,
                //     $compt_espec_descr_1,
                //     $compt_espec_2,
                //     $compt_espec_descr_2,
                //     $user_reg,
                //     $id_compt_asoci_curso,
                //     $compt_gene_2,
                //     $compt_gene_descr_2,                
                //     $compt_espec_3,
                //     $compt_espec_descr_3
                // );
                // $id_ac =$this->Model_Syllabus->insert_update_compt_asoci_curso($parametros_ac);

                
                $parametros = array(
                    'vACCION'        =>'COMPT_ASOCI_CURSO',
                    'p_id_1'         => $id_compt_asoci_curso,
                    'p_id_2'       =>  $id_version_sy,
                    'p_id_3'     => '',
    
                    'p_texto1' =>    $compt_gene,
                    'p_texto2' =>  $compt_gene_descr,
    
                    'p_texto3'    => $compt_espec_1,
                    'p_texto4' =>  $compt_espec_descr_1,
    
                    'p_texto5' =>    $compt_espec_2,
    
                    'p_estado' => '2',
                    'p_user' =>  $user_reg,
    
                    'p_texto6' =>  $compt_espec_descr_2,
                    'p_texto7' => $compt_gene_2,
                    'p_texto8' =>  $compt_gene_descr_2,
                    'p_texto9' =>  $compt_espec_3,   
                    'p_texto10' =>  $compt_espec_descr_3,   
    
                );
    
                $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);
    
            }

            $sumilla_curso =$this->Model_Cursos->mirar_sumilla_curso($id_curso);        

            $sumilla_data =$this->Contenedor_Model->get_sumilla_by_version($id_version_sy);        
                

                if(count($sumilla_data)==0){
                    $id_sumilla='';
                }else{
                    $id_sumilla=$sumilla_data[0]['id_sumilla'];
                }
    
                if(count($sumilla_curso)==0){
                    $sumilla_curso='';
                }else{
                    $sumilla_curso=  $sumilla_curso[0]['descrip_sumilla'];
                }
    
                // $parametros = array(
                //     $id_version_sy,
                //     $sumilla_curso,
                //     $user_reg,
                //     $id_sumilla
                // );
                
            // $id =$this->Model_Syllabus->update_insert_sumilla($parametros);
            $parametros = array(
                'vACCION'        =>'SUMILLA',
                'p_id_1'         => $id_sumilla,
                'p_id_2'       =>  $id_version_sy,
                'p_id_3'     => '',
                'p_texto1' =>  $sumilla_curso,
                'p_texto2' => '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,

                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );

            $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);

    }



    
    public function Actualizar_compt_aso_curso_only($id_ciclo,$id_version_sy,$user_reg,$accion,$id_compt_asoci_curso='',$id_curso){
        $data_compt_det= $this->Model_Syllabus->listar_compet_detalle($id_ciclo);  
        
        if(!empty($data_compt_det)){

            $data_diccion = array();
            if($data_compt_det[0]['compet_gene_uno']== 0 || $data_compt_det[0]['compet_gene_nivel_uno'] === ''){
                $data_diccion['general_uno']= array();
            }else{
                $data_diccion['general_uno']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_gene_uno'],$data_compt_det[0]['compet_gene_nivel_uno']);
            }
            if($data_compt_det[0]['compet_gene_dos']== 0 ||$data_compt_det[0]['compet_gene_nivel_dos']=== ''){
                $data_diccion['general_dos']= array();
            }else{
                $data_diccion['general_dos']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_gene_dos'],$data_compt_det[0]['compet_gene_nivel_dos']);    
            }
            if($data_compt_det[0]['compet_espec_uno']== 0 || $data_compt_det[0]['compet_espec_nivel_uno']=== ''){
                $data_diccion['especif_dos']= array();
            }else{
                $data_diccion['especif_uno']= $this->Model_Syllabus->listar_diccionario_compte($data_compt_det[0]['compet_espec_uno'],$data_compt_det[0]['compet_espec_nivel_uno']);    
            }
            if( $data_compt_det[0]['compet_espec_dos']== 0  || $data_compt_det[0]['compet_espec_nivel_dos']=== ''){
                $data_diccion['especif_dos']= array();
            }else{
                $data_diccion['especif_dos']= $this->Model_Syllabus->listar_diccionario_compte( $data_compt_det[0]['compet_espec_dos'],$data_compt_det[0]['compet_espec_nivel_dos']);      
            }
            if( $data_compt_det[0]['compet_espec_tres']== 0  || $data_compt_det[0]['compet_espec_nivel_tres']=== ''){
                $data_diccion['especif_tres']= array();
            }else{
                $data_diccion['especif_tres']= $this->Model_Syllabus->listar_diccionario_compte( $data_compt_det[0]['compet_espec_tres'],$data_compt_det[0]['compet_espec_nivel_tres']);
            }
            $compt_gene='';
            $compt_gene_descr='';
            $compt_espec_1='';
            $compt_espec_descr_1='';
            $compt_espec_2='';
            $compt_espec_descr_2='';
            $compt_gene_2='';
            $compt_gene_descr_2='';
            $compt_espec_3='';
            $compt_espec_descr_3='';
            if (!empty($data_diccion['general_uno'])) {
                $compt_gene= $data_diccion['general_uno'][0]['nom_compet'];
                $compt_gene_descr = (!isset($data_diccion['general_uno'][0]['nivel_uno']) ? '' : $data_diccion['general_uno'][0]['nivel_uno']).' '.(!isset($data_diccion['general_uno'][0]['nivel_dos']) ? '' : $data_diccion['general_uno'][0]['nivel_dos']).' '.(!isset($data_diccion['general_uno'][0]['nivel_tres']) ? '' : $data_diccion['general_uno'][0]['nivel_tres']);
            }
            if (!empty($data_diccion['general_dos'])) {
                $compt_gene_2= $data_diccion['general_dos'][0]['nom_compet'];
                $compt_gene_descr_2 = (!isset($data_diccion['general_dos'][0]['nivel_uno']) ? '' : $data_diccion['general_dos'][0]['nivel_uno']).' '.(!isset($data_diccion['general_dos'][0]['nivel_dos']) ? '' : $data_diccion['general_dos'][0]['nivel_dos']).' '.(!isset($data_diccion['general_dos'][0]['nivel_tres']) ? '' : $data_diccion['general_dos'][0]['nivel_tres']);
            }
            //------------------------------------            
            if (!empty($data_diccion['especif_uno'])) {
                $compt_espec_1= $data_diccion['especif_uno'][0]['nom_compet'];
                $compt_espec_descr_1 = (!isset($data_diccion['especif_uno'][0]['nivel_uno']) ? '' : $data_diccion['especif_uno'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_uno'][0]['nivel_dos']) ? '' : $data_diccion['especif_uno'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_uno'][0]['nivel_tres']) ? '' : $data_diccion['especif_uno'][0]['nivel_tres']);
            }
            if (!empty($data_diccion['especif_dos'])) {
                $compt_espec_2= $data_diccion['especif_dos'][0]['nom_compet'];
                $compt_espec_descr_2 = (!isset($data_diccion['especif_dos'][0]['nivel_uno']) ? '' : $data_diccion['especif_dos'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_dos'][0]['nivel_dos']) ? '' : $data_diccion['especif_dos'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_dos'][0]['nivel_tres']) ? '' : $data_diccion['especif_dos'][0]['nivel_tres']);
            }
            if (!empty($data_diccion['especif_tres'])) {
                $compt_espec_3= $data_diccion['especif_tres'][0]['nom_compet'];
                $compt_espec_descr_3 = (!isset($data_diccion['especif_tres'][0]['nivel_uno']) ? '' : $data_diccion['especif_tres'][0]['nivel_uno']).' '.(!isset($data_diccion['especif_tres'][0]['nivel_dos']) ? '' : $data_diccion['especif_tres'][0]['nivel_dos']).' '.(!isset($data_diccion['especif_tres'][0]['nivel_tres']) ? '' : $data_diccion['especif_tres'][0]['nivel_tres']);
            }

            $parametros = array(
                'vACCION'        =>'COMPT_ASOCI_CURSO',
                'p_id_1'         => $id_compt_asoci_curso,
                'p_id_2'       =>  $id_version_sy,
                'p_id_3'     => '',

                'p_texto1' =>    $compt_gene,
                'p_texto2' =>  $compt_gene_descr,

                'p_texto3'    => $compt_espec_1,
                'p_texto4' =>  $compt_espec_descr_1,

                'p_texto5' =>    $compt_espec_2,

                'p_estado' => '2',
                'p_user' =>  $user_reg,

                'p_texto6' =>  $compt_espec_descr_2,
                'p_texto7' => $compt_gene_2,
                'p_texto8' =>  $compt_gene_descr_2,
                'p_texto9' =>  $compt_espec_3,   
                'p_texto10' =>  $compt_espec_descr_3,   

            );

            $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);



        }

    }


    public function Actualizar_sumilla_curso_only($id_ciclo,$id_version_sy,$user_reg,$accion,$id_compt_asoci_curso='',$id_curso){       
        
        $sumilla_curso =$this->Model_Cursos->mirar_sumilla_curso($id_curso);        

        $sumilla_data =$this->Contenedor_Model->get_sumilla_by_version($id_version_sy);        
            

            if(count($sumilla_data)==0){
                $id_sumilla='';
            }else{
                $id_sumilla=$sumilla_data[0]['id_sumilla'];
            }

            if(count($sumilla_curso)==0){
                $sumilla_curso='';
            }else{
                $sumilla_curso=  $sumilla_curso[0]['descrip_sumilla'];
            }

            // $parametros = array(
            //     $id_version_sy,
            //     $sumilla_curso,
            //     $user_reg,
            //     $id_sumilla
            // );
            
            
            // $id =$this->Model_Syllabus->update_insert_sumilla($parametros);

            $parametros = array(
                'vACCION'        =>'SUMILLA',
                'p_id_1'         => $id_sumilla,
                'p_id_2'       =>  $id_version_sy,
                'p_id_3'     => '',
                'p_texto1' =>  $sumilla_curso,
                'p_texto2' => '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,

                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );

            $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);


    }


    //------------------Crud ---------------------------------------------------------
    public function Insert_Asyllabus(){
        if ($this->session->userdata('usuario')) {

            $estado              = $this->input->post("cbx_basicos_id_est_syllabus");
            $nombre_syllabus         = $this->input->post("nombre_syllabus");
            $periodo_anio         = $this->input->post("cbx_basicos_periodo_anio");
            $periodo_ciclo         = $this->input->post("periodo_ciclo");

            $id_plan_estudios              = $this->input->post("cbx_basicos_id_plan_estudios");
            $id_carrera                 = $this->input->post("cbx_basicos_id_carrera");
            $id_director              = $this->input->post("cbx_basicos_id_director");
            $nom_ciclo              = $this->input->post("nom_ciclo");

            $id_curso              = $this->input->post("cbx_basicos_id_curso");
            $creditos              = $this->input->post("creditos");
            $horas_teoricas              = $this->input->post("horas_teoricas");
            $horas_practicas              = $this->input->post("horas_practicas");
            $horas_totales              = $this->input->post("horas_totales");

            $requisito              = implode(",", $this->input->post("requisito"));
            $tipo_ciclo              = $this->input->post("cbx_basicos_id_tipo_curso");
            $id_condicion                 = $this->input->post("cbx_basicos_id_curso_importancia");
            $presencialidad              = $this->input->post("cbx_basicos_id_curso_forma_estudio");
            $id_docente              = implode(",", $this->input->post("cbx_multiple_id_docente"));
            
            $version_principal        = $this->input->post("version_principal");

            $id_facultad        = null;
            $id_depart_univer               = null;
            $id_asignacion_curso               = null;


            $id_ciclo              = $this->input->post("id_ciclo");
            $id_tipo_estudios              = $this->input->post("id_tipo_estudios");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];



           
           
           
           
            $accion = 'INSERTAR_SYLLABUS';
            $parametros = array(
                $accion,
                '',
                $id_facultad,
                $nombre_syllabus,
                $periodo_anio,
                $periodo_ciclo,
                $id_depart_univer,
                $id_carrera,
                $id_condicion,
                $creditos,
                $horas_teoricas,
                $horas_practicas,
                $id_director,
                $id_docente,
                $id_curso,
                $id_plan_estudios,
                $requisito,
                $estado,
                $user_reg,
                $nom_ciclo,
                $presencialidad,
                $tipo_ciclo,
            	$horas_totales,
                $id_ciclo,
                $id_tipo_estudios,
                $version_principal,
                $id_asignacion_curso,
                ''
            );
        
            $data=$this->Model_Syllabus->procedureCrud_Syllabus($parametros);
            $this->Seleccionar_compt_aso($id_ciclo,$data[0]['id_version_sy'],$user_reg,'','',$id_curso);




            if(  $id_tipo_estudios == 1){

                $parametros = array(
                    'I',
                    $data[0]['id_version_sy'],
    
                    'Prueba de Entrada',
                    'Práctica calificada',
                    'Práctica calificada',
                    'Evaluación parcial',
                    'Presentación de trabajo integrador',
                    '',
                    'Evaluación final',
    
                    1,
                    5,
                    8,
                    11,
                    15,
                    '',
                    16,
    
                    0,
                    15,
                    15,
                    20,
                    30,
                    '',
                    20,
             
                    $user_reg,
                    ''
                );

            }elseif($id_tipo_estudios == 2){

                $parametros = array(
                    'I',
                    $data[0]['id_version_sy'],
    
                    'Prueba de Entrada',
                    'Práctica calificada',
                    'Práctica calificada',
                    '',
                    'Práctica calificada',
                    '',
                    'Presentación de trabajo integrador',
    
                    1,
                    1,
                    2,
                    3,
                    4,
                    '',
                    '',
    
                    0,
                    20,
                    15,
                    '',
                    25,
                    '',
                    40,
             
                    $user_reg,
                    ''
                );

            }else{

                $parametros = array(
                    'I',
                    $data[0]['id_version_sy'],
    
                    'Prueba de Entrada',
                    'Práctica calificada',
                    'Práctica calificada',
                    'Evaluación parcial',
                    'Presentación de trabajo integrador',
                    '',
                    'Evaluación final',
    
                    1,
                    2,
                    6,
                    7,
                    4,
                    '',
                    8,
    
                    0,
                    15,
                    15,
                    20,
                    30,
                    '',
                    20,
             
                    $user_reg,
                    ''
                );
            }

         
                   
            $id =$this->Model_Syllabus->insert_update_forma_herrami_eval($parametros);
        }
        else{
            redirect('/login');
        }        
    }

    public function Update_Asyllabus(){
        if ($this->session->userdata('usuario')) {
            
            $id_syllabus        = $this->input->post("id_asyllabus");
            $estado              = $this->input->post("cbx_basicos_id_est_syllabus");
            $nombre_syllabus         = $this->input->post("nombre_syllabus");
            $periodo_anio         = $this->input->post("cbx_basicos_periodo_anio");
            $periodo_ciclo         = $this->input->post("periodo_ciclo");
            $id_plan_estudios              = $this->input->post("cbx_basicos_id_plan_estudios");
            $id_carrera                 = $this->input->post("cbx_basicos_id_carrera");
            $id_director              = $this->input->post("cbx_basicos_id_director");
            $nom_ciclo              = $this->input->post("nom_ciclo");
            $id_curso              = $this->input->post("cbx_basicos_id_curso");
            $creditos              = $this->input->post("creditos");
            $horas_teoricas              = $this->input->post("horas_teoricas");
            $horas_practicas              = $this->input->post("horas_practicas");
            $horas_totales              = $this->input->post("horas_totales");
            $requisito              = implode(",", $this->input->post("requisito"));
            $tipo_ciclo              = $this->input->post("cbx_basicos_id_tipo_curso");
            $id_condicion                 = $this->input->post("cbx_basicos_id_curso_importancia");
            $presencialidad              = $this->input->post("cbx_basicos_id_curso_forma_estudio");
            $id_docente              = implode(",", $this->input->post("cbx_multiple_id_docente"));
            $id_facultad        = 0;      
            $id_depart_univer  = 0;
            $id_ciclo              = $this->input->post("id_ciclo");
            $id_tipo_estudios              = $this->input->post("id_tipo_estudios");
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];
            $version_principal        = $this->input->post("version_principal");








            $accion = 'ACTUALIZAR_SYLLABUS';
            $parametros = array(
                $accion,
                $id_syllabus,
                $id_facultad,
                $nombre_syllabus,
                $periodo_anio,
                $periodo_ciclo,
                $id_depart_univer,
                $id_carrera,
                $id_condicion,
                $creditos,
                $horas_teoricas,
                $horas_practicas,
                $id_director,
                $id_docente,
                $id_curso,
                $id_plan_estudios,
                $requisito,
                $estado,
                $user_reg,
                $nom_ciclo,
                $presencialidad,
                $tipo_ciclo,
            	$horas_totales,
                $id_ciclo,
                $id_tipo_estudios,
                $version_principal,
                '',
                ''
            );
     
            $this->Model_Syllabus->procedureCrud_Syllabus($parametros);
                //-------------------------------------------------------------------------
            $acciondos = 'LISTAR_SYLLABUS_ID';
            
            
            
            
            

            $parametrosdos = array(
                $acciondos,
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

            $this->Model_Syllabus->procedureCrud_Syllabus($parametrosdos);
            $data =$this->Model_Syllabus->listar_compt_asoci_curso($version_principal);

            
            $this->Seleccionar_compt_aso($id_ciclo,$version_principal,$user_reg,'E',$data[0]['id_compt_asoci_curso'],$id_curso);
          
            // echo "<pre>";
            // print_r($parametros);
            // exit();
        }
        else{
            redirect('/login');
        }
    }

    public function Delete_Asyllabus(){
        if ($this->session->userdata('usuario')) {
            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id_syllabus =$this->input->post("id_syllabus");          
            








            $accion = 'ELIMINAR_SYLLABUS';
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
                $user_eli,
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

           $DTERT= $this->Model_Syllabus->procedureCrud_Syllabus($parametros);
            echo "<pre>";
            print_r($DTERT);
            echo "</pre>";    
        }
        else{
            redirect('/login');
        }
    }

    public function CambioEstado(){
        if ($this->session->userdata('usuario')) {

            $user_actual = $_SESSION['usuario'][0]['id_usuario'];
            $id_syllabus =$this->input->post("id_syllabus");

            $version_principal =$this->input->post("version_principal");

            
            $estado =$this->input->post("estado");
            $accion = 'ACTUALIZAR_SYLLABUS_ESTADO';

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
                $estado,
                $user_actual,
                '',
                '',
                '',
            	'',
                '',
                '',
                $version_principal,
                '',
                ''
            );

                //     echo '<pre>';
                // print_r($parametros);
                // echo '</pre>';
                // exit();


            $this->Model_Syllabus->procedureCrud_Syllabus($parametros);
            sleep(1);
            $acciondos = 'LISTAR_SYLLABUS_ID';
            






            $parametrossegundo = array(
                $acciondos,
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

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametrossegundo);

                $parametros_version_sy = array(
                    $estado,
                    $user_actual,
                    $datos["data_silabus"][0]['version_principal'],
                );

                $dir = dirname(__DIR__, 4);
            
                $dato['id_syllabus'] = $id_syllabus;
                $dato['periodo'] = $datos["data_silabus"][0]['periodo_anio'].' '.$datos["data_silabus"][0]['periodo_ciclo'];
                $dato['nom_syll'] = $datos["data_silabus"][0]['nombre_syllabus'];

                $dato['nom_carrera'] = $datos["data_silabus"][0]['nom_carrera'];
                $dato['plan_estudios'] = $datos["data_silabus"][0]['nom_plan_estudios'];

                $dato['fec_reg'] = $datos["data_silabus"][0]['fec_reg'];
                $dato['fech_estado'] = $datos["data_silabus"][0]['fech_estado'];

                $date1 = new DateTime($dato['fec_reg']);
                $date2 = new DateTime($dato['fech_estado']);
                $diff = $date1->diff($date2);
                $dato['fech_diferencia'] = formato_resta($diff);

                $dato['url_pdf'] = site_url($this->url.$this->opcion.'/Asyllabus_pdf/'.  $dato['id_syllabus'] );
                $dato['url_comentarios'] = site_url($this->url.$this->opcion.'/Asyllabus_data_mirar/'.  $dato['id_syllabus'] .'/'. $datos["data_silabus"][0]['version_principal']);
                $dato['url_comentarios_ficha'] = site_url($this->url.$this->opcion.'/Asyllabus_data_mirar_ficha_eval/'.  $dato['id_syllabus'] .'/'. $datos["data_silabus"][0]['version_principal']);

                $dato['url_lista'] = site_url('admin/usuarios/Asyllabus');

                $dato['nom_usu_registro'] = $datos["data_silabus"][0]['nom_usu_registro'];
                $dato['nom_est_syllabus'] = $datos["data_silabus"][0]['nom_est_syllabus'];
                $dato['nom_usu_estado'] = $datos["data_silabus"][0]['nom_usu_estado'];
                $dato['estado'] = $datos["data_silabus"][0]['estado'];
                       
                // echo '<pre>';
                // print_r($dato);
                // echo '</pre>';
                // exit();

            $mail = new PHPMailer(true);
            $mail->isSMTP();                                      // Set mailer to use SMTP
            try {
                $mail->CharSet = $this->CharSet;
                //Server settings
                $mail->SMTPDebug =  $this->SMTPDebug;                                 // Enable verbose debug output
                $mail->Host = $this->Host;                  // Specify main and backup SMTP servers
                $mail->SMTPAuth = $this->SMTPAuth;                                 // Enable SMTP authentication
                $mail->Username = $this->Username;                // SMTP username
                $mail->Password = $this->Password;                           // SMTP password
                $mail->SMTPSecure = $this->SMTPSecure;                           // Enable SSL encryption, TLS also accepted with port 587
                $mail->Port = $this->Port;                                   // TCP port to connect to
                //Recipients
                $mail->setFrom('pupixoxd@gmail.com', 'Alerta de Syllabus'); //desde donde se envia
                $mail->addAddress('pupixo988@gmail.com', 'Pedro Acosta');     // Add a recipient
                // $mail->addAddress('mirtha.nino.salvador@gmail.com', 'Mirtha Nino');     // Add a recipient
                // $mail->addAddress('180000323@cientifica.edu.pe', 'Cientifica');     // Add a recipient

                


                $mail->AddEmbeddedImage($dir.'\assets\template\correo_img\syllabus\img1.png', 'logo_1');                  
                $mail->AddEmbeddedImage($dir.'\assets\template\correo_img\syllabus\img2.jpg', 'logo_2');  
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Syllabus '. $dato['nom_syll'].'-'. $dato['periodo'] .' '.'ha cambiado de estado' ;
                $html = $this->load->view($this->url_carpeta.'mail/alerta_syllabus_estado.php',$dato,true);
                $mail->Body = $html;

                $mail->send();
                echo 'Message has been sent';

            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }
        else{
            redirect('/login');
        }
    }

    //---------------------------------------------------------------------------------------------------------

    public function Asyllabus_pdf($id_syllabus){
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

            $data_pdf['id_version_sy'] = $data_pdf["data_silabus"][0]['version_principal'];
            
            $nombres_requisitos=datos_sillabus( $data_pdf['id_version_sy'] ,'requisito');

            if( $nombres_requisitos !=null){ 
                $ids_cursos = explode(",", $nombres_requisitos );
                $cursos_nom = array();
                foreach ($ids_cursos as $key => $valor) {
                        $cursos =$this->contenedor->get_curso_excel_id($valor);
                        array_push($cursos_nom, $cursos[0]['nom_curso']);
                }
                $cursos_nombres_text   = implode(",", $cursos_nom);                        
                $data_pdf['requisitos_text'] = $cursos_nombres_text;
            }else{
                $data_pdf['requisitos_text'] = '';
            }
       
            $nombres_docentes=datos_sillabus( $data_pdf['id_version_sy'] ,'id_docente');
     
            if( $nombres_docentes != null){ 
                $ids_docentes = explode(",", $nombres_docentes );
                $docentes_nom = array();
                foreach ($ids_docentes as $key => $valor) {
                        $docente =$this->contenedor->get_lista_docentes_id($valor);
                        array_push($docentes_nom, $docente[0]['nom_usu_docente']);
                }
                $docentes_nombres_text   = implode(",", $docentes_nom);                        
                $data_pdf['docentes_text'] = $docentes_nombres_text;

            }else{
                $data_pdf['docentes_text'] = '';
            }
   
            $data_pdf["compt_asoci_curso"] = $this->Model_Syllabus->listar_compt_asoci_curso($data_pdf["data_silabus"][0]['version_principal']);
            $data_pdf["forma_herrami_eval"] = $this->Model_Syllabus->listar_forma_herrami_eval($data_pdf["data_silabus"][0]['version_principal']);
            $data_pdf["lista_org_aprendizaje"] = $this->Model_Syllabus->listar_compt_org_aprendizaje($data_pdf["data_silabus"][0]['version_principal']);

            $num_modulo_numbers =$this->contenedor->get_tabla_org_aprendizaje_for_act_creados_main($data_pdf["data_silabus"][0]['version_principal']);

            $data_pdf["modulos"] =Agrupar_array_por_keyvalue($num_modulo_numbers,'num_modulo');
          
            $data_pdf["plataforma_herramienta"]  =$this->Model_Syllabus->listar_plataformas_herramientas($data_pdf["data_silabus"][0]['version_principal']);
            $data_pdf["biblio_obliga"] =$this->Model_Syllabus->listar_referencias_bibliograficas($data_pdf["data_silabus"][0]['version_principal'],'obligatorio');
            $data_pdf["biblio_consult"] =$this->Model_Syllabus->listar_referencias_bibliograficas($data_pdf["data_silabus"][0]['version_principal'],'consulta');

            //  echo '<pre>';
            // print_r($data_pdf["data_silabus"][0]);
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

            // $mpdf->SetHeader('First section header');
            // $mpdf->SetFooter('{PAGENO} section footer');
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->setAutoBottomMargin = 'stretch';



            $html = $this->load->view($this->url_carpeta.'pdf/syllabus_resumen.php',$data_pdf,true);
         
            $mpdf->WriteHTML($html);

            $mpdf->SetDisplayMode('fullpage');
            $mpdf->list_indent_first_level = 0; 

            //call watermark content and image
            $mpdf->SetWatermarkText('');
            $mpdf->showWatermarkText = true;
            $mpdf->watermarkTextAlpha = 0.1;


            $mpdf->Output();

        }
        else{
            redirect('/login');
        }        
    }

    public function Asyllabus_resumen($id_syllabus){
        if ($this->session->userdata('usuario')) {
            $datos   = obtenerDatosIndexNuevo($this);

            $datos['id_syllabus'] = $id_syllabus;

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


            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);


            if(empty($datos["data_silabus"] )){
                redirect('/login');
            }

            $datos["data_silabus_version"] = $this->Model_Syllabus->listar_syversion_id_sy($id_syllabus);

            $id_syllabus_version = $datos["data_silabus"][0]['version_principal'];

            $porcen_syll_dg = $this->Model_Syllabus->ver_porcentaje_syllabus_dg($id_syllabus_version);
            $porcen_syll_ac = $this->Model_Syllabus->ver_porcentaje_syllabus_ac($id_syllabus_version);
            $porcen_syll_oa = $this->Model_Syllabus->ver_porcentaje_syllabus_oa($id_syllabus_version);
            $porcen_syll_fhe = $this->Model_Syllabus->ver_porcentaje_syllabus_fhe($id_syllabus_version);
            $porcen_syll_ap = $this->Model_Syllabus->ver_porcentaje_syllabus_ap($id_syllabus_version);
            $porcentaje_syllabus_ph = $this->Model_Syllabus->ver_porcentaje_syllabus_ph($id_syllabus_version);
            $porcentaje_syllabus_bibli = $this->Model_Syllabus->ver_porcentaje_syllabus_bibli($id_syllabus_version);
            $porcentaje_syllabus_sumilla = $this->Model_Syllabus->ver_porcentaje_syllabus_sumilla($id_syllabus_version);
            $porcentaje_syllabus_result_ga = $this->Model_Syllabus->ver_porcentaje_syllabus_result_ga($id_syllabus_version);
            $porcentaje_syllabus_estrate_didac = $this->Model_Syllabus->ver_porcentaje_syllabus_estrate_didac ($id_syllabus_version);


            $porcentaje_syllabus_ficha_eval1 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,1);
            $porcentaje_syllabus_ficha_eval2 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,2);
            $porcentaje_syllabus_ficha_eval3 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,3);
            $porcentaje_syllabus_ficha_eval4 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,4);
            $porcentaje_syllabus_ficha_eval5 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,5);
            $porcentaje_syllabus_ficha_eval6 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_syllabus_version,6);


            $datos["valor_porcentajes_syllabus_dg"]= ($porcen_syll_dg->porcentaje_syllabus == null ? 0 : $porcen_syll_dg->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ac"]= ($porcen_syll_ac->porcentaje_syllabus == null ? 0 : $porcen_syll_ac->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_oa"]= ($porcen_syll_oa->CANTIDAD == null ? 0 : $porcen_syll_oa->CANTIDAD)  ;
            $datos["valor_porcentajes_syllabus_fhe"]= ($porcen_syll_fhe->porcentaje_syllabus == null ? 0 : $porcen_syll_fhe->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_sumilla"]= ($porcentaje_syllabus_sumilla->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_sumilla->porcentaje_syllabus);

            $datos["valor_porcentajes_syllabus_result_ga"]= ($porcentaje_syllabus_result_ga->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_result_ga->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_estrate_didac"]= ($porcentaje_syllabus_estrate_didac->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_estrate_didac->porcentaje_syllabus);

            $datos["valor_porcentajes_syllabus_ap"]= ($porcen_syll_ap->porcentaje_syllabus == null ? 0 : $porcen_syll_ap->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ph"]= ($porcentaje_syllabus_ph->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ph->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_bibli"]= ($porcentaje_syllabus_bibli->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_bibli->porcentaje_syllabus);


            // $datos["valor_porcentajes_syllabus_bibli"]= ($porcentaje_syllabus_bibli->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_bibli->porcentaje_syllabus);



            $datos["valor_porcentajes_syllabus_ficha_eval1"]= ($porcentaje_syllabus_ficha_eval1->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval1->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ficha_eval2"]= ($porcentaje_syllabus_ficha_eval2->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval2->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ficha_eval3"]= ($porcentaje_syllabus_ficha_eval3->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval3->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ficha_eval4"]= ($porcentaje_syllabus_ficha_eval4->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval4->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ficha_eval5"]= ($porcentaje_syllabus_ficha_eval5->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval5->porcentaje_syllabus);
            $datos["valor_porcentajes_syllabus_ficha_eval6"]= ($porcentaje_syllabus_ficha_eval6->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval6->porcentaje_syllabus);


            // echo '<pre>';
            // print_r(  $datos["data_silabus"] );
            // echo '</pre>';
            // exit();


            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'resumen_syllabus/resumen_syllabus.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    public function Asyllabus_data($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;

            $datos['abrev']              = 'asyllabus_data';
            $datos['form_1']             = 'formulario_uno';
            $datos['form_2']             = 'formulario_dos';
            $datos['form_3']             = 'formulario_tres';
            $datos['form_4']             = 'formulario_cuatro';
            $datos['form_5']             = 'formulario_cinco';
            $datos['form_6']             = 'formulario_seis';
            $datos['form_7']             = 'formulario_siete';
            $datos['form_8']             = 'formulario_ocho';
            $datos['form_9']             = 'formulario_nueve';
            $datos['form_10']          = 'formulario_diez';

            $datos['tituloSecundario2']  = 'Syllabus Secciones';

            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
        
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
                $id_version_sy,
                '',
                ''
            );
         

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            
            if(empty($datos["data_silabus"] )){
                redirect('/login');
            }
            
            $datos["compt_asoci_curso"] = $this->Model_Syllabus->listar_compt_asoci_curso($id_version_sy);
            $datos["forma_herrami_eval"] = $this->Model_Syllabus->listar_forma_herrami_eval($id_version_sy);
            $datos['version_sy_principal'] =  $datos["data_silabus"][0]['version_principal'];

            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'datos_sy/syllabus_data.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    public function Update_Asyllabus_datos_generales(){
        if ($this->session->userdata('usuario')) {
            
            $id_version_sy        = $this->input->post("id_version_sy");
            $id_syllabus        = $this->input->post("id_syllabus");
            $version_sy_principal        = $this->input->post("version_sy_principal");
            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $nom_syllabus               = $this->input->post("nom_syllabus");
            $anio               = $this->input->post("anio");
            $numero_ciclo               = $this->input->post("numero_ciclo");

            $id_plan_estudios               = $this->input->post("cbx_basicos_id_plan_estudios");
            $id_carrera               = $this->input->post("cbx_basicos_id_carrera");
            $nom_ciclo               = $this->input->post("nom_ciclo");
            $id_curso               = $this->input->post("cbx_basicos_id_curso");

            $creditos              = $this->input->post("creditos");
            $horas_teoricas              = $this->input->post("horas_teoricas");
            $horas_practicas              = $this->input->post("horas_practicas");
            $horas_totales              = $this->input->post("horas_totales");

            $requisito              = implode(",", $this->input->post("requisito"));

            $tipo_ciclo                 = $this->input->post("cbx_basicos_id_tipo_curso");
            $presencialidad                 = $this->input->post("cbx_basicos_id_curso_forma_estudio");
            $id_condicion                 = $this->input->post("cbx_basicos_id_curso_importancia");
    
            $id_director              = $this->input->post("cbx_basicos_id_director");
            $id_docente              = implode(",", $this->input->post("cbx_multiple_id_docente"));

            $estado_sillabus              = $this->input->post("estado_sillabus");
            $id_ciclo              = $this->input->post("id_ciclo");
            $id_tipo_estudios              = $this->input->post("id_tipo_estudios");

            $id_compt_asoci_curso  = $this->input->post("id_compt_asoci_curso");           

            $accion = 'ACTUALIZAR_SYLLABUS_DATOS_GENERALES';
           
           




            $parametros = array(
                $accion,
                $id_version_sy,
                0,
                $nom_syllabus,
                $anio,
                $numero_ciclo,
                0,
                $id_carrera,
                $id_condicion,
                $creditos,
                $horas_teoricas,
                $horas_practicas,
                $id_director,
                $id_docente,
                $id_curso,
                $id_plan_estudios,
                $requisito,
                $estado_sillabus,
                $user_reg,
                $nom_ciclo,
                $presencialidad,
                $tipo_ciclo,
            	$horas_totales,
                 $id_ciclo,
                 $id_tipo_estudios,
                 $version_sy_principal ,
                 '',
                 ''
            );
                     
            $this->Model_Syllabus->procedureCrud_Syllabus($parametros);
         
            $nombre_syllabus =datos_sillabus($id_version_sy,'nom_curso');
            $periodo_ciclo=datos_sillabus($id_version_sy,'periodo_ciclo');
            $periodo_anio=datos_sillabus($id_version_sy,'periodo_anio');

            echo  $nombre_syllabus.','.$periodo_anio.','.$periodo_ciclo;

        }
        else{
            redirect('/login');
        }
    }

    //------------------------------------------------------------------------

    public function Insert_Update_Asyllabus_compt_asoci_curso(){
        if ($this->session->userdata('usuario')) {
            
            $id_compt_asoci_curso        = $this->input->post("id_compt_asoci_curso");

            $id_version_sy        = $this->input->post("id_version_sy");
            
            $compt_gene               = $this->input->post("compt_gene");
            $compt_gene_descr                 = $this->input->post("compt_gene_descr");

            $compt_gene_2               = $this->input->post("compt_gene_2");
            $compt_gene_descr_2                 = $this->input->post("compt_gene_descr_2");


            $compt_espec_1                 = $this->input->post("compt_espec_1");
            $compt_espec_descr_1              = $this->input->post("compt_espec_descr_1");
            $compt_espec_2              = $this->input->post("compt_espec_2");
            $compt_espec_descr_2              = $this->input->post("compt_espec_descr_2");
      
            $compt_espec_3              = $this->input->post("compt_espec_3");
            $compt_espec_descr_3              = $this->input->post("compt_espec_descr_3");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            // $accion    = $this->input->post("accion");  
            // $parametros = array(
            //     $accion,
            //     $id_version_sy,
            //     $compt_gene,
            //     $compt_gene_descr,
            //     $compt_espec_1,
            //     $compt_espec_descr_1,
            //     $compt_espec_2,
            //     $compt_espec_descr_2,
            //     $user_reg,
            //     $id_compt_asoci_curso,
            //     $compt_gene_2,
            //     $compt_gene_descr_2,
            //     $compt_espec_3,
            //     $compt_espec_descr_3
            // );
                   
            // $id =$this->Model_Syllabus->insert_update_compt_asoci_curso($parametros);

            
            $parametros = array(
                'vACCION'        =>'COMPT_ASOCI_CURSO',
                'p_id_1'         => $id_compt_asoci_curso,
                'p_id_2'       =>  $id_version_sy,
                'p_id_3'     => '',

                'p_texto1' =>    $compt_gene,
                'p_texto2' =>  $compt_gene_descr,

                'p_texto3'    => $compt_espec_1,
                'p_texto4' =>  $compt_espec_descr_1,

                'p_texto5' =>    $compt_espec_2,

                'p_estado' => '2',
                'p_user' =>  $user_reg,

                'p_texto6' =>  $compt_espec_descr_2,
                'p_texto7' => $compt_gene_2,
                'p_texto8' =>  $compt_gene_descr_2,
                'p_texto9' =>  $compt_espec_3,   
                'p_texto10' =>  $compt_espec_descr_3,   

            );

            $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);
            
          
            /*
              echo "<pre>";
                print_r($id);
                echo "</pre>";
                exit;
                
                $view_traces_request = $this->load->view('request_store/traces_request', array(
                'traces' => $this->Request_trace->findByRequest($request_id),
                'request' => $request
                    ), true);

            */
            echo $id->ID;

        }
        else{
            redirect('/login');
        }
    }


    public function Actualizar_compet_curso(){
        if ($this->session->userdata('usuario')) {
            $id_ciclo              = $this->input->post("id_ciclo");
            $id_version_sy        = $this->input->post("id_version_sy");
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];
            $id_compt_asoci_curso  = $this->input->post("id_compt_asoci_curso");           
            $id_curso               = $this->input->post("cbx_basicos_id_curso");

            $this->Actualizar_compt_aso_curso_only($id_ciclo,$id_version_sy,$user_reg,'E',$id_compt_asoci_curso,$id_curso);
        
            $data =$this->Model_Syllabus->listar_compt_asoci_curso($id_version_sy);
            echo json_encode($data);

        }
        else{
            redirect('/login');
        }
    }


    public function Actualizar_sumilla_curso(){
        if ($this->session->userdata('usuario')) {
            $id_ciclo              = $this->input->post("id_ciclo");
            $id_version_sy        = $this->input->post("id_version_sy");
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];
            $id_compt_asoci_curso  = $this->input->post("id_compt_asoci_curso");           
            $id_curso               = $this->input->post("cbx_basicos_id_curso");

            $this->Actualizar_sumilla_curso_only($id_ciclo,$id_version_sy,$user_reg,'E',$id_compt_asoci_curso,$id_curso);
            
            $data =$this->Model_Syllabus->listar_sumilla_sy($id_version_sy);
            echo json_encode($data);

        
        }
        else{
            redirect('/login');
        }
    }

    public function Insert_Update_Asyllabus_sumilla(){
        if ($this->session->userdata('usuario')) {
            
            $id_sumilla        = $this->input->post("id_sumilla");
            $desc_sumilla        = $this->input->post("desc_sumilla");
            $id_version_sy        = $this->input->post("id_version_sy");            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            // $parametros = array(
            //     $id_version_sy,
            //     $desc_sumilla,
            //     $user_reg,
            //     $id_sumilla
            // );
                   
            // $id =$this->Model_Syllabus->update_insert_sumilla($parametros);
            

            $parametros = array(
                'vACCION'        =>'SUMILLA',
                'p_id_1'         => $id_sumilla,
                'p_id_2'       =>  $id_version_sy,
                'p_id_3'     => '',
                'p_texto1' =>  $desc_sumilla,
                'p_texto2' => '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,

                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );

            $id = $this->contenedor->procedureUpdateOrInsertTables($parametros);

            // echo $id->ID;
            echo $id[0]['ID']; 



        }
        else{
            redirect('/login');
        }
    }
    
    public function Insert_Update_Asyllabus_desc_result_gen_apr(){
        if ($this->session->userdata('usuario')) {
            
            $id_result_gen_apr        = $this->input->post("id_result_gen_apr");
            $desc_result_gen_apr        = $this->input->post("desc_result_gen_apr");
            $id_version_sy        = $this->input->post("id_version_sy");            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            // $parametros = array(
            //     $,
            //     $,
            //     $,
            //     $ 
            // );
                   
            // $id =$this->Model_Syllabus->update_insert_result_gen_apr($parametros);
            
            // echo $id->ID;

            $parametros = array(
                'vACCION'        =>'RESULT_GEN_APR',
                'p_id_1'         => $id_result_gen_apr,
                'p_id_2'       => $id_version_sy,
                'p_id_3'     => '',

                'p_texto1' =>  $desc_result_gen_apr,
                'p_texto2' => '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,
  
                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );


            $data=$this->contenedor->procedureUpdateOrInsertTables($parametros);
            echo $data[0]['ID']; 

        }
        else{
            redirect('/login');
        }
    }

    public function Insert_Update_Asyllabus_estrategias_didacticas(){
        if ($this->session->userdata('usuario')) {
            

            $id_estrateg_didact        = $this->input->post("id_estrateg_didact");
            $desc_estrateg_didact        = $this->input->post("desc_estrateg_didact");
            $id_version_sy        = $this->input->post("id_version_sy");            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            // $parametros = array(
            //     $id_version_sy,
            //     $desc_estrateg_didact,
            //     $user_reg,
            //     $id_estrateg_didact
            // );
                   
            // $id =$this->Model_Syllabus->update_insert_estrategias_didactica($parametros);
            
            // echo $id->ID;

            $parametros = array(
                'vACCION'        =>'ESTRATEGIAS_DIDACTICAS',
                'p_id_1'         => $id_estrateg_didact,
                'p_id_2'       => $id_version_sy,
                'p_id_3'     => '',
                'p_texto1' =>  $desc_estrateg_didact,
                'p_texto2' => '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,
  
                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );


            $data=$this->contenedor->procedureUpdateOrInsertTables($parametros);

            echo $data[0]['ID']; 



        }
        else{
            redirect('/login');
        }
    }

    //------------------------------------------------------------------------

    function cargar_tabla_org_aprendizaje($id_version_sy=null){
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
                  
            $data = $this->Model_Syllabus->listar_compt_org_aprendizaje($id_version_sy);
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {

                            $botones = "<center style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;'>"   
                                            . "<div class='btn-group' role='group' aria-label='' style='width: 100%; justify-content: flex-end;'>"

                                                    ."<div class='btn-group' >"
                                                    . "<a style='cursor: pointer;width: auto'  title='Eliminar Organización Aprendizaje'  onclick=Eliminar_form_3(".$row['id_org_aprendizaje'].")  type='button' class='btn bg-danger rueda_pdf' >"
                                                        . "<span  class='fa fa-trash-o'></span>"
                                                    . "</a>"
                                                    ."</div>"

                                                    ."<div class='btn-group' >"
                                                    . "<a  style='cursor: pointer;width: auto' title='Editar Organización Aprendizaje'  onclick=Editar_form3('E',".$row['id_org_aprendizaje'].",'". str_replace(' ', '_',$row['modulo_aprendizaje'])."','".str_replace(' ', '_', $row['result_aprendizaje'])."','".$row['semanas_aprendizaje_ini']."','".$row['semanas_aprendizaje_fin']."','".str_replace(' ', '_', $row['conten_aprendizaje'])."','".$row['modulo_num_orden']."')  type='button' class='btn bg-light rueda_verperfil'>"
                                                        . "<span  class='fa fa-pencil-square-o'> </span>"
                                                    . "</a>"
                                                    ."</div>"

                                            ."</div>"
                                        ."</center>";

                            $semanas_rango = "Semana ".$row['semanas_aprendizaje_ini']."- Semana ".$row['semanas_aprendizaje_fin'];
                    
                            $texto .= '{"ID_ORG_APRENDIZAJE":' . json_encode($row['id_org_aprendizaje']) . ','
                                    . '"ID_VERSION_SY":' . json_encode($row['id_version_sy']) . ','

                                    . '"ORDEN":' .  json_encode($row['modulo_num_orden'])  . ','
                                    
                                    . '"MODULO_APRENDIZAJE":' .  json_encode($row['modulo_aprendizaje'])  . ','
                                    . '"RESULT_APRENDIZAJE":' .  json_encode($row['result_aprendizaje'])  . ','
                                    . '"SEMANAS":"' .  $semanas_rango  . '",'
                                    . '"CONTEN_APRENDIZAJE":' .  json_encode($row['conten_aprendizaje'])  . ','
                                    . '"ACCION":"' . $botones . '"},';

                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
           
    }

    public function Insert_Update_Asyllabus_org_aprendizaje(){
        if ($this->session->userdata('usuario')) {
            
            $id_org_aprendizaje        = $this->input->post("id_org_aprendizaje");
            $id_version_sy        = $this->input->post("id_version_sy");
            $modulo_num_orden   = $this->input->post("modulo_num_orden");
            $modulo_aprendizaje               = $this->input->post("modulo_aprendizaje");
            $result_aprendizaje                 = $this->input->post("result_aprendizaje");
            $semanas_aprendizaje_ini                 = $this->input->post("semanas_aprendizaje_ini");
            $semanas_aprendizaje_fin                 = $this->input->post("semanas_aprendizaje_fin");

            $conten_aprendizaje              = $this->input->post("conten_aprendizaje");
    
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $accion    = $this->input->post("accion");  

            $parametros = array(
                $accion,
                $id_version_sy,
                $modulo_aprendizaje,
                $result_aprendizaje,
                $semanas_aprendizaje_ini,
                $semanas_aprendizaje_fin,
                $conten_aprendizaje,
                $user_reg,
                $id_org_aprendizaje,
                $modulo_num_orden
            );
                   
            $id =$this->Model_Syllabus->insert_update_org_aprendizaje($parametros);
            echo $id->ID;
        }
        else{
            redirect('/login');
        }
    }

    public function Delete_Asyllabus_form_3(){
        if ($this->session->userdata('usuario')) {
            
            $id_org_aprendizaje        = $this->input->post("id_org_aprendizaje");
            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                $user_reg,
                $id_org_aprendizaje
            );
                   
            $this->Model_Syllabus->eliminar_org_aprendizaje($parametros);
        }
        else{
            redirect('/login');
        }
    }

    //---------------------------------------------------
    public function Insert_Update_Asyllabus_actividades_principales(){
        if ($this->session->userdata('usuario')) {
            
            $accion        = $this->input->post("accion");


            if($accion==='I'){
                $id_org_aprendizaje        = $this->input->post("id_org_aprendizaje");
                $id_org_aprendizaje = $this->input->post("id_org_aprendizaje");
                $cant_modulos        = $this->input->post("cant_modulos");
                $cant_semanas    = $this->input->post("cant_semanas");  
                $cant_sesiones    = $this->input->post("cant_sesiones");  
                $user_reg = $_SESSION['usuario'][0]['id_usuario'];
    
    
                $parametros_modulo = array(
                    $id_org_aprendizaje,
                    $cant_modulos,
                    $user_reg
                );
    
                $id_modulo_ =$this->Model_Syllabus->insert_modulo($parametros_modulo);
                $id_modulo=$id_modulo_->ID;
    
    
                $id_semanas = array();
                foreach ($cant_semanas as $row) {
                    $id_semana_modulo =$this->Model_Syllabus->insert_semana_modulo($id_modulo,$row['num_semana'], $user_reg);
                    $id_semanas[$row['num_semana']] =  $id_semana_modulo->ID_SEMANA;
                }
    
    
                $nueva_cant_sesiones = array();
    
                foreach ($cant_sesiones as $key => $value) {
                    $semana=$id_semanas[$value['semana_pertenece']];
                    $reemplazos = array( "semana_pertenece" => $semana );
                    $reemplazo_data = array_replace($cant_sesiones[$key], $reemplazos);
                    array_push($nueva_cant_sesiones,$reemplazo_data);
                }
                
        
                $id_sesiones = array();
    
                foreach ($nueva_cant_sesiones as $key => $row) {
                    $id_sesion_modulo=$this->Model_Syllabus->insert_sesion_modulo($row['num_sesion'],$row['desc_tema'],$row['descr_iteracc_docente'],$row['descr_trabajo_autor'],$row['semana_pertenece'],$user_reg);
                    $id_s=$id_sesion_modulo->ID_SESION;
                    array_push($id_sesiones,$id_s);
    
                }
    
                $id_act_org_apr =$this->Model_Syllabus->upd_org_aprendizaje_insert_id_modulo($id_org_aprendizaje,$id_modulo);
    
        
            }else{

                $user_reg = $_SESSION['usuario'][0]['id_usuario'];

                $cant_sesiones    = $this->input->post("cant_sesiones");  

                foreach ($cant_sesiones as $key => $value) {
                    $this->Model_Syllabus->upd_sesion_modulo($value['id_sesion'],$value['num_sesion'],$value['desc_tema'],$value['descr_trabajo_autor'],$value['descr_iteracc_docente'],$user_reg );
                }
            }

        }
        else{
            redirect('/login');
        }

    }

    //-----------------------------------

    public function Insert_Asyllabus_referencias_bibliograficas(){
        if ($this->session->userdata('usuario')) {
            
                         
            $id_version_sy        = $this->input->post("id_version_sy");

            $nom_referencias_bibliograficas        = $this->input->post("nom_referencias_bibliograficas");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $tipo_bibliografia    = $this->input->post("tipo_bibliografia");  

            $parametros = array(
                'vACCION'        =>'REFERENCIAS_BIBLIOGRAFICAS',
                'p_id_1'         => '',
                'p_id_2'       => $id_version_sy,
                'p_id_3'     => '',
                'p_texto1' =>  $nom_referencias_bibliograficas,
                'p_texto2' =>  $tipo_bibliografia,
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,
  
                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );


            $data=$this->contenedor->procedureUpdateOrInsertTables($parametros);

            echo $data[0]['ID']; 

        }
        else{
            redirect('/login');
        }

    }

    public function Editar_Asyllabus_bibliografi(){
        if ($this->session->userdata('usuario')) {
            
            $id_referencias_bibliograficas        = $this->input->post("id_referencias_bibliograficas");
                         
            $nom_biblio        = $this->input->post("nom_biblio");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                'vACCION'        =>'REFERENCIAS_BIBLIOGRAFICAS',
                'p_id_1'         =>  $id_referencias_bibliograficas,
                'p_id_2'       => '',
                'p_id_3'     => '',
                'p_texto1' =>  $nom_biblio,
                'p_texto2' =>  '',
                'p_texto3'    => '',
                'p_texto4' =>  '',
                'p_texto5' => '',
                'p_estado' => '2',
                'p_user' =>  $user_reg,
  
                'p_texto6' => '',
                'p_texto7' => '',
                'p_texto8' =>  '',
                'p_texto9' =>  '',   
                'p_texto10' =>  '',   
            );


            $data=$this->contenedor->procedureUpdateOrInsertTables($parametros);

            echo $data[0]['ID']; 



        }
        else{
            redirect('/login');
        }

    }

    public function Listar_referencias_bibliograficas(){
        if ($this->session->userdata('usuario')) {
            $id_version_sy        = $this->input->post("id_version_sy");

            $tipo_bibliografia        = $this->input->post("tipo_bibliografia");

                   
            $datos =$this->Model_Syllabus->listar_referencias_bibliograficas($id_version_sy,$tipo_bibliografia);

            $lista ="";
            foreach ($datos as $row) {
                $lista .="<tr>
                
                <td WIDTH='90%'> ".$row['nom_referencias_bibliograficas']." </td>
                <td WIDTH='10%' > 
                    <a  style='cursor: pointer;width: auto' title='Editar'  onclick=Editar_Refer(".$row['id_referencias_bibliograficas'].",this,'".$tipo_bibliografia."')  class='dropdown-item delay-toogle btn-table-modal'>
                        <span  class='fa fa-pencil-square-o'> </span>
                    </a>
                </td>
                <td WIDTH='10%' >
                    <a style='cursor: pointer;' onclick='Eliminar_Refer(".$row['id_referencias_bibliograficas'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar' >
                        <span><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></span>
                    </a>                   
                </td>
                </tr>";
            }

            /*
            echo "<pre>";
            print_r($datos);
            echo "</pre>";

            exit();
            */
            
            echo $lista;

        }
        else{
            redirect('/login');
        }

    }

    public function Delete_ReferObli(){
        if ($this->session->userdata('usuario')) {
            
            $id_referencias_bibliograficas          = $this->input->post("id_referencias_bibliograficas");
            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                $user_reg,
                $id_referencias_bibliograficas  
            );
                   
            $this->Model_Syllabus->eliminar_referobli($parametros);
        }
        else{
            redirect('/login');
        }
    }
   
    //-------------------------------------------

    
    public function Listar_plataformas_herramientas(){
        if ($this->session->userdata('usuario')) {
            $id_version_sy        = $this->input->post("id_version_sy");
                   
            $datos =$this->Model_Syllabus->listar_plataformas_herramientas($id_version_sy);

            $lista ="";
            foreach ($datos as $row) {
                $lista .="
                <tr>
                    <td WIDTH='95%' > <b>".$row['nom_recurso']."</b> :  ".$row['recurso_descrip']." </td> 
                    <td WIDTH='5%' >
                        <a style='cursor: pointer;' onclick='Eliminar_Herramienta(".$row['id_plataformas_herramientas'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar' ><span><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></span> </a>
                    </td>
   
                </tr>";
            }

            /*
            echo "<pre>";
            print_r($datos);
            echo "</pre>";

            exit();
            */
            
            echo $lista;

        }
        else{
            redirect('/login');
        }
    }

    
    public function Combo_plataformas_herramientas() {
        if ($this->session->userdata('usuario')) {
            $datos['id_version_sy']  = $this->input->post("id_version_sy");

            // $this->load->library('layout');
            // $this->layout->view();

            $this->load->view($this->url_carpeta.'datos_sy/combo_herramienta.php', $datos);

        }
        else{
            redirect('/login');
        }
    }


    public function Insert_Asyllabus_plataformas_herramientas(){
        if ($this->session->userdata('usuario')) {
            


            $id_version_sy        = $this->input->post("id_version_sy");
                         
            $nom_plataformas_herramientas        = $this->input->post("cbx_basicos_nom_plataformas_herramientas");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            $parametros = array(
                $id_version_sy,
                $nom_plataformas_herramientas,
                $user_reg
            );

            /*
                echo "<pre>";
                print_r($parametros);
                echo "</pre>";

                exit();
            */
                   
            $id =$this->Model_Syllabus->insert_plataformas_herramientas($parametros);
            echo $id->ID;
        }
        else{
            redirect('/login');
        }

    }
    
    public function Editar_Asyllabus_plataformas_herramientas(){
        if ($this->session->userdata('usuario')) {
            
            $id_plataformas_herramientas        = $this->input->post("id_plataformas_herramientas");
                         
            $nom_plataformas_herramientas        = $this->input->post("nom_plataformas_herramientas");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            $parametros = array(
                $id_plataformas_herramientas,
                $nom_plataformas_herramientas,
                $user_reg
            );

                   
            $this->Model_Syllabus->edit_plataformas_herramientas($parametros);
        }
        else{
            redirect('/login');
        }

    }

    public function Delete_Asyllabus_form_6(){
        if ($this->session->userdata('usuario')) {
            
            $id_plataformas_herramientas         = $this->input->post("id_plataformas_herramientas");
            
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                $user_reg,
                $id_plataformas_herramientas 
            );
                   
            $this->Model_Syllabus->eliminar_herramientas($parametros);
        }
        else{
            redirect('/login');
        }
    }


    public function Insert_Update_Asyllabus_forma_herrami_eval(){
        if ($this->session->userdata('usuario')) {
            
            $id_forma_herrami_eval        = $this->input->post("id_forma_herrami_eval");
            $id_version_sy        = $this->input->post("id_version_sy");
                 
            $eval_diag_detalle               = $this->input->post("eval_diag_detalle");
            $eval_diag_sem                 = $this->input->post("eval_diag_sem");
            $eval_diag_peso                 = $this->input->post("eval_diag_peso");

            $eval_cont1_detalle               = $this->input->post("eval_cont1_detalle");
            $eval_cont1_sem                 = $this->input->post("eval_cont1_sem");
            $eval_cont1_peso                 = $this->input->post("eval_cont1_peso");

            $eval_cont2_detalle               = $this->input->post("eval_cont2_detalle");
            $eval_cont2_sem                 = $this->input->post("eval_cont2_sem");
            $eval_cont2_peso                 = $this->input->post("eval_cont2_peso");

            $eval_parcial_detalle               = $this->input->post("eval_parcial_detalle");
            $eval_parcial_sem                 = $this->input->post("eval_parcial_sem");
            $eval_parcial_peso                 = $this->input->post("eval_parcial_peso");

            $eval_cont3_detalle               = $this->input->post("eval_cont3_detalle");
            $eval_cont3_sem                 = $this->input->post("eval_cont3_sem");
            $eval_cont3_peso                 = $this->input->post("eval_cont3_peso");

            $eval_cont4_detalle               = $this->input->post("eval_cont4_detalle");
            $eval_cont4_sem                 = $this->input->post("eval_cont4_sem");
            $eval_cont4_peso                 = $this->input->post("eval_cont4_peso");

            $eval_final_detalle               = $this->input->post("eval_final_detalle");
            $eval_final_sem                 = $this->input->post("eval_final_sem");
            $eval_final_peso                 = $this->input->post("eval_final_peso");

    
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $accion    = $this->input->post("accion");  

            $parametros = array(
                $accion,
                $id_version_sy,

                $eval_diag_detalle,
                $eval_cont1_detalle,
                $eval_cont2_detalle,
                $eval_parcial_detalle,
                $eval_cont3_detalle,
                $eval_cont4_detalle,
                $eval_final_detalle,

                $eval_diag_sem,
                $eval_cont1_sem,
                $eval_cont2_sem,
                $eval_cont3_sem,
                $eval_parcial_sem,
                $eval_cont4_sem,
                $eval_final_sem,

                $eval_diag_peso,
                $eval_cont1_peso,
                $eval_cont2_peso,
                $eval_parcial_peso,
                $eval_cont3_peso,
                $eval_cont4_peso,
                $eval_final_peso,
         
                $user_reg,
                $id_forma_herrami_eval
            );
                   
            $id =$this->Model_Syllabus->insert_update_forma_herrami_eval($parametros);
            echo $id->ID;
        }
        else{
            redirect('/login');
        }
    }


    //---------------------------------------------------

    public function Asyllabus_data_revision($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;


            $datos['abrev']              = 'asyllabus_data';
            $datos['form_1']             = 'formulario_uno';
            $datos['form_2']             = 'formulario_dos';
            $datos['form_3']             = 'formulario_tres';
            $datos['form_4']             = 'formulario_cuatro';
            $datos['form_5']             = 'formulario_cinco';
            $datos['form_6']             = 'formulario_seis';
            $datos['form_7']             = 'formulario_siete';
            $datos['form_8']             = 'formulario_ocho';
            $datos['form_9']             = 'formulario_nueve';
            $datos['form_10']          = 'formulario_diez';

            $datos['tituloSecundario2']  = 'Syllabus Secciones';







            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
            
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
                $id_version_sy,
                '',
                ''
            );
        

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);
            
            $datos["compt_asoci_curso"] = $this->Model_Syllabus->listar_compt_asoci_curso($id_version_sy);

            $datos["forma_herrami_eval"] = $this->Model_Syllabus->listar_forma_herrami_eval($id_version_sy);






            // echo '<pre>';
            // print_r($datos);
            // echo '</pre>';
            // exit();

            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'datos_sy/syllabus_data_revision.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    function cargar_tabla_org_aprendizaje_revision($id_version_sy=null){
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
                  
            $data = $this->Model_Syllabus->listar_compt_org_aprendizaje($id_version_sy);
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {

                     
                            $semanas_rango = "Semana ".$row['semanas_aprendizaje_ini']."- Semana ".$row['semanas_aprendizaje_fin'];
                    
                            $texto .= '{"ID_ORG_APRENDIZAJE":' . json_encode($row['id_org_aprendizaje']) . ','
                                    . '"ID_VERSION_SY":' . json_encode($row['id_version_sy']) . ','
                                    . '"ORDEN":' .  json_encode($row['modulo_num_orden'])  . ','

                                    . '"MODULO_APRENDIZAJE":' .  json_encode($row['modulo_aprendizaje'])  . ','
                                    . '"RESULT_APRENDIZAJE":' .  json_encode($row['result_aprendizaje'])  . ','
                                    . '"SEMANAS":"' .  $semanas_rango  . '",'
                                    . '"CONTEN_APRENDIZAJE":' .  json_encode($row['conten_aprendizaje'])  . '},';

                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
           
    }

    public function Listar_plataformas_herramientas_revision(){
        if ($this->session->userdata('usuario')) {
            $id_version_sy        = $this->input->post("id_version_sy");
                   
            $datos =$this->Model_Syllabus->listar_plataformas_herramientas($id_version_sy);

            $lista ="";
            foreach ($datos as $row) {
                $lista .="
                <tr>
                <td WIDTH='95%' > <b>".$row['nom_recurso']."</b> :  ".$row['recurso_descrip']." </td> 
                    
                </tr>";
            }

            /*
            echo "<pre>";
            print_r($datos);
            echo "</pre>";

            exit();
            */
            
            echo $lista;

        }
        else{
            redirect('/login');
        }
    }

    public function Listar_referencias_bibliograficas_revision(){
        if ($this->session->userdata('usuario')) {
            $id_version_sy        = $this->input->post("id_version_sy");

            $tipo_bibliografia        = $this->input->post("tipo_bibliografia");

                   
            $datos =$this->Model_Syllabus->listar_referencias_bibliograficas($id_version_sy,$tipo_bibliografia);

            $lista ="";
            foreach ($datos as $row) {
                $lista .="<tr><td WIDTH='90%' >".$row['nom_referencias_bibliograficas']."</td>
                </tr>";
            }

            /*
            echo "<pre>";
            print_r($datos);
            echo "</pre>";

            exit();
            */
            
            echo $lista;

        }
        else{
            redirect('/login');
        }

    }
    
    public function Asyllabus_data_mirar($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;


            $datos['abrev']              = 'asyllabus_data';
            $datos['form_1']             = 'formulario_uno';
            $datos['form_2']             = 'formulario_dos';
            $datos['form_3']             = 'formulario_tres';
            $datos['form_4']             = 'formulario_cuatro';
            $datos['form_5']             = 'formulario_cinco';
            $datos['form_6']             = 'formulario_seis';
            $datos['form_7']             = 'formulario_siete';
            $datos['form_8']             = 'formulario_ocho';
            $datos['form_9']             = 'formulario_nueve';
            $datos['form_10']          = 'formulario_diez';

            $datos['tituloSecundario2']  = 'Syllabus Secciones';
            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
            
            




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
                $id_version_sy,
                '',
                ''
            );
        

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

                
            if(empty($datos["data_silabus"] )){
                redirect('/login');
            }
            
            $datos["compt_asoci_curso"] = $this->Model_Syllabus->listar_compt_asoci_curso($id_version_sy);

            $datos["forma_herrami_eval"] = $this->Model_Syllabus->listar_forma_herrami_eval($id_version_sy);

            // echo '<pre>';
            // print_r($datos);
            // echo '</pre>';
            // exit();

            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'datos_sy/syllabus_data_mirar.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    //---------------------------------------------------------------

    public function Enviar_Correo_Syllabus_terminado(){
        if ($this->session->userdata('usuario')) {

            $dir = dirname(__DIR__, 4);

            // $user_reg = $_SESSION['usuario'][0]['id_usuario'];


            $dato['id_syllabus'] =$this->input->post("id_syllabus");
            $dato['periodo'] =$this->input->post("periodo");
            $dato['fecha_actual'] =$this->input->post("fecha");
            $dato['nom_syll'] =$this->input->post("nom_syll");
            $dato['nom_curso'] =$this->input->post("nom_curso");

            $dato['carrera'] =$this->input->post("carrera");
            $dato['plan_estudios'] =$this->input->post("plan_estudios");
            $dato['nom_usu_registro'] =$this->input->post("nom_usu_registro");
            $dato['id_version_sy'] =$this->input->post("id_version_sy");
            $dato['nom_tipo_estudios'] =$this->input->post("nom_tipo_estudios");
 
            $dato['timestamp'] = $this->fechaespanol->dateFriendly(strtotime($dato['fecha_actual']));
            $dato['url_pdf'] = site_url($this->url.$this->opcion.'/Asyllabus_pdf/'.  $dato['id_syllabus'] );
            $dato['url_comentario'] = site_url($this->url.$this->opcion.'/Asyllabus_data_revision/'.  $dato['id_syllabus'] .'/'.  $dato['id_version_sy']);
            $dato['url_comentario_ficha'] = site_url($this->url.$this->opcion.'/Asyllabus_data_revision_ficha_eval/'.  $dato['id_syllabus'] .'/'.  $dato['id_version_sy']);

            $dato['url_lista'] = site_url('admin/usuarios/Asyllabus');

            $correos =$this->Model_Syllabus->listar_correos_usuarios_revision();
           

            $usu_nombre_correo_actual = actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'usuario_nombres').' '.actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'usuario_amater').' '.actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'usuario_apater');

            $usu_correo_actual = actualizar_data_logeo($_SESSION['usuario'][0]['id_usuario'],'usuario_email');


            $mail = new PHPMailer(true);
            $mail->isSMTP();                                      // Set mailer to use SMTP

                    try {
                        $mail->CharSet = $this->CharSet;
                        //Server settings
                        $mail->SMTPDebug =  $this->SMTPDebug;                                 // Enable verbose debug output
                        $mail->Host = $this->Host;                  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = $this->SMTPAuth;                                 // Enable SMTP authentication
                        $mail->Username = $this->Username;                // SMTP username
                        $mail->Password = $this->Password;                           // SMTP password
                        $mail->SMTPSecure = $this->SMTPSecure;                           // Enable SSL encryption, TLS also accepted with port 587
                        $mail->Port = $this->Port;                                   // TCP port to connect to

                        $mail->setFrom('pupixoxd@gmail.com', 'Alerta de Syllabus'); //desde donde se envia            
                        $mail->addAddress('180000323@cientifica.edu.pe', 'Alerta de Syllabus'); //desde donde se envia
                        // $mail->addAddress('Pedro.Acosta@inei.gob.pe', 'Alerta de Syllabus'); //desde donde se envia

                        $mail->addAddress($usu_correo_actual, $usu_nombre_correo_actual ); //desde donde se envia

                        foreach ($correos as $key => $valores) {
                            //Recipients
                            $mail->addAddress($valores['usuario_email'], $valores['usuario_nombres'].' '.$valores['usuario_amater'].' '. $valores['usuario_apater']);     // Add a recipient
                        }
                   
                        $mail->AddEmbeddedImage($dir.'\assets\template\correo_img\syllabus\img1.png', 'logo_1');                                          
                        $mail->AddEmbeddedImage($dir.'\assets\template\correo_img\syllabus\img2.jpg', 'logo_2');  
                        $mail->AddEmbeddedImage($dir.'\assets\template\correo_img\syllabus\youtube.png', 'logo_3');     
   
                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Syllabus '. $dato['nom_syll'].'-'. $dato['periodo'] .' '.'a espera de revisión ' ;
                        $html = $this->load->view($this->url_carpeta.'mail/alerta_syllabus_termino.php',$dato,true);
                        $mail->Body = $html;
                        $mail->send();
                        echo 'Message has been sent';

                    } catch (Exception $e) {
                        echo 'Message could not be sent.';
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }


        }else{
            redirect('/login');
        }
    }
       
    public function Nueva_version(){
        if ($this->session->userdata('usuario')) {
            
            $id_syllabus          = $this->input->post("id_syllabus");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $cant_versiones = count($this->Model_Syllabus->listar_syversion_id_sy($id_syllabus)) +1 ;

            $parametros = array(
                $id_syllabus,
                $cant_versiones,
                $user_reg
            );

            //   echo '<pre>';
            // print_r($parametros);
            // echo '</pre>';
            // exit();
                   
            $this->Model_Syllabus->registrar_version_sy($parametros);
        }
        else{
            redirect('/login');
        }
    }
    public function Version_principal(){
        if ($this->session->userdata('usuario')){
            
            $id_syllabus          = $this->input->post("id_syllabus");
            $id_version_sy          = $this->input->post("id_version_sy");
            $estado          = $this->input->post("estado");
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                $user_reg,
                $id_syllabus,
                $id_version_sy,
                $estado
            );
                
            $this->Model_Syllabus->update_version_sy_principal($parametros);
        }
        else{
            redirect('/login');
        }
    }
    
    public function Ver_Version_syllabu(){
        if ($this->session->userdata('usuario')) {
            
            $id_syllabus          = $this->input->post("id_syllabus");
            $id_version_sy          = $this->input->post("id_version_sy");
            $numero_version          = $this->input->post("numero_version");
            
            $porcen_syll_dg = $this->Model_Syllabus->ver_porcentaje_syllabus_dg($id_version_sy);
            $porcen_syll_ac = $this->Model_Syllabus->ver_porcentaje_syllabus_ac($id_version_sy);
            $porcen_syll_oa = $this->Model_Syllabus->ver_porcentaje_syllabus_oa($id_version_sy);
            $porcen_syll_fhe = $this->Model_Syllabus->ver_porcentaje_syllabus_fhe($id_version_sy);
            $porcen_syll_ap = $this->Model_Syllabus->ver_porcentaje_syllabus_ap($id_version_sy);
            $porcentaje_syllabus_ph = $this->Model_Syllabus->ver_porcentaje_syllabus_ph($id_version_sy);
            $porcentaje_syllabus_bibli = $this->Model_Syllabus->ver_porcentaje_syllabus_bibli($id_version_sy);
            $porcentaje_syllabus_sumilla = $this->Model_Syllabus->ver_porcentaje_syllabus_sumilla($id_version_sy);
            $porcentaje_syllabus_result_ga = $this->Model_Syllabus->ver_porcentaje_syllabus_result_ga($id_version_sy);
            $porcentaje_syllabus_estrate_didac = $this->Model_Syllabus->ver_porcentaje_syllabus_estrate_didac ($id_version_sy);

            $valor_porcentajes_syllabus_dg= ($porcen_syll_dg->porcentaje_syllabus == null ? 0 : $porcen_syll_dg->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ac= ($porcen_syll_ac->porcentaje_syllabus == null ? 0 : $porcen_syll_ac->porcentaje_syllabus);
            $valor_porcentajes_syllabus_oa= ($porcen_syll_oa->CANTIDAD == null ? 0 : $porcen_syll_oa->CANTIDAD)  ;
            $valor_porcentajes_syllabus_fhe= ($porcen_syll_fhe->porcentaje_syllabus == null ? 0 : $porcen_syll_fhe->porcentaje_syllabus);
            $valor_porcentajes_syllabus_sumilla= ($porcentaje_syllabus_sumilla->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_sumilla->porcentaje_syllabus);

            $valor_porcentajes_syllabus_result_ga= ($porcentaje_syllabus_result_ga->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_result_ga->porcentaje_syllabus);
            $valor_porcentajes_syllabus_estrate_didac= ($porcentaje_syllabus_estrate_didac->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_estrate_didac->porcentaje_syllabus);

            $valor_porcentajes_syllabus_ap= ($porcen_syll_ap->porcentaje_syllabus == null ? 0 : $porcen_syll_ap->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ph= ($porcentaje_syllabus_ph->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ph->porcentaje_syllabus);
            $valor_porcentajes_syllabus_bibli= ($porcentaje_syllabus_bibli->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_bibli->porcentaje_syllabus);



            //------------

            $porcentaje_syllabus_ficha_eval1 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,1);
            $porcentaje_syllabus_ficha_eval2 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,2);
            $porcentaje_syllabus_ficha_eval3 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,3);
            $porcentaje_syllabus_ficha_eval4 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,4);
            $porcentaje_syllabus_ficha_eval5 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,5);
            $porcentaje_syllabus_ficha_eval6 = $this->Model_Syllabus->ver_porcentaje_syllabus_ficha_eval ($id_version_sy,6);


            $valor_porcentajes_syllabus_ficha_eval1= ($porcentaje_syllabus_ficha_eval1->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval1->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ficha_eval2= ($porcentaje_syllabus_ficha_eval2->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval2->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ficha_eval3= ($porcentaje_syllabus_ficha_eval3->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval3->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ficha_eval4= ($porcentaje_syllabus_ficha_eval4->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval4->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ficha_eval5= ($porcentaje_syllabus_ficha_eval5->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval5->porcentaje_syllabus);
            $valor_porcentajes_syllabus_ficha_eval6= ($porcentaje_syllabus_ficha_eval6->porcentaje_syllabus == null ? 0 : $porcentaje_syllabus_ficha_eval6->porcentaje_syllabus);
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

            $data_silabus = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            $revision = '';
            $vista='';
            $mirar ='';

                            if($_SESSION['usuario'][0]['id_nivel'] == 4 ){ 
                                $revision =site_url($this->url.$this->opcion.'/Asyllabus_data_revision/'. $id_syllabus.'/'.$id_version_sy );
                            }else if($_SESSION['usuario'][0]['id_nivel']==1){
                                $revision =site_url($this->url.$this->opcion.'/Asyllabus_data_revision/'. $id_syllabus.'/'.$id_version_sy );
                                $vista =site_url($this->url.$this->opcion.'/Asyllabus_data/'. $id_syllabus.'/'.$id_version_sy  );
                                $mirar =site_url($this->url.$this->opcion.'/Asyllabus_data_mirar/'. $id_syllabus.'/'.$id_version_sy  );
                            }else if($_SESSION['usuario'][0]['id_nivel']==5){
                            } else{
                                $vista =site_url($this->url.$this->opcion.'/Asyllabus_data/'. $id_syllabus.'/'.$id_version_sy  );
                                $mirar =site_url($this->url.$this->opcion.'/Asyllabus_data_mirar/'. $id_syllabus.'/'.$id_version_sy  );
                            }

            $versi ='<h1> Versión '.$numero_version.' '.($data_silabus[0]['version_principal']==$id_version_sy  ? "</br> <h6>Actualmente es la versión Principal</h6>": "" ) .  ' </h1>';

            
            if($data_silabus[0]['fech_aprob'] == ''){
                $tiempo_sy_text= "TIEMPO ACTUAL TRANSCURRIDO DESDE LA CREACIÓN DESDE ESTA VERSIÓN DEL SYLLABUS";
            }else{
                $tiempo_sy_text= "TIEMPO TOTAL QUE SE EMPLEÓ PARA LA CREACIÓN DE ESTA VERSIÓN DEL SYLLABUS";
            }   

            $version_sy_list = $this->Model_Syllabus->listar_syversion_id($id_version_sy);

            $date1 = new DateTime($version_sy_list[0]['fecha_reg_version']);
            $date2 = new DateTime($version_sy_list[0]['fech_aprob']);
            $diff = $date1->diff($date2);
            $fech_diferencia = formato_resta($diff);

            //-----------------------------------------------------------------------

            $revision_ficha = '';
            $vista_ficha='';
            $mirar_ficha ='';

            if($_SESSION['usuario'][0]['id_nivel'] == 4 ){ 
                $revision_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_revision_ficha_eval/'. $id_syllabus.'/'.$id_version_sy );
            }else if($_SESSION['usuario'][0]['id_nivel']==1){
                $revision_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_revision_ficha_eval/'. $id_syllabus.'/'.$id_version_sy );
                $vista_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_ficha_eval/'. $id_syllabus.'/'.$id_version_sy  );
                $mirar_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_mirar_ficha_eval/'. $id_syllabus.'/'.$id_version_sy  );
            }else if($_SESSION['usuario'][0]['id_nivel']==5){
            } else{
                $vista_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_ficha_eval/'. $id_syllabus.'/'.$id_version_sy  );
                $mirar_ficha =site_url($this->url.$this->opcion.'/Asyllabus_data_mirar_ficha_eval/'. $id_syllabus.'/'.$id_version_sy  );
            }



            $DATA = array(
                'sy' => array(
                                'revision' => $revision ,
                                'vista' => $vista ,
                                'mirar' => $mirar ,

                                'id_syllabus' => $id_syllabus ,
                                'periodo' => $data_silabus[0]['periodo_anio']. ' ' .  $data_silabus[0]['periodo_ciclo'] ,
                                'fecha' => $data_silabus[0]['fec_reg'] ,
                                'nom_syll' =>$data_silabus[0]['nombre_syllabus'] ,
                                'nom_carrera' => $data_silabus[0]['nom_carrera'] ,
                                'plan_estudios' => $data_silabus[0]['nom_plan_estudios'] ,
                                'nom_usu_registro' => $data_silabus[0]['nom_usu_registro'],
                                'id_version_sy' => $id_version_sy,
                                'nom_tipo_estudios' => $data_silabus[0]['nom_tipo_estudios'] ,
                                'nom_curso' => $data_silabus[0]['nom_curso'] ,
                              


                                'valor_porcentajes_syllabus_dg' => $valor_porcentajes_syllabus_dg ,
                                'valor_porcentajes_syllabus_ac' => $valor_porcentajes_syllabus_ac ,
                                'valor_porcentajes_syllabus_sumilla' => $valor_porcentajes_syllabus_sumilla ,
                                'valor_porcentajes_syllabus_result_ga' => $valor_porcentajes_syllabus_result_ga ,
                                'valor_porcentajes_syllabus_oa' => $valor_porcentajes_syllabus_oa ,
                                'valor_porcentajes_syllabus_estrate_didac' => $valor_porcentajes_syllabus_estrate_didac ,
                                'valor_porcentajes_syllabus_fhe' => $valor_porcentajes_syllabus_fhe ,
                                'valor_porcentajes_syllabus_ap' => $valor_porcentajes_syllabus_ap ,
                                'valor_porcentajes_syllabus_ph' => $valor_porcentajes_syllabus_ph ,
                                'valor_porcentajes_syllabus_bibli' => $valor_porcentajes_syllabus_bibli ,

                            ),

                'version' => $versi,
                'ficha' => array(
                                    'revision_ficha' => $revision_ficha ,
                                    'vista_ficha' => $vista_ficha ,
                                    'mirar_ficha' => $mirar_ficha ,

          
                                    'valor_porcentajes_syllabus_ficha_eval1' => $valor_porcentajes_syllabus_ficha_eval1 ,
                                    'valor_porcentajes_syllabus_ficha_eval2' => $valor_porcentajes_syllabus_ficha_eval2 ,
                                    'valor_porcentajes_syllabus_ficha_eval3' => $valor_porcentajes_syllabus_ficha_eval3 ,
                                    'valor_porcentajes_syllabus_ficha_eval4' => $valor_porcentajes_syllabus_ficha_eval4 ,
                                    'valor_porcentajes_syllabus_ficha_eval5' => $valor_porcentajes_syllabus_ficha_eval5 ,
                                    'valor_porcentajes_syllabus_ficha_eval6' => $valor_porcentajes_syllabus_ficha_eval6 ,


                                ),
                'tiempo_sy_text' =>  $tiempo_sy_text ,
                'tiempo_sy_diff' => $fech_diferencia ,
                'es_principal'  => $data_silabus[0]['version_principal']==$id_version_sy,
            );

            $json = json_encode($DATA); 
            
            echo($json); 

        }
        else{
            redirect('/login');
        }
    }

    public function Insert_Update_comentario_vers_sy(){
        if ($this->session->userdata('usuario')) {
            
            $id_version_sy          = $this->input->post("id_version_sy");
            $data_campo          = $this->input->post("data_campo");
            $campo          = $this->input->post("campo");

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $parametros = array(
                $user_reg,
                $data_campo,
                $id_version_sy,
                $campo

            );
                   
            $id =$this->Model_Syllabus->upd_version_sy_comentario($parametros);

            echo '<pre>';
            print_r( $id );
            echo '</pre>';
            // exit();
        }
        else{
            redirect('/login');
        }
    }

    ///------------------------------------------------------------------------------------------------------

    public function Historial_version_sy($id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);

            $datos['id_version_sy'] = $id_version_sy;
            $datos['abrev']              = 'asyllabus_historial';
            
             $datos["version_sy"] = $this->Model_Syllabus->listar_syversion_id($id_version_sy);
             $datos['id_syllabus'] =    $datos["version_sy"][0]['id_syllabus'];


            // echo '<pre>';
            // print_r($datos);
            // echo '</pre>';
            // exit();

            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'/historial/historial_version_sy.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }


    function cargar_tabla_historial($id_version_sy,$id_seccion){
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
                  
            $data = $this->Model_Syllabus->listar_historial_seccion($id_version_sy,$id_seccion);
                  
        
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {

                        
                            $texto .= '{"ACCION":' . json_encode($row['nom_accion']) . ','
                                    . '"USUARIO":' . json_encode($row['nombre_reg']) . ','
                                    . '"FECHA":' . json_encode($row['fec_reg']) . ','
                                    . '"ID_HISTORIAL":' . json_encode($row['id_historial_acc']) . ''

                                    . '},';

                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
           
    }

    function cargar_tabla_historial_ficha($id_version_sy,$id_seccion,$eval1){

        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
                  
            $data = $this->Model_Syllabus->listar_historial_seccion_ficha($id_version_sy,$id_seccion,$eval1);
                  
        
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {

                        
                            $texto .= '{"ACCION":' . json_encode($row['nom_accion']) . ','
                                    . '"USUARIO":' . json_encode($row['nombre_reg']) . ','
                                    . '"FECHA":' . json_encode($row['fec_reg']) . ','
                                    . '"ID_HISTORIAL":' . json_encode($row['id_historial_acc']) . ''

                                    . '},';

                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
    }

    //---------------------------------------------------------------------------------------------

    public function Asyllabus_data_ficha_eval($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
        
            $datos['abrev']              = 'asyllabus_ficha_data';
            $datos['formulario_eval_1']             = 'formulario_eval_1';
            $datos['formulario_eval_2']             = 'formulario_eval_2';
            $datos['formulario_eval_3']             = 'formulario_eval_3';
            $datos['formulario_eval_4']             = 'formulario_eval_4';
            $datos['formulario_eval_5']             = 'formulario_eval_5';
            $datos['formulario_eval_6']             = 'formulario_eval_6';

            $datos['tituloSecundario2']  = 'Ficha de Evaluación Secciones';

            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
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
                $id_version_sy,
                '',
                ''
            );        

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

                
            if(empty($datos["data_silabus"] )){
                redirect('/login');
            }

            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;
            $datos['version_sy_principal'] =  $datos["data_silabus"][0]['version_principal'];

            $datos["ficha_eval_1"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,1);
            $datos["ficha_eval_2"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,2);
            $datos["ficha_eval_3"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,3);
            $datos["ficha_eval_4"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,4);
            $datos["ficha_eval_5"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,5);
            $datos["ficha_eval_6"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,6);


            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'ficha_evalu/ficha_evaluacion.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    public function Insert_Update_ficha_eval(){
        if ($this->session->userdata('usuario')) {
            $id_version_sy          = $this->input->post("id_version_sy");
            $semana_eval          = $this->input->post("semana_eval");
            $defin_eval          = $this->input->post("defin_eval");
            $descrip_eval          = $this->input->post("descrip_eval");
            $criterios_eval          = $this->input->post("criterios_eval");
            $ids_competencias          = $this->input->post("ids_competencias");
            $ids_com_text=implode(",", $ids_competencias); // string(20) "lastname,email,phone"
            $number          = $this->input->post("number");
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $id_ficha_eval          = $this->input->post("id_eval");
            $criterio          = $this->input->post("criterio");

            $parametro1 = array(
                $id_version_sy,
                $semana_eval,
                $defin_eval,
                $descrip_eval,
                $criterios_eval,
                $ids_com_text,
                $number,
                $user_reg
            );            
             $this->Model_Syllabus->upd_ficha_eval($parametro1);
            foreach ($criterio as $row) {
                // $parametros = array(
                //     $id_ficha_eval,
                //     $row['id_compet'],
                //     $row['logrado'],
                //     $row['logrado_puntaje'],
                //     $row['en_proceso'],
                //     $row['en_proceso_puntaje'],
                //     $row['no_logrado'],
                //     $row['no_logrado_puntaje'],
                //     $user_reg,
                //     $row['id_criti'] ,
                // );            

                // echo '<pre>';
                // print_r( $parametros );
                // echo '</pre>';
                
                // exit();
                //  $id =$this->Model_Syllabus->insert_update_eval_ficha($parametros);

                 $parametros = array(
                    'vACCION'        =>'CRITERIO_EVAL',
                    'p_id_1'         =>  $id_ficha_eval,
                    'p_id_2'       =>  $row['id_compet'],
                    'p_id_3'     =>  $row['id_criti'],
                    'p_texto1' =>  $row['logrado'],
                    'p_texto2' => $row['logrado_puntaje'],
                    'p_texto3'    => $row['en_proceso'],
                    'p_texto4' =>  $row['en_proceso_puntaje'],
                    'p_texto5' => $row['no_logrado'],
                    'p_estado' => '2',
                    'p_user' =>  $user_reg,
    
                    'p_texto6' => $row['no_logrado_puntaje'],
                    'p_texto7' => '',
                    'p_texto8' =>  '',
                    'p_texto9' =>  '',   
                    'p_texto10' =>  '',   
                );

            // echo '<pre>';
            //     print_r( $parametros );
            //     echo '</pre>';
                

                 $this->contenedor->procedureUpdateOrInsertTables($parametros);

            }

            // $id_eval          = $this->input->post("id_eval");          
        }
        else{
            redirect('/login');
        }
    }

    public function Asyllabus_data_mirar_ficha_eval($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
        
            $datos['abrev']              = 'asyllabus_ficha_data';
            $datos['formulario_eval_1']             = 'formulario_eval_1';
            $datos['formulario_eval_2']             = 'formulario_eval_2';
            $datos['formulario_eval_3']             = 'formulario_eval_3';
            $datos['formulario_eval_4']             = 'formulario_eval_4';
            $datos['formulario_eval_5']             = 'formulario_eval_5';
            $datos['formulario_eval_6']             = 'formulario_eval_6';

            $datos['tituloSecundario2']  = 'Ficha de Evaluación Secciones';
          
            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
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
                $id_version_sy,
                '',
                ''
            );    

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;
            $datos['version_sy_principal'] =  $datos["data_silabus"][0]['version_principal'];

            $datos["ficha_eval_1"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,1);
            $datos["ficha_eval_2"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,2);
            $datos["ficha_eval_3"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,3);
            $datos["ficha_eval_4"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,4);
            $datos["ficha_eval_5"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,5);
            $datos["ficha_eval_6"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,6);


            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'ficha_evalu/ficha_evaluacion_mirar.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }

    
    public function Asyllabus_data_revision_ficha_eval($id_syllabus,$id_version_sy){
        if ($this->session->userdata('usuario')) {

            $datos   = obtenerDatosIndexNuevo($this);
        
            $datos['abrev']              = 'asyllabus_ficha_data';
            $datos['formulario_eval_1']             = 'formulario_eval_1';
            $datos['formulario_eval_2']             = 'formulario_eval_2';
            $datos['formulario_eval_3']             = 'formulario_eval_3';
            $datos['formulario_eval_4']             = 'formulario_eval_4';
            $datos['formulario_eval_5']             = 'formulario_eval_5';
            $datos['formulario_eval_6']             = 'formulario_eval_6';

            $datos['tituloSecundario2']  = 'Ficha de Evaluación Secciones';

         
            $accion = 'LISTAR_SYLLABUS_ID_VERSION';
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
                $id_version_sy,
                '',
                ''
            );      

            $datos["data_silabus"] = $this->Model_Syllabus->procedureCrud_Syllabus($parametros);

            $datos['id_syllabus'] = $id_syllabus;
            $datos['id_version_sy'] = $id_version_sy;
            $datos['version_sy_principal'] =  $datos["data_silabus"][0]['version_principal'];

            $datos["ficha_eval_1"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,1);
            $datos["ficha_eval_2"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,2);
            $datos["ficha_eval_3"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,3);
            $datos["ficha_eval_4"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,4);
            $datos["ficha_eval_5"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,5);
            $datos["ficha_eval_6"] = $this->Model_Syllabus->listar_ficha_eval($id_version_sy,6);


            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'ficha_evalu/ficha_evaluacion_revision.php', $datos);
        }
        else{
            redirect('/login');
        }        
    }


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

            
            // if(empty($datos["data_silabus"] )){
            //     redirect('/login');
            // }
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

            $html = $this->load->view($this->url_carpeta.'pdf/ficha_eval.php',$data_pdf,true);
         
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



 
