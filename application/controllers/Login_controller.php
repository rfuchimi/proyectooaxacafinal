<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("User_model");
    }

    public function login()
    {
        if ($user = $this->User_model->login_user()) {
            $this->session->set_userdata(get_object_vars($user));
            $this->session->set_flashdata('notify', array('status' => 1, 'message' => '¡Bienvenido ' . $user->email . '!'));
            redirect(base_url());
        } else {
    		$this->session->set_flashdata('notify', array('status' => 0, 'message' => 'Usuario no encontrado. Intenta con otros datos.'));
            redirect(base_url());
        }
    }

    public function logout()
    {
    	$email = $_SESSION['email'];
        session_destroy();
        $this->session->set_flashdata('notify', array('status' => 2, 'message' => '¡Hasta luego ' . $email . '!'));
        redirect(base_url());
    }

}
