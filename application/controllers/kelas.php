<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('level') == 'user') {
            show_404();
        }
        $this->load->model(array('user_model','kelas_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $kelas = $this->kelas_model->get_all();

        $data = array(
            'kelas_data' => $kelas,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Kelas',
            'content' => 'kelas/kelas_list',
        );

        $this->load->view('template', $data);
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('kelas/create_action'),
    	    'id_kelas' => set_value('id_kelas'),
    	    'kelas' => set_value('kelas'),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Kelas',
            'content' => 'kelas/kelas_form',
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
        		'kelas' => $this->input->post('kelas',TRUE),
        	    );

            $this->kelas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelas/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->kelas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('kelas/update_action'),
        		'id_kelas' => set_value('id_kelas', $row->id_kelas),
        		'kelas' => set_value('kelas', $row->kelas),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Kelas',
                'content' => 'kelas/kelas_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelas', TRUE));
        } else {
            $data = array(
        		'kelas' => $this->input->post('kelas',TRUE),
        	    );

            $this->kelas_model->update($this->input->post('id_kelas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelas/update/'.$this->input->post('id_kelas', TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->kelas_model->get_by_id($id);

        if ($row) {
            $this->kelas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelas'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('kelas', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_kelas', 'id_kelas', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file kelas.php */
/* Location: ./application/controllers/kelas.php */