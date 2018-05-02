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
		if(!empty($data_array['intents'])){
			$confidence = $data_array['intents'][0]['confidence'];
			if ($confidence <= 0.37){
				if(isset($data_array['context']['intentos'])){
					$intentos = $data_array['context']['intentos'];
					$data_array['context']['intentos'] = $intentos+1;
				}else{
					$data_array['context']['intentos'] = 1;
				}
			}
		}

		if(isset($data_array['output']['datos'])){
			$datos = (object) ['pregunta' => $data_array['output']['datos']['pregunta']];
			//Existe en sesion los datos y el numero de pregunta?
			if(isset($this->session->userdata['datos']) && isset($this->session->userdata['datos']->pregunta)){
					//El numero de pregunta en la sesion sigue siendo el mismo?
					if($this->session->userdata['datos']->pregunta == $datos->pregunta){
						//agregamos o modificamos los datos en la sesion
						foreach ( $data_array['output']['datos'] as $key => $valor ) {
							if(!empty($valor)){
								$this->session->userdata['datos']->$key = $valor;
							}
						}
					}else{
						//creamos un objeto nuevo en la sesion
						foreach ( $data_array['output']['datos'] as $key => $valor ) {
							if(!empty($valor)){
								$datos->$key = $valor;
							}
						}
						$this->session->set_userdata('datos', $datos);
					}
			}else{
				//creamos un objeto nuevo en la sesion
				foreach ( $data_array['output']['datos'] as $key => $valor ) {
					if(!empty($valor)){
						$datos->$key = $valor;
					}
				}
				$this->session->set_userdata('datos', $datos);
			}
		}else{
			//creamos un objeto vacio en la sesion
			$datos = null;
			$this->session->set_userdata('datos', $datos);
		}

		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($data_array));
  }
}
