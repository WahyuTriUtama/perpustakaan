<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','pengarang_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $pengarang = $this->pengarang_model->get_all();

        $data = array(
            'pengarang_data' => $pengarang,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Pengarang',
            'content' => 'pengarang/pengarang_list',
        );

        $this->load->view('template', $data);
    }
    
    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('pengarang/create_action'),
    	    'id_pengarang' => set_value('id_pengarang'),
    	    'pengarang' => set_value('pengarang'),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Pengarang',
            'content' => 'pengarang/pengarang_form',
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
        		'pengarang' => $this->input->post('pengarang',TRUE),
        	    );

            $this->pengarang_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengarang/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->pengarang_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('pengarang/update_action'),
        		'id_pengarang' => set_value('id_pengarang', $row->id_pengarang),
        		'pengarang' => set_value('pengarang', $row->pengarang),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Pengarang',
                'content' => 'pengarang/pengarang_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengarang'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengarang', TRUE));
        } else {
            $data = array(
        		'pengarang' => $this->input->post('pengarang',TRUE),
        	    );

            $this->pengarang_model->update($this->input->post('id_pengarang', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengarang/update/'.$this->input->post('id_pengarang', TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->pengarang_model->get_by_id($id);

        if ($row) {
            $this->pengarang_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengarang'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengarang'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('pengarang', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_pengarang', 'id_pengarang', 'trim');
	    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pengarang.xls";
        $judul = "pengarang";
        $tablehead = 2;
        $tablebody = 3;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        xlsWriteLabel(0, 0, $judul);

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "no");
    	xlsWriteLabel($tablehead, $kolomhead++, "pengarang");

    	foreach ($this->pengarang_model->get_all() as $data) {
                $kolombody = 0;

                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->pengarang);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file pengarang.php */
/* Location: ./application/controllers/pengarang.php */