<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeneraJSON extends CI_Controller {

	public function index(){

		$this->load->view('mapa_mex/index');
		$this->data['mapaRegion'] = $this->mapa(1);//Pinta la region
		$this->data['mapaEstado'] = $this->mapa(1, true);//Pinta el estado
		$this->data['graficas'] = $this->charts(1);//Pinta la grafica
		$this->load->view('welcome_message', $this->data);
		
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
		$legend->area->mode = 'vertical';
		$legend->area->slices = array();

		//CONSULTA DE LAS REGIONES
		$consultaReg=$this->db->query('
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
			WHERE e.est_nombre LIKE "%' . $entrada . '%"';
		} elseif ( !empty($entrada) && $entrada > 0 && $entrada <= 9 ) {
			$sqlMapa .= '
			WHERE r.reg_nombre LIKE "%' . $entrada . '%"';
		}
		$sqlMapa .= '
			ORDER BY e.est_nombre;';

		$consultaEst=$this->db->query($sqlMapa);

		$areas = new stdClass();
		foreach ($consultaEst->result() as $fila){
			$areas->{$fila->est_nombre} = new stdClass();
			$areas->{$fila->est_nombre}->value = $fila->reg_id;
			$areas->{$fila->est_nombre}->href = '#';
			$areas->{$fila->est_nombre}->tooltip = new stdClass();
			$areas->{$fila->est_nombre}->tooltip->content = htmlentities(
				//'<span style=\'font-weight:bold;\'>' . $fila->reg_id . '</span><br>' . $fila->est_nombre
				$fila->reg_id . ' - ' . $fila->est_nombre
			);
		}

		$mapa = new stdClass();
		$mapa->map = $map;
		$mapa->legend = $legend;
		$mapa->areas = $areas;

		echo json_encode($areas, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

	public function charts($pregunta, array $opciones = NULL){

		if ($opciones != NULL) {
			$region = array_key_exists('region', $opciones) ? $opciones['region'] : '';
			$estado = array_key_exists('estado', $opciones) ? $opciones['estado'] : '';
			$mes = array_key_exists('mes', $opciones) ? $opciones['mes'] : '';
			$anio = array_key_exists('anio', $opciones) ? $opciones['anio'] : '';
			$top = array_key_exists('top', $opciones) ? $opciones['top'] : '';
			$f_inicial = array_key_exists('f_inicial', $opciones) ? $opciones['f_inicial'] : '';
			$f_final = array_key_exists('f_final', $opciones) ? $opciones['f_final'] : '';
			$rol = array_key_exists('rol', $opciones) ? $opciones['rol'] : '';
			$condicional = array_key_exists('condicional', $opciones) ? $opciones['condicional'] : '';
		}

		$chart = array();

		switch ($pregunta) {
			case 1:
				$sql = '
					SELECT  tfv_id, tfv_nombre, ven_fecha, ven_monto, pln_nombre
					FROM cat_venta
						INNER JOIN cat_FuerzaVenta USING (fve_id)
						INNER JOIN cat_TipoFuerzaVenta USING (tfv_id)
						INNER JOIN cat_cuenta USING (cta_id)
						INNER JOIN cat_numero USING (num_id)
						INNER JOIN cat_plan USING (pln_id)
					WHERE
						pln_nombre = "TELCEL PREPAGO"';

				if (!empty($f_inicial) && !empty($f_final)) {
					$sql .= '
						AND ven_fecha BETWEEN "' . $f_inicial . '" AND "' . $f_final . '"';
				}

				$sql .= '
					ORDER BY ven_monto DESC
					LIMIT 0 , 5;';
		
				$resultado = $this->db->query($sql);

				foreach ($resultado->result() as $fila){
					$props = new stdClass();
					$props->category = htmlentities($fila->tfv_nombre);
					$props->value1 = $fila->ven_monto;
					array_push($chart, $props);
				}
				break;

			case 2:
				$sql = '
					SELECT reg_id, reg_nombre, count(num_id) totalLineas, #fac_fecha,
						vin_observacion Movimiento#, vin_fecha fechaMovimiento
					FROM cat_venta
						INNER JOIN cat_cuenta USING(cta_id)
						INNER JOIN cat_plan USING(pln_id)
						INNER JOIN vin_movimientoCuenta USING(cta_id)
						INNER JOIN cat_movimiento USING(mov_id)
						INNER JOIN cat_factura USING(ven_id)
						INNER JOIN cat_estado USING(est_id)
						INNER JOIN cat_region USING(reg_id)
						INNER JOIN cat_coordenada USING(est_id)
					WHERE pln_id=3 #PREPAGO
						AND mov_id=1
						AND vin_observacion="PRIMERA RECARGA"';

				if (!empty($mes)) {
					$sql .= '
						AND MONTH(fac_fecha) = ' . $mes;
				}

				if (!empty($anio)) {
					$sql .= '
						AND YEAR(fac_fecha) = ' . $anio;
				}

				if (!empty($f_inicial) && !empty($f_final)) {
					$sql .= '
						AND vin_fecha BETWEEN "' . $f_inicial . '" AND "' . $f_final . '"';
				}

				$sql .= '
					GROUP BY reg_id ORDER BY reg_id;';
		
				$resultado = $this->db->query($sql);

				foreach ($resultado->result() as $fila){
					$props = new stdClass();
					$props->category = $fila->reg_nombre;
					$props->value1 = $fila->totalLineas;
					array_push($chart, $props);
				}
				break;

			case 3:
				$sql = '
					SELECT reg_id, reg_nombre, count(num_id) totalLineas#, fac_fecha
					FROM cat_venta
						INNER JOIN cat_cuenta USING(cta_id)
						INNER JOIN cat_plan USING(pln_id) # plan prepago
						INNER JOIN cat_factura USING(ven_id)
						INNER JOIN cat_estado USING(est_id)
						INNER JOIN cat_region USING(reg_id)
						INNER JOIN cat_coordenada USING(est_id)
						INNER JOIN cat_empleado USING(emp_id)
					WHERE pln_id=3 # telcel pregado
						AND rol_id = 3 # rol empleado LIDER
			      ';

				if (!empty($mes)) {
					$sql .= '
						AND MONTH(fac_fecha) = ' . $mes;
				}

				if (!empty($anio)) {
					$sql .= '
						AND YEAR(fac_fecha) = ' . $anio;
				}

				$sql .= '
					GROUP BY reg_id ORDER BY count(num_id) ASC;';
		
				$resultado = $this->db->query($sql);

				foreach ($resultado->result() as $fila){
					$props = new stdClass();
					$props->category = $fila->reg_nombre;
					$props->value1 = $fila->totalLineas;
					array_push($chart, $props);
				}
				break;

		}
		
		/*$chart = array();
		for ($i=0; $i < 10; $i++) {			
			$props = new stdClass();
			$props->category = '2013-08-' . ($i+1);
			$props->value1 = $i+417;
			$props->value2 = $i+127;
			array_push($chart, $props);	
		}*/

		echo json_encode($chart, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	}

}

/* End of file GeneraJSON.php */
/* Location: ./application/controllers/GeneraJSON.php */