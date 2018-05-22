<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneraJSON {

	public function __construct(){
		$cred = new Credentials();
		$con = array();
		$con = $cred->conexion();
		$this->CI =& get_instance();
		$this->CI->load->database($con);
	}
	
	public function mapa($entrada = '', $estado = false){

		$map = new stdClass();
		$map->name = 'mexico';
		$map->zoom = new stdClass();
		$map->zoom->enabled = 'true';
		$map->zoom->maxLevel = 10;

		$legend = new stdClass();
		$legend->area = new stdClass();
		$legend->area->display = true;
		$legend->area->title = 'REGIONES DE VENTA TELCEL';
		$legend->area->mode = 'horizontal';
		$legend->area->slices = array();

		//CONSULTA DE LAS REGIONES
		$consultaReg=$this->CI->db->query('
			SELECT r.reg_id, r.reg_nombre, r.reg_color, 
				CONCAT(r.reg_nombre," - ", GROUP_CONCAT(e.est_abreviatura SEPARATOR ", ")) AS est
			FROM telcel.cat_region AS r
			INNER JOIN telcel.cat_estado AS e USING (reg_id)
			GROUP BY reg_id;
		');

		foreach ($consultaReg->result() as $fila){

			$slices = new stdClass();
			$slices->max = $fila->reg_id;
			$slices->min = $fila->reg_id;
			$slices->attrs = new stdClass();
			$slices->attrs->fill = '#' . $fila->reg_color;
			$slices->label = $fila->est;
			array_push($legend->area->slices, $slices);

		}

		//CONSULTA DE LOS ESTADOS
		$sqlMapa = '
			SELECT e.est_id, e.est_nombre, r.reg_id, r.reg_nombre
			FROM telcel.cat_estado AS e
			INNER JOIN telcel.cat_region AS r USING (reg_id)';

		if ($estado && !empty($entrada) && $entrada > 0 && $entrada <= 32) {
			$sqlMapa .= '
			WHERE e.est_id = ' . $entrada;
		} elseif ( !empty($entrada) && $entrada > 0 && $entrada <= 9 ) {
			$sqlMapa .= '
			WHERE r.reg_id = ' . $entrada;
		}
		$sqlMapa .= '
			ORDER BY e.est_nombre;';

		$consultaEst=$this->CI->db->query($sqlMapa);

		$areas = new stdClass();
		foreach ($consultaEst->result() as $fila){
			$areas->{$fila->est_nombre} = new stdClass();
			$areas->{$fila->est_nombre}->value = $fila->reg_id;
			$areas->{$fila->est_nombre}->href = '#';
			$areas->{$fila->est_nombre}->tooltip = new stdClass();
			$areas->{$fila->est_nombre}->tooltip->content = htmlentities(
				$fila->reg_id . '<br>' . $fila->est_nombre
			);
		}

		$mapa = new stdClass();
		$mapa->map = $map;
		$mapa->legend = $legend;
		$mapa->areas = $areas;

		return json_encode($mapa, JSON_PRETTY_PRINT);
	}

	public function charts(){
		$chart = array();
		
		for ($i=0; $i < 10; $i++) {			
			$props = new stdClass();
			$props->category = '2013-08-' . ($i+1);
			$props->value1 = $i+417;
			$props->value2 = $i+127;
			array_push($chart, $props);	
		}

		return json_encode($chart, JSON_PRETTY_PRINT);
	}
}

/* End of file GeneraJSON.php */
/* Location: ./application/libraries/GeneraJSON.php */