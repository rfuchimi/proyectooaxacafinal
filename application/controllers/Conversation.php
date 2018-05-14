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

			if(isset($data_array['output']['datos']['pintaDate'])){
				$data_array['chat_ui']['datepicker'] = true;

				//Fechas estaticas en lo que se realiza con los datapiker en la interfaz
				$data_array['context']["f_inicial"] = '2017-12-15' ;
				$data_array['context']["f_final"] = '2018-01-15';
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
							$salida[$i] = $respuesta['text'];
						}else{
							$salida[$i] = $data_array['output']['text'][$i-1];
						}
					}
					$data_array['output']['text']=$salida;
				}else{
					$data_array['output']['text'][]=$respuesta['text'];
				}
				if(isset($respuesta['data'])){
					$data_array['charts'] = $respuesta['data'];	
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
				$num_mes=$this->numMes($datos->mes);
				$top = $this->numTop($datos->top);

				if(isset($datos->region)){
					$respuesta["text"] = "Aqui va el valor que retorna la consulta 1 por region->".$datos->region;
				}else{
					if(isset($datos->estado)){
						$respuesta["text"] = "Aqui va el valor que retorna la consulta 1 por estado->".$datos->estado;
					}else{
						$sql = "
						SELECT  tfv_nombre, ven_monto
						FROM cat_venta
							JOIN cat_FuerzaVenta USING (fve_id)
							JOIN cat_TipoFuerzaVenta USING (tfv_id)
							JOIN cat_cuenta USING (cta_id)
							JOIN cat_numero USING (num_id)
							JOIN cat_plan USING (pln_id)
						WHERE MONTH(ven_fecha) = $num_mes AND YEAR(ven_fecha) = $datos->anio
							AND pln_nombre = 'TELCEL PREPAGO'
						ORDER BY ven_monto DESC
						LIMIT $top;
						";
						$query=$this->db->query($sql);
						$respuesta["text"]= "El top $top del fueza de venta en ".$datos->mes." de ".$datos->anio." se muestra en la grafica";
						$respuesta["data"] = $query->result();
					}
				}
				break;
			case 2:
				$respuesta["text"] = "Aqui va el valor que retorna la consulta 2";
				break;
			case 3:
				$respuesta["text"] = "Aqui va el valor que retorna la consulta 3";
				break;
			case 4:
				$respuesta["text"] = "Aqui va el valor que retorna la consulta 4";
				break;
			case 5:
				$respuesta["text"] = "Aqui va el valor que retorna la consulta 5";
				break;
			default:
				$respuesta["text"] = "No hay respuesta para la pregunta".$datos->pregunta;
				break;
		}
		return $respuesta;
	}

	private function numMes($mes){
		switch ($mes) {
			case 'enero':
				$num = 1;
				break;
			case 'febrero':
				$num = 2;
				break;
			case 'marzo':
				$num = 3;
				break;
			case 'abril':
				$num = 4;
				break;
			case 'mayo':
				$num = 5;
				break;
			case 'junio':
				$num = 6;
				break;
			case 'julio':
				$num = 7;
				break;
			case 'agosto':
				$num = 8;
				break;
			case 'septiembre':
				$num = 9;
				break;
			case 'octubre':
				$num = 10;
				break;
			case 'noviembre':
				$num = 11;
				break;
			case 'diciembre':
				$num = 12;
				break;
		}
		return $num;

	}

	private function numTop($top){
		switch ($top) {
			case 'limit5':
				$num = 5;
				break;
			case 'limit10':
				$num = 5;
				break;
		}
		return $num;
	}
}
