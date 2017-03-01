<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penerbit extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','penerbit_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $penerbit = $this->penerbit_model->get_all();

        $data = array(
            'penerbit_data' => $penerbit,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Penerbit',
            'content' => 'penerbit/penerbit_list',
        );

        $this->load->view('template', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('penerbit/create_action'),
    	    'id_penerbit' => set_value('id_penerbit'),
    	    'penerbit' => set_value('penerbit'),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Penerbit',
            'content' => 'penerbit/penerbit_form',
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
        		'penerbit' => $this->input->post('penerbit',TRUE),
        	    );

            $this->penerbit_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('penerbit/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->penerbit_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('penerbit/update_action'),
        		'id_penerbit' => set_value('id_penerbit', $row->id_penerbit),
        		'penerbit' => set_value('penerbit', $row->penerbit),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Penerbit',
                'content' => 'penerbit/penerbit_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penerbit'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_penerbit', TRUE));
        } else {
            $data = array(
        		'penerbit' => $this->input->post('penerbit',TRUE),
        	    );

            $this->penerbit_model->update($this->input->post('id_penerbit', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penerbit/update/'.$this->input->post('id_penerbit', TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->penerbit_model->get_by_id($id);

        if ($row) {
            $this->penerbit_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penerbit'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penerbit'));
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('penerbit', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_penerbit', 'id_penerbit', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "penerbit.xls";
        $judul = "penerbit";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "penerbit");

    	foreach ($this->penerbit_model->get_all() as $data) {
                $kolombody = 0;

                //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->penerbit);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file penerbit.php */
/* Location: ./application/controllers/penerbit.php */