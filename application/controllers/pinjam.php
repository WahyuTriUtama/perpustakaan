<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pinjam extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','buku_model','pinjam_model','anggota_model','kelas_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $pinjam = $this->pinjam_model->get_all();

        $data = array(
            'pinjam_data' => $pinjam,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Peminjam Buku',
            'content' => 'pinjam/pinjam_list',
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->pinjam_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'View',
        		'id_pinjam' => $row->id_pinjam,
        		'id_anggota' => $row->NIS,
                'nama' => $row->nama,
                'kelas' => $this->kelas_model->get_by_id($row->kelas)->kelas,
                'hp' => $row->hp,
        		'tgl_pinjam' => $row->tgl_pinjam,
        		'tgl_kembali' => $row->tgl_kembali,
        		'id_buku' => $row->id_buku,
                'judul' => $row->judul,
                'kategori' => $row->kategori,
                'pengarang' => $row->pengarang,
                'penerbit' => $row->penerbit,
                'thn' => $row->thn_terbit,
        		'status' => $row->status,
        		'petugas' => $this->user_model->get_by_id($row->petugas)->nama,
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Peminjam Buku',
                'content' => 'pinjam/pinjam_read',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pinjam'));
        }
    }
    
    public function create() 
    {
        $now = date('Y');
        $kode = $this->pinjam_model->get_last_id();
        if ($kode) {
            $cut_code = substr($kode->id_pinjam, 8, 4);
            $k = $cut_code+1;
            if ($k == 1) {
                $kode1 = "PJ-".$now."-1001";
            }else{
                $kode1 = "PJ-".$now."-".$k;
            }
        }else{
            $kode1 = "PJ-".$now."-1001";
        }
        $today = date("d-m-Y");
        $seven      = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
        $back        = date("d-m-Y", $seven);
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('pinjam/create_action'),
    	    'id_pinjam' => $kode1,
    	    'id_anggota' => set_value('id_anggota'),
    	    'tgl_pinjam' => $today,
    	    'tgl_kembali' => $back,
    	    'id_buku' => set_value('id_buku'),
    	    'status' => set_value('status'),
    	    'petugas' => $this->user_model->get_by_username($this->session->userdata('username'))->nama,
            'dt_anggota' => $this->anggota_model->get_all(),
            'dt_buku' => $this->buku_model->get_all(),
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Peminjam Buku',
            'content' => 'pinjam/pinjam_form',
    	);
        $this->load->view('template', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $row = $this->buku_model->get_by_id($this->input->post('id_buku',TRUE));
            if ($row->stok >= 1) {
                if ($row->stok <> $row->st_out) {
                    $data = array(
                        'id_pinjam' => $this->input->post('id_pinjam',TRUE),
                        'id_anggota' => $this->input->post('id_anggota',TRUE),
                        'tgl_pinjam' => $this->input->post('tgl_pinjam',TRUE),
                        'tgl_kembali' => $this->input->post('tgl_kembali',TRUE),
                        'id_buku' => $this->input->post('id_buku',TRUE),
                        'status' => '1',
                        'petugas' => $this->user_model->get_by_username($this->session->userdata('username'))->id_user,
                        );

                    $this->pinjam_model->insert($data);

                    $data2 = array('st_out' => $row->st_out+1);
                    $this->buku_model->update($this->input->post('id_buku', TRUE), $data2);

                    $this->session->set_flashdata('message', 'Create Record Success');
                    redirect(site_url('pinjam/create'));
                } else {
                    $this->session->set_flashdata('message', 'Stok buku kosong!');
                    redirect(site_url('pinjam/create'));
                }
                
            } else {
                $this->session->set_flashdata('message', 'Stok buku kosong!');
                redirect(site_url('pinjam/create'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->pinjam_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Edit',
                'action' => site_url('pinjam/update_action'),
        		'id_pinjam' => set_value('id_pinjam', $row->id_pinjam),
        		'id_anggota' => set_value('id_anggota', $row->id_anggota),
        		'tgl_pinjam' => set_value('tgl_pinjam', $row->tgl_pinjam),
        		'tgl_kembali' => set_value('tgl_kembali', $row->tgl_kembali),
        		'id_buku' => set_value('id_buku', $row->id_buku),
        		'status' => set_value('status', $row->status),
        		'petugas' => $this->user_model->get_by_username($this->session->userdata('username'))->nama,
                'dt_anggota' => $this->anggota_model->get_all(),
                'dt_buku' => $this->buku_model->get_all(),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Peminjam Buku',
                'content' => 'pinjam/pinjam_form',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pinjam'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pinjam', TRUE));
        } else {
            $data = array(
        		'id_anggota' => $this->input->post('id_anggota',TRUE),
        		'tgl_pinjam' => $this->input->post('tgl_pinjam',TRUE),
        		'tgl_kembali' => $this->input->post('tgl_kembali',TRUE),
        		'id_buku' => $this->input->post('id_buku',TRUE),
        		'status' => '1',
        		'petugas' => $this->user_model->get_by_username($this->session->userdata('username'))->id_user,
        	    );

            $this->pinjam_model->update($this->input->post('id_pinjam', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pinjam'));
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->pinjam_model->get_by_id($id);

            if ($row) {
                $this->pinjam_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pinjam'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pinjam'));
            }
        } else {
            show_404();
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('id_anggota', ' ', 'trim|required|numeric');
    	$this->form_validation->set_rules('tgl_pinjam', ' ', 'trim|required');
    	$this->form_validation->set_rules('tgl_kembali', ' ', 'trim|required');
    	$this->form_validation->set_rules('id_buku', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_pinjam', 'id_pinjam', 'trim|required');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pinjam.xls";
        $judul = "Data Peminjaman";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "id_anggota");
    	xlsWriteLabel($tablehead, $kolomhead++, "tgl_pinjam");
    	xlsWriteLabel($tablehead, $kolomhead++, "tgl_kembali");
    	xlsWriteLabel($tablehead, $kolomhead++, "id_buku");
    	xlsWriteLabel($tablehead, $kolomhead++, "status");
    	xlsWriteLabel($tablehead, $kolomhead++, "petugas");

    	foreach ($this->pinjam_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->id_anggota);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_pinjam);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_kembali);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->id_buku);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->petugas);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file pinjam.php */
/* Location: ./application/controllers/pinjam.php */