<?php
class Model_Cursos extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Lima");
    }

    function procedureCrudCursos($parametros) {
        $this->db->free_db_resource();
        $sql = "call sp_CrudCursos(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,   ?,?,?,?,?,?   ,?,?);";
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


    
    function listar_diccionario_compet($id_curso){

        if($id_curso === ''){
            $sql = "select * from diccionario_compet
            where 
            tipo='1' and 
            estado=2";
   
        }else{
            $sql = "select * from diccionario_compet
            where 
            id_curso='".$id_curso."' and 
            estado=2";
   
        }
 
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    
    // function guardar_compet_detalle($parametros){

    //     if($parametros[12]==0){

    //         $sql = "      
    //             INSERT INTO compet_detalle
    //             (
    //                 compet_gene_uno,
    //                 compet_gene_nivel_uno,

    //                 compet_gene_dos,
    //                 compet_gene_nivel_dos,

    //                 compet_espec_uno,
    //                 compet_espec_nivel_uno,

    //                 compet_espec_dos,
    //                 compet_espec_nivel_dos,

    //                 compet_espec_tres,
    //                 compet_espec_nivel_tres,

    //                     estado,
    //                     fec_reg,
    //                     user_reg,
    //                     id_ciclo
    //             )
    //             VALUES 
    //             (
    //                 '".$parametros[0]."',
    //                 '".$parametros[1]."',
    //                 '".$parametros[2]."',
    //                 '".$parametros[3]."',
    //                 '".$parametros[4]."',
    //                 '".$parametros[5]."',
    //                 '".$parametros[6]."',
    //                 '".$parametros[7]."',
    //                 '".$parametros[8]."',
    //                 '".$parametros[9]."',
    //                 2,
    //                 NOW(),
    //                 ".$parametros[10].",
    //                 ".$parametros[11]."
    //             );
    //         ";
    
    //         $sql_data = " SELECT LAST_INSERT_ID() AS 'ID'";

    //     }else{

    //         $sql = "
    //                     UPDATE 
    //                             compet_detalle  
    //                     SET 
                
    //                     compet_gene_uno	= '".$parametros[0]."',
    //                     compet_gene_nivel_uno	= '".$parametros[1]."',
                        
    //                     compet_gene_dos	= '".$parametros[2]."',
    //                     compet_gene_nivel_dos	= '".$parametros[3]."',

    //                     compet_espec_uno	= '".$parametros[4]."',
    //                     compet_espec_nivel_uno	= '".$parametros[5]."',

    //                     compet_espec_dos	= '".$parametros[6]."',
    //                     compet_espec_nivel_dos	= '".$parametros[7]."',

    //                     compet_espec_tres	= '".$parametros[8]."',
    //                     compet_espec_nivel_tres= '".$parametros[9]."',
                    
    //                     fec_act=NOW(),
    //                     user_act=".$parametros[10]." 
                
    //                     WHERE
    //                         id_compet_detalle= ".$parametros[12].";
    //         ";
    
    //         $sql_data = " SELECT ROW_COUNT() AS 'ID'";

    //     }

    //     $this->db->query($sql);
        
    //     $query=$this->db->query($sql_data);

    //     if ($query->num_rows() == 1){
    //         return $query->row();
    //     }
            
    //         return FALSE;     

    // }

        
    function listar_diccionario_compet_especificas($id_curso){

   
            $sql = "select * from diccionario_compet
            where 
            id_curso='".$id_curso."' and 
            estado=2";


        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
    
    function eliminar_dicci_compt($parametros){
            $sql = "
                        UPDATE 
                            diccionario_compet  
                        SET 

                            estado=4,
                            fec_eli=NOW(),
                            user_eli=".$parametros[1]." 
                        WHERE
                            id_diccionario_competen= ".$parametros[0].";
                    ";

            $sql_data = " SELECT ROW_COUNT() AS 'ID'";

            $this->db->query($sql);
        
            $query=$this->db->query($sql_data);

            if ($query->num_rows() == 1){
                return $query->row();
            }
                
                return FALSE;          
    }



    function mirar_sumilla_curso($id_curso){

            $sql = "select * from sumilla_curso
            where 
            id_curso=".$id_curso;     
 

        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    

}