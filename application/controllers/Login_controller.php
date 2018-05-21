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
            $this->session->set_flashdata('notify', array('status' => 1, 'message' => '¡Bienvenido ' . $user->per_nombre . ' ' . $user->per_apellidoPaterno . '!'));
            redirect(base_url());
        } else {
    		$this->session->set_flashdata('notify', array('status' => 0, 'message' => 'Usuario no encontrado. Intenta de nuevo.'));
            $this->session->set_flashdata('data', $_POST);
            redirect(base_url());
        }
    }

    public function logout()
    {
        $per_nombre = $_SESSION['per_nombre'];
        $per_apellidoPaterno = $_SESSION['per_apellidoPaterno'];
        $this->session->sess_destroy();
        $this->session->set_userdata(array('nothing' => 1));
        $this->session->set_flashdata('notify', array('status' => 2, 'message' => '¡Hasta luego ' . $per_nombre . ' ' . $per_apellidoPaterno . '!'));
        redirect(base_url());
    }

}
