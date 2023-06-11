<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  class n_model extends CI_Model{
    function __construct(){
      parent::__construct();
      $this->load->database();
      $this->load->library('session');  
    }

    public function login($usuario){
      //echo "jsjsj";
      //echo $usuario;
      $sql = "SELECT 	u.id_usuario, u.usuario_nombres, u.usuario_apater, u.usuario_amater, u.usuario_codigo, u.id_nivel, u.usuario_email, 
              u.usuario_password,u.estado, n.nom_nivel, dis.nombre_distrito, dep.nombre_departamento, pro.nombre_provincia , u.foto ,td.nom_tipo_documento,
              u.ciclo_num,u.id_plan_estudios,pl.nom_plan_estudios ,ca.nom_carrera
              
              FROM users u
              left join nivel n on n.id_nivel=u.id_nivel
              left join departamento dep on dep.id_departamento=u.id_departamento
              left join provincia pro on pro.id_provincia=u.id_provincia
              left join distrito dis on dis.id_distrito=u.id_distrito
              left join tipo_documento td on td.id_tipo_documento=u.id_tipo_documento
              left join plan_estudios pl on pl.id_plan_estudios=u.id_plan_estudios
              left join  carrera ca on ca.id_carrera = pl.id_carrera
              

              WHERE u.estado in (2) and u.usuario_codigo = '" . $usuario . "'";
      //echo($sql);
      $query = $this->db->query($sql)->result_array();

      //var_dump($query);
      /*if(count($query) > 0){
      }*/
      return $query;
    }

    public function gettipoacceso($usuario){

      $sql="select us.CODUSER,t.Tipo_acceso, t.DescAcceso
                  from Usuario_Sistema us 
                  inner join tipoacceso t on t.codi_sistema=us.Codi_Sistema and t.Tipo_acceso=us.Tipo_Acceso
                  where us.Codi_Sistema='0030' and us.CODUSER='".$usuario."'";

        $query = $this->db->query($sql)->result_array();
      if(count($query) > 0){

      }
      return $query;
    }

    function registrar_usuario($dato){
      $fecha=date('Y-m-d H:i:s');       
      $sql=" insert into users 
            (
                usuario_nombres,
                usuario_apater,
                usuario_amater,
                sexo,
                usuario_codigo,
                usuario_password ,
                num_celp,
                fecha_nacimiento,
                id_tipo_documento,
                num_doc,
                id_departamento,
                id_provincia,
                id_distrito,
                usuario_email,
                id_nivel,
                estado,
                fec_reg
                )
              values 
             (
            '". $dato['usuario_nombres']."',
            '". $dato['usuario_apater']."',
            '". $dato['usuario_amater']."',
            '". $dato['sexo']."',
            '". $dato['usuario_codigo']."',
            '". $dato['usuario_password']."',

            '". $dato['num_celp']."',
            '". $dato['fecha_nacimiento']."',
            '". $dato['id_tipo_documento']."',
            '". $dato['numero_doc']."',
            '". $dato['id_departamento']."',
            '". $dato['id_provincia']."',
            '". $dato['id_distrito']."',
            '". $dato['usuario_email']."',
             '3',
             '2', 
             '".$fecha."')";
     // echo $sql;
      $this->db->query($sql);
    }
      
  }
?>
