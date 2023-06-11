<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecursoAula extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Recursos del Aula';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Recursos del Aula';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Recursos del Aula';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_recurso_aula';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'RecursoAula';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/maestros/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'recursoaula';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/maestros/recursoaula/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Model_RecursoAula','main_model');
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

    function cargar_tabla_RecursoAula()
    {
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

            $accion = 'LISTADO_RECURSOS_AULA';
            $parametros = array($accion,'', '', '', '','', '', '', '','', '', '', '','', '', '');
            
            // print_r($parametros);
            // exit();
     
            $data = $this->main_model->procedureCrudRecursoAula($parametros);
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
                                          
                                                ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_recursos_aula'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"  	
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                ."Editar Fila</span>"
                                                ."</a>"


                                                ."<a style='cursor: pointer;' onclick='Eliminar_".$this->opcion."(".$row['id_recursos_aula'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                ."Eliminar Fila</span>"
                                                ."</a>"
                                            . "</div>"
                                        . "</div>"
                                    ."</div></center>";
                   


                        $tipo_recurso = ($row['tipo_recurso']==1 ? 'Herramienta Digital' : 'Otros Software' ) ;
                        $tipo_licencia = ($row['tipo_licencia']==1 ? 'Contrato' : 'Libre' ) ;

                        $sede = ($row['codigo_local']!==1 ? ($row['codigo_local']!==2 ? ($row['codigo_local']!==3 ? ($row['codigo_local']!==4 ? ($row['codigo_local']==5 ? 'SL05' : 'SL06' )  : 'SL04' )  : 'SL03' ) : 'SL02' )  : 'SL01' ) ;

                        $texto .= '{"ID_RECURSOS_AULA":' . json_encode($row['id_recursos_aula']) . ','

                                . '"MODALIDAD":' . json_encode($row['modalidad']) . ','

                                . '"NOM_MODALIDAD":' . json_encode($row['nom_curso_forma_estudio']) . ','

                                . '"CODIGO_LOCAL":' . json_encode($row['codigo_local']) . ','
                                . '"SEDE":' . json_encode($sede) . ','

                                . '"NUM_RECURSO":' . json_encode($row['num_recurso']) . ','
                                . '"CODIGO_RECURSO":' . json_encode($row['codigo_recurso']) . ','
                                . '"NOM_RECURSO":' . json_encode($row['nom_recurso']) . ','
                                . '"TIPO_RECURSO":' . json_encode($row['tipo_recurso']) . ','
                                . '"NOM_TIPO_RECURSO":' . json_encode($tipo_recurso ) . ','

                                . '"TIPO_LICENCIA":' . json_encode($row['tipo_licencia']) . ','
                                . '"NOM_TIPO_LICENCIA":' . json_encode( $tipo_licencia ) . ','

                                . '"CANT_ANIOS_LICENCIA":' . json_encode($row['cant_anios_licencia']) . ','
                                . '"RECURSOS_DESCRIP":' . json_encode($row['recurso_descrip']) . ','
                                . '"CANT_PROGRAMAS":' . json_encode($row['cant_programas']) . ','
                                . '"RECURSOS_COMENT":' . json_encode($row['recurso_coment']) . ','
                                . '"ANALISIS_PERTINENCIA":' . json_encode($row['analisis_pertinencia']) . ','


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
    public function Insert_RecursoAula(){
        if ($this->session->userdata('usuario')) {
            $user_reg= $_SESSION['usuario'][0]['id_usuario'];

            $modalidad               = $this->input->post("cbx_basicos_id_curso_forma_estudio");            
            $codigo_local               = $this->input->post("codigo_local");            
            $num_recurso               = $this->input->post("num_recurso");            
            $codigo_recurso               = $this->input->post("codigo_recurso");            
            $nom_recurso               = $this->input->post("nom_recurso");            
            $tipo_recurso               = $this->input->post("tipo_recurso");            
            $tipo_licencia               = $this->input->post("tipo_licencia");            
            $cant_anios_licencia               = $this->input->post("cant_anios_licencia");            
            $recurso_descrip               = $this->input->post("recurso_descrip");            
            $cant_programas               = $this->input->post("cant_programas");            
            $recurso_coment               = $this->input->post("recurso_coment");            
            $analisis_pertinencia               = $this->input->post("analisis_pertinencia");            

            $id_status              = $this->input->post("cbx_basicos_id_status");



            $accion = 'INSERTAR_RECURSOS_AULA' ;
            $parametros = array(
                $accion,
                '',
                $modalidad,           
                $codigo_local,        
                $num_recurso,           
                $codigo_recurso,                        
                $nom_recurso,         
                $tipo_recurso,          
                $tipo_licencia,            
                $cant_anios_licencia,            
                $recurso_descrip,        
                $cant_programas,         
                $recurso_coment,                         
                $analisis_pertinencia,           
    
                $id_status,
                $user_reg
                );

           //$respuesta=
            $this->main_model->procedureCrudRecursoAula($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['ultimo_id']);
            // echo "</pre>";

        }
        else{
            redirect('/login');
        }        
    }

    public function Update_RecursoAula(){
        if ($this->session->userdata('usuario')) {
            $id =$this->input->post("id_carrera");
            
            $user_act= $_SESSION['usuario'][0]['id_usuario'];

            $id_nivel              = $this->input->post("id_nivel");


            
            $modalidad               = $this->input->post("cbx_basicos_id_curso_forma_estudio");            
            $codigo_local               = $this->input->post("codigo_local");            
            $num_recurso               = $this->input->post("num_recurso");            
            $codigo_recurso               = $this->input->post("codigo_recurso");            
            $nom_recurso               = $this->input->post("nom_recurso");            
            $tipo_recurso               = $this->input->post("tipo_recurso");            
            $tipo_licencia               = $this->input->post("tipo_licencia");            
            $cant_anios_licencia               = $this->input->post("cant_anios_licencia");            
            $recurso_descrip               = $this->input->post("recurso_descrip");            
            $cant_programas               = $this->input->post("cant_programas");            
            $recurso_coment               = $this->input->post("recurso_coment");            
            $analisis_pertinencia               = $this->input->post("analisis_pertinencia");    

            $id_status              = $this->input->post("cbx_basicos_id_status");

            
            $accion = 'ACTUALIZAR_RECURSOS_AULA' ;
            $parametros = array(
                $accion,
                $id_nivel,

                $modalidad,           
                $codigo_local,        
                $num_recurso,           
                $codigo_recurso,                        
                $nom_recurso,         
                $tipo_recurso,          
                $tipo_licencia,            
                $cant_anios_licencia,            
                $recurso_descrip,        
                $cant_programas,         
                $recurso_coment,                         
                $analisis_pertinencia,     

                $id_status,
                $user_act
            );


            
            $respuesta= $this->main_model->procedureCrudRecursoAula($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['FILASAFECTADAS']);
            // echo "</pre>";
            // exit();

        }
        else{
            redirect('/login');
        }
    }

    public function Delete_RecursoAula(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id");

          
            $accion = 'ELIMINAR_RECURSOS_AULA';
            $parametros = array(
                $accion,
                $id,
                $modalidad,           
                $codigo_local,        
                $num_recurso,           
                $codigo_recurso,                        
                $nom_recurso,         
                $tipo_recurso,          
                $tipo_licencia,            
                $cant_anios_licencia,            
                $recurso_descrip,        
                $cant_programas,         
                $recurso_coment,                         
                $analisis_pertinencia,    

                '',
                $user_eli,
            );



            $this->main_model->procedureCrudRecursoAula($parametros);

        }
        else{
            redirect('/login');
        }
    }
    //---------------------------------------------------------------------------------------------------------
 


}