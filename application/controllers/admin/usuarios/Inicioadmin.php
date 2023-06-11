<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Inicioadmin extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Inicio';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Inicio';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Inicio';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_inicioadmin';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Inicioadmin';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/usuarios/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->url_carpeta       = 'admin/inicio/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->abrev             = 'inicioadmin'; 
              
        $this->load->model('Contenedor_Model');
        $this->load->model('Admin_model');

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

          

            // echo '<pre>';
            // print_r(  $_SESSION['usuario'][0]['id_nivel']);
            // echo '</pre>';
            // exit();



            $this->load->library('layout');
            $this->layout->view($this->url_carpeta.'index', $datos);
        }else{
            redirect('/login');
        }
    } 
/***********************************************************/


    public function Cambiar_clave() {
        if (!$this->session->userdata('usuario')) {
            redirect(base_url());
        }
        $id_user=  $_SESSION['usuario'][0]['id_usuario'];  
        $dato['camb_clave'] = $this->Admin_model->get_camb_clave($id_user);
        $this->load->view('admin/clave/index',$dato);
    }

    function Update_clave(){
        $dato['usuario_password']=$this->input->post("usuario_password");
        $password=$this->input->post("usuario_password");
        $dato['user_password_hash']= password_hash($password, PASSWORD_DEFAULT);

        $dato['id_usuario']= $this->input->post("id_usuario");  
        $this->Admin_model->update_clave($dato);

        redirect('/login');
    }
    function Upload_image_perfil(){
        if ($this->session->userdata('usuario')) {

            if(isset($_POST["image_usu"]))
            {
       
                $dir = dirname(__DIR__, 4);

                
                $id_usuario= $_SESSION['usuario'][0]['id_usuario'];  
                $usu_data = $this->Admin_model->get_camb_clave($id_usuario);


                $carperta_fisica=$dir.'\assets\images\photos_profile\datos_personales_'.$id_usuario;


                if(!empty($usu_data[0]['foto'])){
                 $nombre_fisico = str_replace("/photo", "\photo", $usu_data[0]['foto']);
                  
                    if (file_exists($carperta_fisica)) {

                    }else{

                        mkdir($carperta_fisica, 0777, true);
                        chmod($carperta_fisica, 0777);
                    }
 

                    if (file_exists($carperta_fisica.$nombre_fisico)) {
                        unlink($carperta_fisica.$nombre_fisico);
                    }
                }

                if (file_exists($carperta_fisica)) {

                }else{

                    mkdir($carperta_fisica, 0777, true);
                    chmod($carperta_fisica, 0777);
                }


                $data = $_POST["image_usu"];
                $image_array_1 = explode(";", $data);
                $image_array_2 = explode(",", $image_array_1[1]);
                $data = base64_decode($image_array_2[1]);

                $imageName_db =  '/photo_' . time() . '.png';
                $nombre_fisicodos= str_replace("/photo", "\photo", $imageName_db);
                $imageName =  $carperta_fisica.$nombre_fisicodos;
                file_put_contents($imageName, $data);


                $dato['foto']=$imageName_db;
                $this->Contenedor_Model->update_foto_profile($dato);

                $imageName_web =  base_url() .'assets/images/photos_profile/datos_personales_'.$id_usuario.$imageName_db ;
                echo $imageName_web;
            
            }
        }else{
            redirect('/login');
        }
    }


    public function Modal_Anuncios() {
        if (!$this->session->userdata('usuario')) {
            redirect(base_url());
        }
        $id_user=  $_SESSION['usuario'][0]['id_usuario'];  
        // $dato['list_anuncios'] = $this->Admin_model->get_anuncios_modal($id_user);
        $dato['list_anuncios'] =0;
        $this->load->view('admin/inicio/anuncios/modal_anuncio',$dato);
    }



    function Buscador_secciones(){

        switch ($_SESSION['usuario'][0]['id_nivel'] ){ 
            case 1:
                $DATA = array(
                    array(
                            'name' => "Inicio " ,
                            'url' => site_url('admin/usuarios/Inicioadmin'),
                            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
                    ),
                    
                    array(
                        'name' => "Curso" ,
                        'url' => site_url('admin/maestros/Cursos'),
                        'icon' => '<i class="far fa-book"></i>',
                    ),
                    array(
                        'name' => "Carrera" ,
                        'url' =>  site_url('admin/maestros/Carrera'),
                        'icon' => '<i class="fad fa-road"></i>',
                    ),
                    array(
                        'name' => "Director" ,
                        'url' =>  site_url('admin/maestros/Director'),
                        'icon' => '<i class="fad fa-users-crown"></i>',
                    ),
                    array(
                        'name' => "Docente" ,
                        'url' =>  site_url('admin/maestros/Docente'),
                        'icon' => '<i class="fad fa-users-class"></i>',
                    ),
                    array(
                        'name' => "Nivel" ,
                        'url' =>  site_url('admin/maestros/Nivel'),
                        'icon' => '<i class="fab fa-connectdevelop"></i>',
                    ),
                    array(
                        'name' => "Usuarios" ,
                        'url' =>  site_url('admin/usuarios/Usuarios') ,
                        'icon' => '<i  class="icon-user"></i>',
                    ),
                    array(
                        'name' => "Plan Estudios" ,
                        'url' =>  site_url('admin/usuarios/PlanEstudios') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sidebar feather-icon"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>',
                    ),
                    array(
                        'name' => "Syllabus" ,
                        'url' => site_url('admin/usuarios/Asyllabus') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text feather-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    ),
                );
        

            break;
            case 2:

                $DATA = array(
               
                    array(
                        'name' => "Inicio Alumno" ,
                        'url' => site_url('alumno/InicioAlumno'),
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
                    ),
                    array(
                        'name' => "Curso" ,
                        'url' => site_url('admin/maestros/Cursos'),
                        'icon' => '<i class="far fa-book"></i>',
                    ),
                    array(
                        'name' => "Carrera" ,
                        'url' =>  site_url('admin/maestros/Carrera'),
                        'icon' => '<i class="fad fa-road"></i>',
                    ),
                    array(
                        'name' => "Director" ,
                        'url' =>  site_url('admin/maestros/Director'),
                        'icon' => '<i class="fad fa-users-crown"></i>',
                    ),
                    array(
                        'name' => "Docente" ,
                        'url' =>  site_url('admin/maestros/Docente'),
                        'icon' => '<i class="fad fa-users-class"></i>',
                    ),
                    array(
                        'name' => "Nivel" ,
                        'url' =>  site_url('admin/maestros/Nivel'),
                        'icon' => '<i class="fab fa-connectdevelop"></i>',
                    ),
                  
                );
        

            break;
            case 3:

                $DATA = array(
                    array(
                            'name' => "Inicio " ,
                            'url' => site_url('admin/usuarios/Inicioadmin'),
                            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
                    ),
 		            array(
                        'name' => "Syllabus" ,
                        'url' => site_url('admin/usuarios/Asyllabus') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text feather-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    ),
                );
        

            break;
            case 4:

                $DATA = array(
                    array(
                            'name' => "Inicio " ,
                            'url' => site_url('admin/usuarios/Inicioadmin'),
                            'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
                    ),
                    
                  
                    array(
                        'name' => "Curso" ,
                        'url' => site_url('admin/maestros/Cursos'),
                        'icon' => '<i class="far fa-book"></i>',
                    ),
                    array(
                        'name' => "Carrera" ,
                        'url' =>  site_url('admin/maestros/Carrera'),
                        'icon' => '<i class="fad fa-road"></i>',
                    ),
                    array(
                        'name' => "Director" ,
                        'url' =>  site_url('admin/maestros/Director'),
                        'icon' => '<i class="fad fa-users-crown"></i>',
                    ),
                    array(
                        'name' => "Docente" ,
                        'url' =>  site_url('admin/maestros/Docente'),
                        'icon' => '<i class="fad fa-users-class"></i>',
                    ),
                    array(
                        'name' => "Nivel" ,
                        'url' =>  site_url('admin/maestros/Nivel'),
                        'icon' => '<i class="fab fa-connectdevelop"></i>',
                    ),
                  array(
                        'name' => "Usuarios" ,
                        'url' =>  site_url('admin/usuarios/Usuarios') ,
                        'icon' => '<i  class="icon-user"></i>',
                    ),

                    array(
                        'name' => "Plan Estudios" ,
                        'url' =>  site_url('admin/usuarios/PlanEstudios') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sidebar feather-icon"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line></svg>',
                    ),
                    array(
                        'name' => "Syllabus" ,
                        'url' => site_url('admin/usuarios/Asyllabus') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text feather-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    ),
                );
        


            break;
            case 5:


                $DATA = array(
            
                    array(
                        'name' => "Inicio Alumno" ,
                        'url' => site_url('alumno/InicioAlumno'),
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>',
                    ),
                   
                    array(
                        'name' => "Tus Syllabus" ,
                        'url' => site_url('alumno/TusSyllabus') ,
                        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text feather-icon"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>',
                    ),
                );
        


            break;
        }
   
        $json = json_encode($DATA); 
        
        echo($json); 


    }
        
}