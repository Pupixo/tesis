<?php

defined('BASEPATH') OR exit('No estan permitidos los scripts directos');

class Layout {

    private $ci;
   // private $layout = 'Admin/layout/layout_principal';
    
    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->model('Contenedor_model','contenedor');        
    }

    public function view($view, $parametros = null) {
        $data = array();
        $data['contenido'] = $this->ci->load->view($view, $parametros, true);
        $data['th'] = $this;
                
        return $this->ci->load->view('Admin/layout/layout_principal', $data, false);
        //$this->layout,
    }

    
    
}
