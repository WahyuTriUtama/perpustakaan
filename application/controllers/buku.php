<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Buku extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','buku_model','kategori_model','penerbit_model','pengarang_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $buku = $this->buku_model->get_all();

        $data = array(
            'buku_data' => $buku,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Buku',
            'content' => 'buku/buku_list',
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->buku_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button'=> 'View',
        		'id_buku' => $row->id_buku,
        		'judul' => $row->judul,
        		'id_kategori' => $row->kategori,
        		'id_pengarang' => $row->pengarang,
        		'id_penerbit' => $row->penerbit,
        		'thn_terbit' => $row->thn_terbit,
        		'stok' => $row->stok,
        		'st_out' => $row->st_out,
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Buku',
                'content' => 'buku/buku_read',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku'));
        }
    }
    
    public function create() 
    {
        $kode = $this->buku_model->get_last_id();
        if ($kode) {
            $cut_code = substr($kode->id_buku, 2, 4);
            $k = $cut_code+1;
            if ($k == 1) {
                $kode1 = "BK1001";
            }else{
                $kode1 = "BK".$k;
            }
        }else{
            $kode1 = "BK1001";
        }

        $data = array(
            'button' => 'Tambah',
            'action' => site_url('buku/create_action'),
    	    'id_buku' => $kode1,
    	    'judul' => set_value('judul'),
    	    'id_kategori' => set_value('id_kategori'),
    	    'id_pengarang' => set_value('id_pengarang'),
    	    'id_penerbit' => set_value('id_penerbit'),
    	    'thn_terbit' => set_value('thn_terbit'),
    	    'stok' => set_value('stok'),
    	    'st_out' => set_value('st_out'),
            'dt_kategori' => $this->kategori_model->get_all(),
            'dt_penerbit' => $this->penerbit_model->get_all(),
            'dt_pengarang' => $this->pengarang_model->get_all(),
            'kode' => $kode1,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Buku',
            'content' => 'buku/buku_form',
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
                'id_buku' => $this->input->post('id_buku', TRUE),
        		'judul' => $this->input->post('judul',TRUE),
        		'id_kategori' => $this->input->post('id_kategori',TRUE),
        		'id_pengarang' => $this->input->post('id_pengarang',TRUE),
        		'id_penerbit' => $this->input->post('id_penerbit',TRUE),
        		'thn_terbit' => $this->input->post('thn_terbit',TRUE),
        		'stok' => $this->input->post('stok',TRUE),
        		'st_out' => '0',
        	    );

            $this->buku_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('buku/create'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->buku_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('buku/update_action'),
        		'id_buku' => set_value('id_buku', $row->id_buku),
        		'judul' => set_value('judul', $row->judul),
        		'id_kategori' => set_value('id_kategori', $row->id_kategori),
        		'id_pengarang' => set_value('id_pengarang', $row->id_pengarang),
        		'id_penerbit' => set_value('id_penerbit', $row->id_penerbit),
        		'thn_terbit' => set_value('thn_terbit', $row->thn_terbit),
        		'stok' => set_value('stok', $row->stok),
        		'st_out' => set_value('st_out', $row->st_out),
                'dt_kategori' => $this->kategori_model->get_all(),
                'dt_penerbit' => $this->penerbit_model->get_all(),
                'dt_pengarang' => $this->pengarang_model->get_all(),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Buku',
                'content' => 'buku/buku_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('buku'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_buku', TRUE));
        } else {
            $data = array(
        		'judul' => $this->input->post('judul',TRUE),
        		'id_kategori' => $this->input->post('id_kategori',TRUE),
        		'id_pengarang' => $this->input->post('id_pengarang',TRUE),
        		'id_penerbit' => $this->input->post('id_penerbit',TRUE),
        		'thn_terbit' => $this->input->post('thn_terbit',TRUE),
        		'stok' => $this->input->post('stok',TRUE),
        	    );

            $this->buku_model->update($this->input->post('id_buku', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('buku'));
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->buku_model->get_by_id($id);

            if ($row) {
                $this->buku_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('buku'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('buku'));
            }
        } else {
            show_404();
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('judul', ' ', 'trim|required');
    	$this->form_validation->set_rules('id_kategori', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('id_pengarang', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('id_penerbit', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('thn_terbit', ' ', 'trim|required|numeric|exact_length[4]');
    	$this->form_validation->set_rules('stok', ' ', 'trim|required|numeric');

    	$this->form_validation->set_rules('id_buku', ' ', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Buku.xls";
        $judul = "Data Buku";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Judul");
    	xlsWriteLabel($tablehead, $kolomhead++, "Kategori");
    	xlsWriteLabel($tablehead, $kolomhead++, "Pengarang");
    	xlsWriteLabel($tablehead, $kolomhead++, "Penerbit");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Terbit");
    	xlsWriteLabel($tablehead, $kolomhead++, "Stok");
    	xlsWriteLabel($tablehead, $kolomhead++, "Dipinjam");

    	foreach ($this->buku_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->judul);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->kategori);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->pengarang);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->penerbit);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->thn_terbit);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->stok);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->st_out);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file buku.php */
/* Location: ./application/controllers/buku.php */