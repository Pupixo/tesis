<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrera extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Carreras';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Carreras';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Carreras';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_carreras';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Carrera';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/maestros/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'carrera';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/maestros/carreras/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Model_Carrera','main_model');
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

    function cargar_tabla_Carrera()
    {
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

            $accion = 'LISTADO_CARRERA';
            $parametros = array($accion,'', '', '', '', '','');
            
            // print_r($parametros);
            // exit();
     
            $data = $this->main_model->procedureCrudCarrera($parametros);
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {
                        

                        $botones = "<center style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;'>"   
                                        . "<div   class='btn-group' role='group' aria-label='' style='width: 100%; justify-content: flex-end;'>"
                                        . "<div class='btn-group' role='group'>"
                            
                                     
                                            . "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
                                                . "<span  class='fa fa-gear'></span>"
                                            . "</button>"
                                          
                                            . "<div  style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;' class='dropdown-menu rueda-accion color-0' aria-labelledby='btnGroupDrop".$this->opcion."'>"
                                          
                                                ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_carrera'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"  	
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                ."Editar Fila</span>"
                                                ."</a>"


                                                ."<a style='cursor: pointer;' onclick='Eliminar_".$this->opcion."(".$row['id_carrera'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                ."Eliminar Fila</span>"
                                                ."</a>"
                                            . "</div>"
                                        . "</div>"
                                    ."</div></center>";
                   



                        $texto .= '{"ID_CARRERA":' . json_encode($row['id_carrera']) . ','
                                . '"NOM_CARRERA":' . json_encode($row['nom_carrera']) . ','
                                . '"ID_FACULTAD":' . json_encode($row['id_facultad']) . ','   
                                . '"ID_DIRECTOR":' . json_encode($row['id_director']) . ',' 
                                . '"NOM_DIRECTOR":' . json_encode($row['nom_director']) . ',' 
                                . '"NOM_ESTATUS"             :' . json_encode($row['nom_status']) . ','
                                . '"ESTADO"             :' . json_encode($row['estado']) . ','
                                . '"FEG_REG"             :' . json_encode($row['fec_reg']) . ','
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
    public function Insert_Carrera(){
        if ($this->session->userdata('usuario')) {
            $user_reg= $_SESSION['usuario'][0]['id_usuario'];

            $nom_carrera               = $this->input->post("nom_carrera");            
            $id_status              = $this->input->post("cbx_basicos_id_status");

            $id_director              = $this->input->post("cbx_basicos_id_director");


            $accion = 'INSERTAR_CARRERA';
            $parametros = array(
                $accion,
                '',
                $nom_carrera,
                '',
                $id_status,
                $user_reg,
                $id_director
            );

           //$respuesta=
            $this->main_model->procedureCrudCarrera($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['ultimo_id']);
            // echo "</pre>";

        }
        else{
            redirect('/login');
        }        
    }

    public function Update_Carrera(){
        if ($this->session->userdata('usuario')) {
            $id =$this->input->post("id_carrera");
            
            $user_act= $_SESSION['usuario'][0]['id_usuario'];
            $nom_carrera               = $this->input->post("nom_carrera");            

            $id_status              = $this->input->post("cbx_basicos_id_status");

            $id_director              = $this->input->post("cbx_basicos_id_director");


            
            $accion = 'ACTUALIZAR_CARRERA';
            $parametros = array(
                $accion,
                $id,
                $nom_carrera,
                '',
                $id_status,
                $user_act,
                $id_director 

            );


            
            $respuesta= $this->main_model->procedureCrudCarrera($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['FILASAFECTADAS']);
            // echo "</pre>";
            // exit();

        }
        else{
            redirect('/login');
        }
    }

    public function Delete_Carrera(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id");

          
            $accion = 'ELIMINAR_CARRERA';
            $parametros = array(
                $accion,
                $id,
                '',
                '',
                '',
                $user_eli,
                ''

            );



            $this->main_model->procedureCrudCarrera($parametros);

        }
        else{
            redirect('/login');
        }
    }
    //---------------------------------------------------------------------------------------------------------
 


}