<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Syllabus extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Tus Syllabus UCSUR';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Tus Syllabus UCSUR';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Syllabus';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'form-tu_sillabus';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Syllabus';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'layout_web/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'syllabus';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->wdepe             = 'Syllabus';        /* NOMBRE DEL API                                                   */
        $this->widop             = 1;   

        $this->load->model('Contenedor_Model','contenedor');
        $this->load->library(array('session'));

    }

    public function index()
    {
        if ($this->session->userdata('usuario')) {
            $datos   = obtenerDatosIndexNuevo($this);
            //echo "<pre>";
            //print_r( $datos );
            //$this->vista_layout($this->url.'inicio_web',$datos);
            //$this->vista_layout($this->url.'webcuerpo',$datos);        
            $data = array();
            $data['contenido'] = $this->load->view($this->url.'webcuerpo', $datos, true);
            $data['th'] = $this;
             $this->load->view($this->url.'inicio_web', $data, false);
        }
        else{
            $datos   = obtenerDatosIndexNuevo($this);
            //echo "<pre>";
            //print_r( $datos );
            //$this->vista_layout($this->url.'inicio_web',$datos);
            //$this->vista_layout($this->url.'webcuerpo',$datos);        
            $data = array();
            $data['contenido'] = $this->load->view($this->url.'webcuerpo', $datos, true);
            $data['th'] = $this;
             $this->load->view($this->url.'inicio_web', $data, false);
        }
    }


}