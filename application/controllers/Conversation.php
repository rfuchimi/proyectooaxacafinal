<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Conversation extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("Assistant");
    	$this->load->library("Credentials");
		$this->load->library('session');
	}

	public function conversation() {
    $query = $this->input->post('query');
    $credenciales = new Credentials();
		$watson = new Assistant();
		$watson->set_credentials( $credenciales->get_Assistant_Credentials_User(),
                              $credenciales->get_Assistant_Credentials_Password());
		$wid = $credenciales->get_Assistant_Id();

		$data_array = $watson->send_watson_conv_request($query,$wid);
		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		
		$this->output->set_output(json_encode($data_array));

  }


}
