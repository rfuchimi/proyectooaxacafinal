<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{		
		$query=$this->db->query("SELECT * FROM cat_estado");
		foreach ($query->result() as $row)
		{
	        echo $row->estado_id." ";
	        echo $row->est_nombre."<BR>";
		}
		$this->load->view('welcome_message');
	}
}
