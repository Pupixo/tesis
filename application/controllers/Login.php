<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		//$this->load->library('Password');
	    $this->load->helper(array('url'));
		$this->load->model('N_model');
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$this->load->view('login/login1'); 
	}

	public function ingresar()
	{
		$usuario = $_POST['Usuario'];
		$password = $_POST['Password'];
		$sesion = $this->N_model->login($usuario);
		if (count($sesion) > 0) {
			$_SESSION['usuario'] = $sesion;
			if (password_verify($password, $_SESSION['usuario'][0]['usuario_password'])) {
				echo $_SESSION['usuario'][0]['id_nivel'];
			}
			else{
			echo "error";
			}
		}
		else {
			echo "error";
		}
	}

	public function logout()
	{
     	$this->session->sess_destroy();
     	redirect('/login');
     	//$this->load->view('login/login');
     }

     public function tippoacceso($usuario)
	 {
   
		 header('Content-Type: application/json');
        $data = $this->n_model->gettipoacceso($usuario);
        echo json_encode($data);

		//echo $data;
     }

}
