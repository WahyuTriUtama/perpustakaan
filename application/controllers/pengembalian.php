<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pengembalian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model(array('user_model','buku_model','pinjam_model','pengembalian_model','anggota_model'));
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $pengembalian = $this->pengembalian_model->get_all();

        $data = array(
            'pengembalian_data' => $pengembalian,
            'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
            'title' => 'Data Pengembalian',
            'content' => 'pengembalian/pengembalian_list',
        );

        $this->load->view('template', $data);
    }

    public function read($id) 
    {
        $row = $this->pengembalian_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'View',
        		'id_pengembalian' => $row->id_pengembalian,
        		'id_pinjam' => $row->id_pinjam,
                'id_anggota' => $row->id_anggota,
        		'tgl_terima' => $row->tgl_terima,
                'tgl_pinjam' => $row->tgl_pinjam,
                'bts_kembali' => $row->tgl_kembali,
        		'telat' => $row->telat,
        		'denda' => $row->denda,
        		'petugas' => $this->user_model->get_by_id($row->petugas)->nama,
                'kode' => $row->id_buku,
                'kategori' => $row->kategori,
                'pengarang' => $row->pengarang,
                'penerbit' => $row->penerbit,
                'judul' => $row->judul,
                'thn' => $row->thn_terbit,
                'dt_anggota' => $this->anggota_model->get_all(),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'Data Pengembalian',
                'content' => 'pengembalian/pengembalian_read',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengembalian'));
        }
    }
    
    public function create() 
    {
        $kode = $this->input->get('kode',TRUE);
        if (strlen($kode) == 12) {
            $row = $this->pinjam_model->get_by_id($kode);
            if ($row) {
                $kode_in = $kode;
                $data_pinjam = $this->pinjam_model->get_by_id($kode);
                $now = date("d-m-Y");
                // tanggal bts kembali
                $exp = explode("-", $data_pinjam->tgl_kembali);
                $date1 = $exp[0];
                $month1 = $exp[1];
                $year1 = $exp[2];
                // tanggal kembali
                $exp_2 = explode("-", $now);
                $date2 = $exp_2[0];
                $month2 = $exp_2[1];
                $year2 =  $exp_2[2];
                // menghitung JDN
                $date1 = GregorianToJD($month1, $date1, $year1);
                $date2 = GregorianToJD($month2, $date2, $year2);
                // hitung selisih
                $gab = $date2 - $date1;
                if (($gab)<=0){
                    $telat = "0";
                    $denda = "0";
                }else {
                    $telat = $gab;
                    $denda = ($gab)*100;
                }

                $data = array(
                    'button' => 'Tambah',
                    'action' => site_url('pengembalian/create_action'),
                    'id_pengembalian' => set_value('id_pengembalian'),
                    'id_pinjam' => $kode_in,
                    'id_anggota' => $data_pinjam->id_anggota,
                    'tgl_pinjam' => $data_pinjam->tgl_pinjam,
                    'bts_kembali' => $data_pinjam->tgl_kembali,
                    'tgl_terima' => $now,
                    'telat' => $telat,
                    'denda' => $denda,
                    'kode' => $data_pinjam->id_buku,
                    'kategori' => $data_pinjam->kategori,
                    'pengarang' => $data_pinjam->pengarang,
                    'penerbit' => $data_pinjam->penerbit,
                    'judul' => $data_pinjam->judul,
                    'thn' => $data_pinjam->thn_terbit,
                    'stok' => $data_pinjam->stok,
                    'st_out' => $data_pinjam->st_out,
                    'dt_anggota' => $this->anggota_model->get_all(),
                    'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                    'title' => 'Data Pengembalian',
                    'content' => 'pengembalian/pengembalian_form',
                   );
                $this->load->view('template', $data);
            }else{
                redirect(site_url('pinjam'));
            }
        }else{
            redirect(site_url('pinjam'));
        }
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        		'id_pinjam' => $this->input->post('id_pinjam',TRUE),
        		'tgl_terima' => $this->input->post('tgl_terima',TRUE),
        		'telat' => $this->input->post('telat',TRUE),
        		'denda' => $this->input->post('denda',TRUE),
        		'petugas' => $this->user_model->get_by_username($this->session->userdata('username'))->id_user,
        	    );

            $data_2 = array('status' => '0');

            $row = $this->buku_model->get_by_id($this->pinjam_model->get_by_id($this->input->post('id_pinjam',TRUE))->id_buku);
            $data_3 = array('st_out' => $row->st_out-1);

            $this->pengembalian_model->insert($data);
            $this->pinjam_model->update($this->input->post('id_pinjam', TRUE), $data_2);
            $this->buku_model->update($row->id_buku, $data_3);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pengembalian'));
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->pengembalian_model->get_by_id($id);

            if ($row) {
                $this->pengembalian_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('pengembalian'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('pengembalian'));
            }
        } else {
            show_404();
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_pinjam', ' ', 'trim|required');
	$this->form_validation->set_rules('tgl_terima', ' ', 'trim|required');
	$this->form_validation->set_rules('telat', ' ', 'trim|required|numeric');

	$this->form_validation->set_rules('id_pengembalian', 'id_pengembalian', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Pengembalian.xls";
        $judul = "Data Pengembalian";
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
    	xlsWriteLabel($tablehead, $kolomhead++, "Kode Pinjam");
    	xlsWriteLabel($tablehead, $kolomhead++, "Tgl. Kembali");
    	xlsWriteLabel($tablehead, $kolomhead++, "Telat");
    	xlsWriteLabel($tablehead, $kolomhead++, "Denda");
    	xlsWriteLabel($tablehead, $kolomhead++, "Petugas");

    	foreach ($this->pengembalian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->id_pinjam);
    	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_terima);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->telat);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->denda);
    	    xlsWriteNumber($tablebody, $kolombody++, $data->petugas);

    	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

};

/* End of file pengembalian.php */
/* Location: ./application/controllers/pengembalian.php */