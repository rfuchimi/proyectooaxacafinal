<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function index(){
		$generaJSON = new GeneraJSON();

		$this->load->view('mapa_mex/index');
		$this->data['mapaRegion'] = $generaJSON->mapa(1);//Pinta la region
		$this->data['mapaEstado'] = $generaJSON->mapa(1, true);//Pinta el estado
		$this->data['graficas'] = $generaJSON->charts();//Pinta la grafica
		$this->load->view('welcome_message', $this->data);
	}
}
