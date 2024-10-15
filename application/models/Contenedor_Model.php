<?php
class Contenedor_Model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Lima");
    }
    //---------- CONSULTAS DE LOGEO-------------------------------------


    function procedureUpdateOrInsertTables($parametros) {
        $this->db->free_db_resource();
        $sql = "call sp_UpdateOrInsertTables(?,?,?,?,?,?,?,?,?,?,? , ?,?,?,?,?);";
        $query = $this->db->query($sql, $parametros);
       // $array = $query->result_array();
        if ($query) {
            $data = $query->result_array();
            $query->free_result();
            $query->next_result();
        }
        return $data;
       //return $array;
    }



    function get_list_nivelusuario($id_nivel=null){
        if(isset($id_nivel) && $id_nivel > 0){
            $sql = "select * from nivel where estado=2 and id_nivel =".$id_nivel;
        }
        else
        {
            $sql = "select * from nivel where estado=2";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_status(){
        $sql = "select * from estado";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
        
    function get_camb_clave($id_user){
        if(isset($id_user) && $id_user > 0){
            $sql = "select u.*, n.nom_nivel 
            from users u left join nivel n on n.id_nivel=u.id_nivel
            where id_usuario=".$id_user;
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
   
    function update_foto_profile($dato){
        $id_usuario= $_SESSION['usuario'][0]['id_usuario'];

        $sql = "
                    update users 
                    set 
                    foto='".$dato['foto']."'
                    where id_usuario =".$id_usuario;

        $this->db->query($sql);
    }

    function update_clave($dato){
        $id_usuario= $_SESSION['usuario'][0]['id_usuario'];

        $sql = "update users set usuario_password='".$dato['user_password_hash']."', fec_act=NOW(), 
                user_act='$id_usuario' 
                where id_usuario =".$dato['id_usuario']."";
        $this->db->query($sql);
    }

    function find_data_logeo($id_usuario){
        if(isset($id_usuario) && $id_usuario > 0){
            //$sql = "select * from users where id_usuario =".$id_usuario;

            $sql = "SELECT 	
                    u.id_usuario, 
                    u.usuario_nombres,
                    u.usuario_apater, 
                    u.usuario_amater, 
                    u.usuario_codigo, 
                    u.id_nivel,
                    u.num_celp,
                    u.usuario_email, 
                    u.usuario_password,
                    u.estado, 
                    n.nom_nivel, 
                    dis.nombre_distrito, 
                    dep.nombre_departamento,
                    pro.nombre_provincia,
                    u.foto,
                    td.nom_tipo_documento,
                    pl.nom_plan_estudios ,
                    ca.nom_carrera
                    
                    FROM users u

                    left join nivel n on n.id_nivel=u.id_nivel
                    left join departamento dep on dep.id_departamento=u.id_departamento
                    left join provincia pro on pro.id_provincia=u.id_provincia
                    left join distrito dis on dis.id_distrito=u.id_distrito
                    left join tipo_documento td on td.id_tipo_documento=u.id_tipo_documento
                    left join plan_estudios pl on pl.id_plan_estudios=u.id_plan_estudios
                    left join  carrera ca on ca.id_carrera = pl.id_carrera
                    WHERE u.estado in (2) and u.id_usuario  = " . $id_usuario . "";
        }
        $query = $this->db->query($sql)->result_Array();
        
        return $query;
    }

    function datos_sillabus($id_version_sy){
        if(isset($id_version_sy) && $id_version_sy > 0){

            $sql = "
            
            SELECT 
                s.*,
                st.nom_est_syllabus,
                c.nom_carrera,
                d.nom_director,
                pe.nom_plan_estudios,
                tc.nom_tipo_curso,
                cfs.nom_curso_forma_estudio,
                ci.nom_curso_importancia,
                s.nom_ciclo,
                cur.nom_curso,
                te.nom_tipo_estudios,
                te.id_tipo_estudios,        
                vs.numero_version,
                vs.nom_version_sy,
                vs.fech_aprob,
                vs.usu_aprob,
                vs.fech_estado,
                vs.usu_estado,
                vs.fec_reg as 'fecha_reg_version'
            FROM 
            syllabus_det s

				INNER JOIN versiones_syllabus vs on s.id_version_sy = vs.id_version_sy

				INNER JOIN syllabus so on so.id_syllabus = vs.id_syllabus
                INNER JOIN asignacion_cursos ac on so.id_asignacion_curso= ac.id_asignacion_cursos
                INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios

                INNER JOIN estado_syllabus st on s.estado = st.id_est_syllabus

                LEFT JOIN plan_estudios pe on s.id_plan_estudios=pe.id_plan_estudios
                LEFT JOIN carrera c on  s.id_carrera  = c.id_carrera 
                LEFT JOIN director d on  s.id_director   = d.id_director  
                LEFT JOIN tipo_curso tc on s.tipo_ciclo = tc.id_tipo_curso
                LEFT JOIN curso_forma_estudio cfs on s.presencialidad = cfs.id_curso_forma_estudio
                LEFT JOIN curso_importancia ci on s.id_condicion = ci.id_curso_importancia
                LEFT JOIN curso cur on s.id_curso = cur.id_curso
                LEFT JOIN tipo_estudios te on s.id_tipo_estudios = te.id_tipo_estudios
            WHERE s.estado in (2,1,3) and s.id_version_sy  = " . $id_version_sy . 
            " and ape.estado =2 and ac.estado=2;";

        }
        $query = $this->db->query($sql)->result_Array();
        
        return $query;
    }

    /*** GENERALES CONSULTAS */

   
    function get_list_tipo_documento(){
      
            $sql = "select * from tipo_documento  where  estado=2";

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_facultades(){
    
            $sql = "select * from facultad where  estado=2" ;
        
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_estado_syllabus(){
    
            $sql = "select * from estado_syllabus";
    
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_departamento_universitario(){
        if(isset($id_depart_uni) && $id_depart_uni > 0){
            $sql = "select * from departamento_universitario where id_depart_uni ='".$id_depart_uni."'  and estado=2 order by nom_depart_uni";
        }
        else
        {
            $sql = "select * from departamento_universitario   where  estado=2";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_carreras($id_carrera=0,$id_selected){
        if(isset($id_carrera) && $id_carrera > 0){

            if($id_selected==true){
                $sql = "select * from carrera where estado=2  order by nom_carrera";
            }else{
                $sql = "
                select 0 AS id_carrera, 'GENERAL' AS nom_carrera 
                UNION 
                select id_carrera,nom_carrera 
                from carrera where id_carrera ='".$id_carrera."' and estado=2 order by id_carrera 
                ";
            }
        }
        else
        {
            $sql = "select * from carrera where estado=2";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_directores($id_director=0){
        if(isset($id_director) && $id_director > 0){
            $sql = "select * from director where id_director ='".$id_director."'  and estado=2 order by nom_director";
        }
        else
        {
            $sql = "select * from director  where  estado=2";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
    
    function get_lista_docentes(){
 
            $sql = "select id_usuario, CONCAT( usuario_nombres, ' ', usuario_apater , ' ' , usuario_amater )  as nom_usu_docente  from users where id_nivel= 3 and estado=2 order by usuario_nombres";
        
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_docentes_id($id_usuario){

        $sql = "select id_usuario, CONCAT( usuario_nombres, ' ', usuario_apater , ' ' , usuario_amater )  as nom_usu_docente  from users where id_nivel= 3 and estado=2 and id_usuario ='".$id_usuario."' order by usuario_nombres";

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_anios_periodo($anio_act){

        $anio = 2040;
     

        if(isset($anio_act) && $anio_act > 0){
            $lista_datos = array();

            for(  $i= $anio; $i >= 1998; $i--){
                    $array_ = array(
                        "periodo_anio" => $i,
                        "nom_periodo_anio" => $i,
                    );
                    array_push($lista_datos, $array_);
            }
        }
        else
        {
            $lista_datos = array();

            for( $i=$anio; $i >=1998; $i--){
                    $array_ = array(
                        "periodo_anio" => $i,
                        "nom_periodo_anio" => $i,
                    );
                    array_push($lista_datos, $array_);
            } 
        }



        //return $lista_datos;

        return $lista_datos;

    }

    function get_lista_plan_estudios($id_plan_estudios=0,$id_selected){
        if(isset($id_plan_estudios) && $id_plan_estudios > 0){
            if($id_selected==true){
                $sql = "select * from plan_estudios  where  estado=3";
            }else{
                $sql = "select * from plan_estudios where id_plan_estudios ='".$id_plan_estudios."'  and estado=3 order by nom_plan_estudios DESC";
            }
        }
        else
        {
            $sql = "select * from plan_estudios  where  estado=3";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    
    function get_lista_plan_estudios_asignado($id_plan_estudios=0,$id_selected){
        if(isset($id_plan_estudios) && $id_plan_estudios > 0){
            if($id_selected==true){
                $sql = "
                
                select ape.*,pe.nom_plan_estudios from asignacion_plan_estudios ape 
                INNER JOIN plan_estudios pe on ape.id_plan_estudios=pe.id_plan_estudios 
                where ape.estado=2 order by ape.fec_reg DESC; 
                              
                ";
            }else{
                $sql = "
                
                select ape.*,pe.nom_plan_estudios from asignacion_plan_estudios ape 
                INNER JOIN plan_estudios pe on ape.id_plan_estudios=pe.id_plan_estudios 
                where id_plan_estudios ='".$id_plan_estudios."' and 
                ape.estado=2 order by ape.fec_reg DESC; 
                
                "
                ;
            }
        }
        else
        {
            $sql = "
                select ape.*,pe.nom_plan_estudios from asignacion_plan_estudios ape 
                INNER JOIN plan_estudios pe on ape.id_plan_estudios=pe.id_plan_estudios 
                where ape.estado=2 order by ape.fec_reg DESC; 
            ";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_lista_cursos($id_curso,$carreras_ids)
    {
        if(isset($id_curso) && $id_curso  > 0){
                $sql = "select * from curso where id_curso  ='".$id_curso ."'  and estado in (2,10) order by nom_curso ASC";
        }else{
            if($carreras_ids==''){
                $sql = "select * from curso  where  estado=100000";
            }
            
            // else if($carreras_ids=='lista'){
            //     $sql = "select * from curso where  estado=2 order by nom_curso ASC";            
            // }
            
            else{
                $sql = "select * from curso where  estado in (2,10) order by nom_curso ASC";
                // $sql = "select * from curso where  estado=2 and id_carrera in (".$carreras_ids.",0) order by nom_curso ASC";

            }
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_cursos_combo($ids,$data)
    {

        if($data == false){

            $sql = "
            SELECT
                0 AS `id_curso` ,
                'NINGUNO' AS `nom_curso` 
            UNION
                SELECT 
                `id_curso`,
                `nom_curso` 
                FROM CURSO WHERE ESTADO in (2,10,9) ORDER BY id_curso ASC
        ";            
 

        }else{

            $sql = "
            SELECT
                0 AS `id_curso` ,
                'NINGUNO' AS `nom_curso` 
            UNION
                SELECT 
                `id_curso`,
                `nom_curso` 
                FROM CURSO 
                WHERE ESTADO in (2,10,9) 
                AND id_curso IN (".$ids.")
                
                ORDER BY id_curso ASC
        ";            
 

        }

     
        
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    
    function get_carrera_filtro($id_carrera)
    {
        if(isset($id_carrera) && $id_carrera > 0){
            $sql = "           
                   
                    SELECT * FROM `carrera` WHERE id_carrera ='".$id_carrera."' and estado in (2)  order by nom_carrera ASC

          ";
        } else if(isset($id_carrera) && $id_carrera==0){

            $sql = "
                    SELECT
                    0 AS `id_carrera`,
                    'CURSOS GENERALES' AS `nom_carrera` ,
                    0 AS `id_facultad` ,
                    0 AS `id_director` ,
                    2 AS `estado` ,
                    '' AS `fec_reg`,
                    0 AS `user_reg` ,
                    '' AS `fec_act` ,
                    0 AS `user_act` ,
                    '' AS `fec_eli` ,
                    0 AS `user_eli` 
                    UNION
                    SELECT * FROM `carrera` WHERE estado=2 
            ";

        }else{
            $sql = "
            
                SELECT
                0 AS `id_carrera`,
                'GENERALES' AS `nom_carrera` ,
                0 AS `id_facultad` ,
                0 AS `id_director` ,
                2 AS `estado` ,
                '' AS `fec_reg`,
                0 AS `user_reg` ,
                '' AS `fec_act` ,
                0 AS `user_act` ,
                '' AS `fec_eli` ,
                0 AS `user_eli` 
            
            ";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
      
    function get_carrera_filtro_excel($id_carrera)
    {
        if(isset($id_carrera) && $id_carrera > 0){
            $sql = "           
                   
                    SELECT * FROM `carrera` WHERE id_carrera ='".$id_carrera."' and estado=2 order by nom_carrera ASC

          ";
        } else if(isset($id_carrera) && $id_carrera==0){

            $sql = "
                    SELECT
                    0 AS `id_carrera`,
                    'CURSOS GENERALES' AS `nom_carrera` ,
                    0 AS `id_facultad` ,
                    0 AS `id_director` ,
                    2 AS `estado` ,
                    '' AS `fec_reg`,
                    0 AS `user_reg` ,
                    '' AS `fec_act` ,
                    0 AS `user_act` ,
                    '' AS `fec_eli` ,
                    0 AS `user_eli` 
       
            ";

        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    //------------ COSULTAS ESPECIFICAS--------------


    function get_lista_print($ids_docentes,$campo,$tabla,$id_tabla)
    {
        if($ids_docentes !=""){

            $ids =explode(",",$ids_docentes);
            $cant_ids=count($ids);
            $ultimo_id = $cant_ids-1 ;
            $sql = "select $campo from ".$tabla." where ".$id_tabla." in (";
            for ($i = 0; $i < $cant_ids; $i++) {
                if($ultimo_id ==$i){
                    $sql .=$ids[$i];

                }else{
                    $sql .=$ids[$i].",";

                }
            }
           
            $sql .=")   and estado=2 order by ".$campo;

            $query = $this->db->query($sql)->result_Array();
            return $query;
        }
        else
        {
            return null;
        }
       
    }

    function get_lista_curso_forma_estudio($id_curso_forma_estudio=0,$id_selected)
    {
        if(isset($id_curso_forma_estudio ) && $id_curso_forma_estudio  > 0){      
        
            if($id_selected==true){
                $sql = "select * from curso_forma_estudio order by nom_curso_forma_estudio ASC";
            }else{
                $sql = "select * from curso_forma_estudio where id_curso_forma_estudio  ='".$id_curso_forma_estudio ."' order by nom_curso_forma_estudio ASC";
            }
        }
        else
        {
            $sql = "select * from curso_forma_estudio order by nom_curso_forma_estudio ASC";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_plan_estudios_aginado_usu($id_usuario=0,$id_selected)
    {
        
        $sql = "
        select ape.*,pe.nom_plan_estudios from asignacion_plan_estudios ape 
        INNER JOIN plan_estudios pe on ape.id_plan_estudios=pe.id_plan_estudios 
        where ape.id_usuario ='".$id_usuario ."'and ape.estado=2 order by ape.fec_reg DESC; 
        ";
          
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_tipo_curso($id_tipo_curso=0,$id_selected)
    {
        if(isset($id_tipo_curso) && $id_tipo_curso  > 0){
            if($id_selected==true){
                $sql = "select * from tipo_curso order by nom_tipo_curso ASC";
            }else{
                $sql = "select * from tipo_curso where id_tipo_curso  ='".$id_tipo_curso ."' order by nom_tipo_curso ASC";
            }
        }else{
            $sql = "select * from tipo_curso order by nom_tipo_curso ASC";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_lista_curso_importancia($id_curso_importancia=0,$id_selected)
    {
        if(isset($id_curso_importancia) && $id_curso_importancia  > 0){
        
            
            if($id_selected==true){
                $sql = "select * from curso_importancia order by nom_curso_importancia ASC";
            }else{
                $sql = "select * from curso_importancia where id_curso_importancia  ='".$id_curso_importancia ."' order by nom_curso_importancia ASC";
            }
        
        }
        else
        {
            $sql = "select * from curso_importancia order by nom_curso_importancia ASC";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    /*  ---------------------- */

    function get_list_tipo_estudios($id_tipo_estudios)
    {
        if(isset($id_tipo_estudios) && $id_tipo_estudios > 0){
            $sql = "select * from tipo_estudios where id_tipo_estudios ='".$id_tipo_estudios."' order by nom_tipo_estudios";
        }
        else
        {
            $sql = "select * from tipo_estudios";
        }

   
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    
    function get_list_departamento()
    {
        if(isset($id_departamento) && $id_departamento > 0){
            $sql = "select * from departamento where id_departamento ='".$id_departamento."' order by nombre_departamento";
        }
        else
        {
            $sql = "select * from departamento";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_list_provincia($id_departamento=null)
    { 

        if(isset($id_departamento) && $id_departamento > 0){
            $sql = "select * from provincia where id_departamento ='".$id_departamento."' and estado=1 order by nombre_provincia";
        }
        else
        {
            $sql = "select * from provincia";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_distrito($id_departamento=null, $id_provincia=null)
    {
        if(isset($id_departamento) && $id_provincia!=0 && isset($id_provincia) && $id_provincia!=0){
            $sql = "select * from distrito where id_departamento ='".$id_departamento."' and
            id_provincia ='".$id_provincia."' and estado=1 order by nombre_distrito";
        }
        else
        {
            $sql = "select * from distrito";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_list_org_aprendizaje_validar_semana($id_version_sy,$semanas_aprendizaje_ini,$semanas_aprendizaje_fin)
    {        
            $sql = "
            
            select semanas_aprendizaje_ini,semanas_aprendizaje_fin 
            FROM org_aprendizaje 
            WHERE 
            (estado =2 and id_version_sy  = ".$id_version_sy." and  semanas_aprendizaje_ini  = ".$semanas_aprendizaje_ini." or estado =2 and id_version_sy  = ".$id_version_sy." and  semanas_aprendizaje_fin  = ".$semanas_aprendizaje_fin.") or
            (estado =2 and id_version_sy  = ".$id_version_sy." and  semanas_aprendizaje_ini = ".$semanas_aprendizaje_fin." or  estado =2 and id_version_sy  = ".$id_version_sy." and semanas_aprendizaje_fin = ".$semanas_aprendizaje_ini.")
            
            ";
    

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_list_org_aprendizaje_validar_numero_orden($id_version_sy,$modulo_num_orden)
    {        
            $sql = "
            
            select modulo_num_orden 
            FROM org_aprendizaje 
            WHERE 
            estado =2 and id_version_sy  = ".$id_version_sy." and modulo_num_orden=".$modulo_num_orden."     
            ";
    

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    

    function get_tabla_org_aprendizaje_for_range($id_version_sy=null)
    { 

            $sql = "select semanas_aprendizaje_ini,semanas_aprendizaje_fin
            from org_aprendizaje
            where estado =2 and id_version_sy=".$id_version_sy;
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    function get_tabla_org_aprendizaje_for_act_main($id_version_sy=null)
    { 

            $sql = "select *
            from org_aprendizaje 
            where estado =2 and id_modulo = 0 and id_version_sy=".$id_version_sy." ORDER BY
            modulo_num_orden ASC";
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }


    
    function get_tabla_org_aprendizaje_for_act_creados_main($id_version_sy=null)
    { 

            $sql = "select 
            
            org_a.id_org_aprendizaje,org_a.id_version_sy, org_a.id_modulo,org_a.estado, org_a.modulo_aprendizaje,
            m.num_modulo,
            sem_m.id_semana_modulo ,sem_m.num_semana ,
            ses_m.id_sesion_modulo ,ses_m.num_sesion , ses_m.desc_tema,
            ses_m.descr_iteracc_docente , ses_m.descr_trabajo_autor 

            from org_aprendizaje org_a

            INNER JOIN modulo m ON org_a.id_modulo  = m.id_modulo 
            INNER JOIN semana_modulo sem_m ON m.id_modulo  = sem_m.id_modulo 
            INNER JOIN sesion_modulo ses_m ON sem_m.id_semana_modulo  = ses_m.id_semana_modulo 


            where org_a.estado =2 and org_a.id_modulo <> 0 and org_a.id_version_sy=".$id_version_sy." ORDER BY

            modulo_num_orden ASC";
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    /***SELECT2 CONSULTAS */
    function getCurso_select2($searchTerm="",$carreras_ids)
    {

            if($carreras_ids==''){

                $this->db->select('*');
                $this->db->where('estado', 100000);

                $fetched_records = $this->db->get('curso');
                $cursos = $fetched_records->result_array();

            }else{
                    
                    if(isset($searchTerm)){

                        $sql = "
                            select * from curso 
                            where 
                            nom_curso  like '%".$searchTerm."%' 
                            and  estado in (10,2)
                            and id_carrera in (".$carreras_ids."); 
                        ";

                    }else{
                        $sql = "
                            select * from curso 
                            where 
                            estado in (10,2)
                            and id_carrera in (".$carreras_ids."); 
                        ";

                    }
    
                    $cursos = $this->db->query($sql)->result_Array();


            }

        $data = array();
        foreach($cursos as $row){
        $data[] = array("id"=>$row['id_curso'], "text"=>$row['nom_curso']);
        }
        return $data;
    }

    function get_lista_carreras_by_plan_estudios($id_plan_estudio=null)
    { 

            $sql = "

            select id_carrera from plan_estudios
            where id_plan_estudios in (".$id_plan_estudio.")
            AND estado=3" ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }


    
    function get_lista_directores_by_carreras($id_carrera=null)
    { 

            $sql = "

            SELECT c.id_director,d.nom_director FROM carrera c
            INNER JOIN director d on c.id_director=d.id_director
            where c.id_carrera in (".$id_carrera.")
            AND c.estado=2

            
            " ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    function get_lista_cursos_by_plan_estudios($id_plan_estudios=null)
    { 

            $sql = "

           
            SELECT DISTINCT c.id_curso,cur.nom_curso FROM ciclo c
            INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios
            INNER JOIN curso cur on c.id_curso= cur.id_curso
            where p.id_plan_estudios in (".$id_plan_estudios.")
            AND c.estado=2
            
            
            " ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    
    function get_lista_cursos_by_ciclo_by_plan_estudios_asing_usu($id_plan_estudios=null,$num_ciclo, $id_asignacion_plan_estudios)
    { 

            $sql = "

            SELECT ac.id_ciclo,ac.id_curso,cur.nom_curso FROM `asignacion_cursos` ac 
            INNER JOIN curso cur on ac.id_curso= cur.id_curso
            where ac.nom_ciclo ='".$num_ciclo."' AND ac.estado=2 AND ac.id_asignacion_plan_estudios=".$id_asignacion_plan_estudios."; 
            
            " ;            
            $query = $this->db->query($sql)->result_Array();
            return $query;
    }




    function get_lista_cursos_by_ciclo_by_plan_estudios($id_plan_estudios=null,$num_ciclo)
    { 

            $sql = "

           
            SELECT c.id_ciclo,c.id_curso,cur.nom_curso 
            FROM ciclo c
            INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios
            INNER JOIN curso cur on c.id_curso= cur.id_curso
            where
             c.id_plan_estudios in (".$id_plan_estudios.")
            AND c.estado=2 
            AND cur.estado=2
            AND nom_ciclo = '".$num_ciclo."'
            
            
            " ;            
            $query = $this->db->query($sql)->result_Array();
            return $query;
    }

    
    function get_lista_cursos_by_ciclo_by_plan_estudios_asignar($id_plan_estudios=null,$num_ciclo, $id_asignacion_plan_estudios)
    { 

            $sql = "

           
            SELECT c.id_ciclo,c.id_curso,cur.nom_curso 
            FROM ciclo c
            INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios
            INNER JOIN curso cur on c.id_curso= cur.id_curso
            where
             c.id_plan_estudios in (".$id_plan_estudios.")
            AND c.estado=2 
            AND cur.estado=2
            AND c.nom_ciclo = '".$num_ciclo."'
            AND
            c.id_ciclo not in
            ((select ac.id_ciclo from asignacion_cursos ac where ac.id_asignacion_plan_estudios=".$id_asignacion_plan_estudios." and ac.estado=2 )) 
            
            
            " ;            
            $query = $this->db->query($sql)->result_Array();
            return $query;
    }


    function get_lista_ciclos_num_by_plan_estudios($id_plan_estudios=null,$id_asignacion_plan_estudios){ 
        $sql = "          

                SELECT c.nom_ciclo,cur.nom_curso,
                c.id_curso,c.id_ciclo,p.id_plan_estudios 
                FROM ciclo c 
                INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios 
                INNER JOIN curso cur on c.id_curso= cur.id_curso 
                where p.id_plan_estudios in (".$id_plan_estudios.") 
                AND c.estado=2 AND
                c.id_ciclo not in ((select ac.id_ciclo from asignacion_cursos ac where ac.id_asignacion_plan_estudios=".$id_asignacion_plan_estudios." and ac.estado=2 ))
                order by ciclo_electivo,ciclo_num ASC; 
        
                " ;
            
            $query = $this->db->query($sql)->result_Array();
            return $query;
    }


    function get_lista_ciclos_num_by_plan_estudios_asign_usu($id_asignacion_plan_estudios=null)
    { 

            $sql = "

                SELECT DISTINCT ac.id_asignacion_plan_estudios,ac.nom_ciclo FROM `asignacion_cursos` ac
                where ac.id_asignacion_plan_estudios='".$id_asignacion_plan_estudios."' AND ac.estado=2; 
            
            " ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    function get_lista_ciclo_by_plan_estudio($id_plan_estudios=null,$id_ciclo=null)
    { 

            $sql = "


                SELECT 
                c.*,
                ci.nom_curso_importancia,ci.id_curso_importancia,
                tc.nom_tipo_curso,tc.id_tipo_curso,
                cfe.nom_curso_forma_estudio,cfe.id_curso_forma_estudio
                FROM ciclo c
                INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios
                INNER JOIN curso cur on c.id_curso= cur.id_curso
                INNER JOIN curso_importancia ci on c.obligatoriedad= ci.id_curso_importancia
                INNER JOIN tipo_curso tc on c.tipo_curso =tc.id_tipo_curso
                INNER JOIN curso_forma_estudio cfe on c.presencialidad=cfe.id_curso_forma_estudio 

                where c.id_plan_estudios in (".$id_plan_estudios.")
                AND c.id_ciclo in (".$id_ciclo.") AND c.estado=2
                AND cur.estado=2 
                LIMIT 1
            
            " ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    function get_curso_excel_id($id_curso )
    {
        if(isset($id_curso) && $id_curso  > 0){
            $sql = "           
                   
                    SELECT id_curso ,nom_curso 
                    FROM `curso` 
                    WHERE 
                    id_curso  ='".$id_curso ."' and 
                    estado IN (2,10,9)
                    order by nom_curso ASC

                ";
        }else if(isset($id_curso) && $id_curso ==0){

            $sql = "
                    SELECT
                    0 AS `id_curso`,
                    'NINGUNO' AS `nom_curso` 
            ";
        }

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function get_competencias_asocia_ficha_eval($id_ciclo )
    {
        if(isset($id_ciclo) && $id_ciclo  > 0){
            $sql = " 

                    SELECT 
                    cd.compet_gene_uno,cd.compet_gene_dos,
                    cd.compet_espec_uno,cd.compet_espec_dos,cd.compet_espec_tres,

                    compet_gene_nivel_uno,	
                    compet_gene_nivel_dos,
                    compet_espec_nivel_uno,
                    compet_espec_nivel_dos,
                    compet_espec_nivel_tres,

                    d1.nom_compet as 'competencia_general_1',
                    d2.nom_compet as 'competencia_general_2',

                    d3.nom_compet as 'competencia_espec_1',
                    d4.nom_compet as 'competencia_espec_2',
                    d5.nom_compet as 'competencia_espec_3'

                    FROM `compet_detalle` cd
                    LEFT JOIN diccionario_compet d1 on d1.id_diccionario_competen=cd.compet_gene_uno
                    LEFT JOIN diccionario_compet d2 on d2.id_diccionario_competen=cd.compet_gene_dos
                    LEFT JOIN diccionario_compet d3 on d3.id_diccionario_competen=cd.compet_espec_uno
                    LEFT JOIN diccionario_compet d4 on d4.id_diccionario_competen=cd.compet_espec_dos
                    LEFT JOIN diccionario_compet d5 on d5.id_diccionario_competen=cd.compet_espec_tres
                    where id_ciclo='".$id_ciclo ."' 


                    LIMIT 1;

                ";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
       
    function get_diccionario_ids($id,$nivel )
    {
        if(isset($id) && $id  > 0){

            if($nivel==1){
              $nivel=  'nivel_uno';
            }else if($nivel==2){
                $nivel=  'nivel_dos';
            }else{
                $nivel=  'nivel_tres';
            }

            $sql = " 

                    SELECT 
                    
                    id_diccionario_competen,
                    nom_compet,
                    ".$nivel." as nivel_text

                    FROM  diccionario_compet
                    where id_diccionario_competen in (".$id .") 
                    
                    LIMIT 1;

                ";
                $query = $this->db->query($sql)->result_Array();
                return $query;

        }
    }



    function eliminar_criterio($id_criterio_eval){
        $id_usuario= $_SESSION['usuario'][0]['id_usuario'];

        $sql = "update criterios_eval set 
                    estado='4', 
                    fec_eli=NOW(), 
                    user_eli='$id_usuario' 
                where 
                id_criterio_eval =".$id_criterio_eval."
                ";


        $this->db->query($sql);
    }
    
    

    function listar_criterio($id_ficha_eval ){

        $sql = "
                        select ce.*,d.nom_compet from criterios_eval ce
                        LEFT JOIN diccionario_compet d on ce.id_compet=d.id_diccionario_competen
                        where   
                        ce.id_ficha_eval =".$id_ficha_eval." and ce.estado in (1,2,3)  
                        ORDER BY ce.id_ficha_eval ASC
                " ;
                $query = $this->db->query($sql)->result_Array();
                return $query;
    }    
    
    function update_comentarios_ficha_eval($coment_eval,$id_ficha_eval){
        $id_usuario= $_SESSION['usuario'][0]['id_usuario'];

        $sql = "update ficha_eval set 
                    coment_eval='".$coment_eval."', 
                    fech_comen=NOW(), 
                    usu_coment='$id_usuario' 
                where 
                id_ficha_eval =".$id_ficha_eval."
                ";
                $this->db->query($sql);

    }

    function get_total_tabla($nombre_tabla,$campo_id,$ids ){

        if($ids==='todos'){
            $sql = "select count(*) as total from ".$nombre_tabla." where ".$campo_id." in (1,2,3)";

        }else{
            $sql = "select count(*) as total from ".$nombre_tabla." where ".$campo_id." in ($ids)";

        }

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_total_tabla_sy_asig($campo_id,$ids ){

        if($ids==='todos'){
            $sql = "
                        select count(*) as total from syllabus  s
                        INNER JOIN asignacion_cursos ac on s.id_asignacion_curso= ac.id_asignacion_cursos
                        INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios
                        INNER JOIN plan_estudios pe on ape.id_plan_estudios = pe.id_plan_estudios

                        where s.".$campo_id." in (1,2,3) and ape.estado =2 and ac.estado=2 and pe.estado=3;
                    ";

        }else{
            $sql =  "
                        select count(*) as total from syllabus  s
                        INNER JOIN asignacion_cursos ac on s.id_asignacion_curso= ac.id_asignacion_cursos
                        INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios
                        INNER JOIN plan_estudios pe on ape.id_plan_estudios = pe.id_plan_estudios

                        where s.".$campo_id." in ($ids) and ape.estado =2 and ac.estado=2 and pe.estado=3;    
                    ";
        }

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    
    function get_total_tabla_usu($nombre_tabla,$campo_id,$ids,$reg_usu,$campo_usu ){

        if($ids==='todos'){
            $sql = "select count(*) as total from ".$nombre_tabla." 
            where ".$campo_id." in (1,2,3) and ".$campo_usu." = ".$reg_usu ;

        }else{
            $sql = "select count(*) as total from ".$nombre_tabla."
             where ".$campo_id." in ($ids) and ".$campo_usu." = ".$reg_usu ;

        }

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


      
    function get_total_tabla_usu_sy_asig($campo_id,$ids,$reg_usu,$campo_usu ){

        if($ids==='todos'){
            $sql = "select count(*) as total from syllabus  s
            INNER JOIN asignacion_cursos ac on s.id_asignacion_curso= ac.id_asignacion_cursos
            INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios
            INNER JOIN plan_estudios pe on ape.id_plan_estudios = pe.id_plan_estudios

            where s.".$campo_id." in (1,2,3) and s.".$campo_usu." = ".$reg_usu." and ape.estado =2 and ac.estado=2 and pe.estado=3;" ;

        }else{
            $sql = "select count(*) as total from syllabus s
            INNER JOIN asignacion_cursos ac on s.id_asignacion_curso= ac.id_asignacion_cursos
            INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios
            INNER JOIN plan_estudios pe on ape.id_plan_estudios = pe.id_plan_estudios

             where s.".$campo_id." in ($ids) and s.".$campo_usu." = ".$reg_usu ." and ape.estado =2 and ac.estado=2 and pe.estado=3;" ;

        }

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
    
    function get_sumilla_by_version($id_version_sy){

            $sql = "select * from sumilla
            where 
            id_version_sy=".$id_version_sy;     


        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_recursos_aula($id_recursos_aula=0,$id_selected)
    {
        if(isset($id_recursos_aula ) && $id_recursos_aula  > 0){      
        
            if($id_selected==true){
                $sql = "select * from recursos_aula  where estado IN(2) order by id_recursos_aula DESC";
            }else{

                $sql = "select * from recursos_aula where id_recursos_aula not in ((select pl.nom_plataformas_herramientas from plataformas_herramientas pl LEFT JOIN recursos_aula ra on pl.nom_plataformas_herramientas= ra.id_recursos_aula where pl.id_version_sy=".$id_recursos_aula." and pl.estado=2)) order by id_recursos_aula DESC";

            }
        }
        else
        {
            $sql = "select * from recursos_aula  WHERE estado IN(2) order by id_recursos_aula DESC";
        }
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function get_lista_like_print($texto,$campo,$tlb,$id)
    {
        $estados_ids = array(10,2,9);

            $this->db->select('*');
            $this->db->from($tlb);
            // $this->db->where('estado', 10);
            // $this->db->where('estado', 2);
            $this->db->where_in('estado', $estados_ids);
            $this->db->like($campo, $texto);
            $this->db->order_by($id, "asc");
            $this->db->limit(1);
            $query = $this->db->get();

            $data = $query->result_array();
            return $data;
    }


    
    function get_lista_like_print_none($texto,$campo,$tlb,$id)
    {
        $estados_ids = array(10,2,9);

            $this->db->select('*');
            $this->db->from($tlb);
            // $this->db->where('estado', 10);
            // $this->db->where('estado', 2);
            $this->db->where_in('estado', $estados_ids);
            $this->db->like($campo, $texto, 'none');
            $this->db->order_by($id, "asc");
            $this->db->limit(1);
            $query = $this->db->get();

            $data = $query->result_array();
             print_r($data);
            return $data;
    }
    
    function get_lista_ciclo_planEstudios_by_id($id_ciclo)
    { 

            $sql = "

                SELECT c.*, p.tipo_estudios,p.id_carrera as 'id_carrera_plan',car.id_director,p.anio
                FROM ciclo c 
                INNER JOIN plan_estudios p ON c.id_plan_estudios= p.id_plan_estudios
                INNER JOIN carrera car ON p.id_carrera= p.id_carrera 
                where 
                c.id_ciclo in (".$id_ciclo.") 
                AND c.estado=2 LIMIT 1; 

            " ;

            
            $query = $this->db->query($sql)->result_Array();
            return $query;

    }

    
    function planestudio_total_anio( $anio,$estado ){

        $sql = "
        
                select count(*) as total 
                from plan_estudios            
                where estado in (".$estado.")

                " ;

        if($anio!=0){
            $sql .= "
                    and anio = ".$anio."
                    " ;
        }
    
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
    

    function get_total_tabla_sy_asig_anio($anio,$estado , $id_usuario_sesion,$id_nivel_main ){

        $sql =  "
                    select count(*) as total from syllabus  s
                    INNER JOIN asignacion_cursos ac on s.id_asignacion_curso= ac.id_asignacion_cursos
                    INNER JOIN asignacion_plan_estudios ape on ac.id_asignacion_plan_estudios = ape.id_asignacion_plan_estudios
                    INNER JOIN plan_estudios pe on ape.id_plan_estudios = pe.id_plan_estudios

                    where s.estado in (".$estado.") and ape.estado =2 and ac.estado=2 and pe.estado=3
                ";

        if($anio!=0){
            $sql .= "
                    and  pe.anio=".$anio."  
                    " ;
        }

        if($id_nivel_main ==3){
            $sql .= "
                    and  s.id_usuario=".$id_usuario_sesion."  
                    " ;
        }
                

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }



}