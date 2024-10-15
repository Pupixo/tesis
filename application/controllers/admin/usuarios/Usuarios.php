<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Usuarios';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Usuarios';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Usuarios';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_usuarios';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Usuarios';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/usuarios/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'usuario';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/usuarios/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Model_Usuario');
        $this->load->model('Model_Syllabus');
        $this->load->model('Model_Cursos');

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
            $this->layout->view($this->url.'index', $datos);
        }else{
            redirect('/login');
        }
    }

    function cargar_tabla_usuario()
    {
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

            $accion = 'LISTADO_USUARIO';
            $parametros = array($accion,'', '', '', '', '','', '', '', '','','','',null,null);
     
            $data = $this->Model_Usuario->procedureCrudUusuario($parametros);
                    //".$row['usuario_nombres']."    ".$row['id_usuario']."     ".$row['id_usuario']."
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {
                        

                        $botones = "<center >"   
                                        . "<div   class='btn-group' role='group' aria-label='' style='width: 100%; justify-content: flex-end;'>"
                                        . "<div class='btn-group' role='group'>";
                                  

                                        if( $row['id_nivel'] == 3){ 
                                            $botones .="<div class='btn-group' >"
                                                            ."<a  title='Asignar Plan Estudios' onclick='AsignarPlanEstudio(".$row['id_usuario'].")' target='_blank' id='asig_curso_".$this->opcion."' type='button' class='btn bg-light rueda_pdf ' style='width: auto'>"
                                                                . "<span  class='fa fa-hand-pointer'></span>"
                                                            . "</a>"
                                                        ."</div>";
                                        }
                                      



                                     
                                            $botones .= "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
                                                . "<span  class='fa fa-gear'></span>"
                                            . "</button>"
                                          
                                            . "<div  style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;' class='dropdown-menu rueda-accion color-0' aria-labelledby='btnGroupDrop".$this->opcion."'>"
                                          
                                                ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_usuario'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"  	
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                ."Editar Fila</span>"
                                                ."</a>"


                                                ."<a style='cursor: pointer;' onclick='Eliminar_Usuario(".$row['id_usuario'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                ."Eliminar Fila</span>"
                                                ."</a>"
                                            . "</div>"
                                        . "</div>"
                                    ."</div></center>";
                   
                        $texto .= '{"NOMBRE":' . json_encode($row['usuario_nombres']) . ','
                                . '"NIVEL":' . json_encode($row['nom_nivel']) . ','
                                . '"ID_NIVEL":' . json_encode($row['id_nivel']) . ','
                                . '"ESTADO":' . json_encode($row['nom_status']) . ','
                                . '"ESTADO_ID":' . json_encode($row['estado']) . ','
                                . '"PATERNO":' . json_encode($row['usuario_apater']) . ','
                                . '"MATERNO"             :' . json_encode($row['usuario_amater']) . ','
                                . '"CODIGO"             :' . json_encode($row['usuario_codigo']) . ','
                                . '"PASSWORD"             :' . json_encode($row['usuario_password']) . ','
                                . '"MAIL"             :' . json_encode($row['emailp']) . ','
                                . '"CELULAR"             :' . json_encode($row['num_celp']) . ','  


                                . '"ID_PLAN_ESTUDIOS"             :' . json_encode($row['id_plan_estudios']) . ','  
                                . '"CICLO_NUM"             :' . json_encode($row['ciclo_num']) . ','  



                                . '"ACCION"                 :"' . $botones . '"},';
                        $fila++; 
                    }
                    $texto = rtrim($texto, ",");
                    $texto .= ']}';
                    echo $texto;
        }else{
            redirect('/login');

        }
           
    }

    //---------------------------------------------------------------------------
    public function Insert_Usuario(){
        if ($this->session->userdata('usuario')) {
            $user_reg= $_SESSION['usuario'][0]['id_usuario'];

            $id_nivel               = $this->input->post("cbx_basicos_id_nivel");
            $usuario_nombres        = $this->input->post("usuario_nombres"); 
            $usuario_apater         = $this->input->post("usuario_apater");
            $usuario_amater         = $this->input->post("usuario_amater");
            $num_celp               = $this->input->post("num_celp");
            $emailp                 = $this->input->post("emailp");
            $usuario_email          = $emailp;
            $id_status              = $this->input->post("cbx_basicos_id_status");
         
            $usuario_codigo         = $this->input->post("usuario_codigo");

            $password               =$this->input->post("usuario_password");
            $usuario_password       = password_hash($password, PASSWORD_DEFAULT);



            $plan_estudio =$this->input->post("cbx_basicos_id_plan_estudios");
            $num_ciclo =$this->input->post("num_ciclo");



            $accion = 'INSERTAR_USUARIO';
            $parametros = array(
                $accion,
                '',
                $user_reg,
                $id_nivel,
                $usuario_nombres,
                $usuario_apater,
                $usuario_amater,
                $num_celp,
                $emailp,
                $usuario_email,
                $id_status,
                $usuario_codigo,
                $usuario_password,
                $plan_estudio,
                $num_ciclo
            );
            $this->Model_Usuario->procedureCrudUusuario($parametros);
        }
        else{
            redirect('/login');
        }        
    }

    public function Update_Usuario(){
        if ($this->session->userdata('usuario')) {
            $id =$this->input->post("id_usuario");
            $user_act= $_SESSION['usuario'][0]['id_usuario'];
            $usuario_nombres =$this->input->post("usuario_nombres");
            $usuario_apater =$this->input->post("usuario_apater");
            $usuario_amater =$this->input->post("usuario_amater");
            $usuario_codigo =$this->input->post("usuario_codigo");
            $password=$this->input->post("usuario_password");
            $password_original=$this->input->post("password_original");

            
                if($password ===  '*****'){
                    $usuario_password= $password_original;

                }else{
                    $usuario_password= password_hash($password, PASSWORD_DEFAULT);
                }

            $emailp= $this->input->post("emailp");
            $usuario_email= $emailp;  
            $num_celp= $this->input->post("num_celp");
            $id_nivel= $this->input->post("cbx_basicos_id_nivel");
            $id_status= $this->input->post("cbx_basicos_id_status");
           

            $plan_estudio =$this->input->post("cbx_basicos_id_plan_estudios");
            $num_ciclo =$this->input->post("num_ciclo");

  
            $accion = 'ACTUALIZAR_USUARIO';
            $parametros = array(
                $accion,
                $id,
                $user_act,
                $id_nivel,
                $usuario_nombres,
                $usuario_apater,
                $usuario_amater,
                $num_celp,
                $emailp,
                $usuario_email,
                $id_status,
                $usuario_codigo,
                $usuario_password,
                $plan_estudio,
                $num_ciclo

            );
            
       
            
            $this->Model_Usuario->procedureCrudUusuario($parametros);
        }else{
            redirect('/login');
        }
    }

    public function Delete_Usuario(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id_usuario");

            $accion = 'ELIMINAR_USUARIO';
            $parametros = array(
                $accion,
                $id,
                $user_eli,
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
                null,
                null
            );
            $this->Model_Usuario->procedureCrudUusuario($parametros);

        }
        else{
            redirect('/login');
        }
    }
    //---------------------------------------------------------------------------------------------------------

        
    public function Mirar_asignar_plan_estudio($id_usuario ){
        if ($this->session->userdata('usuario')) {

            $id_usuario =$id_usuario;
            $datos =$this->Model_Usuario->listar_asignacion_plan_estudios($id_usuario);   
            $lista = '{"data":[';
            foreach ($datos as $row) {
                $botones =" <div class='container_tabla_td'>"
                                ."<div>" 
                                    ."<a style='cursor: pointer' onclick='Eliminar_PlanEstudiosAsignado(".$row['id_asignacion_plan_estudios'].")' id='delete' role='button' title='Eliminar' >"
                                    ."<i class='fa fa-trash'  style='color: #f40000c9;'></i>"
                                    ."</a>"
                                    ."<a  style='cursor: pointer' title='Asignar Cursos'  onclick=Asignar_Cursos(".$row['id_asignacion_plan_estudios'].",".$row['id_plan_estudios'].",".$row['id_usuario'].",this)  >"
                                        ."<i class='fa fa-archive' style='color: #2242ecc9;margin-left: 20px;' ></i>"
                                    ."</a>" 
                                ."</div>" 
                            ."</div> ";

                        $lista .= '{"NOMBRE":' . json_encode($row['nom_plan_estudios']) . ','
                               .'"ACCION"                 :"' . $botones . '"},';
            }       
            
            $lista = rtrim($lista, ",");
            $lista .= ']}';
            
            echo $lista;
        }
        else{
            redirect('/login');
        }
    }

    public function Combo_planes_estudios(){
        if ($this->session->userdata('usuario')) {

            $id_usuario =$this->input->post("id_usuario");
            $datos =$this->Model_Usuario->listar_combo_asig_plan_est($id_usuario);   
            
            $json = json_encode($datos); 
            
            echo($json); 
        }
        else{
            redirect('/login');
        }
    }

    public function Insertar_AsignacionPlanEstudios(){
        if ($this->session->userdata('usuario')) {
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $id_plan_estudios =$this->input->post("id_plan_estudios");
            $id_usuario =$this->input->post("id_usuario");

            $this->Model_Usuario->insert_asignacion_plan_estudios($id_plan_estudios, $user_reg, $id_usuario );        
          
        }
        else{
            redirect('/login');
        }
    }
    
    public function Eliminar_AsignacionPlanEstudios(){
        if ($this->session->userdata('usuario')) {
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $id_asignacion_plan_estudios =$this->input->post("id_asignacion_plan_estudios");

            $this->Model_Usuario->eliminar_asignacion_plan_estudios($id_asignacion_plan_estudios, $user_reg );        
          
        }
        else{
            redirect('/login');
        }
    }

