<?php
class Model_Usuario extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Lima");
    }

    function procedureCrudUusuario($parametros) {
        $this->db->free_db_resource();
        $sql = "call sp_CrudUsuario(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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


    //_-------------------------------------------------------------
    function listar_asignacion_plan_estudios($id_usuario){
        $sql = "
        select ape.* ,pe.nom_plan_estudios from asignacion_plan_estudios ape
        INNER JOIN plan_estudios pe on ape.id_plan_estudios =pe.id_plan_estudios
        where ape.id_usuario=".$id_usuario." and ape.estado=2
        ";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    function listar_combo_asig_plan_est($id_usuario){
        $sql = "
        select * from plan_estudios
         where id_plan_estudios not in
         ((select ape.id_plan_estudios from asignacion_plan_estudios ape where ape.id_usuario=".$id_usuario." and ape.estado=2 )) 
         and estado=3; 


        ";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }

    
    function insert_asignacion_plan_estudios($id_plan_estudios,$user_reg, $id_usuario){

        $sql = "      
        INSERT INTO asignacion_plan_estudios
        (
    
            id_plan_estudios,
            id_usuario,
                estado,
                fec_reg,
                user_reg
        ) 
        VALUES 
        (

            '".$id_plan_estudios."',
            '".$id_usuario."',

                    2,
                    NOW(),
                    ".$user_reg."

        );
        ";

        $this->db->query($sql);

    }
   
  

    function eliminar_asignacion_plan_estudios($id_asignacion_plan_estudios,$user_reg ){
        $sql = "
        UPDATE 
        asignacion_plan_estudios 
        SET         
        estado = 3,
        fec_eli = NOW(),
        user_eli  = ".$user_reg."
        WHERE 
        id_asignacion_plan_estudios = ".$id_asignacion_plan_estudios.";
                ";
        $this->db->query($sql);
    }


    //_-------------------------------------------------------------




    
    function listar_asignacion_curso($id_asignacion_plan_estudios,$nom_ciclo){
        $sql = "
        select ac.* ,c.nom_curso from asignacion_cursos ac
        INNER JOIN curso c on c.id_curso =ac.id_curso
        where ac.id_asignacion_plan_estudios=".$id_asignacion_plan_estudios." and
        ac.nom_ciclo='".$nom_ciclo."' and
         ac.estado=2
        ";
        $query = $this->db->query($sql)->result_Array();
        return $query;
    }
  
        
    function insert_asignacion_curso($id_curso,$id_ciclo, $id_asignacion_plan_estudios,  $nom_ciclo ,$user_reg ){

        $sql = "      
        INSERT INTO asignacion_cursos
        (
    
            id_asignacion_plan_estudios,
            id_ciclo,
            id_curso,
            nom_ciclo,
                estado,
                fec_reg,
                user_reg
        ) 
        VALUES 
        (

            '".$id_asignacion_plan_estudios."',
            '".$id_ciclo."',
            '".$id_curso."',
            '". $nom_ciclo ."',

                    2,
                    NOW(),
                    ".$user_reg."

        );
        ";

        $this->db->query($sql);

    }
   
    function eliminar_asignacion_cursos($id_asignacion_cursos,$user_reg ){
        $sql = "
        UPDATE 
        asignacion_cursos 
        SET         
        estado = 3,
        fec_eli = NOW(),
        user_eli  = ".$user_reg."
        WHERE 
        id_asignacion_cursos = ".$id_asignacion_cursos.";
                ";
        $this->db->query($sql);
    }


}