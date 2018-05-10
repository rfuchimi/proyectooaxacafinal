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

			if(isset($data_array['output']['datos']['datapiker'])){
				$data_array['chat_ui']['datepicker'] = true;
			}

			if(isset($data_array['output']['datos']['button'])){
				$data_array['chat_ui']['button'] = true;
			}

			if(isset($data_array['output']['datos']['pregunta'])){
				$datos = (object) ['pregunta' => $data_array['output']['datos']['pregunta']];
				//creamos un objeto con las variables
				foreach ( $data_array['output']['datos'] as $key => $valor ) {
					if(!empty($valor)){
						$datos->$key = $valor;
					}
				}
				//hacemos la consulta dependiendo la pregunta
				$respuesta = $this->consulta($datos);
				if(count($data_array['output']['text'])>1){
					for($i=0; $i <= count($data_array['output']['text']); $i++) {
						if($i == 0 ){
							$salida[] = $data_array['output']['text'][$i];
						}else if($i == 1){
							$salida[$i] = $respuesta;
						}else{
							$salida[$i] = $data_array['output']['text'][$i-1];
						}
					}
					$data_array['output']['text']=$salida;
				}else{
					$data_array['output']['text'][]=$respuesta;
				}
			}
		}

		$this->session->set_userdata('context', json_encode($data_array['context']));
		$watson->set_context($this->session->userdata('context'));
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		$this->output->set_output(json_encode($data_array));
  }

	private function consulta($datos){
		switch ($datos->pregunta) {
			case 1:
				if(isset($datos->region)){
					$respuesta = "Aqui va el valor que retorna la consulta 1 por region->".$datos->region;
				}else{
					if(isset($datos->estado)){
						$respuesta = "Aqui va el valor que retorna la consulta 1 por estado->".$datos->estado;
					}else{
						$respuesta = "Aqui va el valor que retorna la consulta 1 sin region";
					}
				}
				break;
			case 2:
				$respuesta = "Aqui va el valor que retorna la consulta 2";
				break;
			case 3:
				$respuesta = "Aqui va el valor que retorna la consulta 3";
				break;
			case 4:
				$respuesta = "Aqui va el valor que retorna la consulta 4";
				break;
			case 5:
				$respuesta = "Aqui va el valor que retorna la consulta 5";
				break;
			default:
				$respuesta = "";
				break;
		}
		return $respuesta;
	}
}
