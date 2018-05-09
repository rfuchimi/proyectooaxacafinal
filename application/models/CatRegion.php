<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CatRegion extends MY_Model {

	protected $_table_name = 'cat_region';
	protected $_primary_key = 'reg_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'reg_id';
	public $_rules = array(
		'reg_nombre' => array(
			'field' => 'reg_nombre',
			'label' => 'nombre',
			'rules' => 'trim|required'
			),
		'reg_descripcion' => array(
			'field' => 'reg_descripcion',
			'label' => 'descripcion',
			'rules' => 'trim|required'
			)
		);

	public function get_new(){
		$obj = new stdClass();
		$obj->reg_nombre = '';
		$obj->reg_descripcion = '';
		return $obj;
	}
}

/* End of file CatRegion.php */
/* Location: ./application/models/CatRegion.php */