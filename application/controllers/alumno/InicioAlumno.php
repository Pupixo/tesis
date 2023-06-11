<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class InicioAlumno extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Inicio Alumno';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Inicio';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Inicio';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_inicioalumno';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'InicioAlumno';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'alumno/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->url_carpeta       = 'alumno/inicio/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->abrev             = 'inicioalumno'; 
              
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


}