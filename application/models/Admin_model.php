<?php
class Admin_model extends CI_Model {
    public function __construct() {
    parent::__construct();
  }

  function get_list_estado(){
    $sql = "select * from status";
    $query = $this->db->query($sql)->result_Array();
    return $query;
  }

  function get_camb_clave($id_user){
    if(isset($id_user) && $id_user > 0){
      $sql = "
      select u.*, n.nom_nivel,s.nom_status from users u 
      left join nivel n on n.id_nivel=u.id_nivel
      left join estado s on s.id_status=u.estado
      where id_usuario=".$id_user;
      $query = $this->db->query($sql)->result_Array();
      return $query;
    }
 
  }

  function update_clave($dato){
    $fecha=date('Y-m-d H:i:s');
    $sql="update users set 
    usuario_password='".$dato['user_password_hash']."',
     fec_act='$fecha', 
     user_act='".$dato['id_usuario']."' 
     where 
     id_usuario =".$dato['id_usuario']."";
    //echo $sql;
    $this->db->query($sql);
  }


}