<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {

    public function __construct() {
        parent::__construct();     
        
        $this->modulo            = 'Modulo:: Cursos';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Cursos';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Cursos';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_cursos';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'Cursos';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/maestros/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'cursos';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/maestros/cursos/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        $this->load->model('Contenedor_Model','contenedor');
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
            $this->layout->view($this->url_carpeta.'index', $datos);
        }else{
            redirect('/login');
        }
    }

    function cargar_tabla_cursos()
    {
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

            $accion = 'LISTADO_CURSOS';
            $parametros = array($accion,'', '', '', '', '','','','','','','','','','','',''   ,'','','','','',''   ,'','');
            
            // print_r($parametros);
            // exit();
     
            $data = $this->Model_Cursos->procedureCrudCursos($parametros);
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {
                        

                        $botones = "<center style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;'>"   
                                        . "<div   class='btn-group' role='group' aria-label='' style='width: 100%; justify-content: flex-end;'>"
                                        . "<div class='btn-group' role='group'>"


                                        ."<div class='btn-group' >"
                                        . "<a type='button' title='Diccionario de Competencias' onclick='Competencia_data(".$row['id_curso'].")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                            . "<i class='fas fa-book'></i>"
                                        . "</a>"
                                        ."</div>"


                                              
                                            ."<div class='btn-group' >"
                                            . "<a type='button' title='Diccionario Sumilla'  onclick='Sumilla_data(".$row['id_curso'].")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                . "<i class='fa fa-envelope'></i>"
                                            . "</a>"
                                            ."</div>"

                                  
                                     
                                            . "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
                                                . "<span  class='fa fa-gear'></span>"
                                            . "</button>"
                                          
                                            . "<div  style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;' class='dropdown-menu rueda-accion color-0' aria-labelledby='btnGroupDrop".$this->opcion."'>"
                                          
                                                ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_curso'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"  	
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                ."Editar Fila</span>"
                                                ."</a>"


                                                ."<a style='cursor: pointer;' onclick='Eliminar_".$this->opcion."(".$row['id_curso'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                ."<span>"
                                                ." <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                ."Eliminar Fila</span>"
                                                ."</a>"
                                            . "</div>"
                                        . "</div>"
                                    ."</div></center>";
                   
                                    


                        $texto .= '{"ID_CURSO":' . json_encode($row['id_curso']) . ','
                                . '"NOM_CURSO":' . json_encode($row['nom_curso']) . ','
                                . '"ID_FACULTAD":' . json_encode($row['id_facultad']) . ','
                                . '"ID_CARRERA":' . json_encode($row['id_carrera']) . ','
                                . '"NOM_CARRERA":' . json_encode($row['nom_carrera']) . ','

                                . '"ID_PLAN_ESTUDIOS":' . json_encode($row['id_plan_estudios']) . ','
                                . '"CODIGO":' . json_encode($row['codigo']) . ','
                                . '"CREDITOS"             :' . json_encode($row['creditos']) . ','
                                . '"HORAS_TEORICAS"             :' . json_encode($row['horas_teoricas']) . ','
                                . '"HORAS_TOTALES"             :' . json_encode($row['horas_totales']) . ','
                                . '"HORAS_PRACTICAS"             :' . json_encode($row['horas_practicas']) . ','
                                . '"REQUISITOS"             :' . json_encode($row['requisitos']) . ','
                                . '"TIPO_CURSO"             :' . json_encode($row['tipo_curso']) . ','
                                . '"TIPO_CURSO_NOM"             :' . json_encode($row['nom_tipo_curso']) . ','
                                . '"PRESENCIALIDAD"             :' . json_encode($row['presencialidad']) . ','
                                . '"PRESENCIALIDAD_NOM"             :' . json_encode($row['nom_curso_forma_estudio']) . ','
                                . '"OBLIGATORIEDAD"             :' . json_encode($row['obligatoriedad']) . ','
                                . '"OBLIGATORIEDAD_NOM"             :' . json_encode($row['nom_curso_importancia']) . ','
                                . '"NOM_ESTATUS"             :' . json_encode($row['nom_status']) . ','
                                . '"ESTADO"             :' . json_encode($row['estado']) . ','


                                . '"HORAS_SINCRO_TEOR"             :' . json_encode($row['horas_sincronas_teoricas']) . ','
                                . '"HORAS_ASINCRO_TEOR"             :' . json_encode($row['horas_asincronas_teoricas']) . ','
                                . '"HORAS_PRESEN_TEOR"             :' . json_encode($row['horas_teoricas_presencial']) . ','
                                . '"HORAS_SINCRO_PRAC"             :' . json_encode($row['horas_sincronas_practicas']) . ','
                                . '"HORAS_ASINCRO_PRAC"             :' . json_encode($row['horas_asincronas_practicas']) . ','
                                . '"HORAS_PRESEN_PRAC"             :' . json_encode($row['horas_practicas_presencial']) . ','


                                . '"CREDITOS_PRESENCIAL"             :' . json_encode($row['creditos_presencial']) . ','
                                . '"CREDITOS_VIRTUAL"             :' . json_encode($row['creditos_virtual']) . ','


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
    public function Insert_Cursos(){
        if ($this->session->userdata('usuario')) {
            $user_reg= $_SESSION['usuario'][0]['id_usuario'];

            $nom_curso               = $this->input->post("nom_curso");
            $codigo        = $this->input->post("codigo"); 
            $creditos         = $this->input->post("creditos");
            $horas_teoricas         = $this->input->post("horas_teoricas");
            $horas_practicas               = $this->input->post("horas_practicas");
            $horas_totales                 = $this->input->post("horas_totales");
            $requisitos              = implode(",", $this->input->post("cbx_multiple_id_curso"));

            $id_tipo_curso              = $this->input->post("cbx_basicos_id_tipo_curso");

            $id_carrera              = $this->input->post("cbx_basicos_id_carrera");


            $id_curso_forma_estudio              = $this->input->post("cbx_basicos_id_curso_forma_estudio");
            $id_curso_importancia              = $this->input->post("cbx_basicos_id_curso_importancia");
            $id_status              = $this->input->post("cbx_basicos_id_status");


            //-------------------------
            $horas_sincronas_teoricas         = $this->input->post("horas_sincronas_teoricas");
            $horas_asincronas_teoricas         = $this->input->post("horas_asincronas_teoricas");
            $horas_teoricas_presencial         = $this->input->post("horas_teoricas_presencial");

            $horas_sincronas_practicas         = $this->input->post("horas_sincronas_practicas");
            $horas_asincronas_practicas         = $this->input->post("horas_asincronas_practicas");
            $horas_practicas_presencial         = $this->input->post("horas_practicas_presencial");


            $creditos_presencial         = $this->input->post("creditos_presencial");
            $creditos_virtual         = $this->input->post("creditos_virtual");

            $accion = 'INSERTAR_CURSOS';
            $parametros = array(
                $accion,
                '',
                $nom_curso,
                '',
                $id_carrera,
                '',
                $codigo,
                $creditos,
                $horas_teoricas,
                $horas_totales,
                $horas_practicas,
                $requisitos,
                $id_tipo_curso,
                $id_curso_forma_estudio,
                $id_curso_importancia,
                $id_status,
                $user_reg,

                $horas_sincronas_practicas,
                $horas_asincronas_practicas,
                $horas_practicas_presencial,
                
                $horas_sincronas_teoricas ,
                $horas_asincronas_teoricas ,
                $horas_teoricas_presencial,


                $creditos_presencial,
                $creditos_virtual 

            );

            echo "<pre>";
            print_r($parametros);
            echo "</pre>";
           // exit();



           //$respuesta=
            $this->Model_Cursos->procedureCrudCursos($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['ultimo_id']);
            // echo "</pre>";

        }
        else{
            redirect('/login');
        }        
    }

    public function Update_Cursos(){
        if ($this->session->userdata('usuario')) {
            $id =$this->input->post("id_cursos");
            
            $user_act= $_SESSION['usuario'][0]['id_usuario'];
            $nom_curso               = $this->input->post("nom_curso");
            $codigo        = $this->input->post("codigo"); 
            $creditos         = $this->input->post("creditos");
            $horas_teoricas         = $this->input->post("horas_teoricas");
            $horas_practicas               = $this->input->post("horas_practicas");
            $horas_totales                 =  $this->input->post("horas_totales");

            $requisitos              = implode(",", $this->input->post("cbx_multiple_id_curso"));

            $id_tipo_curso              = $this->input->post("cbx_basicos_id_tipo_curso");

            $valor  = $id_tipo_curso ;
            if($valor==1){
    
                $id_carrera              =    0;
            }else if($valor==2){
                $id_carrera              = $this->input->post("cbx_basicos_id_carrera");
    
            }else{
                $id_carrera              =    0;
            }

            $id_curso_forma_estudio              = $this->input->post("cbx_basicos_id_curso_forma_estudio");
            $id_curso_importancia              = $this->input->post("cbx_basicos_id_curso_importancia");
            $id_status              = $this->input->post("cbx_basicos_id_status");

                       //-------------------------


            $horas_sincronas_teoricas         = $this->input->post("horas_sincronas_teoricas");
            $horas_asincronas_teoricas         = $this->input->post("horas_asincronas_teoricas");
            $horas_teoricas_presencial         = $this->input->post("horas_teoricas_presencial");
           
            $horas_sincronas_practicas         = $this->input->post("horas_sincronas_practicas");
            $horas_asincronas_practicas         = $this->input->post("horas_asincronas_practicas");
            $horas_practicas_presencial         = $this->input->post("horas_practicas_presencial");


            $creditos_presencial         = $this->input->post("creditos_presencial");
            $creditos_virtual         = $this->input->post("creditos_virtual");
            
            $accion = 'ACTUALIZAR_CURSOS';
            $parametros = array(
                $accion,
                $id,
                $nom_curso,
                '',
                $id_carrera,
                '',
                $codigo,
                $creditos,
                $horas_teoricas,
                $horas_totales,
                $horas_practicas,
                $requisitos,
                $id_tipo_curso,
                $id_curso_forma_estudio,
                $id_curso_importancia,
                $id_status,
                $user_act,


                $horas_sincronas_practicas,
                $horas_asincronas_practicas,
                $horas_practicas_presencial,
                
                $horas_sincronas_teoricas ,
                $horas_asincronas_teoricas ,
                $horas_teoricas_presencial,

                
                $creditos_presencial,
                $creditos_virtual 
            );
            

            // echo "<pre>";
            // print_r($parametros);
            // echo "</pre>";
            
            // exit();

            //$respuesta=
            $this->Model_Cursos->procedureCrudCursos($parametros);
            // echo "<pre>";
            // print_r($respuesta[0]['FILASAFECTADAS']);
            // echo "</pre>";
            //exit();

        }
        else{
            redirect('/login');
        }
    }

    public function Delete_Cursos(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id_cursos");

          
            $accion = 'ELIMINAR_CURSOS';
            $parametros = array(
                $accion,
                $id,
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
                $$user_eli
                ,'','','','','',''
                ,'',''
            );



            $this->Model_Cursos->procedureCrudCursos($parametros);

        }
        else{
            redirect('/login');
        }
    }
    //---------------------------------------------------------------------------------------------------------

    public function Listar_Diccionario_Compt(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id_curso =$this->input->post("id_curso");

            $datos =$this->Model_Cursos->listar_diccionario_compet($id_curso);        

            echo json_encode($datos);

        }
        else{
            redirect('/login');
        }
    }

    public function Guardar_Diccionario_Compt(){
        if ($this->session->userdata('usuario')) {

            $id_diccionario_competen =$this->input->post("id_diccionario_competen");
            $id_curso =$this->input->post("id_curso");

            $compt_gene =$this->input->post("compt_gene");
            $nivel_uno =$this->input->post("nivel_uno");
            $nivel_dos =$this->input->post("nivel_dos");
            $nivel_tres =$this->input->post("nivel_tres");
            $tipo_compt =$this->input->post("tipo_compt");


            $user_actual = $_SESSION['usuario'][0]['id_usuario'];

                $parametros = array(
                    $id_diccionario_competen,
                    $compt_gene,
                    $nivel_uno,
                    $nivel_dos,
                    $nivel_tres,
                    $user_actual,
                    $id_curso,
                    $tipo_compt
                );

                $data=$this->Model_Cursos->guardar_dicci_compt($parametros);        

                echo $data->ID;

        }
        else{
            redirect('/login');
        }
    }

    public function Eliminar_Diccionario_Compt(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id_diccionario_competen");

            $parametros = array(
                $id,
                $user_eli,
            );

            $data=$this->Model_Cursos->eliminar_dicci_compt($parametros);     

            echo '<pre>';
            print_r($data);
            echo '</pre>';

        }
        else{
            redirect('/login');
        }
    }

    public function Mirar_sumilla_curso(){
        if ($this->session->userdata('usuario')) {

            $id_curso =$this->input->post("id_curso");
            $datos =$this->Model_Cursos->mirar_sumilla_curso($id_curso);        
            echo json_encode($datos);
        }
        else{
            redirect('/login');
        }
    }

    
    public function Guardar_Sumilla_Curso(){
        if ($this->session->userdata('usuario')) {


            $id_sumilla_curso =$this->input->post("id_sumilla_curso");
            $texto =$this->input->post("descrip_sumilla");
            $id_curso =$this->input->post("id_curso_sumilla");
            $user_actual = $_SESSION['usuario'][0]['id_usuario'];

                $parametros = array(
                    $id_sumilla_curso,
                    $texto,
                    $user_actual,
                    $id_curso,
                );

                $data=$this->Model_Cursos->guardar_sumilla_curso($parametros);        

        }
        else{
            redirect('/login');
        }
    }


 }

 