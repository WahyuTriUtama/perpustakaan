<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Anggota extends MY_Controller
{
    protected $access = 'user';

    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','anggota_model','kelas_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $anggota = $this->anggota_model->get_all();

        $data = array(
            'anggota_data' => $anggota,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Anggota',
            'content' => 'anggota/anggota_list',
        );

        $this->load->view('template', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('anggota/create_action'),
    	    'id_anggota' => set_value('id_anggota'),
    	    'NIS' => set_value('NIS'),
    	    'nama' => set_value('nama'),
    	    'gender' => set_value('gender'),
    	    'kelas' => set_value('kelas'),
    	    'alamat' => set_value('alamat'),
    	    'hp' => set_value('hp'),
            'dt_kelas' => $this->kelas_model->get_all(),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Anggota',
            'content' => 'anggota/anggota_form',
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
        		'NIS' => $this->input->post('NIS',TRUE),
        		'nama' => $this->input->post('nama',TRUE),
        		'gender' => $this->input->post('gender',TRUE),
        		'kelas' => $this->input->post('kelas',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'hp' => $this->input->post('hp',TRUE),
        	    );

            $this->anggota_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('anggota/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->anggota_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('anggota/update_action'),
        		'id_anggota' => set_value('id_anggota', $row->id_anggota),
        		'NIS' => set_value('NIS', $row->NIS),
        		'nama' => set_value('nama', $row->nama),
        		'gender' => set_value('gender', $row->gender),
        		'id_kelas' => set_value('kelas', $row->kelas),
        		'alamat' => set_value('alamat', $row->alamat),
        		'hp' => set_value('hp', $row->hp),
                'dt_kelas' => $this->kelas_model->get_all(),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Anggota',
                'content' => 'anggota/anggota_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('anggota'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_anggota', TRUE));
        } else {
            $data = array(
        		'NIS' => $this->input->post('NIS',TRUE),
        		'nama' => $this->input->post('nama',TRUE),
        		'gender' => $this->input->post('gender',TRUE),
        		'kelas' => $this->input->post('kelas',TRUE),
        		'alamat' => $this->input->post('alamat',TRUE),
        		'hp' => $this->input->post('hp',TRUE),
        	    );

            $this->anggota_model->update($this->input->post('id_anggota', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('anggota/update/'.$this->input->post('id_anggota', TRUE)));
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->anggota_model->get_by_id($id);

            if ($row) {
                $this->anggota_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('anggota'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('anggota'));
            }
        } else {
            show_404();
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('NIS', ' ', 'trim|required|numeric|exact_length[4]');
    	$this->form_validation->set_rules('nama', ' ', 'trim|required');
    	$this->form_validation->set_rules('gender', ' ', 'trim|required');
    	$this->form_validation->set_rules('kelas', ' ', 'trim|required');
    	$this->form_validation->set_rules('alamat', ' ', 'trim|required');
    	$this->form_validation->set_rules('hp', ' ', 'trim|required|numeric');

    	$this->form_validation->set_rules('id_anggota', 'id_anggota', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Anggota.xls";
        $judul = "Data Anggota";
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
        xlsWriteLabel($tablehead, $kolomhead++, "No");
    	xlsWriteLabel($tablehead, $kolomhead++, "NIS");
    	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
    	xlsWriteLabel($tablehead, $kolomhead++, "Gender");
    	xlsWriteLabel($tablehead, $kolomhead++, "Kelas");
    	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Telp.");

    	foreach ($this->anggota_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->NIS);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->gender);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->kelas);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->hp);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */