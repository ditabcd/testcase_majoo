<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->library('user_agent');
	}

	public function index()
	{
		if ($this->session->userdata('username')==true) {
			redirect('product_admin');
		} else {
			$this->load->view('login');
			}

	}

	public function cek_login($username,$password){
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('username', $username);
		$this->db->where('password',$password);
		return $this->db->get()->row();
	}

	public function aksi_login()
	{
		$user=$this->input->post('username');
		$pass=$this->input->post('password');
		$cek=$this->cek_login($user,$pass);
		if ($cek>0) {
			$data_session=array(
				'id'=>$cek->id,
				'username'=>$cek->username,
			);
			$this->session->set_userdata($data_session);
			if($this->session->userdata('username')==$username){
				redirect('admin/product_admin/');
		} else{
			redirect('login');
		}
	}
		}

	public function register()
	{
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('register');
        } else {
            $set_users = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
            ];
            $this->db->insert('tb_user', $set_users);

            redirect("login");
        }
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
