<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_admin extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index()
    {
        $data['users_data'] = $this->db
            ->get('tb_produk')
            ->result();
        $this->load->view('admin/product_admin/index', $data);
    }

    public function insert()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span class='text-danger'>","</span>");

        $this->form_validation->set_rules('nama_produk', 'nama_produk', 'trim|required|is_unique[tb_produk.nama_produk]');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        // $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|min_length[8]');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/product_admin/insert');
        } else {
            $error = false;
            if ($_FILES['gambar']['name'] != "") {
                $config['upload_path']          = './storage/product/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $config['file_ext_tolower']     = true;
                $config['encrypt_name']         = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $data['error_gambar'] = $this->upload->display_errors('', '');
                    $this->load->view('admin/product_admin/insert', $data);
                    $error = true;
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }else{
                $gambar = "default.png";
            }

            if(!$error){
                $set_users = [
                    'nama_produk' => $this->input->post('nama_produk'),
                    'harga' => $this->input->post('harga'),
                    'deskripsi' => $this->input->post('deskripsi'),
                ];
                $this->db->insert('tb_produk', $set_users);
                $insert_id = $this->db->insert_id();

                
                $set_users = [
                    'gambar' => $gambar
                ];
                $this->db
                    ->where('id', $insert_id)
                    ->update('tb_produk', $set_users);

                redirect("Product_admin");
            }
            
        }
    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span class='text-danger'>","</span>");


        $users_data = $this->db
            ->where('id', $id)
            ->get('tb_produk')
            ->row(0);

        $unique_nama_produk = "";
        if ($this->input->post('username') != $users_data->nama_produk) {
        $unique_nama_produk = '|is_unique[tb_produk.nama_produk]';
        }

        $this->form_validation->set_rules('nama_produk', 'nama_produk', 'trim|required|is_unique[tb_produk.nama_produk]');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('gambar', 'gambar', 'callback_upload_gambar[' . $id . ']');

        if ($this->form_validation->run() == false) {
            $users_data = $this->db
                ->where('id', $id)
                ->get('tb_produk')
                ->row(0);
            $data['users_data'] = $users_data;
            $this->load->view('admin/product_admin/update', $data);
        } else {
            $set_users = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi'),
            ];

            $this->db
                ->where('id', $id)
                ->update('tb_produk', $set_users);

            redirect('Product_admin');
        }
    }


    function upload_gambar($gambar, $id)
    {
        if ($_FILES['gambar']['name'] != "") {
            $config['upload_path']          = './storage/product/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['file_ext_tolower']     = true;
            $config['encrypt_name']         = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->form_validation->set_message('upload_gambar', "{field} : " . $this->upload->display_errors('', ''));
                return false;
            } else {
                $users_data = $this->db
                    ->where('id', $id)
                    ->get('tb_produk')
                    ->row(0);
                if ($users_data->gambar != 'default.png') {
                    unlink('storage/product/' . $users_data->gambar);
                }

                $set_users = [
                    'gambar' => $this->upload->data('file_name')
                ];
                $this->db
                    ->where('id', $id)
                    ->update('tb_produk', $set_users);

                $session_data = $this->session->userdata('userlogin');
                $session_data['gambar'] = $this->upload->data('file_name');
                $this->session->set_userdata('userlogin', $session_data);
            }
        }
        return true;
    }

    public function delete($id_users)
    {
        ##unlink gambar
        $users_data = $this->db
            ->where('id', $id_users)
            ->get('tb_produk')
            ->row(0);
        if ($users_data->gambar != 'default.png') {
            unlink('storage/product/' . $users_data->gambar);
        }

        $this->db
            ->where('id', $id_users)
            ->delete('tb_produk');

        redirect("Product_admin");
    }

}
