<?php

    if (!function_exists('cbx_basicos')) 
    {
        function cbx_basicos($abrev = '', $valor = 0, $bool = false, $funcion = 'listar', $function = null,$id_db='null',$nomb_db='null',$clase_css ='form-control',$placeholder='SELECCIONE',$readonly_option=false,$id_selected=false)
        {
            $CI = get_instance();
            $CI->load->model('Contenedor_model','contenedor');
    
            switch ($funcion) {
                case 'nivel_usuario_general':

                    $objeto    = $CI->contenedor->get_list_nivelusuario();
                    break;
                case 'estados_general':
                    $objeto    = $CI->contenedor->get_list_status();
                    break;

                case 'lista_departamentos':
                    $objeto    = $CI->contenedor->get_list_departamento();
                    break;
                case 'tipo_estudios':
                    $objeto    = $CI->contenedor->get_list_tipo_estudios( $valor);
                    break;                   

                case 'lista_tipo_documento':
                    $objeto    = $CI->contenedor->get_list_tipo_documento();
                    break;
                case 'lista_facultades':
                    $objeto    = $CI->contenedor->get_list_facultades();
                    break;
                case 'listado_estado_syllabus':
                    $objeto    = $CI->contenedor->get_list_estado_syllabus();
                    break;
                case 'lista_departamentos_universitarios':
                    $objeto    = $CI->contenedor->get_list_departamento_universitario();
                    break;
                case 'lista_carreras':
                    $objeto    = $CI->contenedor->get_lista_carreras($valor,$id_selected);
                    break;
                case 'lista_directores':
                    $objeto    = $CI->contenedor->get_lista_directores($valor);
                    break;
                case 'lista_docentes':
                    $objeto    = $CI->contenedor->get_lista_docentes();
                    break;
                case 'lista_anios_periodo':
                    $objeto    = $CI->contenedor->get_lista_anios_periodo($valor);
                    break;    
                case 'lista_plan_estudios':
                    $objeto    = $CI->contenedor->get_lista_plan_estudios($valor,$id_selected);
                    break;                 
                case 'lista_cursos':
                    $objeto    = $CI->contenedor->get_lista_cursos($valor,'lista');
                    break;     
                    
                case 'lista_tipo_curso':
                    $objeto    = $CI->contenedor->get_lista_tipo_curso($valor,$id_selected);
                    break;    
                    
                case 'lista_importancia_curso':
                    $objeto    = $CI->contenedor->get_lista_curso_importancia($valor,$id_selected);
                    break;  

                case 'lista_forma_estudio_curso':
                    $objeto    = $CI->contenedor->get_lista_curso_forma_estudio($valor,$id_selected);
                    break;      
                    
                case 'lista_plan_estudios_aginado_usu':
                    $objeto    = $CI->contenedor->get_lista_plan_estudios_aginado_usu($valor,$id_selected);
                    break;   

              
            }

            $disabled = ($bool) ? ' disabled="disabled"' : "";
            $readonly_ = ($readonly_option) ? 'readonly="readonly"' : "";
            // $readonly_ = ($readonly_option) ? 'disabled="disabled"' : "";


            $selected = ($valor == 0) ? " selected" : "";
            echo '<select '.$readonly_.' class="'.$clase_css.'" id="cbx_basicos_' . $abrev . '" name="cbx_basicos_' . $abrev . '" ' . $disabled . ' ' .  (($function == null) ? "" : "onchange=".  $function ."(this)"  ) .' >';
            echo '<option value="0"  ' . $selected . '>'.$placeholder.'</option>';

            // print($objeto);
            foreach ($objeto as $key => $value) {
            $selected = ($valor == $value[$id_db]) ? " selected" : "";
            echo '<option value="' . $value[$id_db] . '" '. $selected .'>' . $value[$nomb_db] . '</option>';

            }
            echo '</select>';
        }
    }







    if (!function_exists('cbx_basicos_extra_element')) 
    {
        function cbx_basicos_extra_element($abrev = '', $valor = 0, $bool = false, $funcion = 'listar', $function = null,$id_db='null',$nomb_db='null',$clase_css ='form-control',$placeholder='SELECCIONE',$readonly_option=false,$id_selected=false,$id_extra='null')
        {
            $CI = get_instance();
            $CI->load->model('Contenedor_model','contenedor');
    
            switch ($funcion) { 

                case 'lista_plan_estudios_aginado_usu':
                    $objeto    = $CI->contenedor->get_lista_plan_estudios_aginado_usu($valor,$id_selected);
                    break;   

                case 'lista_recursos_aula':
                    $objeto    = $CI->contenedor->get_recursos_aula($valor,$id_selected);
                    break;
                case 'lista_plan_estudios':
                    $objeto    = $CI->contenedor->get_lista_plan_estudios_asignado($valor,$id_selected);
                    break;     

            }

            $disabled = ($bool) ? ' disabled="disabled"' : "";
            $readonly_ = ($readonly_option) ? 'readonly="readonly"' : "";
            // $readonly_ = ($readonly_option) ? 'disabled="disabled"' : "";


            $selected = ($valor == 0) ? " selected" : "";
            echo '<select '.$readonly_.' class="'.$clase_css.'" id="cbx_basicos_' . $abrev . '" name="cbx_basicos_' . $abrev . '" ' . $disabled . ' ' .  (($function == null) ? "" : "onchange=".  $function ."(this)"  ) .' >';
            echo '<option value="0"  ' . $selected . '>'.$placeholder.'</option>';

            // print($objeto);
            foreach ($objeto as $key => $value) {
            // $selected = ($valor == $value[$id_db]) ? " selected" : "";
            echo '<option data-id-extra="'.$value[$id_extra].'" value="' . $value[$id_db] . '" >' . $value[$nomb_db] . '</option>';

            }
            echo '</select>';
        }
    }












    if (!function_exists('cbx_basicos_multiple')) 
    {
        function cbx_basicos_multiple($abrev = '', $valor = 0, $bool = false, $funcion = 'listar', $function = null,$id_db='null',$nomb_db='null',$clase_css ='form-control',$placeholder='SELECCIONE')
        {
            $CI = get_instance();
            $CI->load->model('Contenedor_model','contenedor');
    
            switch ($funcion) {
            
                case 'lista_docentes':
                    $objeto    = $CI->contenedor->get_lista_docentes();
                    break;

                case 'lista_carrera_filtro':
                    $objeto    = $CI->contenedor->get_carrera_filtro($valor);
                    break;     
                case 'lista_cursos':
                    $objeto    = $CI->contenedor->get_lista_cursos_combo(0,false);
                    break;     
            }

            // echo '<pre>';
            // print_r($objeto);
            // echo '</pre>';



            $disabled = ($bool) ? ' disabled="disabled"' : "";
            $selected = "";
            echo '<select  multiple="multiple" class="js-example-basic-multiple '.$clase_css.' " id="cbx_multiple_' . $abrev . '" name="cbx_multiple_' . $abrev . '[]" ' . $disabled . ' ' .  (($function == null) ? "" : "onchange=".  $function ."(this)"  ) .' >';

        if($valor ==0){
                foreach ($objeto as $key => $value) {
                    //$selected = ($valor == $value[$id_db]) ? " selected" : "";
                    echo '<option value="' . $value[$id_db] . '" '. $selected .'>' . $value[$nomb_db] . '</option>';
                }
        }else{

            $data_ids =explode(",",$valor);
                foreach ($objeto as $key => $value) {
                    $selected = (in_array($value[$id_db], $data_ids, false)  ) ? " selected" : "";
                    echo '<option value="' . $value[$id_db] . '" '. $selected .'>' . $value[$nomb_db] . '</option>';
                }
        }

            echo '</select>';
        }
    }

    function generar_html($ruta)
    {
        ob_start();
        include($ruta);
        return  ob_get_clean();
    }


    if (!function_exists('modal_xl_largo_full')) 
    {
        function modal_xl_largo_full($abrev, $ocultar = false,$ruta,$funcion,$formulario,$modal_nombre='modal_data',$bool=true)
        {
            $display = ($ocultar) ? ' style="display:none' : '';
            $modal = '<div id="modal_xl_largo_' . $abrev . '" class="modal fade " role="dialog" aria-labelledby="titulo_modal_xl"  data-backdrop="static" data-keyboard="false" aria-hidden="true" ' . $display . ' >';
            $modal .= '<div class="modal-dialog  modal-dialog-scrollable modal-full-width">';
            $modal .= '<div class="modal-content">';


                $modal .= '<div class="modal-header">';
                $modal .= '<h5 class="modal-title h4" id="titulo_modal_xl_full">Large modal</h5>';
                $modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $modal .= '<span aria-hidden="true">×</span>';
                $modal .= '</button>';
                $modal .= '</div>';


                $modal .= '<div class="modal-body">';
                $modal .= '<form id="' . $formulario . '"  method="POST" enctype="multipart/form-data">';
                $modal .= '<input name="id_'.$abrev.'" type="hidden" id="id_'.$abrev.'"  value="">';

                $modal .=  generar_html($ruta.'/'.$modal_nombre.'.php');

                $modal .= '</form>';
                $modal .= '</div>';

                $modal.= '<div class="modal-footer">';
                
                if($bool ==true){
                    $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                    $modal.= '<button type="button" class="btn btn-primary" onclick="'.$funcion.'();">Guardar</button>';
                }else{
                    $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                }

           
                $modal.= ' </div>';


            $modal .= '</div>';
            $modal .= '</div>';
            $modal .= '</div>';
            echo $modal;
        }
    }

    if (!function_exists('modal_xl_largo')) 
    {
        function modal_xl_largo($abrev, $ocultar = false,$ruta,$funcion,$formulario,$modal_nombre='modal_data',$bool=true)
        {
            $display = ($ocultar) ? ' style="display:none' : '';
            $modal = '<div id="modal_xl_largo_' . $abrev . '" class="modal fade " role="dialog"  data-backdrop="static" data-keyboard="false" aria-labelledby="titulo_modal_xl" aria-hidden="true" ' . $display . ' >';
            $modal .= '<div class="modal-dialog modal-dialog-scrollable modal-xl">';
            $modal .= '<div class="modal-content">';


                $modal .= '<div class="modal-header">';
                $modal .= '<h5 class="modal-title h4" id="titulo_modal_xl">Large modal</h5>';
                $modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $modal .= '<span aria-hidden="true">×</span>';
                $modal .= '</button>';
                $modal .= '</div>';


                $modal .= '<div class="modal-body">';
                $modal .= '<form id="' . $formulario . '"  method="POST" enctype="multipart/form-data">';
                $modal .= '<input name="id_'.$abrev.'" type="hidden" id="id_'.$abrev.'"  value="">';

                $modal .=  generar_html($ruta.'/'.$modal_nombre.'.php');

                $modal .= '</form>';
                $modal .= '</div>';

                $modal.= '<div class="modal-footer">';
                
                if($bool ==true){
                    $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                    $modal.= '<button type="button" class="btn btn-primary" onclick="'.$funcion.'();">Guardar</button>';
                }else{
                    $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                }

           
                $modal.= ' </div>';


            $modal .= '</div>';
            $modal .= '</div>';
            $modal .= '</div>';
            echo $modal;
        }
    }


    if (!function_exists('modal_largo')) 
    {
        function modal_largo($abrev, $ocultar = false,$ruta,$funcion,$formulario,$modal_nombre='modal_data')
        {
            $display = ($ocultar) ? ' style="display:none' : '';
            $modal = '<div id="modal_largo_' . $abrev . '" class="modal fade " role="dialog"  data-backdrop="static" data-keyboard="false" aria-labelledby="titulo_modal_lg" aria-hidden="true" ' . $display . ' >';
            $modal .= '<div class="modal-dialog modal-dialog-scrollable modal-lg">';
            $modal .= '<div class="modal-content">';


                $modal .= '<div class="modal-header">';
                $modal .= '<h5 class="modal-title h4" id="titulo_modal_lg">Extra large modal</h5>';
                $modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $modal .= '<span aria-hidden="true">×</span>';
                $modal .= '</button>';
                $modal .= '</div>';


                $modal .= '<div class="modal-body">';
                $modal .= '<form id="' . $formulario . '"  method="POST" enctype="multipart/form-data">';
                $modal .= '<input name="id_'.$abrev.'" type="hidden" id="id_'.$abrev.'"  value="">';

                $modal .=  generar_html($ruta.'/'.$modal_nombre.'.php');


                $modal .= '</form>';
                $modal .= '</div>';

                $modal.= '<div class="modal-footer">';
                $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                $modal.= '<button type="button" id="boton_guardar_manage" class="btn btn-primary" onclick="'.$funcion.'();">Guardar</button>';
                $modal.= ' </div>';


            $modal .= '</div>';
            $modal .= '</div>';
            $modal .= '</div>';
            echo $modal;
        }
    }


    


    if (!function_exists('modal_peque')) 
    {
        function modal_peque($abrev, $ocultar = false,$ruta,$funcion,$formulario,$modal_nombre='modal_data')
        {
            $display = ($ocultar) ? ' style="display:none' : '';
            $modal = '<div id="modal_peque_' . $abrev . '" class="modal fade"  data-backdrop="static" data-keyboard="false"  role="dialog" aria-labelledby="titulo_modal_peque" aria-hidden="true" ' . $display . ' >';
            $modal .= '<div class="modal-dialog  modal-sm">';
            $modal .= '<div class="modal-content">';


                $modal .= '<div class="modal-header">';
                $modal .= '<h5 class="modal-title h4" id="titulo_modal_peque">Small modal</h5>';
                $modal .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                $modal .= '<span aria-hidden="true">×</span>';
                $modal .= '</button>';
                $modal .= '</div>';


                $modal .= '<div class="modal-body">';
                $modal .= '<form id="' . $formulario . '"  method="POST" enctype="multipart/form-data">';
                $modal .= '<input name="id_'.$abrev.'" type="hidden" id="id_'.$abrev.'"  value="">';

                $modal .=  generar_html($ruta.'/'.$modal_nombre.'.php');

                $modal .= '</form>';

                $modal .= '</div>';

                $modal.= '<div class="modal-footer">';
                $modal.= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>';
                $modal.= '<button type="button" class="btn btn-primary" onclick="'.$funcion.'();">Guardar</button>';
                $modal.= ' </div>';


            $modal .= '</div>';
            $modal .= '</div>';
            $modal .= '</div>';
            echo $modal;
        }
    }


    function Encrypt($string) {
        $cryptKey  = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $string, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function Decrypt($string){
        $cryptKey  = ":jC!a-rfc9GFEg^7(*6NDGhrH?V!+gzYb|tS+-&}M!onG9=#],p3= kMu|5+tFmy";
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $string ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

    function Encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'hitenVkuld%:bTXz,3r>6|FW#!7eSs>vM~n+48~{Mh$#A4p).)#wV3^_y-B.6WCar=b4.';
        $secret_iv = '3w8XD|r@n:nxp|oml]nw$-KEc|rT$H).(~ &`gnV!vD0vs|?r]#Zdr-qRlOV@&#6';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    function actualizar_imagen_logeo($data_mostrar_id) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $user    = $CI->contenedor->find_data_logeo($data_mostrar_id);

        if (isset($user) && $user[0]['foto'] != ''){
            return base_url() . "uploads/user/" . $user->avatar;
        }else{
            return base_url() . "public/web/assets/img/user/user.jpg";
        }
    }

    function actualizar_data_logeo($user_id,$campo) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $user    = $CI->contenedor->find_data_logeo($user_id);

        return $user[0][$campo];
    }

    function datos_sillabus($id_version_sy,$campo) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $user    = $CI->contenedor->datos_sillabus($id_version_sy);

        if (empty($user)) {
            return '';
        } else {
            return $user[0][$campo];
        }


    }

    function Obtener_dia_semana_actual($day)
    {
        $days = ['Monday' => 1, 'Tuesday' => 2, 'Wednesday' => 3, 'Thursday' => 4, 'Friday' => 5, 'Saturday' => 6, 'Sunday' => 7];

        $today = new \DateTime();
        $today->setISODate((int)$today->format('o'), (int)$today->format('W'), $days[ucfirst($day)]);
        return $today;
    }

    function print_lista($ids_docentes,$nom,$tlb,$id) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_mostrar    = $CI->contenedor->get_lista_print($ids_docentes,$nom,$tlb,$id);

        $cant_data_mostrar = count($data_mostrar) -1;
        if ( $data_mostrar == null){
            return '';
        }else{
        
            $datos ="";
                foreach ($data_mostrar as $key => $value) {
                    if($cant_data_mostrar == $key ){
                        $datos .=$value["nom_docente"];
                    }else{
                        $datos .=$value["nom_docente"]." ,";
                    }
                }
            
            
            return $datos;
        }
    }

    function print_lista_like($texto,$campo,$tlb,$id) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_mostrar    = $CI->contenedor->get_lista_like_print($texto,$campo,$tlb,$id);
      
        $datos=null;
        foreach ($data_mostrar as $key => $value) {
                $datos =$value[$id];
        }
            
            
        return $datos;
        
    }



    
    function print_lista_like_none($texto,$campo,$tlb,$id) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_mostrar    = $CI->contenedor->get_lista_like_print_none($texto,$campo,$tlb,$id);
        echo "<pre> data_mostrar>";
        print_r($data_mostrar);
        echo "</pre>";

        $datos=null;
        foreach ($data_mostrar as $key => $value) {
                $datos =$value[$id];
        }
            
            
        return $datos;
        
    }
    
    function print_lista_like_count($texto,$campo,$tlb,$id) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_mostrar    = count($CI->contenedor->get_lista_like_print($texto,$campo,$tlb,$id));

            
        return $data_mostrar;
        
    }
    
    function obtenerDatosIndexNuevo($th){
        $datos = array();
        $datos['modulo']            = $th->modulo;
        //$datos['widop']             = $th->widop;
        $datos['tituloPrincipal']   = $th->tituloPrincipal;
        $datos['tituloSecundario1'] = isset($th->tituloSecundario1) ? $th->tituloSecundario1 : '';
        $datos['tituloSecundario2'] = isset($th->tituloSecundario2) ? $th->tituloSecundario2 : '';
        $datos['tituloSecundario3'] = isset($th->tituloSecundario3) ? $th->tituloSecundario3 : '';
        $datos['tituloSecundario4'] = isset($th->tituloSecundario4) ? $th->tituloSecundario4 : '';
        $datos['tituloSecundario5'] = isset($th->tituloSecundario5) ? $th->tituloSecundario5 : '';
        $datos['formPrincipal']     = isset($th->formPrincipal) ? $th->formPrincipal : '';
        $datos['formSecundario1']   = isset($th->formSecundario1) ? $th->formSecundario1 : '';
        $datos['formSecundario2']   = isset($th->formSecundario2) ? $th->formSecundario2 : '';
        $datos['opcion']            = $th->opcion;
        $datos['url']               = $th->url;
        $datos['urlGeneral']        = $th->url . $th->opcion . '/';
       // $datos['th']              = $th;
        $datos['abrev']             = $th->abrev;
        return $datos;
    }

    function Agrupar_array_por_keyvalue($array,$groupkey)
    {
        if (count($array)>0)
        {
            $keys = array_keys($array[0]);
            $removekey = array_search($groupkey, $keys);
            		
                    if ($removekey===false)
                        return array("Clave \"$groupkey\" no existe");
                    else
                        unset($keys[$removekey]);

            $groupcriteria = array();
            $return=array();
            foreach($array as $value)
            {
                $item=null;
                foreach ($keys as $key)
                {
                    $item[$key] = $value[$key];
                }
                $busca = array_search($value[$groupkey], $groupcriteria);
                if ($busca === false)
                {
                    $groupcriteria[]=$value[$groupkey];
                    $return[]=array($groupkey=>$value[$groupkey],'groupeddata'=>array());
                    $busca=count($return)-1;
                }
                $return[$busca]['groupeddata'][]=$item;
            }
            return $return;
        }
        else{
            return array();

        }
    }

    function formato_resta($df) {

        $str = '';
        $str .= ($df->invert == 1) ? ' - ' : '';
        if ($df->y > 0) {
            // years
            $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
        } if ($df->m > 0) {
            // month
            $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
        } if ($df->d > 0) {
            // days
            $str .= ($df->d > 1) ? $df->d . ' Dias ' : $df->d . ' Día ';
        } if ($df->h > 0) {
            // hours
            $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
        } if ($df->i > 0) {
            // minutes
            $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
        } if ($df->s > 0) {
            // seconds
            $str .= ($df->s > 1) ? $df->s . ' Segundos ' : $df->s . ' Segundo ';
        }

        return $str;
    }

    function contar_filas_tabla($nombre_tabla,$campo_id,$ids ) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_total    = $CI->contenedor->get_total_tabla($nombre_tabla,$campo_id,$ids);

        return $data_total[0]['total'];
    }

    function contar_filas_tabla_usu($nombre_tabla,$campo_id,$ids,$reg_usu,$campo_usu ) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_total    = $CI->contenedor->get_total_tabla_usu($nombre_tabla,$campo_id,$ids,$reg_usu,$campo_usu);

        return $data_total[0]['total'];
    }

    //-----------------------------------------------------------------

    function contar_filas_tabla_sy_asig($campo_id,$ids ) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_total    = $CI->contenedor->get_total_tabla_sy_asig($campo_id,$ids);

        return $data_total[0]['total'];
    }

    function contar_filas_tabla_usu_sy_asig($campo_id,$ids,$reg_usu,$campo_usu ) {
        $CI = & get_instance();
        $CI->load->model('Contenedor_model','contenedor');
        $data_total    = $CI->contenedor->get_total_tabla_usu_sy_asig($campo_id,$ids,$reg_usu,$campo_usu);

        return $data_total[0]['total'];
    }

    