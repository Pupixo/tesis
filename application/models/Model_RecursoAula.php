<?php
class Model_RecursoAula extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("America/Lima");
    }

    function procedureCrudRecursoAula($parametros) {
        $this->db->free_db_resource();
        $sql = "call sp_CrudRecursoAula(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
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

}