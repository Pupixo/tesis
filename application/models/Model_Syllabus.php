<?php
class Model_Syllabus extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Lima");
    }

    function procedureCrud_Syllabus($parametros) {
        $this->db->free_db_resource();
        $sql = "call sp_Crud_Syllabus(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
        $query = $this->db->query($sql, $parametros);
       // $array = $query->result_array();
        if ($query) {
            $data = $query->result_array();
            $query->free_result();
            $query->next_result();
        }
        return $data;

        //    return $array;
    }

    //--------------------------------------------
        
    function listar_syversion_id_sy($id_syllabus){
        $sql =  "
        SELECT vs.*,es.nom_est_syllabus 
        FROM versiones_syllabus vs
        LEFT join estado_syllabus es on vs.estado=es.id_est_syllabus
        WHERE
        vs.id_syllabus = ".$id_syllabus.";
                ";
        // $query = $this->db->query($sql)->row();
        $query = $this->db->query($sql)->result_Array();

        return $query;
    }

    function listar_syversion_id($id_version_sy){
        $sql =  "

            SELECT  vs.id_syllabus,vs.nom_version_sy,vs.numero_version, 
                    vs.fec_reg as fecha_reg_version,vs.user_reg, 
                    vs.fech_aprob,vs.usu_aprob,vs.fech_estado,vs.usu_estado,
                    sd.*,
                    es.nom_est_syllabus,
                    concat(u.usuario_nombres, ' ', u.usuario_apater ,' ',u.usuario_amater) as nombre_reg 
                    FROM 
                    versiones_syllabus vs 
                    LEFT JOIN syllabus_det sd on vs.id_version_sy=sd.id_version_sy 
                    LEFT join estado_syllabus es on vs.estado=es.id_est_syllabus
                    LEFT JOIN users u on vs.user_reg=u.id_usuario
                    WHERE vs.id_version_sy=".$id_version_sy.
            ";



                ";
        // $query = $this->db->query($sql)->row();
        $query = $this->db->query($sql)->result_Array();

        return $query;
    }

    function registrar_version_sy($parametros){
      

            $sql = "      
            INSERT INTO 
            versiones_syllabus
            (
                id_syllabus,
                nom_version_sy,
                numero_version,
                estado,
                fec_reg,
                user_reg
            ) 
            VALUES 
            (
                ".$parametros[0].",
                'Versión ".$parametros[1]."',
                '".$parametros[1]."',
                1,
                NOW(),
                ".$parametros[2]."

            );

            ";
            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
            $this->db->query($sql);


        $query=$this->db->query($sql_data);

        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;


    }

    //--------------------------------------

    function listar_compet_detalle($id_ciclo){
        $sql = "SELECT * FROM `compet_detalle` where id_ciclo=".$id_ciclo." LIMIT 1";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function listar_diccionario_compte($id_diccionario_competen,$niveles){  
        
        $niveles_array = explode(",", $niveles);

        
        $sql = "SELECT nom_compet";

        
        if (in_array("1", $niveles_array)) {
            $sql .= ",nivel_uno";
        }
        if (in_array("2", $niveles_array)) {
            $sql .= ",nivel_dos";
        }
        if (in_array("3", $niveles_array)) {
            $sql .= ",nivel_tres";
        }


        $sql .= "
        ,tipo,estado
        FROM `diccionario_compet`
        where id_diccionario_competen=".$id_diccionario_competen
        ;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    //---------------------------

    function listar_compt_asoci_curso($id_version_sy){
        $sql = "select * from compt_asoci_curso where  id_version_sy=".$id_version_sy;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    
    function listar_sumilla_sy($id_version_sy){
        $sql = "select * from sumilla where  id_version_sy=".$id_version_sy;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    // function insert_update_compt_asoci_curso($parametros){

    //     if($parametros[0] ==='I'){
    //         $sql = "      
    //             INSERT INTO compt_asoci_curso
    //             (
    //                     id_version_sy,
    //                     compt_gene,
    //                     compt_gene_descr,
                
    //                     compt_espec_1,
    //                     compt_espec_descr_1,
    //                     compt_espec_2,
    //                     compt_espec_descr_2,

    //                     estado,
    //                     fec_reg,
    //                     user_reg,
                                
    //                     compt_gene_2,
    //                     compt_gene_descr_2,
    //                     compt_espec_3,
    //                     compt_espec_descr_3
    //             ) 
    //             VALUES 
    //             (
    //                 ".$parametros[1].",
    //                 '".$parametros[2]."',
    //                 '".$parametros[3]."',
    //                 '".$parametros[4]."',
    //                 '".$parametros[5]."',
    //                 '".$parametros[6]."',
    //                 '".$parametros[7]."',
    //                 1,
    //                 NOW(),
    //                 ".$parametros[8].",
    //                 ".$parametros[9].",
    //                 ".$parametros[10].",
    //                 ".$parametros[11].",
    //                 ".$parametros[12].",
        
    //             );
    //         ";
    //         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
    //     }else if($parametros[0] ==='E'){
    //         $sql = "    
    //             UPDATE 
    //             compt_asoci_curso 
    //             SET 
    //             compt_gene = '".$parametros[2]."',
    //             compt_gene_descr  = '".$parametros[3]."',
    //             compt_espec_1 = '".$parametros[4]."',
    //             compt_espec_descr_1 = '".$parametros[5]."',
    //             compt_espec_2 = '".$parametros[6]."',
    //             compt_espec_descr_2  = '".$parametros[7]."',        
                
                

    //             estado = 1,
    //             fec_act = NOW(),
    //             user_act  = ".$parametros[8].",

    //             compt_gene_2='".$parametros[10]."',
    //             compt_gene_descr_2='".$parametros[11]."',
    //             compt_espec_3='".$parametros[12]."',
    //             compt_espec_descr_3='".$parametros[13]."'

    //             WHERE 
    //              id_compt_asoci_curso  = ".$parametros[9].";
    //         ";
    //         $sql_data = "SELECT ROW_COUNT() AS 'ID';";
    //     }else{
    //         $sql = "    
    //             UPDATE 
    //             compt_asoci_curso 
    //             SET 
    //             compt_gene = '".$parametros[2]."',
    //             compt_gene_descr  = '".$parametros[3]."',
    //             compt_espec_1 = '".$parametros[4]."',
    //             compt_espec_descr_1 = '".$parametros[5]."',
    //             compt_espec_2 = '".$parametros[6]."',
    //             compt_espec_descr_2  = '".$parametros[7]."',            
    //             estado = 1,
    //             fec_act = NOW(),
    //             user_act  = ".$parametros[8].",

    //             compt_gene_2='".$parametros[10]."',
    //             compt_gene_descr_2='".$parametros[11]."',
    //             compt_espec_3='".$parametros[12]."',
    //             compt_espec_descr_3='".$parametros[13]."'

    //             WHERE 
    //             id_version_sy = ".$parametros[1]."
    //         ";
    //         $sql_data = "SELECT ROW_COUNT() AS 'ID';";
    //     }
          
    //    $this->db->query($sql);

    //    $query=$this->db->query($sql_data);

    //    if ($query->num_rows() == 1)
    //         return $query->row();
    //         /*
    //                 return $query->num_fields();

    //                 return $query->row();
    //                 row(5)
    //                 if (isset($row))
    //                 {
    //                         echo $row['title'];
    //                         echo $row['name'];
    //                         echo $row['body'];
    //                 }

    //                 $row = $query->row_array();
    //                 $row = $query->row_array(5);

    //                 if (isset($row))
    //                 {
    //                         echo $row['title'];
    //                         echo $row['name'];
    //                         echo $row['body'];
    //                 }

    //                 return $query->result();

    //                 foreach ($query->result() as $row)
    //                     {
    //                             echo $row->title;
    //                             echo $row->name;
    //                             echo $row->body;
    //                     }


    //                 return $query->free_result();
    //                 return $query->row_array();
    //                 return $query->result_array() 

    //                 $row = $query->first_row()
    //                 $row = $query->last_row()
    //                 $row = $query->next_row()
    //                 $row = $query->previous_row()

    //                 $row = $query->first_row(‘array’)
    //                 $row = $query->last_row(‘array’)
    //                 $row = $query->next_row(‘array’)
    //                 $row = $query->previous_row(‘array’)

    //                 $query->data_seek(5); // Skip the first 5 rows combine ubuffe

    //                 $query->unbuffered_row();               // object
    //                 $query->unbuffered_row('object');       // object
    //                 $query->unbuffered_row('array');
    //                 while ($row = $query->unbuffered_row())
    //                 {
    //                         echo $row->title;
    //                         echo $row->name;
    //                         echo $row->body;
    //                 }

    //         */
    //     return FALSE;
    //     /*
    //         $query = $this->db->query($sql_data)->result_Array();
    //         return $query;
    //     */
       
    // }


    //----------------------------------

    // function update_insert_sumilla($parametros){
    //     if($parametros[3] ===''){

    //         $sql = "      
    //                     INSERT INTO sumilla
    //                     (
    //                         id_version_sy,
    //                         desc_sumilla,

    //                             estado,
    //                             fec_reg,
    //                             user_reg
    //                     ) 
    //                     VALUES 
    //                     (
    //                         ".$parametros[0].",
    //                         '".$parametros[1]."',
                            
    //                         2,
    //                         NOW(),
    //                         ".$parametros[2]."
    //                     );
    //         ";
    //         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";


    //     }else{

    //             $sql = "    
    //                         UPDATE sumilla SET 

    //                         desc_sumilla = '".$parametros[1]."',       
    //                         estado = 2,
    //                         fec_act = NOW(),
    //                         user_act  = ".$parametros[2]."

    //                         WHERE 
    //                         id_sumilla  = ".$parametros[3].";";

    //                         $sql_data = "SELECT ROW_COUNT() AS 'ID';";


    //     }
    //    $this->db->query($sql);

    //    $query=$this->db->query($sql_data);

    //    if ($query->num_rows() == 1)
    //         return $query->row();

    //     return FALSE;
    // }





    // function update_insert_result_gen_apr($parametros){
        
    //     if($parametros[3] ===''){
    //         $sql = "      
    //                 INSERT INTO result_general_apren
    //                     (
    //                         id_version_sy,
    //                         desc_result_gen_apr,
    //                         estado,
    //                         fec_reg,
    //                         user_reg
    //                     ) 
    //                     VALUES 
    //                     (
    //                         ".$parametros[0].",
    //                         '".$parametros[1]."',
                            
    //                         2,
    //                         NOW(),
    //                         ".$parametros[2]."
    //                     );
    //         ";

    //         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
    //     }else{

    //         $sql = "    
    //         UPDATE result_general_apren SET 
    //             desc_result_gen_apr = '".$parametros[1]."',       
    //             estado = 1,
    //             fec_act = NOW(),
    //             user_act  = ".$parametros[2]."
    //         WHERE 
    //             id_result_gen_apr   = ".$parametros[3].";";

    //         $sql_data = "SELECT ROW_COUNT() AS 'ID';";

    //     }
    //    $this->db->query($sql);
    //    $query=$this->db->query($sql_data);

    //    if ($query->num_rows() == 1)
    //         return $query->row();

    //     return FALSE;
    // }

    // function update_insert_estrategias_didactica($parametros){
    //     if($parametros[3] ===''){
    //                 $sql = "      
    //                 INSERT INTO estrategias_didacticas
    //                                     (
    //                                         id_version_sy,
    //                                         desc_estrateg_didact,

    //                                             estado,
    //                                             fec_reg,
    //                                             user_reg
    //                                     ) 
    //                                     VALUES 
    //                                     (
    //                                         ".$parametros[0].",
    //                                         '".$parametros[1]."',
                                            
    //                                         2,
    //                                         NOW(),
    //                                         ".$parametros[2]."
    //                                     );
    //                         ";
    //                         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
    //     }else{
    //         $sql = "    
    //         UPDATE estrategias_didacticas SET 
    //             desc_estrateg_didact = '".$parametros[1]."',       
    //             estado = 1,
    //             fec_act = NOW(),
    //             user_act  = ".$parametros[2]."
    //         WHERE 
    //         id_estrateg_didact  = ".$parametros[3].";
    //     ";
    //     $sql_data = "SELECT ROW_COUNT() AS 'ID';";
    //     }
    //    $this->db->query($sql);
    //    $query=$this->db->query($sql_data);
    //    if ($query->num_rows() == 1)
    //         return $query->row();

    //     return FALSE;
    // }

    //-----------------------

    function listar_compt_org_aprendizaje($id_version_sy){
        $sql = "select * from org_aprendizaje where estado =2 and id_version_sy=".$id_version_sy." ORDER BY
        modulo_num_orden ASC" ;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function insert_update_org_aprendizaje($parametros){

        if($parametros[0] ==='I'){
            $sql = "      
            INSERT INTO org_aprendizaje
            (
                    id_version_sy,
                    modulo_aprendizaje,
                    result_aprendizaje,
                    semanas_aprendizaje_ini,
                    semanas_aprendizaje_fin,
                    conten_aprendizaje,
                    estado,
                    fec_reg,
                    user_reg,
                    modulo_num_orden,
                    id_modulo
            ) 
            VALUES 
            (
                ".$parametros[1].",
                '".$parametros[2]."',
                '".$parametros[3]."',
                '".$parametros[4]."',
                '".$parametros[5]."',
                '".$parametros[6]."',
                2,
                NOW(),
                ".$parametros[7].",
                ".$parametros[9].",
                0
            );
            ";

            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";

        }else if($parametros[0] ==='E'){
            $sql = "    
                UPDATE 
                org_aprendizaje 
                SET 
                id_version_sy = ".$parametros[1].",
                modulo_aprendizaje = '".$parametros[2]."',
                result_aprendizaje  = '".$parametros[3]."',
                semanas_aprendizaje_ini = '".$parametros[4]."',
                semanas_aprendizaje_fin = '".$parametros[5]."',
                conten_aprendizaje = '".$parametros[6]."',            
                estado = 2,
                fec_act = NOW(),
                user_act  = ".$parametros[7].",
                modulo_num_orden =".$parametros[9]."
                WHERE 
                id_org_aprendizaje   = ".$parametros[8].";
                        ";

                $sql_data = "SELECT ROW_COUNT() AS 'ID';";

        }
       $this->db->query($sql);

       $query=$this->db->query($sql_data);

       if ($query->num_rows() == 1)
            return $query->row();
        
        return FALSE;

    }

    function eliminar_org_aprendizaje($parametros){
        $sql = "
        UPDATE 
                org_aprendizaje 
                SET         
                estado = 3,
                fec_eli = NOW(),
                user_eli  = ".$parametros[0]."
                WHERE 
                id_org_aprendizaje   = ".$parametros[1].";
                ";
        $query = $this->db->query($sql);
        return $query;
    }

    //---------------------------

    
    function listar_forma_herrami_eval($id_version_sy){
        $sql = "select * from forma_herrami_eval where  id_version_sy=".$id_version_sy;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function insert_update_forma_herrami_eval($parametros){

        if($parametros[0] ==='I'){
            $sql = "      
            INSERT INTO forma_herrami_eval
            (
                    id_version_sy,

                    eval_diag_detalle,
                    eval_cont1_detalle,
                    eval_cont2_detalle,
                    eval_parcial_detalle,
                    eval_cont3_detalle,
                    eval_cont4_detalle,
                    eval_final_detalle,

                    eval_diag_sem,
                    eval_cont1_sem,
                    eval_cont2_sem,
                    eval_parcial_sem,
                    eval_cont3_sem,
                    eval_cont4_sem,
                    eval_final_sem,

                    eval_diag_peso,
                    eval_cont1_peso,
                    eval_cont2_peso,
                    eval_parcial_peso,
                    eval_cont3_peso,
                    eval_cont4_peso,
                    eval_final_peso,

                    estado,
                    fec_reg,
                    user_reg
            ) 
            VALUES 
            (
                ".$parametros[1].",

                '".$parametros[2]."',
                '".$parametros[3]."',
                '".$parametros[4]."',
                '".$parametros[5]."',
                '".$parametros[6]."',
                '".$parametros[7]."',
                '".$parametros[8]."',
                
                '".$parametros[9]."',
                '".$parametros[10]."',
                '".$parametros[11]."',
                '".$parametros[12]."',
                '".$parametros[13]."',
                '".$parametros[14]."',
                '".$parametros[15]."',

                '".$parametros[16]."',
                '".$parametros[17]."',
                '".$parametros[18]."',
                '".$parametros[19]."',
                '".$parametros[20]."',
                '".$parametros[21]."',
                '".$parametros[22]."',


                1,
                NOW(),
                ".$parametros[23]."
    
            );
            ";

            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";


        }else if($parametros[0] ==='E'){
            $sql = "    
                UPDATE 
                forma_herrami_eval 
                SET 
                id_version_sy = ".$parametros[1].",


                eval_diag_detalle = '".$parametros[2]."',
                eval_cont1_detalle  = '".$parametros[3]."',
                eval_cont2_detalle = '".$parametros[4]."',
                eval_parcial_detalle = '".$parametros[5]."',
                eval_cont3_detalle = '".$parametros[6]."',
                eval_cont4_detalle  = '".$parametros[7]."',
                eval_final_detalle  = '".$parametros[8]."',

                eval_diag_sem = '".$parametros[9]."',
                eval_cont1_sem  = '".$parametros[10]."',
                eval_cont2_sem = '".$parametros[11]."',
                eval_parcial_sem = '".$parametros[12]."',
                eval_cont3_sem = '".$parametros[13]."',
                eval_cont4_sem  = '".$parametros[14]."',
                eval_final_sem  = '".$parametros[15]."',
                
                eval_diag_peso = '".$parametros[16]."',
                eval_cont1_peso  = '".$parametros[17]."',
                eval_cont2_peso = '".$parametros[18]."',
                eval_parcial_peso = '".$parametros[19]."',
                eval_cont3_peso = '".$parametros[20]."',
                eval_cont4_peso  = '".$parametros[21]."',
                eval_final_peso  = '".$parametros[22]."',



                estado = 1,
                fec_act = NOW(),
                user_act  = ".$parametros[23]."
                WHERE 
                id_forma_herrami_eval  = ".$parametros[24].";
                        ";

                $sql_data = "SELECT ROW_COUNT() AS 'ID';";

        }
       
        /*
            echo "<pre>";
            print_r($sql);

            print_r($sql_data);

            echo "</pre>";
            exit;
            */
          
       $this->db->query($sql);

       $query=$this->db->query($sql_data);

       if ($query->num_rows() == 1)
            return $query->row();
        
        return FALSE;
       
    }

    //-----------------------------------

    function insert_modulo($parametros_modulo){

            $sql = "      
            INSERT INTO modulo
            (
                id_org_aprendizaje,
                nom_modulo,
                    num_modulo,
                    estado,
                    fec_reg,
                    user_reg
            ) 
            VALUES 
            (
                ".$parametros_modulo[0].",
                '".$parametros_modulo[1]."',
                '".$parametros_modulo[1]."',
                2,
                NOW(),
                ".$parametros_modulo[2]."

            );

            ";
            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
            $this->db->query($sql);


        $query=$this->db->query($sql_data);

        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;
    
    }

    function upd_org_aprendizaje_insert_id_modulo($id_org_aprendizaje,$id_modulo){
        $sql = "
                UPDATE 
                        org_aprendizaje 
                        SET         
                        id_modulo  = ".$id_modulo."
                WHERE 
                        id_org_aprendizaje   = ".$id_org_aprendizaje.";
                ";
                $this->db->query($sql);

            $sql_data = " SELECT ROW_COUNT() AS 'ID'";


        $query=$this->db->query($sql_data);

        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;
    }

    function upd_sesion_modulo($id_sesion,$num_sesion,$desc_tema,$descr_trabajo_autor,$descr_iteracc_docente,$user_reg ){
        $sql = "
                UPDATE 
                sesion_modulo 
                        SET         
                        num_sesion  = ".$num_sesion.",
                        desc_tema  = '".$desc_tema."',
                        descr_iteracc_docente  = '".$descr_iteracc_docente."',
                        descr_trabajo_autor  = '".$descr_trabajo_autor."',
                        fec_act  = NOW(),
                        user_act  = ".$user_reg."

                WHERE 
                id_sesion_modulo   = ".$id_sesion.";
                ";
                $this->db->query($sql);

            $sql_data = " SELECT ROW_COUNT() AS 'ID'";


        $query=$this->db->query($sql_data);

        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;

    }

    function insert_semana_modulo($id_modulo,$num_semana,$user_reg){

            $sql = "      
            INSERT INTO semana_modulo
            (
                    id_modulo,
                    num_semana,
                    estado,
                    fec_reg,
                    user_reg
            ) 
            VALUES 
            (
                ".$id_modulo.",
                '".$num_semana."',
                2,
                NOW(),
                ".$user_reg."

            );
            ";

            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID_SEMANA'";
            $this->db->query($sql);


        $query=$this->db->query($sql_data);
        
        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;

    }

    function insert_sesion_modulo($num_sesion,$desc_tema,$descr_iteracc_docente,$descr_trabajo_autor,$semana_pertenece,$user_reg){

        $sql = "      
        INSERT INTO sesion_modulo
        (
            id_semana_modulo,
            num_sesion,
            desc_tema,
            descr_iteracc_docente,
            descr_trabajo_autor,
                estado,
                fec_reg,
                user_reg
        ) 
        VALUES 
        (
            ".$semana_pertenece.",
            '".$num_sesion."',
            '".$desc_tema."',
            '".$descr_iteracc_docente."',
            '".$descr_trabajo_autor."',
            2,
            NOW(),
            ".$user_reg."

        );
        ";

        $sql_data = " SELECT LAST_INSERT_ID() AS 'ID_SESION'";
        $this->db->query($sql);


            $query=$this->db->query($sql_data);
            
            if ($query->num_rows() == 1)
                    return $query->row();
                
                return FALSE;

    }

    //-------------------------------

    function listar_plataformas_herramientas($id_version_sy){
        $sql = "
        select pl.*,ra.nom_recurso,ra.recurso_descrip from plataformas_herramientas pl
LEFT JOIN recursos_aula ra on pl.nom_plataformas_herramientas= ra.id_recursos_aula
        where pl.id_version_sy=".$id_version_sy." and pl.estado=2";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function insert_plataformas_herramientas($parametros){

            $sql = "      
            INSERT INTO plataformas_herramientas
            (
                    id_version_sy,
                    nom_plataformas_herramientas,
                    estado,
                    fec_reg,
                    user_reg
            ) 
            VALUES 
            (
                ".$parametros[0].",
                '".$parametros[1]."',
                2,
                NOW(),
                ".$parametros[2]."

            );
            ";

            $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
        
            $this->db->query($sql);

            $query=$this->db->query($sql_data);

            if ($query->num_rows() == 1)
                    return $query->row();
                
                return FALSE;
    
    }
    
    function edit_plataformas_herramientas($parametros){

            $sql = "      
            UPDATE plataformas_herramientas
            SET
            nom_plataformas_herramientas='$parametros[1]',
            fec_act =  NOW(),
            user_act= $parametros[2]
            WHERE
            id_plataformas_herramientas = $parametros[0];
            ";

            $this->db->query($sql);

    }

    function eliminar_herramientas($parametros){
        $sql = "
        UPDATE 
        plataformas_herramientas 
                SET         
                estado = 3,
                fec_eli = NOW(),
                user_eli  = ".$parametros[0]."
                WHERE 
                id_plataformas_herramientas     = ".$parametros[1].";
                ";
        $query = $this->db->query($sql);
        return $query;
    }

    //------------------------------

    function listar_referencias_bibliograficas($id_version_sy,$tipo_bibliografia){
        $sql = "select * from referencias_bibliograficas where id_version_sy=".$id_version_sy."  and  tipo_bibliografia='".$tipo_bibliografia."' and estado=2";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function eliminar_referobli($parametros){
        $sql = "
        UPDATE 
              referencias_bibliograficas
                SET         
                estado = 3,
                fec_eli = NOW(),
                user_eli  = ".$parametros[0]."
                WHERE 
                id_referencias_bibliograficas    = ".$parametros[1].";
                ";
        $query = $this->db->query($sql);
        return $query;
    }


    // function edit_referencias_bibliograficas($parametros){

    //     $sql = "      
    //     UPDATE referencias_bibliograficas
    //     SET
    //     nom_referencias_bibliograficas='$parametros[1]',
    //     fec_act =  NOW(),
    //     user_act= $parametros[2]
    //     WHERE
    //     id_referencias_bibliograficas = $parametros[0];
    //     ";

    //     $this->db->query($sql);

    // }



    /*************************************** funciones  */
            function ver_porcentaje_syllabus_dg($id_version_sy){
                $sql = "select porcentaje_syllabus_dg (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_ac($id_version_sy){
                $sql = "select porcentaje_syllabus_ac (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            
            function ver_porcentaje_syllabus_oa($id_version_sy){
                $sql = "select porcentaje_syllabus_oa (".$id_version_sy.")  as CANTIDAD";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            
            function ver_porcentaje_syllabus_fhe($id_version_sy){
                $sql = "select porcentaje_syllabus_fhe (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_ap($id_version_sy){
                $sql = "select porcentaje_syllabus_ap (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            
            function ver_porcentaje_syllabus_ph($id_version_sy){
                $sql = "select porcentaje_syllabus_ph (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_bibli($id_version_sy){
                $sql = "select porcentaje_syllabus_bibli (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_sumilla($id_version_sy){
                $sql = "select porcentaje_syllabus_sumilla (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_result_ga($id_version_sy){
                $sql = "select porcentaje_syllabus_result_ga (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            function ver_porcentaje_syllabus_estrate_didac($id_version_sy){
                $sql = "select porcentaje_syllabus_est_didac (".$id_version_sy.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }

            
            function ver_porcentaje_syllabus_ficha_eval($id_version_sy,$num){
                $sql = "select porcentaje_ficha_eval_1 (".$id_version_sy.",".$num.")  as porcentaje_syllabus";
                $query = $this->db->query($sql)->row();
                return $query;
            }


    /* ----------------------------- */


    function update_version_sy_principal($parametros){

            $sql = "
                        UPDATE 
                                syllabus
                        SET         
                            version_principal = ".$parametros[2].",

                            fech_vers = NOW(),
                            usu_vers  = ".$parametros[0].",
                            estado = ".$parametros[3]."
                        WHERE 
                            id_syllabus     = ".$parametros[1].";
                    ";

        $query = $this->db->query($sql);
        return $query;
    }

    
    function upd_version_sy_comentario($parametros){
                    
                $data = array(
                                $parametros[3] => $parametros[1],
                                'fec_act' => date("Y-m-d H:i:s"),
                                'user_act'  => $parametros[0],
                            );
            
            $this->db->where('id_version_sy', $parametros[2]);
            $this->db->update('coments_version_sy', $data);


            $sql_data = " SELECT ROW_COUNT() AS 'ID'";


        $query=$this->db->query($sql_data);

        if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;
    }

    //----------------------------------------------------------------------


    function listar_historial_seccion($id_version_sy,$id_seccion){
        $sql = "
        select h.*,
        concat(u.usuario_nombres, ' ', u.usuario_apater ,' ',u.usuario_amater) as nombre_reg 
        from historial_acciones h
        LEFT JOIN users u on h.user_reg=u.id_usuario

        where   h.id_seccion =".$id_seccion."  
                AND h.id_version_sy=".$id_version_sy." 
        ORDER BY h.id_tabla ASC
        " ;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }


    function listar_historial_seccion_ficha($id_version_sy,$id_seccion,$eval1){
        $sql = "
        select h.*,
        concat(u.usuario_nombres, ' ', u.usuario_apater ,' ',u.usuario_amater) as nombre_reg 
        from historial_acciones h
        LEFT JOIN users u on h.user_reg=u.id_usuario
        LEFT JOIN ficha_eval fv on h.id_tabla=fv.id_ficha_eval

        where   h.id_seccion =".$id_seccion."  
                AND h.id_version_sy=".$id_version_sy." 
                AND fv.tipo=".$eval1."
        ORDER BY h.id_tabla ASC
        " ;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    //-------------------------------
    
    function listar_ficha_eval($id_version_sy,$tipo){
        $sql = "
                select * from ficha_eval 
                where   
                id_version_sy =".$id_version_sy."  
                and 
                tipo =".$tipo."
                ORDER BY id_ficha_eval ASC
        " ;
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function upd_ficha_eval($parametros){ 	 	 	 	 	 	

                $data = array(
                    'semana_eval' => $parametros[1],
                    'defin_eval'=> $parametros[2],
                    'descrip_eval' => $parametros[3],
                    'criterios_eval'  => $parametros[4],
                    'ids_competencias'  => $parametros[5],
                    'fec_act'  => date('Y-m-d H:i:s'),
                    'user_act'  => $parametros[7]
                );

            $this->db->where('tipo', $parametros[6]);
            $this->db->where('id_version_sy', $parametros[0]);
            $this->db->update('ficha_eval', $data);

            $sql_data = " SELECT ROW_COUNT() AS 'ID'";
            $query=$this->db->query($sql_data);

            if ($query->num_rows() == 1)
                return $query->row();
            
            return FALSE;
    }

    
    // function insert_update_eval_ficha($parametros){

    //     if($parametros[9] =='0'){
    //         $sql = "      
    //             INSERT INTO criterios_eval
    //             (
    //                 id_ficha_eval,
    //                 id_compet,
    //                 logrado,
    //                 puntaje_1,
    //                 en_proceso,
    //                 puntaje_2,
    //                 no_logrado,
    //                 puntaje_3,
    //                 estado,
    //                 fec_reg,
    //                 user_reg
    //             ) 
    //             VALUES 
    //             (
    //                 ".$parametros[0].",
    //                 '".$parametros[1]."',
    //                 '".$parametros[2]."',
    //                 '".$parametros[3]."',
    //                 '".$parametros[4]."',
    //                 '".$parametros[5]."',
    //                 '".$parametros[6]."',
    //                 '".$parametros[7]."',
    //                 2,  
    //                 NOW(),
    //                 '".$parametros[8]."'        
    //             );
    //         ";


    //         $sql = "      
    //             INSERT INTO criterios_eval
    //             (
    //                 id_ficha_eval,
    //                 id_compet,
    //                 logrado,
    //                 puntaje_1,
    //                 en_proceso,
    //                 puntaje_2,
    //                 no_logrado,
    //                 puntaje_3,
    //                 estado,
    //                 fec_reg,
    //                 user_reg
    //             ) 
    //             VALUES 
    //             (
    //                 p_id_1,
    //                 p_id_2,
    //                 p_texto1,
    //                 p_texto2,
    //                 p_texto3,
    //                 p_texto4,
    //                 p_texto5,
    //                 p_texto6,
    //                 2,  
    //                 NOW(),
    //                 p_user        
    //             );
    //         ";


    //         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";
    //     }else{
    //         $sql = "    
    //             UPDATE  criterios_eval   SET 
    //             id_compet = '".$parametros[1]."',
    //             logrado  = '".$parametros[2]."',
    //             puntaje_1 = '".$parametros[3]."',
    //             en_proceso = '".$parametros[4]."',
    //             puntaje_2 = '".$parametros[5]."',
    //             no_logrado  = '".$parametros[6]."',    
    //             puntaje_3  = '".$parametros[7]."',                    
    //             fec_act = NOW(),
    //             user_act  = ".$parametros[8]."
    //             WHERE 
    //             id_criterio_eval  = ".$parametros[9].";
    //         ";

    //         $sql = "    
    //         UPDATE  criterios_eval   SET 
    //         id_compet = p_id_2,
    //         logrado  = p_texto1,
    //         puntaje_1 = p_texto2,
    //         en_proceso = p_texto3,
    //         puntaje_2 = p_texto4,
    //         no_logrado  = p_texto5,    
    //         puntaje_3  = p_texto6,                    
    //         fec_act = NOW(),
    //         user_act  = p_user
    //         WHERE 
    //         id_criterio_eval  = p_id_3;
    //     ";

    //         $sql_data = "SELECT ROW_COUNT() AS 'ID';";
    //     }
          
    //    $this->db->query($sql);

    //    $query=$this->db->query($sql_data);

    //     if ($query->num_rows() == 1)
    //         return $query->row();
    //     return FALSE;
       
    // }

    //-----------------------------------------------------------------------------------------


    function ver_porcentaje_eval_1($id_version_sy){
        $sql = "select porcentaje_syllabus_eval_1 (".$id_version_sy.")  as porcentaje_syllabus";
        $query = $this->db->query($sql)->row();
        return $query;
    }

    function listar_correos_usuarios_revision(){
        $sql = " SELECT * FROM `users` where id_nivel=4 ";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

}