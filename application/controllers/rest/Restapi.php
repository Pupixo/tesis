<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Restserver\Libraries\Rest_Controller;

require APPPATH . '/libraries/Rest_Controller.php';
require APPPATH . '/libraries/Format.php';

class Restapi extends Rest_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('n_model');
    }  

    public function index_get() {
        $this->response(array("id" => "Hola Mundo"));
    }

    public function provincia_post() {
        $id_departamento= $this->input->post("id_departamento");
        $this->response($this->Contenedor_Model->get_list_provincia($id_departamento));

    }

    public function distrito_post() {
            $id_departamento= $this->input->post("id_departamento");
            $id_provincia= $this->input->post("id_provincia");
       
            $this->response($this->Contenedor_Model->get_list_distrito($id_departamento,$id_provincia));
    }

    public function reservas_cabeceras_post() {
        $id_reserva= $this->input->post("id_reserva");
        $this->response($this->Contenedor_Model->get_list_reservas_cabeceras($id_reserva));

    }

    public function org_aprendizaje_validar_semana_post() {
        $id_version_sy= $this->input->post("id_version_sy");
        $semanas_aprendizaje_ini= $this->input->post("semana_ini");
        $semanas_aprendizaje_fin= $this->input->post("semana_fin");

        

        $this->response($this->Contenedor_Model->get_list_org_aprendizaje_validar_semana($id_version_sy,$semanas_aprendizaje_ini,$semanas_aprendizaje_fin));

    }


    public function org_aprendizaje_validar_numero_orden_post() {
        $id_version_sy= $this->input->post("id_version_sy");

        $modulo_num_orden= $this->input->post("modulo_num_orden");

        $data = $this->Contenedor_Model->get_list_org_aprendizaje_validar_numero_orden($id_version_sy,$modulo_num_orden) ;
        
        $cantidad_fila = count($data);
        
        $this->response($cantidad_fila);
    }

    public function tabla_org_aprendizaje_for_range_post() {
        $id_version_sy= $this->input->post("id_version_sy");

        $this->response($this->Contenedor_Model->get_tabla_org_aprendizaje_for_range($id_version_sy));

    }

    public function tabla_org_aprendizaje_for_act__main_post() {
        $id_version_sy= $this->input->post("id_version_sy");

        $this->response($this->Contenedor_Model->get_tabla_org_aprendizaje_for_act_main($id_version_sy));

    }

    public function tabla_org_aprendizaje_for_act__main_creados_post() {
        $id_version_sy= $this->input->post("id_version_sy");

        $this->response($this->Contenedor_Model->get_tabla_org_aprendizaje_for_act_creados_main($id_version_sy));

    }
    
    public function listar_cursos_post() {
      
        // BUSCAR POR TERMINOS
        $searchTerm = $this->input->post('searchTerm');
        $carreras_ids= $this->input->post("carreras_ids");
        //$carreras_ids='';

        //Get CURSOS
       $DATA= $this->Contenedor_Model->getCurso_select2($searchTerm,$carreras_ids);
        
        $this->response($DATA);

    }

    public function listar_cursos_tipo_prese_obli_post() {
      
        // BUSCAR POR TERMINOS
        $id_ciclo= $this->input->post("id_ciclo");
        
        $carreras_ids= $this->input->post("carreras_ids");

        // Get CURSOS
        $CURSOS= $this->Contenedor_Model->get_lista_cursos($id_ciclo,$carreras_ids);

        $TIPO_CURSO= $this->Contenedor_Model->get_lista_tipo_curso($id_ciclo,false);

        $CURSO_FORMA_ESTUDIO= $this->Contenedor_Model->get_lista_curso_forma_estudio($id_ciclo,false);

        $CURSO_IMPORTANCIA= $this->Contenedor_Model->get_lista_curso_importancia($id_ciclo,false);

        $CURSO_REQUISITOS= $this->Contenedor_Model->get_lista_cursos_combo(0,false);

        // 'CURSOS' => ,

        $DATA = array(
            'CURSOS' => $CURSOS  ,
            'TIPO_CURSO' => $TIPO_CURSO,
            'CURSO_FORMA_ESTUDIO' =>  $CURSO_FORMA_ESTUDIO ,
            'CURSO_IMPORTANCIA' => $CURSO_IMPORTANCIA,
            'CURSO_REQUISITOS' => $CURSO_REQUISITOS,


        );
        
        $this->response($DATA);

    }

    public function listar_cursos_by_id_post() {
      
        // BUSCAR POR TERMINOS
        $id_curso = $this->input->post('id_curso');
        //$carreras_ids=''

        //Get CURSOS
       $DATA= $this->Contenedor_Model->get_lista_cursos($id_curso,'');
        
        $this->response($DATA);

    }

    public function lista_carreras_by_plan_estudios_post() {
      
        // BUSCAR POR TERMINOS
        $id_plan_estudios = $this->input->post('id_plan_estudios');
        $id_asignacion_plan_estudios = $this->input->post('id_asignacion_plan_estudios');

        //Get CURSOS
       $respuesta= $this->Contenedor_Model->get_lista_carreras_by_plan_estudios($id_plan_estudios);

       $id_carreras = $respuesta[0]['id_carrera'];

       $array_d = explode(",", $id_carreras);

            //    echo ' <pre>';
            //    print_r($array_d);
            //    echo ' <echo>';
            //    exit;

       $data_final=[];

       foreach ($array_d  as $key => $value) {
        # code...



                if($value==0){

                    $data_final[]= [
                        "id" => 0,
                        "nombre" => 'GENERAL'
                    ];
                                     
      
                }else{

          

                    $data_iterar= $this->Contenedor_Model->get_lista_carreras($value,false);

         

                    $data_final[]= [
                        "id" => $data_iterar[1]['id_carrera'],
                        "nombre" => $data_iterar[1 ]['nom_carrera'],
                    ];
                }
        
       }

       
        //  $respuesta2= $this->Contenedor_Model->get_lista_ciclos_num_by_plan_estudios($id_plan_estudios,$id_asignacion_plan_estudios);
        $respuesta2= $this->Contenedor_Model->get_lista_ciclos_num_by_plan_estudios_asign_usu($id_asignacion_plan_estudios);


        $respuesta3= $this->Contenedor_Model->get_lista_plan_estudios($id_plan_estudios,false);
        $respuesta4= $this->Contenedor_Model->get_list_tipo_estudios($respuesta3[0]['tipo_estudios']);

  

       $lista = array(
        $data_final,
        $respuesta2,
        $respuesta4[0]['id_tipo_estudios']
       );

        $this->response($lista);

    }


    public function lista_carreras_by_plan_estudios_asign_usu_post() {
      
        // BUSCAR POR TERMINOS
        $id_plan_estudios = $this->input->post('id_plan_estudios');
        $id_asignacion_plan_estudios = $this->input->post('id_asignacion_plan_estudios');

        //Get CURSOS
       $respuesta= $this->Contenedor_Model->get_lista_carreras_by_plan_estudios($id_plan_estudios);

       $id_carreras = $respuesta[0]['id_carrera'];

       $array_d = explode(",", $id_carreras);

            //    echo ' <pre>';
            //    print_r($array_d);
            //    echo ' <echo>';
            //    exit;

       $data_final=[];

       foreach ($array_d  as $key => $value) {
        # code...

                if($value==0){

                    $data_final[]= [
                        "id" => 0,
                        "nombre" => 'GENERAL'
                    ];
                                     
                }else{

                    $data_iterar= $this->Contenedor_Model->get_lista_carreras($value,false);

                    $data_final[]= [
                        "id" => $data_iterar[1]['id_carrera'],
                        "nombre" => $data_iterar[1 ]['nom_carrera'],
                    ];
                }
        
       }

        $respuesta2= $this->Contenedor_Model->get_lista_ciclos_num_by_plan_estudios_asign_usu($id_asignacion_plan_estudios);

        $respuesta3= $this->Contenedor_Model->get_lista_plan_estudios($id_plan_estudios,false);
        $respuesta4= $this->Contenedor_Model->get_list_tipo_estudios($respuesta3[0]['tipo_estudios']);

  

       $lista = array(
        $data_final,
        $respuesta2,
        $respuesta4[0]['id_tipo_estudios']
       );

        $this->response($lista);

    }
    
    public function lista_ciclos_by_plan_estudios_asignar_post() {
      
        $id_plan_estudios = $this->input->post('id_plan_estudios');
        $id_asignacion_plan_estudios = $this->input->post('id_asignacion_plan_estudios');




        $respuesta2= $this->Contenedor_Model->get_lista_ciclos_num_by_plan_estudios($id_plan_estudios,$id_asignacion_plan_estudios);

        $lista = array(
        $respuesta2,
        );

        $this->response($lista);

    }

    public function lista_cursos_by_ciclo_by_asignar_cursos_post() {
      
        // BUSCAR POR TERMINOS
        $num_ciclo = $this->input->post('num_ciclo');
        $id_plan_estudios = $this->input->post('id_plan_estudios');
        
        $id_asignacion_plan_estudios = $this->input->post('id_asignacion_plan_estudios');

       $respuesta3= $this->Contenedor_Model->get_lista_cursos_by_ciclo_by_plan_estudios_asignar($id_plan_estudios,$num_ciclo, $id_asignacion_plan_estudios);
                   
        $this->response($respuesta3);

    }
    
    public function lista_directores_by_carrera_post() {
      
        // BUSCAR POR TERMINOS
        $id_carrera = $this->input->post('id_carrera');
        //$carreras_ids=''

        //Get CURSOS
       $respuesta= $this->Contenedor_Model->get_lista_directores_by_carreras($id_carrera);
            
        $this->response($respuesta);

    }
    
    public function lista_ciclo_by_carrera_post() {
      
        // BUSCAR POR TERMINOS
        $id_ciclo = $this->input->post('id_ciclo');
        $id_plan_estudios = $this->input->post('id_plan_estudios');

        //Get CURSOS
        $respuesta3= $this->Contenedor_Model->get_lista_ciclo_by_plan_estudio($id_plan_estudios,$id_ciclo);

        $ids_cursos = explode(",",$respuesta3[0]['requisitos'] );
        $requisitos = array();

        foreach($ids_cursos as $key => $valor) {
            $cursos =$this->Contenedor_Model->get_curso_excel_id($valor);


            if(!empty( $cursos )){
                $fila_data = array(
                    'nom_curso' => $cursos[0]['nom_curso'] ,
                    'id_curso' => $cursos[0]['id_curso'],
                   );
            }else{
                $fila_data = array(
                    'nom_curso' =>'NINGUNO' ,
                    'id_curso' => '0',
                   );
            }

            array_push($requisitos, $fila_data);

        }

        $DATA = array(
            'REQUISITOS' => $requisitos ,
            'DATAMAIN' => $respuesta3,
        );


        $this->response($DATA);

    }


    public function lista_cursos_by_ciclo_by_carrera_asing_usu_post() {
      
        // BUSCAR POR TERMINOS
        $num_ciclo = $this->input->post('num_ciclo');
        $id_plan_estudios = $this->input->post('id_plan_estudios');
        $id_asignacion_plan_estudios = $this->input->post('id_asignacion_plan_estudios');

      
       $respuesta3= $this->Contenedor_Model->get_lista_cursos_by_ciclo_by_plan_estudios_asing_usu($id_plan_estudios,$num_ciclo, $id_asignacion_plan_estudios);
                   
        $this->response($respuesta3);

    }



    public function lista_cursos_by_ciclo_by_carrera_post() {
      
        // BUSCAR POR TERMINOS
        $num_ciclo = $this->input->post('num_ciclo');
        $id_plan_estudios = $this->input->post('id_plan_estudios');

      
       $respuesta3= $this->Contenedor_Model->get_lista_cursos_by_ciclo_by_plan_estudios($id_plan_estudios,$num_ciclo);
                   
        $this->response($respuesta3);

    }

    public function lista_compet_asocia_ficha_eval_post() {
      
        // BUSCAR POR TERMINOS
        $id_ciclo = $this->input->post('id_ciclo');

        //Get CURSOS
       $respuesta3= $this->Contenedor_Model->get_competencias_asocia_ficha_eval($id_ciclo);
                   
        $this->response($respuesta3);

    }

    public function lista_get_diccionario_post() {
      
        // BUSCAR POR TERMINOS
        $combo = $this->input->post('combo');


            $data= array();

            if(isset($combo)){
                foreach($combo as $key => $valor) {
                    
                    $porciones = explode("-", $valor);
                    
                    $fila= $this->Contenedor_Model->get_diccionario_ids($porciones[0],$porciones[1]);
    
                    $fila_data = array(
                        'nom_compet' => $fila[0]['nom_compet'] ,
                        'nivel_text' =>  $fila[0]['nivel_text'] ,
                    );
    
                    array_push($data, $fila_data);
    
                }
            }else{

            }

          

        //Get CURSOS
                   
        $this->response($data);

    }
    
    public function eliminar_fila_criterio_post() {
      
        // BUSCAR POR TERMINOS
        $id_criterio_eval = $this->input->post('id_criti');

        //    echo ' <pre>';
        //    print_r($id_criterio_eval);
        //    echo ' <echo>';
        //    exit;

        //Get CURSOS
         $this->Contenedor_Model->eliminar_criterio($id_criterio_eval);
                   
         $this->response('1');

    }

    public function listar_criterios_eval_post() {
      
        // BUSCAR POR TERMINOS
        $id_ficha_eval = $this->input->post('id_ficha_eval');
        //Get CURSOS
        $respuesta3= $this->Contenedor_Model->listar_criterio($id_ficha_eval);
        $this->response($respuesta3);

    }
    

    public function update_comentarios_ficha_eval_post() {
      
        // BUSCAR POR TERMINOS
        $coment_eval = $this->input->post('coment_eval');
        $id_ficha_eval = $this->input->post('id_ficha_eval');
         $this->Contenedor_Model->update_comentarios_ficha_eval($coment_eval,$id_ficha_eval);          
         $this->response('1');

    }

    public function data_inicio_by_anio_post() {

        $anio = $this->input->post('anio');
        $id_usuario_sesion = $this->input->post('id_usuario_sesion');
        $id_nivel_main = $this->input->post('id_nivel_main');

        $planestudio_total= $this->Contenedor_Model->planestudio_total_anio($anio,'1,2,3');
        $planestudio_est_acti= $this->Contenedor_Model->planestudio_total_anio($anio,'3');
        $planestudio_est_rev= $this->Contenedor_Model->planestudio_total_anio($anio,'2');
        $planestudio_est_anul= $this->Contenedor_Model->planestudio_total_anio($anio,'1');

        $syllabus_total= $this->Contenedor_Model->get_total_tabla_sy_asig_anio($anio,'1,2,3', $id_usuario_sesion,$id_nivel_main );
        $syllabus_est_aprob= $this->Contenedor_Model->get_total_tabla_sy_asig_anio($anio,'2', $id_usuario_sesion,$id_nivel_main );
        $syllabus_est_rev= $this->Contenedor_Model->get_total_tabla_sy_asig_anio($anio,'1', $id_usuario_sesion,$id_nivel_main );
        $syllabus_est_noaprob= $this->Contenedor_Model->get_total_tabla_sy_asig_anio($anio,'3', $id_usuario_sesion,$id_nivel_main );

        $DATA = array(
            'planestudio_total' => $planestudio_total[0]['total'],
            'planestudio_est_acti' => $planestudio_est_acti[0]['total'] ,
            'planestudio_est_rev' =>  $planestudio_est_rev[0]['total'] ,
            'planestudio_est_anul' => $planestudio_est_anul[0]['total'] ,

            'syllabus_total' => $syllabus_total[0]['total'],
            'syllabus_est_aprob' => $syllabus_est_aprob[0]['total'],
            'syllabus_est_rev' => $syllabus_est_rev[0]['total'],
            'syllabus_est_noaprob' => $syllabus_est_noaprob[0]['total'] 
        );
        
        $this->response($DATA);

    }
        
}
