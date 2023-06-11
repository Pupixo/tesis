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
                                        . "<div class='btn-group' role='group'>"
                                  

                                            ."<div class='btn-group' >"
                                            . "<a  title='Asignar Plan Estudios' onclick='AsignarPlanEstudio(".$row['id_usuario'].")' target='_blank' id='asig_curso_".$this->opcion."' type='button' class='btn bg-light rueda_pdf ' style='width: auto'>"
                                                . "<span  class='fa fa-hand-pointer'></span>"
                                            . "</a>"
                                            ."</div>"


                                     
                                            . "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
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

        
    public function Mirar_asignar_plan_estudio(){
        if ($this->session->userdata('usuario')) {

            $id_usuario =$this->input->post("id_usuario");
            $datos =$this->Model_Usuario->listar_asignacion_plan_estudios($id_usuario);   
            
            $lista ="";
            foreach ($datos as $row) {
                $lista .="<tr>
                                <td width='90%' >".$row['nom_plan_estudios']."</td>
                                <td WIDTH='10%' >
                                    <a style='cursor: pointer;' onclick='Eliminar_PlanEstudiosAsignado(".$row['id_asignacion_plan_estudios'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar' >
                                        <span><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></span>
                                    </a>
                                    <a  style='cursor: pointer;width: auto' title='Asignar Cursos'  onclick=Asignar_Cursos(".$row['id_asignacion_plan_estudios'].",".$row['id_plan_estudios'].",".$row['id_usuario'].",this)  class='dropdown-item delay-toogle btn-table-modal'>
                                        <span  class='fa fa-archive'> </span>
                                    </a>
                                </td> 
                        </tr>";
            }            
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
    
    public function Mirar_asignar_curso(){
        if ($this->session->userdata('usuario')) {
            
            $id_asignacion_plan_estudios =$this->input->post("id_asignacion_plan_estudios");
            $nom_ciclo =$this->input->post("nom_ciclo");

            $datos =$this->Model_Usuario->listar_asignacion_curso($id_asignacion_plan_estudios,$nom_ciclo);   
            
            $lista ="";
            foreach ($datos as $row) {
                $lista .="<tr><td width='90%' >".$row['nom_curso']."</td>";
                $lista .=" <td WIDTH='10%' >";
                $lista .='<a style="cursor: pointer;" onclick="Eliminar_CursoAsignado(\''.$row['id_asignacion_cursos'].'\', \''.$row['nom_ciclo'].'\')"  id="delete" role="button" class="dropdown-item delay-toogle btn-table-modal"  title="Eliminar" >';

                $lista .=" <span><svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg></span>";
                $lista .=" </a>";
                $lista .=" </td> </tr>";

                                    
                    
            }            
            echo $lista;
        }
        else{
            redirect('/login');
        }
    }

    
    
    public function Insertar_AsignacionCursos(){
        if ($this->session->userdata('usuario')) {
            $user_reg = $_SESSION['usuario'][0]['id_usuario'];
            $nom_ciclo =$this->input->post("nom_ciclo");

            $id_curso =$this->input->post("id_curso");
            $id_ciclo =$this->input->post("id_ciclo");
            $id_asignacion_plan_estudios =$this->input->post("id_asignacion_plan_estudios");

            $this->Model_Usuario->insert_asignacion_curso($id_curso,$id_ciclo, $id_asignacion_plan_estudios, $nom_ciclo , $user_reg );        
          
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

