<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','kategori_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $kategori = $this->kategori_model->get_all();

        $data = array(
            'kategori_data' => $kategori,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Kategori Buku',
            'content' => 'kategori/kategori_list',
        );

        $this->load->view('template', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('kategori/create_action'),
    	    'id_kategori' => set_value('id_kategori'),
    	    'kategori' => set_value('kategori'),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Kategori Buku',
            'content' => 'kategori/kategori_form',
    	);
        $this->load->view('template', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'kategori' => $this->input->post('kategori',TRUE),
        	    );

            $this->kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kategori/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('kategori/update_action'),
        		'id_kategori' => set_value('id_kategori', $row->id_kategori),
        		'kategori' => set_value('kategori', $row->kategori),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Kategori Buku',
                'content' => 'kategori/kategori_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori/create'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kategori', TRUE));
        } else {
            $data = array(
        		'kategori' => $this->input->post('kategori',TRUE),
        	    );

            $this->kategori_model->update($this->input->post('id_kategori', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kategori/update/'.$this->input->post('id_kategori', TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->kategori_model->get_by_id($id);

        if ($row) {
            $this->kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kategori'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('kategori', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */