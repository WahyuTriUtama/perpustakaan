<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('buku_model','kategori_model'));
        $this->load->helper(array('form','date','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data = array(
            'dt_buku'=> $this->buku_model->get_all(),
            'dt_kategori' => $this->kategori_model->get_all(),
        );

        $this->load->view('front/home', $data);
    }

    public function view()
    {
        $id = $this->input->get('id', TRUE);
        $m = $this->input->get('search', TRUE);
        if ($m == "kategori") {
            $row = $this->kategori_model->get_by_id($id);
            if ($row) {
                $data = array(
                    'dt_buku' => $this->buku_model->get_by_kategori($id),
                    'dt_kategori' => $this->kategori_model->get_all(),
                    );
                $this->load->view('front/home', $data);
            }else{ ?>
                <script type="text/javascript">
                    alert("Kategori yang dicari tidak ada!");
                </script>
            <?php
                redirect(site_url('home'), 'refresh');
             }
        }else{
            redirect(site_url('home'));
        }
    }

};

/* End of file home.php */
/* Location: ./application/controllers/home.php */