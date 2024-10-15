<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\ColumnDimension;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class PlanEstudios extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->modulo            = 'Modulo:: Plan de Estudios';  /* DESCRIPCION ( MODULO :: NRO DE MENU  )                           */
        $this->tituloPrincipal   = 'Plan';   /* NOMBRE PRINCIPAL 1                                               */
        $this->tituloSecundario1 = 'Listado de Plan de Estudios';     /* NOMBRE SECUNDARIO 1, PUEDE HABER HASTA 5 VARIABLES SECUNDARIAS   */
        $this->formPrincipal     = 'formulario_plan_estudios';   /* NOMBRE DEL FORMULARIO                                            */
        $this->opcion            = 'PlanEstudios';        /* NOMBRE DE LA CLASE                                               */
        $this->url               = 'admin/usuarios/';     /* URL DE LA PAGINA ACTUAL                                          */
        $this->abrev             = 'plan_estudios';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */
        $this->url_carpeta       = 'admin/plan_estudios/';        /* NOMBRE DE LA ABREVIATURA QUE SE INDENTIFICARA EN "footer" y js   */

        $this->load->model('Contenedor_Model','contenedor');
        $this->load->model('Model_PlanEstudios');
        $this->load->model('Model_Ciclo');
        $this->load->model('Model_Carrera');
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

    function cargar_tabla_plan_estudios()
    {
        if ($this->session->userdata('usuario')) {
            date_default_timezone_set('America/Lima');
            $fechaActual = date('Y-m-d H:i:s');

            $accion = '';

            if($_SESSION['usuario'][0]['id_nivel'] == 2){

                $accion='LISTADO_PLAN_ESTUDIOS_USER';
                // $accion_esta='LISTAR_SYLLABUS_POR_ESTADOS_USER';
            }else{


                $accion='LISTADO_PLAN_ESTUDIOS';
                // $accion_esta='LISTAR_SYLLABUS_POR_ESTADOS';
            }



            $parametros = array($accion,'', '', '', '','', '', '', '','','','','');

            // print_r($parametros);
            // exit();

            $data = $this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);
                    $texto = '{"data":[';
                    $fila =0;
                    foreach ($data as $row) {


                        $botones = "<center style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;'>"
                                        . "<div   class='btn-group' role='group' aria-label='' style='width: 100%; justify-content: flex-end;'>"

                                        ."<div class='btn-group' >"
                                        . "<a title='Excel' href='". site_url($this->url.$this->opcion.'/PlanEstudios_excel/'. $row['id_plan_estudios'] ) ."' target='_blank' id='verpdf_".$this->opcion."' type='button' class='btn bg-success rueda_pdf ' style='width: auto'>"
                                            . "<span  class='far fa-file-excel'></span>"
                                        . "</a>"
                                        ."</div>";

                                        if($_SESSION['usuario'][0]['id_nivel'] == 4 || $_SESSION['usuario'][0]['id_nivel'] == 1 ){

                                                $botones .="<div class='btn-group' >"
                                                . "<a type='button' title='Cambiar Estado'  onclick='Cambiar_Estado_".$this->opcion."(".$row['id_plan_estudios'].")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                    . "<span  class='fas fa-sync-alt'>"
                                                . "</a>"
                                                ."</div>";


                                        }

                                        $botones .="<div class='btn-group' >"
                                                        . "<a type='button' title='Agregar Electivos'  onclick='Electivos_".$this->opcion."(".$row['id_plan_estudios'].",".$row['id_carrera'].",".$fila.")' class='btn bg-light rueda_verperfil ' style='width: auto'>"
                                                            . "<svg width='24' height='24' viewBox='0 0 24 24'><path fill='currentColor' d='M5.004 5.999h16v2h-16zm2-3.999h12v2h-12zm13.993 7.991H5.003A2.008 2.008 0 0 0 3 12.004v7.974a2.008 2.008 0 0 0 2.003 2.013h15.994A2.008 2.008 0 0 0 23 19.978v-7.974a2.008 2.008 0 0 0-2.003-2.013ZM21 20H5v-8h16Z'/><path fill='currentColor' d='M12.004 18.991h2v-1.989h2v-2.004h-2v-2.007h-2v2.01h-2v2.001h2v1.989z'/></svg>"
                                                        . "</a>"
                                                    ."</div>";




                                            $botones .= "<div class='btn-group' role='group'>"

                                                . "<button id='btnGroupDrop".$this->opcion."' type='button' class='btn bg-accion dropdown-toggle rueda_focus' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'  style='width: auto'>"
                                                    . "<span  class='fa fa-gear'></span>"
                                                . "</button>"

                                                . "<div  style='background:rgb(215, 211, 211) none repeat scroll 0% 0%;border-radius:20px;' class='dropdown-menu rueda-accion color-0' aria-labelledby='btnGroupDrop".$this->opcion."'>"

                                                    ."<a style='cursor: pointer;' onclick=fn_AbrirModal('A',". $row['id_plan_estudios'] . ",".$fila.",'Insert_Update_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Editar ".$this->abrev ."'  >"
                                                    ."<span>"
                                                    ." <svg  width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-edit-2 text-success'> <path d='M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z'></path></svg>"
                                                    ."Editar Fila</span>"
                                                    ."</a>"

                                                    ."<a style='cursor: pointer;' onclick=Articulacion_".$this->opcion."(". $row['id_plan_estudios'] . ",".$fila.",'Insert_Update_Articulacion_".$this->opcion."') class='dropdown-item delay-toogle btn-table-modal' title='Articulación ".$this->abrev ."'  >"
                                                    ."<span>"
                                                        ."<svg width='20' height='20' viewBox='0 0 48 48'><path fill='currentColor' fill-rule='evenodd' d='M19 4a1 1 0 0 1 1 1v8.343a4 4 0 0 1-1.172 2.829l-.503.503a3.287 3.287 0 0 0 3.794 5.265l.243-.12a3.663 3.663 0 0 1 3.276 0l.243.12a3.287 3.287 0 0 0 3.794-5.265l-.503-.503A4 4 0 0 1 28 13.343V5a1 1 0 1 1 2 0v2.024C36.991 9.495 42 16.163 42 24s-5.009 14.505-12 16.976V43a1 1 0 1 1-2 0v-8.343a4 4 0 0 1 1.172-2.829l.503-.503a3.287 3.287 0 0 0-3.794-5.265l-.243.12a3.664 3.664 0 0 1-3.276 0l-.243-.12a3.287 3.287 0 0 0-3.794 5.265l.503.503A4 4 0 0 1 20 34.657V43a1 1 0 1 1-2 0v-2.024C11.009 38.505 6 31.837 6 24S11.009 9.495 18 7.024V5a1 1 0 0 1 1-1Z' clip-rule='evenodd'/></svg>"
                                                    ."Articulación</span>"
                                                    ."</a>";
                                        if($_SESSION['usuario'][0]['id_nivel'] != 4){

                                            $botones .="<a style='cursor: pointer;' onclick='Eliminar_".$this->opcion."(".$row['id_plan_estudios'].")' id='delete' role='button' class='dropdown-item delay-toogle btn-table-modal'  title='Eliminar ".$this->abrev ."' >"
                                                    ."<span>"
                                                    ." <svg width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2 text-danger'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>"
                                                    ."Eliminar Fila</span>"
                                                    ."</a>";

                                        }

                                        $botones .= "</div>"
                                            . "</div>";


                                        $botones .= "</div></center>";

                        $texto .= '{"ID_PLAN_ESTUDIOS":' . json_encode($row['id_plan_estudios']) . ','
                                . '"NOM_PLAN_ESTUDIOS":' . json_encode($row['nom_plan_estudios']) . ','
                                . '"ANIO":' . json_encode($row['anio']) . ','
                                . '"ID_FACULTAD":' . json_encode($row['id_facultad']) . ','
                                . '"ID_CARRERA":' . json_encode($row['id_carrera']) . ','
                                . '"CODIGO_PLAN_ES":' . json_encode($row['codigo_plan_es']) . ','
                                . '"MODALIDAD"             :' . json_encode($row['modalidad']) . ','
                                . '"GRADO_OTORGA"             :' . json_encode($row['grado_otorga']) . ','
                                . '"TITULO_PROFE"             :' . json_encode($row['titulo_prof']) . ','
                                . '"NOM_ESTATUS_PLAN_EST"             :' . json_encode($row['nom_status_plan_est']) . ','
                                . '"ESTADO"             :' . json_encode($row['estado']) . ','
                                . '"NOM_CARRERA"             :' . json_encode($row['nom_carrera']) . ','
                                . '"TIPO_ESTUDIOS"             :' . json_encode($row['tipo_estudios']) . ','

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
    public function Insert_PlanEstudios(){
        if ($this->session->userdata('usuario')) {
            $user_reg= $_SESSION['usuario'][0]['id_usuario'];



            $ciclo_electivo         =  $this->input->post("ciclo_electivo");
            $ciclo        = $this->input->post("ciclo");
            $id_carrera               = $this->input->post("id_carrera");
            $id_plan_estudios = $this->input->post("id_plan_estudios");

            $codigo_plan_estudios               = $this->input->post("codigo_plan_estudios");
            $modalidad        = $this->input->post("modalidad");
            $titulo_prof         = $this->input->post("titulo_prof");
            $grado_otorga         = $this->input->post("grado_otorga");
            $plan_estudios        = $this->input->post("plan_estudios");
            $id_tipo_estudios        = $this->input->post("id_tipo_estudios");
            $anio         =  $this->input->post("anio");



            $accion = 'INSERTAR_PLAN_ESTUDIOS';
            $parametros = array(
                $accion,
                '',
                $plan_estudios,
                '',
                $id_carrera,
                $codigo_plan_estudios,
                $modalidad,
                $grado_otorga,
                $titulo_prof,
                '3',
                $user_reg,
                $id_tipo_estudios,
                $anio
            );

            $respuesta_planestudios=$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);
            $id_plan_estudios = $respuesta_planestudios[0]['ultimo_id'];

            // echo '<pre>';
            // print_r( $parametros );
            // echo '</pre>';
            // exit();

            foreach ($ciclo as $row) {

                if($row['data__fila']['requisitos'] == null || $row['data__fila']['requisitos'] === ''){
                    $requisitos   = '';

                }else{
                    $requisitos              = implode(",", $row['data__fila']['requisitos']);

                }



                $horas_sincronas_teoricas         = $row['data__fila']['horas_sincronas_teoricas'];
                $horas_asincronas_teoricas         =$row['data__fila']['horas_asincronas_teoricas'];
                $horas_teoricas_presencial         = $row['data__fila']['horas_teoricas_presencial'];
                $horas_sincronas_practicas         =$row['data__fila']['horas_sincronas_practicas'];
                $horas_asincronas_practicas         =$row['data__fila']['horas_asincronas_practicas'];
                $horas_practicas_presencial         =$row['data__fila']['horas_practicas_presencial'];
                $creditos_presencial         = $row['data__fila']['creditos_presencial'];
                $creditos_virtual         = $row['data__fila']['creditos_virtual'];
                $num_ciclo  = $row['num_ciclo'];

                $parametros2 = array(
                    'INSERTAR_CICLOS',
                    '',
                    $row['nombre'],
                    '',
                    $id_carrera ,
                    $id_plan_estudios,
                    $row['data__fila']['codigo'],
                    $row['data__fila']['id_curso'],
                    $row['data__fila']['creditos'],
                    $row['data__fila']['horas_teoricas'],
                    $row['data__fila']['horas_totales'],
                    $row['data__fila']['horas_practicas'],
                    $requisitos,
                    $row['data__fila']['tipo_curso'],
                    $row['data__fila']['presencialidad'],
                    $row['data__fila']['obligatoriedad'],
                    '2',
                    $user_reg,

                    $horas_sincronas_practicas,
                    $horas_asincronas_practicas,
                    $horas_practicas_presencial,

                    $horas_sincronas_teoricas ,
                    $horas_asincronas_teoricas ,
                    $horas_teoricas_presencial,


                    $creditos_presencial,
                    $creditos_virtual,
                    $num_ciclo,
                    $ciclo_electivo
                );

               $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);
               $id_ciclo = $respuesta_ciclo[0]['ultimo_id'];

            }

        }
        else{
            redirect('/login');
        }
    }

    public function Update_PlanEstudios(){
        if ($this->session->userdata('usuario')) {

            $id =$this->input->post("id_plan_estudios");
            $user_act= $_SESSION['usuario'][0]['id_usuario'];

            $ciclo = $this->input->post("ciclo");
            $ciclo_electivo         =  $this->input->post("ciclo_electivo");
            $id_carrera               = $this->input->post("id_carrera");

            if( $ciclo_electivo==1){

                $codigo_plan_estudios               = $this->input->post("codigo_plan_estudios");
                $modalidad        = $this->input->post("modalidad");
                $titulo_prof         = $this->input->post("titulo_prof");
                $grado_otorga         = $this->input->post("grado_otorga");
                $plan_estudios        = $this->input->post("plan_estudios");
                $id_tipo_estudios        = $this->input->post("id_tipo_estudios");
                $anio        = $this->input->post("anio");

                $accion = 'ACTUALIZAR_PLAN_ESTUDIOS';
                $parametros = array(
                    $accion,
                    $id,
                    $plan_estudios,
                    '',
                    $id_carrera,
                    $codigo_plan_estudios,
                    $modalidad,
                    $grado_otorga,
                    $titulo_prof,
                    '3',
                    $user_act,
                    $id_tipo_estudios,
                    $anio 
                );

                $this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

            }

            // echo '<pre>';
            // print_r( $parametros );
            // echo '</pre>';

            foreach ($ciclo as $row) {


                if($row['data__fila']['requisitos'] == null || $row['data__fila']['requisitos'] === ''){
                    $requisitos   = '';

                }else{
                    $requisitos   = implode(",", $row['data__fila']['requisitos']);

                }


                $horas_sincronas_teoricas         = $row['data__fila']['horas_sincronas_teoricas'];
                $horas_asincronas_teoricas         =$row['data__fila']['horas_asincronas_teoricas'];
                $horas_teoricas_presencial         = $row['data__fila']['horas_teoricas_presencial'];
                $horas_sincronas_practicas         =$row['data__fila']['horas_sincronas_practicas'];
                $horas_asincronas_practicas         =$row['data__fila']['horas_asincronas_practicas'];
                $horas_practicas_presencial         =$row['data__fila']['horas_practicas_presencial'];

                $creditos_presencial         = $row['data__fila']['creditos_presencial'];
                $creditos_virtual         = $row['data__fila']['creditos_virtual'];
                $num_ciclo  = $row['num_ciclo'];
                $id_ciclo  = $row['data__fila']['id_ciclo'];

                if( $id_ciclo  ===''){

                        $parametros2 = array(
                            'INSERTAR_CICLOS',
                            0,
                            $row['nombre'],
                            0,
                            $id_carrera,
                            $id,
                            $row['data__fila']['codigo'],
                            $row['data__fila']['id_curso'],
                            $row['data__fila']['creditos'],
                            $row['data__fila']['horas_teoricas'],
                            $row['data__fila']['horas_totales'],
                            $row['data__fila']['horas_practicas'],
                            $requisitos,
                            $row['data__fila']['tipo_curso'],
                            $row['data__fila']['presencialidad'],
                            $row['data__fila']['obligatoriedad'],
                            '2',
                            $user_act,

                            $horas_sincronas_practicas,
                            $horas_asincronas_practicas,
                            $horas_practicas_presencial,

                            $horas_sincronas_teoricas ,
                            $horas_asincronas_teoricas ,
                            $horas_teoricas_presencial,

                            $creditos_presencial,
                            $creditos_virtual,
                            $num_ciclo,

                            $ciclo_electivo
                        );

				//echo '<pre>';
                        //print_r( $parametros2 );
                        //echo '</pre>';

                    $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);
                    $id_ciclo = $respuesta_ciclo[0]['ultimo_id'];



                }else{

                    $parametros2 = array(
                        'ACTUALIZAR_CICLOS',
                        $id_ciclo,
                        $row['nombre'],
                        0,
                        $id_carrera,
                        $id,
                        $row['data__fila']['codigo'],
                        $row['data__fila']['id_curso'],
                        $row['data__fila']['creditos'],
                        $row['data__fila']['horas_teoricas'],
                        $row['data__fila']['horas_totales'],
                        $row['data__fila']['horas_practicas'],
                        $requisitos,
                        $row['data__fila']['tipo_curso'],
                        $row['data__fila']['presencialidad'],
                        $row['data__fila']['obligatoriedad'],
                        '2',
                        $user_act,

                        $horas_sincronas_practicas,
                        $horas_asincronas_practicas,
                        $horas_practicas_presencial,
                        $horas_sincronas_teoricas ,
                        $horas_asincronas_teoricas ,
                        $horas_teoricas_presencial,

                        $creditos_presencial,
                        $creditos_virtual,

                        $num_ciclo,
                        $ciclo_electivo
                    );


                      echo '<pre>';
                     print_r( $parametros2 );
                     echo '</pre>';


                $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);

                }

            }

        }
        else{
            redirect('/login');
        }
    }

    public function Delete_PlanEstudios(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id =$this->input->post("id_usuario");
            $accion = 'ELIMINAR_PLAN_ESTUDIOS';
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
                ''

            );
            $this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

        }
        else{
            redirect('/login');
        }
    }

    public function Delete_Ciclo(){
        if ($this->session->userdata('usuario')) {

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];
            $id_ciclo =$this->input->post("id_ciclo");

            $parametros2 = array(
                'ELIMINAR_CICLOS',
                $id_ciclo,
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
                $user_eli

                ,'','','','','',''
                ,'','',
                '',
                ''
            );

           $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);

                     echo '<pre>';
                    print_r( $respuesta_ciclo );
                    echo '</pre>';
        }
        else{
            redirect('/login');
        }
    }


    public function Delete_Ciclo_Completo(){
        if ($this->session->userdata('usuario')) {

            $id_plan_estudios =$this->input->post("id_plan_estudios");
            $num_ciclo =$this->input->post("num_ciclo");

            $user_eli = $_SESSION['usuario'][0]['id_usuario'];


            $parametros2 = array(
                'ELIMINAR_CICLOS_COMPLETO',
                '',
                '',
                '',
                '',
                $id_plan_estudios,
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
                $user_eli

                ,'','','','','',''
                ,'','',
                $num_ciclo,
                ''
            );

           $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);

                     echo '<pre>';
                    print_r( $respuesta_ciclo );
                    echo '</pre>';
        }
        else{
            redirect('/login');
        }
    }

    public function CambioEstado(){
        if ($this->session->userdata('usuario')) {

            $id_plan_estudios =$this->input->post("id_plan_estudios");
            $estado =$this->input->post("estado");
            $accion = 'ACTUALIZAR_PLAN_ESTUDIOS_ESTADO';
            $parametros = array(
                $accion,
                $id_plan_estudios,
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                $estado,
                '',
                '',
                ''
            );



            $this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

        }
        else{
            redirect('/login');
        }
    }

    //---------------------------------------------------------------------------------------------------------

    public function List_byid_PlanEstudios(){
        if ($this->session->userdata('usuario')) {

            $id =$this->input->post("ID_PLAN_ESTUDIOS");

            $carreras_ids= $this->input->post("carreras_ids");






            $accion = 'LISTAR_PLAN_ESTUDIOS_ID';
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
                ''
            );

            //$respuesta_planestudios=$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

           $data_ =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

           $CURSOS= $this->Contenedor_Model->get_lista_cursos(0,$carreras_ids);

           $TIPO_CURSO= $this->Contenedor_Model->get_lista_tipo_curso(0,false);

           $CURSO_FORMA_ESTUDIO= $this->Contenedor_Model->get_lista_curso_forma_estudio(0,false);

           $CURSO_IMPORTANCIA= $this->Contenedor_Model->get_lista_curso_importancia(0,false);

           $CURSO_REQUISITOS= $this->Contenedor_Model->get_lista_cursos_combo(0,false);



           $DATA = array(
               'CURSOS' => $CURSOS ,
               'TIPO_CURSO' => $TIPO_CURSO,
               'CURSO_FORMA_ESTUDIO' =>  $CURSO_FORMA_ESTUDIO ,
               'CURSO_IMPORTANCIA' => $CURSO_IMPORTANCIA,
               'CURSO_REQUISITOS' => $CURSO_REQUISITOS,
               'DATA_MAIN' => $data_
           );

           echo json_encode($DATA);

        }
        else{
            redirect('/login');
        }
    }

    public function List_byid_electivo_PlanEstudios(){
        if ($this->session->userdata('usuario')) {





            $id =$this->input->post("ID_PLAN_ESTUDIOS");
            $carreras_ids= $this->input->post("carreras_ids");
            $accion = 'LISTAR_PLAN_ESTUDIOS_ID_ELECTIVO';
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
                ''
            );

            //$respuesta_planestudios=$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

           $data_ =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

           $CURSOS= $this->Contenedor_Model->get_lista_cursos(0,$carreras_ids);

           $TIPO_CURSO= $this->Contenedor_Model->get_lista_tipo_curso(0,false);

           $CURSO_FORMA_ESTUDIO= $this->Contenedor_Model->get_lista_curso_forma_estudio(0,false);

           $CURSO_IMPORTANCIA= $this->Contenedor_Model->get_lista_curso_importancia(0,false);

           $CURSO_REQUISITOS= $this->Contenedor_Model->get_lista_cursos_combo(0,false);



           $DATA = array(
               'CURSOS' => $CURSOS ,
               'TIPO_CURSO' => $TIPO_CURSO,
               'CURSO_FORMA_ESTUDIO' =>  $CURSO_FORMA_ESTUDIO ,
               'CURSO_IMPORTANCIA' => $CURSO_IMPORTANCIA,
               'CURSO_REQUISITOS' => $CURSO_REQUISITOS,
               'DATA_MAIN' => $data_
           );

           echo json_encode($DATA);

        }
        else{
            redirect('/login');
        }
    }

    public function Guardar_PlanEstudios_articulacion(){
        if ($this->session->userdata('usuario')) {
            $user = $_SESSION['usuario'][0]['id_usuario'];

            $comp_general_uno =$this->input->post("comp_general_uno");
            $niveles_comp_general_uno = ( is_null($this->input->post("niveles_comp_general_uno")) ? '' :  $this->input->post("niveles_comp_general_uno"));

            $comp_general_dos =$this->input->post("comp_general_dos");
            $niveles_comp_general_dos = ( is_null($this->input->post("niveles_comp_general_dos")) ? '' :  $this->input->post("niveles_comp_general_dos"));

            $comp_especifica_uno =$this->input->post("comp_especifica_uno");
            $niveles_comp_especif_uno = (is_null($this->input->post("niveles_comp_especif_uno")) ? '' :  $this->input->post("niveles_comp_especif_uno"));

            $comp_especifica_dos =$this->input->post("comp_especifica_dos");
            $niveles_comp_especif_dos = ( is_null($this->input->post("niveles_comp_especif_dos")) ? '' :  $this->input->post("niveles_comp_especif_dos"));

            $comp_especifica_tres =$this->input->post("comp_especifica_tres");
            $niveles_comp_especif_tres = (is_null($this->input->post("niveles_comp_especif_tres")) ? '' :  $this->input->post("niveles_comp_especif_tres"));

            $id_ciclo =$this->input->post("id_ciclo");

            $id_compet_detalle =$this->input->post("id_compet_detalle");

            $parametros = array(
                'vACCION'        =>'COMPT_DETALLE',
                'p_id_1'         => $id_compet_detalle,
                'p_id_2'       => $id_ciclo,
                'p_id_3'     => '',
                'p_texto1' =>  $comp_general_uno,
                'p_texto2' => $niveles_comp_general_uno,
                'p_texto3'    => $comp_general_dos,
                'p_texto4' =>  $niveles_comp_general_dos,
                'p_texto5' => $comp_especifica_uno,
                'p_estado' => '2',
                'p_user' =>  $user,
  
                'p_texto6' => $niveles_comp_especif_uno,
                'p_texto7' =>  $comp_especifica_dos,
                'p_texto8' =>  $niveles_comp_especif_dos,
                'p_texto9' =>  $comp_especifica_tres,   
                'p_texto10' =>  $niveles_comp_especif_tres,   
            );


            $data=$this->contenedor->procedureUpdateOrInsertTables($parametros);

            echo $data[0]['ID']; 



        }
        else{
            redirect('/login');
        }
    }

    public function List_byid_PlanEstudios_articulacion(){
        if ($this->session->userdata('usuario')) {

            $id =$this->input->post("ID_PLAN_ESTUDIOS");

            $carreras_ids= $this->input->post("carreras_ids");



            $accion = 'LISTAR_PLAN_ESTUDIOS_ID_ARTICULACION';
            $parametros = array(
                $accion,
                $id,
                1,
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

           $ciclos =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);


           $accion = 'LISTAR_PLAN_ESTUDIOS_ID_ARTICULACION';
           $parametros = array(
               $accion,
               $id,
               2,
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



            $ciclo_electivo =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

            $data_html_out= '';

            if(isset($ciclos)){
                $ciclos_nom =Agrupar_array_por_keyvalue($ciclos,'ciclo_num');
            }else{
                $ciclos_nom = array();
            }


            if(isset($ciclo_electivo)){
                $ciclos_nom_elect =Agrupar_array_por_keyvalue($ciclo_electivo,'ciclo_num');
            }else{
                $ciclos_nom_elect = array();
            }

            // echo '<pre>';
            // print_r($ciclos_nom);
            // echo '</pre>';

            // echo '<pre>';
            // print_r($ciclos_nom_elect);
            // echo '</pre>';
            // exit();


            foreach($ciclos_nom  as $fila){

                foreach($fila['groupeddata'] as $key => $value ){

                    $general =$this->Model_Cursos->listar_diccionario_compet('');

                    $especifico =$this->Model_Cursos->listar_diccionario_compet_especificas($value['id_curso']);



                    //cmbos
                    /** */
                            $comp_general_uno = '<select style="width: 400px;background: white;"  class="custom-select mw-100" > <option value="">SELECCIONE</option>';
                            foreach($general  as $fila_tres){

                                if($fila_tres['id_diccionario_competen'] ==  $value['compet_gene_uno'] ){
                                    $comp_general_uno .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                                }else{
                                    $comp_general_uno .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                                }
                            }
                            $comp_general_uno .= '</select>';


                            $comp_general_dos = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                            foreach($general  as $fila_tres){

                                if($fila_tres['id_diccionario_competen'] ==  $value['compet_gene_dos'] ){
                                    $comp_general_dos .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                                }else{
                                    $comp_general_dos .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                                }
                            }
                            $comp_general_dos .= '</select>';

                            //-----------

                            $comp_especifica_uno = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                            foreach($especifico  as $fila_tres){

                                if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_uno'] ){
                                    $comp_especifica_uno .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                                }else{
                                    $comp_especifica_uno .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                                }
                            }
                            $comp_especifica_uno .= '</select>';

                            $comp_especifica_dos ='<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                            foreach($especifico  as $fila_tres){

                                if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_dos'] ){
                                    $comp_especifica_dos .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                                }else{
                                    $comp_especifica_dos .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                                }
                            }
                            $comp_especifica_dos .= '</select>';

                            $comp_especifica_tres = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                            foreach($especifico  as $fila_tres){

                                if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_tres'] ){
                                    $comp_especifica_tres .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                                }else{
                                    $comp_especifica_tres .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                                }
                            }
                            $comp_especifica_tres .= '</select>';

                    /** */

                    //niveles
                    /** */


                        $array_data_niveles_comp_general_uno = explode(",", $value['compet_gene_nivel_uno']);
                        $niveles_comp_general_uno= '<select style="width: 150px;" class="custom-select mw-100">';

                            $niveles_comp_general_uno .=  '<option '.( in_array('', $array_data_niveles_comp_general_uno) ? 'selected': '' ).' value="">Seleccione</option>';


                            $niveles_comp_general_uno .=  '<option '.( in_array(1, $array_data_niveles_comp_general_uno) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_general_uno .=  '<option '.( in_array(2, $array_data_niveles_comp_general_uno) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_general_uno .=  '<option '.( in_array(3, $array_data_niveles_comp_general_uno) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_general_uno .= '</select>';



                        $array_data_niveles_comp_general_dos = explode(",", $value['compet_gene_nivel_dos']);
                        $niveles_comp_general_dos= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_general_dos .=  '<option '.( in_array('', $array_data_niveles_comp_general_dos) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_general_dos .=  '<option '.( in_array(1, $array_data_niveles_comp_general_dos) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_general_dos .=  '<option '.( in_array(2, $array_data_niveles_comp_general_dos) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_general_dos .=  '<option '.( in_array(3, $array_data_niveles_comp_general_dos) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_general_dos .= '</select>';

                        //---
                        $array_data_niveles_comp_especif_uno = explode(",", $value['compet_espec_nivel_uno']);
                        $niveles_comp_especif_uno= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_uno .=  '<option '.( in_array('', $array_data_niveles_comp_especif_uno) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_uno .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_uno .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_uno .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_uno .= '</select>';


                        $array_data_niveles_comp_especif_dos = explode(",", $value['compet_espec_nivel_dos']);
                        $niveles_comp_especif_dos= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_dos .=  '<option '.( in_array('', $array_data_niveles_comp_especif_dos) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_dos .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_dos .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_dos .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_dos .= '</select>';


                        $array_data_niveles_comp_especif_tres = explode(",", $value['compet_espec_nivel_tres']);
                        $niveles_comp_especif_tres= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_tres .=  '<option '.( in_array('', $array_data_niveles_comp_especif_tres) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_tres .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_tres .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_tres .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_tres .= '</select>';


                    /** */

                    if($key ==0){
                        $data_html_out .=   '<tr  style="background:  #1c2d41;font-size: 20px;font-weight: bold;" ><td  colspan="12" >'.$value['nom_ciclo'].'</td></tr>';
                    }

                    $data_html_out .=   '<tr data-id="'.( is_null($value['id_compet_detalle']) ? '0' :$value['id_compet_detalle'] ).'" >'

                                                .'<td>'.$value['nom_curso'].'</td>'

                                                .'<td>'.$comp_general_uno.'</td>'
                                                .'<td>'.$niveles_comp_general_uno.'</td>'

                                                .'<td>'.$comp_general_dos.'</td>'
                                                .'<td>'.$niveles_comp_general_dos.'</td>'

                                                .'<td>'.$comp_especifica_uno.'</td>'
                                                .'<td>'. $niveles_comp_especif_uno .'</td>'

                                                .'<td>'.$comp_especifica_dos.'</td>'
                                                .'<td>'.$niveles_comp_especif_dos .'</td>'

                                                .'<td>'.$comp_especifica_tres.'</td>'
                                                .'<td>'. $niveles_comp_especif_tres.'</td>'


                                                .'<td><button type="button" title="Guardar fila" onclick="Guardar_Articulacion_Fila('.$value['id_curso'].',this,'.$value['id_ciclo'].')" class="btn btn-danger btn-circle"><i class="fas fa-save"></i></button></td>'

                                        .'</tr>';




                }

            }

            foreach($ciclos_nom_elect  as $fila){

                foreach($fila['groupeddata'] as $key => $value ){

                    $general =$this->Model_Cursos->listar_diccionario_compet('');

                    $especifico =$this->Model_Cursos->listar_diccionario_compet_especificas($value['id_curso']);

                    /** */
                        $comp_general_uno = '<select style="width: 400px;background: white;"  class="custom-select mw-100" > <option value="">SELECCIONE</option>';
                        foreach($general  as $fila_tres){

                            if($fila_tres['id_diccionario_competen'] ==  $value['compet_gene_uno'] ){
                                $comp_general_uno .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                            }else{
                                $comp_general_uno .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                            }
                        }
                        $comp_general_uno .= '</select>';

                        $comp_general_dos = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                        foreach($general  as $fila_tres){

                            if($fila_tres['id_diccionario_competen'] ==  $value['compet_gene_dos'] ){
                                $comp_general_dos .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                            }else{
                                $comp_general_dos .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                            }
                        }
                        $comp_general_dos .= '</select>';

                        //-----------
                        $comp_especifica_uno = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                        foreach($especifico  as $fila_tres){

                            if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_uno'] ){
                                $comp_especifica_uno .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                            }else{
                                $comp_especifica_uno .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                            }
                        }
                        $comp_especifica_uno .= '</select>';

                        $comp_especifica_dos ='<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                        foreach($especifico  as $fila_tres){

                            if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_dos'] ){
                                $comp_especifica_dos .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                            }else{
                                $comp_especifica_dos .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                            }
                        }
                        $comp_especifica_dos .= '</select>';

                        $comp_especifica_tres = '<select style="width: 400px;background: white;"  class="custom-select mw-100" ><option value="">SELECCIONE</option>';
                        foreach($especifico  as $fila_tres){

                            if($fila_tres['id_diccionario_competen'] ==  $value['compet_espec_tres'] ){
                                $comp_especifica_tres .=  '<option selected value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';

                            }else{
                                $comp_especifica_tres .=  '<option value="'.$fila_tres['id_diccionario_competen'] .'">'.$fila_tres['nom_compet'] .'</option>';
                            }
                        }
                        $comp_especifica_tres .= '</select>';

                    /** */


                    //niveles
                    /** */

                        $array_data_niveles_comp_general_uno = explode(",", $value['compet_gene_nivel_uno']);
                        $niveles_comp_general_uno= '<select style="width: 150px;" class="custom-select mw-100">';

                            $niveles_comp_general_uno .=  '<option '.( in_array('', $array_data_niveles_comp_general_uno) ? 'selected': '' ).' value="">Seleccione</option>';


                            $niveles_comp_general_uno .=  '<option '.( in_array(1, $array_data_niveles_comp_general_uno) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_general_uno .=  '<option '.( in_array(2, $array_data_niveles_comp_general_uno) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_general_uno .=  '<option '.( in_array(3, $array_data_niveles_comp_general_uno) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_general_uno .= '</select>';

                        $array_data_niveles_comp_general_dos = explode(",", $value['compet_gene_nivel_dos']);
                        $niveles_comp_general_dos= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_general_dos .=  '<option '.( in_array('', $array_data_niveles_comp_general_dos) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_general_dos .=  '<option '.( in_array(1, $array_data_niveles_comp_general_dos) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_general_dos .=  '<option '.( in_array(2, $array_data_niveles_comp_general_dos) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_general_dos .=  '<option '.( in_array(3, $array_data_niveles_comp_general_dos) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_general_dos .= '</select>';

                        //---
                        $array_data_niveles_comp_especif_uno = explode(",", $value['compet_espec_nivel_uno']);
                        $niveles_comp_especif_uno= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_uno .=  '<option '.( in_array('', $array_data_niveles_comp_especif_uno) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_uno .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_uno .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_uno .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_uno) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_uno .= '</select>';

                        $array_data_niveles_comp_especif_dos = explode(",", $value['compet_espec_nivel_dos']);
                        $niveles_comp_especif_dos= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_dos .=  '<option '.( in_array('', $array_data_niveles_comp_especif_dos) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_dos .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_dos .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_dos .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_dos) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_dos .= '</select>';

                        $array_data_niveles_comp_especif_tres = explode(",", $value['compet_espec_nivel_tres']);
                        $niveles_comp_especif_tres= '<select style="width: 150px;" class="custom-select mw-100">';

                        $niveles_comp_especif_tres .=  '<option '.( in_array('', $array_data_niveles_comp_especif_tres) ? 'selected': '' ).' value="">Seleccione</option>';

                            $niveles_comp_especif_tres .=  '<option '.( in_array(1, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).' value="1">1</option>';
                            $niveles_comp_especif_tres .=  '<option '.( in_array(2, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).'  value="2">2</option>';
                            $niveles_comp_especif_tres .=  '<option '.( in_array(3, $array_data_niveles_comp_especif_tres) ? 'selected': '' ).'  value="3">3</option>';
                        $niveles_comp_especif_tres .= '</select>';

                    /** */

                    if($key ==0){
                        $data_html_out .=   '<tr  style="background:  #1c2d41;font-size: 20px;font-weight: bold;" ><td  colspan="12" >'.$value['nom_ciclo'].'</td></tr>';
                    }

                    $data_html_out .=   '<tr data-id="'.(is_null($value['id_compet_detalle']) ? '0' :$value['id_compet_detalle']).'" >'

                                                .'<td>'.$value['nom_curso'].'</td>'

                                                .'<td>'.$comp_general_uno.'</td>'
                                                .'<td>'.$niveles_comp_general_uno.'</td>'

                                                .'<td>'.$comp_general_dos.'</td>'
                                                .'<td>'.$niveles_comp_general_dos.'</td>'

                                                .'<td>'.$comp_especifica_uno.'</td>'
                                                .'<td>'. $niveles_comp_especif_uno .'</td>'

                                                .'<td>'.$comp_especifica_dos.'</td>'
                                                .'<td>'.$niveles_comp_especif_dos .'</td>'

                                                .'<td>'.$comp_especifica_tres.'</td>'
                                                .'<td>'. $niveles_comp_especif_tres.'</td>'


                                                .'<td><button type="button" title="Guardar fila" onclick="Guardar_Articulacion_Fila('.$value['id_curso'].',this,'.$value['id_ciclo'].')" class="btn btn-danger btn-circle"><i class="fas fa-save"></i></button></td>'

                                        .'</tr>';




                }

            }


           echo $data_html_out ;

        }
        else{
            redirect('/login');
        }
    }

    public function PlanEstudios_excel($id_plan_estudios){

        if ($this->session->userdata('usuario')) {

            $user = $_SESSION['usuario'][0]['id_usuario'];
            $id_plan_estudios = $id_plan_estudios;

            $spreadsheet = new Spreadsheet();



            $parametros = array(
                'LISTAR_PLAN_ESTUDIOS_ID_SIN_CICLO',
                $id_plan_estudios,
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

            $PLAN_ESTUDIOS =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);



                //    echo ' <pre>';
                //    print_r($PLAN_ESTUDIOS);
                //    echo ' <echo>';
                //    exit;

            if(!empty($PLAN_ESTUDIOS)){

                $ids_carrera = explode(",", $PLAN_ESTUDIOS[0]['id_carrera'] );
                $carreras_nom = array();

                foreach ($ids_carrera as $key => $value) {
                        $carreras =$this->contenedor->get_carrera_filtro_excel($value);
                        array_push($carreras_nom, $carreras[0]['nom_carrera']);
                }

                $carreras_nombres_text   = implode(",", $carreras_nom);

                /**  datos principales */


                    /**propiedades del archivo */
                    $spreadsheet
                        ->getProperties()
                        ->setCreator( $PLAN_ESTUDIOS[0]['usuario_nombres'].' '.$PLAN_ESTUDIOS[0]['usuario_apater'].' '.$PLAN_ESTUDIOS[0]['usuario_amater'])
                        ->setLastModifiedBy( date("Y-m-d", strtotime($PLAN_ESTUDIOS[0]['fec_reg'])) )
                        // ->setTitle('Plan de estudios '.$PLAN_ESTUDIOS[0]['nom_plan_estudios'].' '.$PLAN_ESTUDIOS[0]['nom_plan_estudios']. 'Mi primer documento creado con PhpSpreadSheet')
                        ->setTitle('Plan de estudios '.$PLAN_ESTUDIOS[0]['nom_plan_estudios'].' '.$PLAN_ESTUDIOS[0]['nom_plan_estudios']. 'Mi primer documento creado con PhpSpreadSheet')

                        ->setSubject($PLAN_ESTUDIOS[0]['nom_plan_estudios'].' -'. $PLAN_ESTUDIOS[0]['titulo_prof'])
                        ->setDescription('Este documento fue creado por el sistema de gestion documental de la UCSUR')
                        ->setKeywords('plan de estudios ,'.$PLAN_ESTUDIOS[0]['titulo_prof'].','.$PLAN_ESTUDIOS[0]['grado_otorga'].','.$carreras_nombres_text)
                        ->setCategory($PLAN_ESTUDIOS[0]['grado_otorga'].','.$carreras_nombres_text);


                    $sheet = $spreadsheet->getActiveSheet();



                    

                    $sheet->setCellValue('A1', 'AÃ‘O: '.$PLAN_ESTUDIOS[0]['anio']);
                    $sheet->getStyle('A1')->getFont()->setBold(true);
                    $cells = 'A1:P1';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                

                    $sheet->setCellValue('A2', 'TIPOS DE ESTUDIOS: '.$PLAN_ESTUDIOS[0]['nom_tipo_estudios']);
                    $sheet->getStyle('A2')->getFont()->setBold(true);
                    $cells = 'A2:P2';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                    /** titulo 3  */
                    $sheet->setCellValue('A3', 'PLAN DE ESTUDIOS: '.$PLAN_ESTUDIOS[0]['nom_plan_estudios']);
                    $sheet->getStyle('A3')->getFont()->setBold(true);
                    $cells = 'A3:P3';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                    /** titulo 4  */
                    $sheet->setCellValue('A4', 'CÃ“DIGO PLAN DE ESTUDIOS: '.$PLAN_ESTUDIOS[0]['codigo_plan_es']);
                    $sheet->getStyle('A4')->getFont()->setBold(true);
                    $cells = 'A4:P4';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                    /** titulo 5 */
                    $sheet->setCellValue('A5', 'GRADO QUE OTORGA: '.$PLAN_ESTUDIOS[0]['grado_otorga']);
                    $sheet->getStyle('A5')->getFont()->setBold(true);
                    $cells = 'A5:P5';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    /** titulo 6 */
                    $sheet->setCellValue('A6', 'TITULO QUE OTORGA: '.$PLAN_ESTUDIOS[0]['titulo_prof']);
                    $sheet->getStyle('A6')->getFont()->setBold(true);
                    $cells = 'A6:P6';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                    /** titulo 7  */
                    $sheet->setCellValue('A7', 'MODALIDAD: '.$PLAN_ESTUDIOS[0]['modalidad']);
                    $sheet->getStyle('A7')->getFont()->setBold(true);
                    $cells = 'A7:P7';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    /** titulo 8  */
                    $sheet->setCellValue('A8', 'CARRERA: '.$PLAN_ESTUDIOS[0]['nom_carrera']);
                    $sheet->getStyle('A8')->getFont()->setBold(true);
                    $cells = 'A8:P8';
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('a6a6a6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                /**  datos principales */

            }

            $parametros2 = array(
                    'LISTAR_CICLOS_POR_PLAN_ESTUDIOS_ID',
                    '',
                    '',
                    '',
                    '',
                    $id_plan_estudios,
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
                    ,'','','','','',''
                    ,'','',
                    '',
                    1
            );

            $respuesta_ciclo=$this->Model_Ciclo->procedureCrudCiclos($parametros2);


                //    echo ' <pre>';
                //    print_r($parametros2);
                //    echo ' <echo>';
                //    exit;

        /** BODY */

            /*** LISTADO  */

                /** CABECERA */

                $cells = 'A9:B9';
                $sheet->setCellValue('A9', '');

                $sheet->mergeCells($cells);
                $sheet->getStyle($cells)->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('043c9c');

                $cells = 'C9:E9';
                $sheet->setCellValue('C9', 'HORAS TEORÃA');

                $sheet->mergeCells($cells);
                $sheet->getStyle($cells)->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c7cbc');
                $sheet->getStyle($cells)->getAlignment()->setHorizontal('center');

                // $cells = 'F9';
                // $sheet->setCellValue('F9', '');

                // $sheet->mergeCells($cells);
                // $sheet->getStyle($cells)->getFont()->getColor()->setARGB('FFFFFF');
                // $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');

                $cells = 'F9:H9';
                $sheet->setCellValue('F9', 'HORAS DE PRÃCTICA');

                $sheet->mergeCells($cells);
                $sheet->getStyle($cells)->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c64ac');
                $sheet->getStyle($cells)->getAlignment()->setHorizontal('center');


                $cells = 'I9:P9';
                $sheet->setCellValue('I9', '');

                $sheet->mergeCells($cells);
                $sheet->getStyle($cells)->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('043c8c');


                //--------------------------------------------------


                $sheet->setCellValue('A10', 'CODIGO');
                $sheet->getStyle('A10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('A10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('A')->setAutoSize(TRUE);

                $sheet->setCellValue('B10', 'CURSOS');
                $sheet->getStyle('B10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('B10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('B')->setAutoSize(TRUE);

                $sheet->setCellValue('C10', 'HORAS PRESENCIAL');
                $sheet->getStyle('C10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('C10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c7cbc');
                $sheet->getColumnDimension('C')->setAutoSize(TRUE);


                $sheet->setCellValue('D10', 'SINCRONAS');
                $sheet->getStyle('D10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('D10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c7cbc');
                $sheet->getColumnDimension('D')->setAutoSize(TRUE);


                $sheet->setCellValue('E10', 'ASINCRONAS');
                $sheet->getStyle('E10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('E10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c7cbc');
                $sheet->getColumnDimension('E')->setWidth(24);


                $sheet->setCellValue('F10', 'HORAS PRESENCIAL');
                $sheet->getStyle('F10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('F10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c64ac');
                $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                $sheet->setCellValue('G10', 'SINCRONAS');
                $sheet->getStyle('G10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('G10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c64ac');
                $sheet->getColumnDimension('G')->setAutoSize(TRUE);


                $sheet->setCellValue('H10', 'ASINCRONAS');
                $sheet->getStyle('H10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('H10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1c64ac');
                $sheet->getColumnDimension('H')->setAutoSize(TRUE);


                $sheet->setCellValue('I10', 'HORAS TOTALES');
                $sheet->getStyle('I10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('I10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('I')->setAutoSize(TRUE);


                $sheet->setCellValue('J10', 'CRÃ‰DITOS PRESENCIALES');
                $sheet->getStyle('J10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('J10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('J')->setAutoSize(TRUE);


                $sheet->setCellValue('K10', 'CRÃ‰DITOS VIRTUALES');
                $sheet->getStyle('K10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('K10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('K')->setAutoSize(TRUE);


                $sheet->setCellValue('L10', 'CRÃ‰DITOS');
                $sheet->getStyle('L10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('L10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('L')->setAutoSize(TRUE);


                $sheet->setCellValue('M10', 'REQUISITO');
                $sheet->getStyle('M10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('M10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('M')->setAutoSize(TRUE);


                $sheet->setCellValue('N10', 'GENERAL/ESPECÃFICO');
                $sheet->getStyle('N10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('N10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('N')->setAutoSize(TRUE);


                $sheet->setCellValue('O10', 'PRESENCIALIDAD');
                $sheet->getStyle('O10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('O10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('O')->setAutoSize(TRUE);

                $sheet->setCellValue('P10', 'OBLIGATORIEDAD');
                $sheet->getStyle('P10')->getFont()->getColor()->setARGB('FFFFFF');
                $estilo = $sheet->getStyle('P10');
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $sheet->getColumnDimension('P')->setAutoSize(TRUE);

            /*** LISTADO  */

            $start = 11;

            $creditos_obligatorios=0;
            $creditos_electivos=0;

            $creditos_especifico=0;
            $creditos_general=0;

            $creditos_presencial=0;
            $creditos_adistancia=0;
            $creditos_semi_presencial=0;


            if(!empty($respuesta_ciclo)){

                    $CICLOS =Agrupar_array_por_keyvalue($respuesta_ciclo,'ciclo_num');


                //    echo ' <pre>';
                //    print_r($CICLOS);
                //    echo ' <echo>';
                //    exit;

                    $creditos_final = 0;
                    $htp_final=0;
                    $hta_final=0;
                    $hts_final=0;
                    $hpp_final=0;
                    $hpa_final=0;
                    $hps_final=0;
                    $creditos_presen_final=0;
                    $creditos_virtual_final=0;
                    $htt_final=0;



                foreach($CICLOS as $data){

                    $sub_start= $start+1;

                    $cells = 'A'.$start.':P'.$start;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('043c8c');
                    $sheet->setCellValue('A'.$start, 'CICLO: '.$data['ciclo_num']);
                    $sheet->getStyle('A'.$start)->getFont()->setBold(true);
                    $sheet->getStyle('A'.$start)->getFont()->getColor()->setARGB('FFFFFF');
                    $sheet->getStyle($cells)->getAlignment()->setHorizontal('left');

                    $creditos = 0;
                    $htp=0;
                    $hta=0;
                    $hts=0;
                    $hpp=0;
                    $hpa=0;
                    $hps=0;
                    $creditos_presen=0;
                    $creditos_virtual=0;
                    $htt=0;

                    foreach ($data['groupeddata'] as $key => $value) {


                            $creditos += $value['creditos'];

                            $htp+=$value['horas_teoricas_presencial'];
                            $hta+=$value['horas_asincronas_teoricas'];
                            $hts+=$value['horas_sincronas_teoricas'];

                            $hpp+=$value['horas_practicas_presencial'];
                            $hpa+=$value['horas_asincronas_practicas'];
                            $hps+=$value['horas_sincronas_practicas'];

                            $creditos_presen+=$value['creditos_presencial'];
                            $creditos_virtual+=$value['creditos_virtual'];


                            $htt += $value['horas_totales'];

                            $ids_cursos = explode(",", $value['requisitos'] );
                            $cursos_nom = array();

                            foreach ($ids_cursos as $key => $valor) {
                                    $cursos =$this->contenedor->get_curso_excel_id($valor);
                                    if(!empty($cursos)){
                                        array_push($cursos_nom, $cursos[0]['nom_curso']);
                                    }else{
                                        array_push($cursos_nom,'');
                                    }
                            }

                            $cursos_nombres_text   = implode(",", $cursos_nom);

                            $sheet->setCellValue('A'.$sub_start, $value['codigo']);
                            $sheet->getStyle('A'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('A'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('A')->setAutoSize(TRUE);

                            $sheet->setCellValue('B'.$sub_start, $value['nom_curso']);
                            $sheet->getStyle('B'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('B'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('B')->setAutoSize(TRUE);


                            $sheet->setCellValue('C'.$sub_start, $value['horas_teoricas_presencial']);
                            $sheet->getStyle('C'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('C'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                            $sheet->setCellValue('D'.$sub_start, $value['horas_sincronas_teoricas']);
                            $sheet->getStyle('D'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('D'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                            $sheet->setCellValue('E'.$sub_start, $value['horas_asincronas_teoricas']);
                            $sheet->getStyle('E'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('E'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            // $sheet->getColumnDimension('E')->setAutoSize(TRUE);


                            $sheet->setCellValue('F'.$sub_start, $value['horas_practicas_presencial']);
                            $sheet->getStyle('F'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('F'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                            $sheet->setCellValue('G'.$sub_start, $value['horas_sincronas_practicas']);
                            $sheet->getStyle('G'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('G'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('G')->setAutoSize(TRUE);


                            $sheet->setCellValue('H'.$sub_start, $value['horas_asincronas_practicas']);
                            $sheet->getStyle('H'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('H'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('H')->setAutoSize(TRUE);

                            $sheet->setCellValue('I'.$sub_start, $value['horas_totales']);
                            $sheet->getStyle('I'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('I'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('I')->setAutoSize(TRUE);


                            $sheet->setCellValue('J'.$sub_start, $value['creditos_presencial']);
                            $sheet->getStyle('J'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('J'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                            $sheet->setCellValue('K'.$sub_start, $value['creditos_virtual']);
                            $sheet->getStyle('K'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('K'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('K')->setAutoSize(TRUE);

                            $sheet->setCellValue('L'.$sub_start,  $value['creditos']);
                            $sheet->getStyle('L'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('L'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('L')->setAutoSize(TRUE);

                            $sheet->setCellValue('M'.$sub_start, $cursos_nombres_text);
                            $sheet->getStyle('M'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('M'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('M')->setAutoSize(TRUE);

                            $sheet->setCellValue('N'.$sub_start, $value['nom_tipo_curso']);
                            $sheet->getStyle('N'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('N'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('N')->setAutoSize(TRUE);



                            if($value['tipo_curso']==1){
                                $creditos_general+= $value['creditos'];
                            }else{
                                $creditos_especifico+= $value['creditos'];
                            }


                            $sheet->setCellValue('O'.$sub_start,  $value['nom_curso_forma_estudio']);
                            $sheet->getStyle('O'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('O'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('O')->setAutoSize(TRUE);

                            if($value['presencialidad']==1){
                                $creditos_presencial+= $value['creditos'];
                            }else if($value['presencialidad']==2){
                                $creditos_adistancia+= $value['creditos_virtual'];
                            }else if ($value['presencialidad']==3){
                                $creditos_semi_presencial+= $value['creditos_virtual'];
                            }


                            $sheet->setCellValue('P'.$sub_start, $value['nom_curso_importancia']);
                            $sheet->getStyle('P'.$sub_start)->getFont()->getColor()->setARGB('000000');
                            $estilo = $sheet->getStyle('P'.$sub_start);
                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                            $sheet->getColumnDimension('P')->setAutoSize(TRUE);


                            if($value['obligatoriedad']==1){
                                $creditos_obligatorios+= $value['creditos'];

                            }else{
                                $creditos_electivos+= $value['creditos'];
                            }

                            $sub_start++;

                    }

                    $sub_start_sum=$sub_start;

                    /** TOTALES DE CICLO */

                    $sheet->setCellValue('B'.$sub_start_sum, 'TOTAL');
                    $sheet->getStyle('B'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('B'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('B')->setAutoSize(TRUE);
                    $sheet->getStyle('B'.$sub_start_sum)->getAlignment()->setHorizontal('right');


                    $sheet->setCellValue('C'.$sub_start_sum, $htp);
                    $sheet->getStyle('C'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('C'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                    $sheet->setCellValue('D'.$sub_start_sum, $hts);
                    $sheet->getStyle('D'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('D'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                    $sheet->setCellValue('E'.$sub_start_sum, $hta);
                    $sheet->getStyle('E'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('E'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    // $sheet->getColumnDimension('E')->setAutoSize(TRUE);

                    $sheet->setCellValue('F'.$sub_start_sum, $hpp);
                    $sheet->getStyle('F'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('F'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                    $sheet->setCellValue('G'.$sub_start_sum, $hps);
                    $sheet->getStyle('G'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('G'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('G')->setAutoSize(TRUE);

                    $sheet->setCellValue('H'.$sub_start_sum, $hpa);
                    $sheet->getStyle('H'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('H'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('H')->setAutoSize(TRUE);

                    $sheet->setCellValue('I'.$sub_start_sum,$htt);
                    $sheet->getStyle('I'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('I'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('I')->setAutoSize(TRUE);


                    $sheet->setCellValue('J'.$sub_start_sum, $creditos_presen);
                    $sheet->getStyle('J'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('J'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                    $sheet->setCellValue('K'.$sub_start_sum, $creditos_virtual);
                    $sheet->getStyle('K'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('K'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('K')->setAutoSize(TRUE);


                    $sheet->setCellValue('L'.$sub_start_sum,  $creditos);
                    $sheet->getStyle('L'.$sub_start_sum)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('L'.$sub_start_sum);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('L')->setAutoSize(TRUE);


                    $creditos_final += $creditos;

                    $htp_final+=$htp;
                    $hta_final+=$hta;
                    $hts_final+= $hts;

                    $hpp_final+=$hpp;
                    $hpa_final+= $hpa;
                    $hps_final+=$hps;

                    $creditos_presen_final+=$creditos_presen;
                    $creditos_virtual_final+=$creditos_virtual;

                    $htt_final+=$htt;


                    /** TOTAL DE TODO */
                    $start = $sub_start+1;

                }


                    $start = $start + 1 ;

                /** totales ciclos */

                    $sheet->setCellValue('B'.$start, 'TOTAL DE CICLOS');
                    $sheet->getStyle('B'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('B'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('B')->setAutoSize(TRUE);
                    $sheet->getStyle('B'.$start)->getAlignment()->setHorizontal('center');

                    $sheet->setCellValue('C'.$start, $htp_final);
                    $sheet->getStyle('C'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('C'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                    $sheet->setCellValue('D'.$start, $hts_final);
                    $sheet->getStyle('D'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('D'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                    $sheet->setCellValue('E'.$start, $hta_final);
                    $sheet->getStyle('E'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('E'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    // $sheet->getColumnDimension('E')->setAutoSize(TRUE);

                    $sheet->setCellValue('F'.$start, $hpp_final);
                    $sheet->getStyle('F'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('F'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                    $sheet->setCellValue('G'.$start, $hps_final);
                    $sheet->getStyle('G'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('G'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('G')->setAutoSize(TRUE);

                    $sheet->setCellValue('H'.$start, $hpa_final);
                    $sheet->getStyle('H'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('H'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('H')->setAutoSize(TRUE);


                    $sheet->setCellValue('I'.$start, $htt_final);
                    $sheet->getStyle('I'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('I'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('I')->setAutoSize(TRUE);

                    $sheet->setCellValue('J'.$start, $creditos_presen_final);
                    $sheet->getStyle('J'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('J'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                    $sheet->setCellValue('K'.$start, $creditos_virtual_final);
                    $sheet->getStyle('K'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('K'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('K')->setAutoSize(TRUE);



                    $sheet->setCellValue('L'.$start,  $creditos_final);
                    $sheet->getStyle('L'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('L'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('L')->setAutoSize(TRUE);



                    $start = $start + 1 ;


                    if ($creditos_final > 0) {
                        $porcentaje_prese_c = (floatval($creditos_presen_final)/floatval($creditos_final));
                    }else{
                        $porcentaje_prese_c = 0; //Valor predeterminado
                    }

                    if ($creditos_final > 0) {
                        $porcentaje_virt_c = (floatval($creditos_virtual_final)/floatval($creditos_final));
                    }else{
                        $porcentaje_virt_c = 0; //Valor predeterminado
                    }

                    $porcentaje_final_c =  $porcentaje_virt_c+$porcentaje_prese_c;

                    $sheet->setCellValue('J'.$start, $porcentaje_prese_c);
                    $sheet->getStyle('J'.$start)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                    $sheet->getStyle('J'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('J'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                    $sheet->setCellValue('K'.$start, $porcentaje_virt_c);
                    $sheet->getStyle('k'.$start)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                    $sheet->getStyle('K'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('K'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('K')->setAutoSize(TRUE);

                    $sheet->setCellValue('L'.$start,  $porcentaje_final_c );
                    $sheet->getStyle('L'.$start)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                    $sheet->getStyle('L'.$start)->getFont()->getColor()->setARGB('000000');
                    $estilo = $sheet->getStyle('L'.$start);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFFFF00');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $sheet->getColumnDimension('L')->setAutoSize(TRUE);
                /** totales ciclos */

            }else{

            }

        /** BODY */
         /** electivos */

                        $parametros = array(
                            'LISTAR_PLAN_ESTUDIOS_ID_ELECTIVO',
                            $id_plan_estudios,
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

                        $PLAN_ESTUDIOS_ELEC =$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);

                        // echo '<pre>';
                        // print_r( $PLAN_ESTUDIOS_ELEC );
                        // echo '</pre>';
                        // exit();

                        if(!empty($PLAN_ESTUDIOS_ELEC)){
                            $CICLOS_ELECT =Agrupar_array_por_keyvalue($PLAN_ESTUDIOS_ELEC,'nom_ciclo');
                            /** BODY ELECTIVOS */
                                    $start_elect = $start + 5 ;
                                    $creditos_final_elect = 0;
                                    $htp_final_elect=0;
                                    $hta_final_elect=0;
                                    $hts_final_elect=0;
                                    $hpp_final_elect=0;
                                    $hpa_final_elect=0;
                                    $hps_final_elect=0;
                                    $creditos_presen_final_elect=0;
                                    $creditos_virtual_final_elect=0;
                                    $htt_final_elect=0;

                                    foreach($CICLOS_ELECT as $data){

                                        $sub_start_elect= $start_elect+1;

                                        $cells = 'A'.$start_elect.':P'.$start_elect;
                                        $sheet->mergeCells($cells);
                                        $estilo = $sheet->getStyle($cells);
                                        $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('043c84');
                                        $sheet->setCellValue('A'.$start_elect, 'CICLO: '.$data['nom_ciclo']);
                                        $sheet->getStyle('A'.$start_elect)->getFont()->setBold(true);
                                        $sheet->getStyle('A'.$start_elect)->getFont()->getColor()->setARGB('FFFFFF');
                                        $sheet->getStyle($cells)->getAlignment()->setHorizontal('left');

                                        $creditos_elect = 0;
                                        $htp_elect=0;
                                        $hta_elect=0;
                                        $hts_elect=0;
                                        $hpp_elect=0;
                                        $hpa_elect=0;
                                        $hps_elect=0;
                                        $creditos_presen_elect=0;
                                        $creditos_virtual_elect=0;
                                        $htt_elect=0;

                                        foreach ($data['groupeddata'] as $key => $value) {

                                                $creditos_elect += $value['creditos'];

                                                $htp_elect+=$value['horas_teoricas_presencial'];
                                                $hta_elect+=$value['horas_asincronas_teoricas'];
                                                $hts_elect+=$value['horas_sincronas_teoricas'];

                                                $hpp_elect+=$value['horas_practicas_presencial'];
                                                $hpa_elect+=$value['horas_asincronas_practicas'];
                                                $hps_elect+=$value['horas_sincronas_practicas'];

                                                $creditos_presen_elect+=$value['creditos_presencial'];
                                                $creditos_virtual_elect+=$value['creditos_virtual'];

                                                $htt_elect += $value['horas_totales'];

                                                    /** */
                                                            if( $value['requisitos']== null || $value['requisitos'] === '' ){
                                                                $cursos_nombres_text   = 'SEGÃšN LISTA DE ELECTIVOS DE ORIENTACIÃ“N';
                                                            }else{
                                                                $ids_cursos = explode(",", $value['requisitos'] );

                                                                $cursos_nom = array();

                                                                foreach ($ids_cursos as $key => $valor) {
                                                                        $cursos =$this->contenedor->get_curso_excel_id($valor);
                                                                        array_push($cursos_nom, $cursos[0]['nom_curso']);
                                                                }
                                                                $cursos_nombres_text   = implode(",", $cursos_nom);
                                                            }

                                                            $sheet->setCellValue('A'.$sub_start_elect, $value['codigo']);
                                                            $sheet->getStyle('A'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('A'.$sub_start_elect);
                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('A')->setAutoSize(TRUE);

                                                            $sheet->setCellValue('B'.$sub_start_elect, $value['nom_curso']);
                                                            $sheet->getStyle('B'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('B'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('B')->setAutoSize(TRUE);

                                                            $sheet->setCellValue('C'.$sub_start_elect, $value['horas_teoricas_presencial']);
                                                            $sheet->getStyle('C'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('C'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                                                            $sheet->setCellValue('D'.$sub_start_elect, $value['horas_sincronas_teoricas']);
                                                            $sheet->getStyle('D'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('D'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                                                            $sheet->setCellValue('E'.$sub_start_elect, $value['horas_asincronas_teoricas']);
                                                            $sheet->getStyle('E'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('E'.$sub_start_elect);
                                                            // $sheet->getColumnDimension('E')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('F'.$sub_start_elect, $value['horas_practicas_presencial']);
                                                            $sheet->getStyle('F'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('F'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('G'.$sub_start_elect, $value['horas_sincronas_practicas']);
                                                            $sheet->getStyle('G'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('G'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('G')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('H'.$sub_start_elect, $value['horas_asincronas_practicas']);
                                                            $sheet->getStyle('H'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('H'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('H')->setAutoSize(TRUE);



                                                            $sheet->setCellValue('I'.$sub_start_elect, $value['horas_totales']);
                                                            $sheet->getStyle('I'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('I'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('I')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('J'.$sub_start_elect, $value['creditos_presencial']);
                                                            $sheet->getStyle('J'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('J'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('J')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('K'.$sub_start_elect, $value['creditos_virtual']);
                                                            $sheet->getStyle('K'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('K'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('K')->setAutoSize(TRUE);




                                                            $sheet->setCellValue('L'.$sub_start_elect,  $value['creditos']);
                                                            $sheet->getStyle('L'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('L'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                                                            $sheet->getColumnDimension('L')->setAutoSize(TRUE);




                                                            $sheet->setCellValue('M'.$sub_start_elect, $cursos_nombres_text);
                                                            $sheet->getStyle('M'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('M'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('M')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('N'.$sub_start_elect, $value['nom_tipo_curso']);
                                                            $sheet->getStyle('N'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('N'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('N')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('O'.$sub_start_elect,  $value['nom_curso_forma_estudio']);
                                                            $sheet->getStyle('O'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('O'.$sub_start_elect);

                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('O')->setAutoSize(TRUE);


                                                            $sheet->setCellValue('P'.$sub_start_elect, $value['nom_curso_importancia']);
                                                            $sheet->getStyle('P'.$sub_start_elect)->getFont()->getColor()->setARGB('000000');
                                                            $estilo = $sheet->getStyle('P'.$sub_start_elect);
                                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                            $sheet->getColumnDimension('P')->setAutoSize(TRUE);

                                                    /** */

                                                $sub_start_elect++;

                                        }

                                        $sub_start_sum_elect=$sub_start_elect;

                                            /** TOTALES DE CICLO */

                                                $sheet->setCellValue('B'.$sub_start_sum_elect, 'TOTAL');
                                                $sheet->getStyle('B'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('B'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');

                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('B')->setAutoSize(TRUE);
                                                $sheet->getStyle('B'.$sub_start_sum_elect)->getAlignment()->setHorizontal('right');



                                                $sheet->setCellValue('C'.$sub_start_sum_elect, $htp_elect);
                                                $sheet->getStyle('C'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('C'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                                                $sheet->setCellValue('D'.$sub_start_sum_elect, $hts_elect);
                                                $sheet->getStyle('D'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('D'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                                                $sheet->setCellValue('E'.$sub_start_sum_elect, $hta_elect);
                                                $sheet->getStyle('E'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('E'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                // $sheet->getColumnDimension('E')->setAutoSize(TRUE);

                                                $sheet->setCellValue('F'.$sub_start_sum_elect, $hpp_elect);
                                                $sheet->getStyle('F'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('F'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                                                $sheet->setCellValue('G'.$sub_start_sum_elect, $hps_elect);
                                                $sheet->getStyle('G'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('G'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('G')->setAutoSize(TRUE);

                                                $sheet->setCellValue('H'.$sub_start_sum_elect, $hpa_elect);
                                                $sheet->getStyle('H'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('H'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('H')->setAutoSize(TRUE);

                                                $sheet->setCellValue('I'.$sub_start_sum_elect,$htt_elect);
                                                $sheet->getStyle('I'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('I'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('I')->setAutoSize(TRUE);


                                                $sheet->setCellValue('J'.$sub_start_sum_elect, $creditos_presen_elect);
                                                $sheet->getStyle('J'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('J'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                                                $sheet->setCellValue('K'.$sub_start_sum_elect, $creditos_virtual_elect);
                                                $sheet->getStyle('K'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('K'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('K')->setAutoSize(TRUE);


                                                $sheet->setCellValue('L'.$sub_start_sum_elect,  $creditos_elect);
                                                $sheet->getStyle('L'.$sub_start_sum_elect)->getFont()->getColor()->setARGB('000000');
                                                $estilo = $sheet->getStyle('L'.$sub_start_sum_elect);
                                                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('188cc6');
                                                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                                $sheet->getColumnDimension('L')->setAutoSize(TRUE);

                                            /** TOTALES DE CICLO */

                                        $creditos_final_elect += $creditos_elect;

                                        $htp_final_elect+=$htp_elect;
                                        $hta_final_elect+=$hta_elect;
                                        $hts_final_elect+= $hts_elect;

                                        $hpp_final_elect+=$hpp_elect;
                                        $hpa_final_elect+= $hpa_elect;
                                        $hps_final_elect+=$hps_elect;

                                        $creditos_presen_final_elect+=$creditos_presen_elect;
                                        $creditos_virtual_final_elect+=$creditos_virtual_elect;

                                        $htt_final_elect+=$htt_elect;


                                        $start_elect = $sub_start_elect+1;

                                    }

                                    $start_elect = $start_elect + 1 ;

                                    /** TOTAL DE TODO */

                                            $sheet->setCellValue('B'.$start_elect, 'TOTAL DE CICLOS ELECTIVOS');
                                            $sheet->getStyle('B'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('B'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('B')->setAutoSize(TRUE);
                                            $sheet->getStyle('B'.$start_elect)->getAlignment()->setHorizontal('center');

                                            $sheet->setCellValue('C'.$start_elect, $htp_final_elect);
                                            $sheet->getStyle('C'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('C'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('C')->setAutoSize(TRUE);

                                            $sheet->setCellValue('D'.$start_elect, $hts_final_elect);
                                            $sheet->getStyle('D'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('D'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('D')->setAutoSize(TRUE);

                                            $sheet->setCellValue('E'.$start_elect, $hta_final_elect);
                                            $sheet->getStyle('E'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('E'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            // $sheet->getColumnDimension('E')->setAutoSize(TRUE);

                                            $sheet->setCellValue('F'.$start_elect, $hpp_final_elect);
                                            $sheet->getStyle('F'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('F'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('F')->setAutoSize(TRUE);


                                            $sheet->setCellValue('G'.$start_elect, $hps_final_elect);
                                            $sheet->getStyle('G'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('G'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('G')->setAutoSize(TRUE);

                                            $sheet->setCellValue('H'.$start_elect, $hpa_final_elect);
                                            $sheet->getStyle('H'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('H'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('H')->setAutoSize(TRUE);


                                            $sheet->setCellValue('I'.$start_elect, $htt_final_elect);
                                            $sheet->getStyle('I'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('I'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('I')->setAutoSize(TRUE);

                                            $sheet->setCellValue('J'.$start_elect, $creditos_presen_final_elect);
                                            $sheet->getStyle('J'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('J'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('J')->setAutoSize(TRUE);

                                            $sheet->setCellValue('K'.$start_elect, $creditos_virtual_final_elect);
                                            $sheet->getStyle('K'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('K'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('K')->setAutoSize(TRUE);



                                            $sheet->setCellValue('L'.$start_elect,  $creditos_final_elect);
                                            $sheet->getStyle('L'.$start_elect)->getFont()->getColor()->setARGB('000000');
                                            $estilo = $sheet->getStyle('L'.$start_elect);
                                            $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFC0C0C0');
                                            $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                                            $sheet->getColumnDimension('L')->setAutoSize(TRUE);

                                    /** TOTAL DE TODO */


                            /** BODY ELECTIVOS */
                        }else{
                            $start_elect = $start + 1 ;

                        }


        /** electivos */



            $start_tbl =$start_elect+5;


            /** tabla 1  */
                    $sheet->setCellValue('B'.$start_tbl, 'TIPO DE ESTUDIOS');
                    $sheet->getStyle('B'.$start_tbl)->getFont()->setBold(true);
                    $sheet->getStyle('B'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'B'.$start_tbl.':B'.$start_tbl;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    $sheet->setCellValue('C'.$start_tbl, 'CANTIDAD DE CRÃ‰DITOS');
                    $sheet->getStyle('C'.$start_tbl)->getFont()->setBold(true);
                    $sheet->getStyle('C'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'C'.$start_tbl.':C'.$start_tbl;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                    $start_tbl_uno=$start_tbl+1;

                    $sheet->setCellValue('B'.$start_tbl_uno, 'CrÃ©ditos para cursos generales');
                    $sheet->getStyle('B'.$start_tbl_uno)->getFont()->setBold(true);
                    //$sheet->getStyle('C'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'B'.$start_tbl_uno.':B'.$start_tbl_uno;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                   // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    $sheet->setCellValue('C'.$start_tbl_uno, $creditos_general);
                    //$sheet->getStyle('D'.$start_tbl_uno)->getFont()->setBold(true);
                   // $sheet->getStyle('D'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'C'.$start_tbl_uno.':C'.$start_tbl_uno;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                   // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                    $start_tbl_uno=$start_tbl_uno+1;

                    $sheet->setCellValue('B'.$start_tbl_uno, 'CrÃ©ditos para cursos especÃ­ficos y de especialidad');
                    $sheet->getStyle('B'.$start_tbl_uno)->getFont()->setBold(true);
                    //$sheet->getStyle('C'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'B'.$start_tbl_uno.':B'.$start_tbl_uno;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    $sheet->setCellValue('C'.$start_tbl_uno, $creditos_especifico);
                    //$sheet->getStyle('D'.$start_tbl_uno)->getFont()->setBold(true);
                    //$sheet->getStyle('D'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'C'.$start_tbl_uno.':C'.$start_tbl_uno;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                   // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    $start_tbl_uno=$start_tbl_uno+1;

                    $creditos_espe_gene = $creditos_especifico+$creditos_general;

                    $sheet->setCellValue('B'.$start_tbl_uno, 'TOTAL');
                    $sheet->getStyle('B'.$start_tbl_uno)->getFont()->setBold(true);
                    //$sheet->getStyle('C'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'B'.$start_tbl_uno.':B'.$start_tbl_uno;
                    $sheet->getStyle('B'.$start_tbl_uno)->getAlignment()->setHorizontal('right');

                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                    //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    // $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    // $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                    $sheet->setCellValue('C'.$start_tbl_uno, $creditos_espe_gene);
                    //$sheet->getStyle('D'.$start_tbl_uno)->getFont()->setBold(true);
                    //$sheet->getStyle('D'.$start_tbl_uno)->getFont()->getColor()->setARGB('FFFFFF');
                    $cells = 'C'.$start_tbl_uno.':C'.$start_tbl_uno;
                    $sheet->mergeCells($cells);
                    $estilo = $sheet->getStyle($cells);
                   // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                    $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                    $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



            /** tabla 2  */

                $sheet->setCellValue('E'.$start_tbl, 'TIPO DE ESTUDIOS');
                $sheet->getStyle('E'.$start_tbl)->getFont()->setBold(true);
                $sheet->getStyle('E'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'E'.$start_tbl.':E'.$start_tbl;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheet->setCellValue('F'.$start_tbl, 'CANTIDAD DE CRÃ‰DITOS');
                $sheet->getStyle('F'.$start_tbl)->getFont()->setBold(true);
                $sheet->getStyle('F'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'F'.$start_tbl.':F'.$start_tbl;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                $start_tbl_dos=$start_tbl+1;

                $sheet->setCellValue('E'.$start_tbl_dos, 'CrÃ©ditos obligatorios');
                $sheet->getStyle('E'.$start_tbl_dos)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'E'.$start_tbl_dos.':E'.$start_tbl_dos;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheet->setCellValue('F'.$start_tbl_dos, $creditos_obligatorios);
                //$sheet->getStyle('F'.$start_tbl_dos)->getFont()->setBold(true);
                // $sheet->getStyle('F'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'F'.$start_tbl_dos.':F'.$start_tbl_dos;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                $start_tbl_dos=$start_tbl_dos+1;

                $sheet->setCellValue('E'.$start_tbl_dos, 'CrÃ©ditos Electivos');
                $sheet->getStyle('E'.$start_tbl_dos)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'E'.$start_tbl_dos.':E'.$start_tbl_dos;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheet->setCellValue('F'.$start_tbl_dos,  $creditos_electivos);
                //$sheet->getStyle('F'.$start_tbl_dos)->getFont()->setBold(true);
                //$sheet->getStyle('F'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'F'.$start_tbl_dos.':F'.$start_tbl_dos;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $start_tbl_dos=$start_tbl_dos+1;

                $total_obli_elec = $creditos_obligatorios + $creditos_electivos;

                $sheet->setCellValue('E'.$start_tbl_dos, 'TOTAL');
                $sheet->getStyle('E'.$start_tbl_dos)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'E'.$start_tbl_dos.':E'.$start_tbl_dos;
                $sheet->getStyle('E'.$start_tbl_dos)->getAlignment()->setHorizontal('right');

                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                // $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                // $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheet->setCellValue('F'.$start_tbl_dos, $total_obli_elec);
                //$sheet->getStyle('F'.$start_tbl_dos)->getFont()->setBold(true);
                //$sheet->getStyle('F'.$start_tbl_dos)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'F'.$start_tbl_dos.':F'.$start_tbl_dos;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


            /** tabla 3  */

                $start_tbl =$start_tbl_dos +4;

                $total_pre_adis_sp= $creditos_presen_final+ $creditos_adistancia+ $creditos_semi_presencial;


                $sheet->setCellValue('B'.$start_tbl, '% DE CRÃ‰DITOS SEGÃšN TIPO DE MODALIDAD:');
                $sheet->getStyle('B'.$start_tbl)->getFont()->setBold(true);
                $sheet->getStyle('B'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'B'.$start_tbl.':B'.$start_tbl;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

                $sheet->setCellValue('C'.$start_tbl, 'CRÃ‰DITOS');
                $sheet->getStyle('C'.$start_tbl)->getFont()->setBold(true);
                $sheet->getStyle('C'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'C'.$start_tbl.':C'.$start_tbl;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                $sheet->setCellValue('D'.$start_tbl, 'PORCENTAJE');
                $sheet->getStyle('D'.$start_tbl)->getFont()->setBold(true);
                $sheet->getStyle('D'.$start_tbl)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'D'.$start_tbl.':D'.$start_tbl;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);




                $start_tbl_tres=$start_tbl+1;

                $sheet->setCellValue('B'.$start_tbl_tres, 'PRESENCIAL');
                $sheet->getStyle('B'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('D'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'B'.$start_tbl_tres.':B'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                $sheet->setCellValue('C'.$start_tbl_tres, $creditos_presen_final);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'C'.$start_tbl_tres.':C'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                if ($total_pre_adis_sp > 0) {
                    $porcentaje_presen_moda = (floatval($creditos_presen_final)/floatval($total_pre_adis_sp));
                }else{
                    $porcentaje_presen_moda = 0; //Valor predeterminado
                }

                $sheet->setCellValue('D'.$start_tbl_tres, $porcentaje_presen_moda );
                $sheet->getStyle('D'.$start_tbl_tres)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'D'.$start_tbl_tres.':D'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);





                $start_tbl_tres=$start_tbl_tres+1;

                $sheet->setCellValue('B'.$start_tbl_tres, 'SEMIPRESENCIAL');
                $sheet->getStyle('B'.$start_tbl_tres)->getFont()->setBold(true);
                // $sheet->getStyle('D'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'B'.$start_tbl_tres.':B'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);


                $sheet->setCellValue('C'.$start_tbl_tres, $creditos_semi_presencial);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'C'.$start_tbl_tres.':C'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                if ($total_pre_adis_sp > 0) {
                    $porcentaje_semi_p = (floatval($creditos_semi_presencial)/floatval($total_pre_adis_sp));
                }else{
                    $porcentaje_semi_p = 0; //Valor predeterminado
                }

                $sheet->setCellValue('D'.$start_tbl_tres,$porcentaje_semi_p);
                $sheet->getStyle('D'.$start_tbl_tres)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'D'.$start_tbl_tres.':D'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);





                $start_tbl_tres=$start_tbl_tres+1;

                $sheet->setCellValue('B'.$start_tbl_tres, 'A DISTANCIA ');
                $sheet->getStyle('B'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('D'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'B'.$start_tbl_tres.':B'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                $sheet->setCellValue('C'.$start_tbl_tres, $creditos_adistancia);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('E'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'C'.$start_tbl_tres.':C'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ec9324');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);




                if ($total_pre_adis_sp > 0) {
                    $porcentaje_adist = (floatval($creditos_adistancia)/floatval($total_pre_adis_sp));
                }else{
                    $porcentaje_adist = 0; //Valor predeterminado
                }


                $sheet->setCellValue('D'.$start_tbl_tres, $porcentaje_adist);
                $sheet->getStyle('D'.$start_tbl_tres)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('F'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'D'.$start_tbl_tres.':D'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);




                $start_tbl_tres=$start_tbl_tres+1;


                $total_porcent_mod=$porcentaje_presen_moda+$porcentaje_adist+$porcentaje_semi_p;


                $sheet->setCellValue('B'.$start_tbl_tres, 'TOTAL ');
                $sheet->getStyle('B'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('B'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'B'.$start_tbl_tres.':B'.$start_tbl_tres;
                $sheet->getStyle('B'.$start_tbl_tres)->getAlignment()->setHorizontal('right');
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                //$estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                // $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                // $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                $sheet->setCellValue('C'.$start_tbl_tres, $total_pre_adis_sp);
                //$sheet->getStyle('C'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('C'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'C'.$start_tbl_tres.':C'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



                $sheet->setCellValue('D'.$start_tbl_tres, $total_porcent_mod);
                $sheet->getStyle('D'.$start_tbl_tres)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                //$sheet->getStyle('D'.$start_tbl_tres)->getFont()->setBold(true);
                //$sheet->getStyle('D'.$start_tbl_tres)->getFont()->getColor()->setARGB('FFFFFF');
                $cells = 'D'.$start_tbl_tres.':D'.$start_tbl_tres;
                $sheet->mergeCells($cells);
                $estilo = $sheet->getStyle($cells);
                // $estilo->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('000000');
                $estilo->getBorders()->getTop()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
                $estilo->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);



            /** tabla 3  */






            $curdate = date('d-m-Y');

            $writer = new Xlsx($spreadsheet);

            $filename = 'Plan_de_estudios-'.$PLAN_ESTUDIOS[0]['nom_plan_estudios'].'-'.$curdate;
            ob_end_clean();
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');

        }
        else{
            redirect('/login');
        }

    }


    public function PlanEstudios_excel_importar(){

        $fecha=date('Y-m-d');
        $user_reg= $_SESSION['usuario'][0]['id_usuario'];

        $nombreArchivo = $_FILES['excel_file']['tmp_name'];

        $documento = IOFactory::load($nombreArchivo);
        $totalHojas = $documento->getSheetCount();
        $hojaActual=  $documento->getSheet(0);
        $numeroFilas = $hojaActual->getHighestDataRow();
        $letra = $hojaActual->getHighestColumn();
        $numerLetra = Coordinate::columnIndexFromString($letra);

        $buscar_dospuntos   = ':';


        $contar_filas =0;
        //anio :                  LETRA,CELDA_NUMERO
        $contar_filas++;
        $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
        $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
        $posexacta_dospuntos=$posicion_dospuntos+1;
        $string_data = substr($valorCampo,$posexacta_dospuntos);
        $anio =  trim($string_data);


        //CPE                                        LETRA,CELDA_NUMERO
        $contar_filas++;
        $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
        $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
        $posexacta_dospuntos=$posicion_dospuntos+1;
        $string_data = substr($valorCampo,$posexacta_dospuntos);
        $id_tipo_estudios =  trim($string_data);

        $cpe=print_lista_like($id_tipo_estudios,'nom_tipo_estudios','tipo_estudios','id_tipo_estudios');




        //NOMBRE PLAN DE ESTUDIOS :                  LETRA,CELDA_NUMERO
        $contar_filas++;
        $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
        $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
        $posexacta_dospuntos=$posicion_dospuntos+1;
        $string_data = substr($valorCampo,$posexacta_dospuntos);
        $plan_estudios =  trim($string_data);




        //CÃ“DIGO PLAN DE ESTUDIOS :                  LETRA,CELDA_NUMERO
        $contar_filas++;
        $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
        $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
        $posexacta_dospuntos=$posicion_dospuntos+1;
        $string_data = substr($valorCampo,$posexacta_dospuntos);
        $codigo_plan_estudios =  trim($string_data);
        // echo '.'.$codigo_plan_estudios.'</br>';




         //GRADO QUE OTORGA        :                  LETRA,CELDA_NUMERO
         $contar_filas++;
         $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
         $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
         $posexacta_dospuntos=$posicion_dospuntos+1;
         $string_data = substr($valorCampo,$posexacta_dospuntos);
         $grado_otorga =  trim($string_data);
        //  echo '.'.$grado_otorga.'.';



         //TÃTULO PROFESIONAL:                        LETRA,CELDA_NUMERO
         $contar_filas++;
         $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
         $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
         $posexacta_dospuntos=$posicion_dospuntos+1;
         $string_data = substr($valorCampo,$posexacta_dospuntos);
         $titulo_prof =  trim($string_data);
        //  echo '.'.$titulo_prof.'.</br>';




         //MODALIDAD  :                               LETRA,CELDA_NUMERO
         $contar_filas++;
         $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
         $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
         $posexacta_dospuntos=$posicion_dospuntos+1;
         $string_data = substr($valorCampo,$posexacta_dospuntos);
         $modalidad =  trim($string_data);

        //  $modalidad_id=print_lista_like($modalidad,'nom_curso_forma_estudio','curso_forma_estudio','id_curso_forma_estudio');




         //CARRERA :                                  LETRA,CELDA_NUMERO
         $contar_filas++;
         $valorCampo = $hojaActual->getCellByColumnAndRow(1,$contar_filas);
         $posicion_dospuntos = strpos($valorCampo, $buscar_dospuntos);
         $posexacta_dospuntos=$posicion_dospuntos+1;
         $string_data = substr($valorCampo,$posexacta_dospuntos);
         $nombre_carrera =  trim($string_data);




         $carrera_id=print_lista_like($nombre_carrera,'nom_carrera','carrera','id_carrera');
         $accion = 'INSERTAR_PLAN_ESTUDIOS';
         $parametros = array(
             $accion,
             '',
             $plan_estudios,
             '',
             $carrera_id,
             $codigo_plan_estudios,
             $modalidad,
             $grado_otorga,
             $titulo_prof,
             '3',
             $user_reg,
             $cpe,
             $anio
         );


        //  print_r($parametros);
        //  echo '<br/>';

            $respuesta_planestudios=$this->Model_PlanEstudios->procedureCrudPlanEstudios($parametros);
            $id_plan_estudios = $respuesta_planestudios[0]['ultimo_id'];
        //    $id_plan_estudios =0;

            $buscar_ciclo   = 'CICLO:';

            $hojaActual=  $documento->getSheet(0);
            $numeroFilas = $hojaActual->getHighestDataRow();
            $letra = $hojaActual->getHighestColumn();

            $numerLetra = Coordinate::columnIndexFromString($letra);

            $principal = array();
            //-------

                $num_ciclo=0;
                $nombre=0;
                $ciclo_electivo=0;

                $horas_sincronas_practicas=0;
                $horas_asincronas_practicas=0;
                $horas_practicas_presencial=0;

                $horas_sincronas_teoricas=0;
                $horas_asincronas_teoricas=0;
                $horas_teoricas_presencial=0;

                $horas_totales=0;


                $horas_teoricas=0;
                $horas_practicas=0;

                $creditos_presencial=0;
                $creditos_virtual=0;
                $creditos=0;
                $estado_id=2;
            //-------

            $orden_electivo=1;

            $Filas_reales = $numeroFilas - 14;
            $contar_filas++;
            $contar_filas++;
            $contar_filas++;

            $esta_vacio=false;

            for($indiceFila= $contar_filas ; $indiceFila <= $Filas_reales;$indiceFila++){
                    $valorA = $hojaActual->getCellByColumnAndRow(1,$indiceFila);
                    $ciclo_existe=strpos($valorA, ':');
                    //CICLO
                    if($ciclo_existe !== false){
                        $posicion_data=strpos($valorA, $buscar_dospuntos);
                        if( $posicion_data !== false){
                            $posi_exacta=$posicion_data+1;
                            $string_data = substr($valorA,$posi_exacta);
                            $ciclo =  trim($string_data);

                            if(strlen($ciclo) < 3){
                                $num_ciclo= $ciclo;
                                $nombre= 'ciclo '.$ciclo;
                                if (is_numeric($num_ciclo)) {
                                    $ciclo_electivo='1';
                                } else {
                                    $ciclo_electivo='2';
                                }
                            }else{
                                $num_ciclo=  $orden_electivo;
                                $nombre= $ciclo;
                                $ciclo_electivo='2';
                                $orden_electivo++;
                            }
                        
                        }
                    }
                    for($indiceColumna=1; $indiceColumna <= $numerLetra ; $indiceColumna++){
                        if(strlen($valorA) != 0){

                            if($ciclo_existe !== false){

                            }else{


                                $valor_trim = trim($hojaActual->getCellByColumnAndRow($indiceColumna,$indiceFila));

                                
                                if($indiceColumna==1){

                                    if(strlen(trim($valor_trim))==0){ 
                                        $esta_vacio=true;
                                    }else{
                                        $esta_vacio=false;

                                        $principal['data__fila_'.$indiceFila]['nombre']= mb_strtoupper($nombre, 'UTF-8');  
                                        $principal['data__fila_'.$indiceFila]['num_ciclo']= $num_ciclo;
                                        $principal['data__fila_'.$indiceFila]['ciclo_electivo']= $ciclo_electivo;
                                        if($valor_trim==='-'){

                                        }else{
                                            $validar_codigo_curso=print_lista_like($valor_trim,'codigo','curso','id_curso');
                                            if($validar_codigo_curso==null){
                                                $principal['data__fila_'.$indiceFila]['codigo']= $valor_trim;
                                                $principal['data__fila_'.$indiceFila]['id_curso']= null;
                                            }else{
                                                $principal['data__fila_'.$indiceFila]['codigo']= $valor_trim;
                                                $principal['data__fila_'.$indiceFila]['id_curso']= $validar_codigo_curso;
                                            }
                                        }
                                        $estado_id= 2;
                                    }



                                      

                                }else{

                                    if($esta_vacio){

                                    }else{

                                        switch ($indiceColumna) {
                                            case 2:
                                                $valor_trim = trim($valor_trim);
                                                $str_valor_trim =  mb_strtoupper($valor_trim, 'UTF-8'); 

                                                echo "<pre>";
                                                print_r(".str_valor_trim eletct....".$str_valor_trim."......");
                                                echo "</pre>";



                                                $principal['data__fila_'.$indiceFila]['nombre_curso'] = $str_valor_trim; 
        
                                                if ($str_valor_trim == 'ELECTIVO 1') {
                                                    $validar_codigo_curso_electivo=print_lista_like($valor_trim,'nom_curso','curso','id_curso');
                                                    if($validar_codigo_curso_electivo==null){
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= null;
                                                    }else{
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= $validar_codigo_curso_electivo;
                                                        $estado_id= 10;
    
                                                    }
                                                } elseif ($str_valor_trim =='ELECTIVO 2') {
                                                     $validar_codigo_curso_electivo=print_lista_like($valor_trim,'nom_curso','curso','id_curso');
                                                    if($validar_codigo_curso_electivo==null){
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= null;
                                                    }else{
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= $validar_codigo_curso_electivo;
                                                        $estado_id= 10;
                                                    }
                                                } elseif ($str_valor_trim =='ELECTIVO 3') {
                                                     $validar_codigo_curso_electivo=print_lista_like($valor_trim,'nom_curso','curso','id_curso');
                                                    if($validar_codigo_curso_electivo==null){
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= null;
                                                    }else{
                                                        $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                        $principal['data__fila_'.$indiceFila]['id_curso']= $validar_codigo_curso_electivo;
                                                        $estado_id= 10;
                                                    }
                                                }elseif ($str_valor_trim =='ELECTIVO') {
                                                    $validar_codigo_curso_electivo=print_lista_like_none($valor_trim,'nom_curso','curso','id_curso');
                                                   if($validar_codigo_curso_electivo==null){
                                                       $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                       $principal['data__fila_'.$indiceFila]['id_curso']= null;
                                                   }else{
                                                       $principal['data__fila_'.$indiceFila]['codigo']= '-';
                                                       $principal['data__fila_'.$indiceFila]['id_curso']= $validar_codigo_curso_electivo;
                                                       $estado_id= 10;
                                                   }
                                               }
    
                                            break;
                                            case 3:
                                                $horas_teoricas_presencial= $valor_trim;
                                            break;
                                            case 4:
                                                $horas_sincronas_teoricas= $valor_trim;
                                            break;
                                            case 5:
                                                $horas_asincronas_teoricas= $valor_trim;
                                            break;
                                            case 6:
                                                $horas_practicas_presencial= $valor_trim;
                                            break;
                                            case 7:
                                                $horas_sincronas_practicas = $valor_trim;
                                            break;
                                            case 8:
                                                $horas_asincronas_practicas= $valor_trim;
                                            break;
    
                                            case 13:
                                                    
                                                    $ids_cursos = explode(",", $valor_trim );

                                        
                                                    $cursos_nom = array();
    
                                                    foreach ($ids_cursos as $key => $valor_fila) {
                                                        $valor_fila = trim($valor_fila);

                                                        $valor_fila_m= mb_strtoupper($valor_fila, 'UTF-8'); 
                                                        
    
                                                        if($valor_fila_m==='NINGUNO' || $valor_fila_m==='Ninguno'){
                                                            array_push($cursos_nom, 0);
                                                        }elseif(strlen($valor_fila_m)<2){

                                                        }else {
                                                            $id_curso=print_lista_like($valor_fila_m,'nom_curso','curso','id_curso');
                                                       
                                                            if($id_curso!==null){
                                                                array_push($cursos_nom,  $id_curso);
                                                            }
                                                        }
                                                    }

                                                    
                                                    if(empty($cursos_nom)) {
                                                        $principal['data__fila_'.$indiceFila]['requisitos']= '' ;
                                                    } else {
                                                        $cursos_nombres_text   = implode(",", $cursos_nom);
                                                        $principal['data__fila_'.$indiceFila]['requisitos']= $cursos_nombres_text ;
                                                    }
    
                                            break;
                                            case 14:
    
                                                    $valor_trim =mb_strtoupper($valor_trim, 'UTF-8'); 

                                                    $id_tipo_curso=print_lista_like($valor_trim,'nom_tipo_curso','tipo_curso','id_tipo_curso');
                                                    $principal['data__fila_'.$indiceFila]['tipo_curso']= $id_tipo_curso;
    
                                                    if($id_tipo_curso==1){
                                                        $principal['data__fila_'.$indiceFila]['carrera_id']= '';
                                                    }else{
                                                        $principal['data__fila_'.$indiceFila]['carrera_id']= $carrera_id;
                                                    }
    
                                            break;
                                            case 15:
                                                    $valor_trim =mb_strtoupper($valor_trim, 'UTF-8'); 

                                                    $id_curso_forma_estudio=print_lista_like($valor_trim,'nom_curso_forma_estudio','curso_forma_estudio','id_curso_forma_estudio');
    
                                                    $principal['data__fila_'.$indiceFila]['presencialidad']= $id_curso_forma_estudio;
                                            break;
                                            case 16:

                                                    $valor_trim =mb_strtoupper($valor_trim, 'UTF-8'); 

                                                    $id_curso_importancia=print_lista_like($valor_trim,'nom_curso_importancia','curso_importancia','id_curso_importancia');
                                                    $principal['data__fila_'.$indiceFila]['obligatoriedad']= $id_curso_importancia;
    
                                                 
                                                        $horas_totales= $horas_teoricas_presencial+$horas_sincronas_teoricas+$horas_asincronas_teoricas+$horas_practicas_presencial+ $horas_sincronas_practicas+$horas_asincronas_practicas;
                                                        $creditos_presencial =  (($horas_practicas_presencial)/32) + (($horas_teoricas_presencial)/16);
                                                        $creditos_virtual= (( $horas_sincronas_teoricas +  $horas_asincronas_teoricas)/16) + (( $horas_sincronas_practicas+ $horas_asincronas_practicas)/32);
    
                                                        $creditos=  $creditos_presencial +  $creditos_virtual;
                                                        $horas_teoricas=$horas_sincronas_teoricas+$horas_asincronas_teoricas +$horas_teoricas_presencial;
                                                        $horas_practicas=$horas_sincronas_practicas+ $horas_asincronas_practicas + $horas_practicas_presencial;
                                                    if($principal['data__fila_'.$indiceFila]['id_curso']== null ){   
                                                        $parametros_cursos = array(
                                                            'INSERTAR_CURSOS',
                                                            '',
                                                            $principal['data__fila_'.$indiceFila]['nombre_curso'],
                                                            '',
                                                            $principal['data__fila_'.$indiceFila]['carrera_id'],
                                                            '',
                                                            $principal['data__fila_'.$indiceFila]['codigo'],
                                                            $creditos,
                                                            $horas_teoricas,
                                                            $horas_totales,
                                                            $horas_practicas,
                                                            $principal['data__fila_'.$indiceFila]['requisitos'],
                                                            $principal['data__fila_'.$indiceFila]['tipo_curso'],
                                                            $principal['data__fila_'.$indiceFila]['presencialidad'],
                                                            $principal['data__fila_'.$indiceFila]['obligatoriedad'],
                                                            2,
                                                            $user_reg,
                                                            $horas_sincronas_practicas,
                                                            $horas_asincronas_practicas,
                                                            $horas_practicas_presencial,
                                                            $horas_sincronas_teoricas,
                                                            $horas_asincronas_teoricas ,
                                                            $horas_teoricas_presencial,
                                                            $creditos_presencial,
                                                            $creditos_virtual
    
                                                        );
    
    
                                                        echo "<pre>";
                                                        print_r($parametros_cursos);
                                                        echo "</pre>";
    
    
                                                            $respuesta= $this->Model_Cursos->procedureCrudCursos($parametros_cursos);
                                                       
                                                            $principal['data__fila_'.$indiceFila]['id_curso'] =$respuesta[0]['ultimo_id'];
                                                    }
    
                                                    $parametros_ciclo = array(
                                                        'INSERTAR_CICLOS',
                                                        '',
                                                        $nombre,
                                                        '',
                                                        $principal['data__fila_'.$indiceFila]['carrera_id'],
                                                        $id_plan_estudios,
                                                        $principal['data__fila_'.$indiceFila]['codigo'],
                                                        $principal['data__fila_'.$indiceFila]['id_curso'],
                                                        $creditos,
                                                        $horas_teoricas,
                                                        $horas_totales,
                                                        $horas_practicas,
                                                        $principal['data__fila_'.$indiceFila]['requisitos'],
                                                        $principal['data__fila_'.$indiceFila]['tipo_curso'],
                                                        $principal['data__fila_'.$indiceFila]['presencialidad'],
                                                        $principal['data__fila_'.$indiceFila]['obligatoriedad'],
                                                        $estado_id,
                                                        $user_reg,
    
                                                        $horas_sincronas_practicas,
                                                        $horas_asincronas_practicas,
                                                        $horas_practicas_presencial,
    
                                                        $horas_sincronas_teoricas ,
                                                        $horas_asincronas_teoricas ,
                                                        $horas_teoricas_presencial,
    
                                                        $creditos_presencial,
                                                        $creditos_virtual,
    
                                                        $num_ciclo,
                                                        $ciclo_electivo
                                                    );
    
                                                                            // echo '<pre>';
                                                                            // print_r( $parametros_ciclo );
                                                                            // echo '</pre>';
    
                                                                            // $respuesta_ciclo=
                                                    $this->Model_Ciclo->procedureCrudCiclos($parametros_ciclo);
                                                                            // $id_ciclo = $respuesta_ciclo[0]['ultimo_id'];
    
                                            break;
    
                                        }
                                    }

                            
                                }

                            }

                        }
                    }
            }

    }
}