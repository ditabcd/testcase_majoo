<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->library('user_agent');
	}

	public function index()
	{
		$data['users_data'] = $this->db
            ->get('tb_produk')
            ->result();
		$this->load->view('home/index', $data);
	}


}