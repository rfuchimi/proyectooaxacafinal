<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CatVenta extends MY_Model {

	protected $_table_name = 'cat_venta';
	protected $_primary_key = 'ven_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'ven_id';
	public $_rules = array(
		'ven_monto' => array(
			'field' => 'ven_monto',
			'label' => 'monto',
			'rules' => 'trim|required'
			),
		'ven_fecha' => array(
			'field' => 'ven_fecha',
			'label' => 'fecha',
			'rules' => 'trim|required'
			),
		'cta_id' => array(
			'field' => 'cta_id',
			'label' => 'cuenta',
			'rules' => 'trim|required'
			),
		'fve_id' => array(
			'field' => 'fve_id',
			'label' => 'fuerza venta',
			'rules' => 'trim|required'
			)
		);

	public function get_new(){
		$obj = new stdClass();
		$obj->ven_monto = '';
		$obj->ven_fecha = '';
		$obj->cta_id = '';
		$obj->fve_id = '';
		return $obj;
	}
}

/* End of file CatVenta.php */
/* Location: ./application/models/CatVenta.php */