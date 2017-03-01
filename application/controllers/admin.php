<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','kategori_model','anggota_model','buku_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
    	redirect(site_url('admin/welcome'));
	}

    public function welcome()
    {
        $now = date("d m Y");        
        $data = array(
            'dt_kategori' => $this->kategori_model->total_rows(),
            'dt_anggota' => $this->anggota_model->total_rows(),
            'dt_buku' => $this->buku_model->total_rows(),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Home',
            'content' => 'home/welcome',
        );
        $this->load->view('template', $data);
    }

    public function logout()
    {   
        $this->session->sess_destroy('logged_in');
        $this->session->sess_destroy('username');
        $this->session->sess_destroy('level');
        session_destroy();
        redirect(site_url('home'),'refresh');
    }

};


/* End of file admin.php */
/* Location: ./application/controllers/admin.php */