//-------------------------------------------------------
    
    public function Mirar_asignar_curso($id_asignacion_plan_estudios){
            if ($this->session->userdata('usuario')) {
                
                $id_asignacion_plan_estudios =$id_asignacion_plan_estudios;

                $datos =$this->Model_Usuario->listar_asignacion_curso($id_asignacion_plan_estudios);   
                
                $lista = '{"data":[';
                foreach ($datos as $row) {
                    $botones =" <div class='container_tabla_td'>"
                                    ."<div>" 
                                        ."<a style='cursor: pointer' onclick='Eliminar_CursoAsignado(".$row['id_asignacion_cursos'].")' id='delete' role='button' title='Eliminar' >"
                                        ."<i class='fa fa-trash'  style='color: #f40000c9;'></i>"
                                        ."</a>"
                                    ."</div>" 
                                ."</div> ";

                            $lista .= '{"NOMBRE":' . json_encode(  $row['nom_ciclo']  . ' - '. $row['nom_curso']) . ','
                                    .'"ACCION"                 :"' . $botones . '"},';
                }       
                
                $lista = rtrim($lista, ",");
                $lista .= ']}';
                
                echo $lista;

            }
            else{
                redirect('/login');
            }
        }


        
        public function Seleccionar_compt_aso($id_ciclo,$id_version_sy,$user_reg,$accion,$id_compt_asoci_curso,$id_curso){
            $data_compt_det= $this->Model_Syllabus->listar_compet_detalle($id_ciclo);  

            $data_diccion = array();

            if(!empty($data_compt_det)){

                if($data_compt_det[0]['compet_gene_uno']== 0 || $data_compt_det[0]['compet_gene_nivel_uno'] === '' ){
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
                    'vACCION'        =>'COMPT_ASOCI_CURSO_ASIGNAR_CURSO',
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

            // $id =$this->Model_Syllabus->update_insert_sumilla($parametros);
        }


    
    
    public function Insertar_AsignacionCursos(){
        if ($this->session->userdata('usuario')) {
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];
            $nom_ciclo =$this->input->post("nom_ciclo");
            $id_asignacion_plan_estudios =$this->input->post("id_asignacion_plan_estudios");
            $docente_id =$this->input->post("docente_id");

            foreach ($nom_ciclo as $row) {
                $fila = explode("[", $row);

                $result_insert=$this->Model_Usuario->insert_asignacion_curso($fila[2],$fila[1],$id_asignacion_plan_estudios,$fila[0],$user_reg);     
                

                $datos_ciclo=$this->contenedor->get_lista_ciclo_planEstudios_by_id($fila[1]);        

                $estado              = 1;
                $nombre_syllabus         = null;
                $periodo_anio         = $datos_ciclo[0]["anio"];
                $periodo_ciclo         = null;
    
                $id_plan_estudios              =  $datos_ciclo[0]["id_plan_estudios"];
                $id_carrera                 =  $datos_ciclo[0]["id_carrera_plan"];
                $id_director              = $datos_ciclo[0]["id_director"];
                $nom_ciclo              = $datos_ciclo[0]["nom_ciclo"];
    
                $id_curso              = $datos_ciclo[0]["id_curso"];

                print("id_curso***********************************". $id_curso);
                $creditos              = $datos_ciclo[0]["creditos"];
                $horas_teoricas              =  $datos_ciclo[0]["horas_teoricas"];
                $horas_practicas              =   $datos_ciclo[0]["horas_practicas"];
                $horas_totales              =  $datos_ciclo[0]["horas_totales"];
    
                $requisito              = $datos_ciclo[0]["requisitos"];
                $tipo_ciclo              = $datos_ciclo[0]["tipo_curso"];
                $id_condicion                 =  $datos_ciclo[0]["obligatoriedad"]; 
                $presencialidad              = $datos_ciclo[0]["presencialidad"];
                $id_docente              = $docente_id;
                
                $version_principal        = null;
    
                $id_facultad        = null;
                $id_depart_univer               = null;
                $id_asignacion_curso               =  $result_insert[0]["ultimo_id"];

                $id_ciclo              = $fila[1];
                $id_tipo_estudios              = $datos_ciclo[0]["tipo_estudios"];
    
                        
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
                            $docente_id       
                        );
                    
                        $data=$this->Model_Syllabus->procedureCrud_Syllabus($parametros);
                        print_r($data);
            
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
            
                        $this->Seleccionar_compt_aso($id_ciclo,$data[0]['id_version_sy'],$user_reg,'','',$id_curso);

            }      
        }
        else{
            redirect('/login');
        }
    }



    
    public function Eliminar_AsignacionCurso(){
        if ($this->session->userdata('usuario')) {

            $user_reg = $_SESSION['usuario'][0]['id_usuario'];

            $id_asignacion_cursos =$this->input->post("id_asignacion_cursos");
            $this->Model_Usuario->eliminar_asignacion_cursos($id_asignacion_cursos, $user_reg );        
          
        }
        else{
            redirect('/login');
        }
    }


 }

