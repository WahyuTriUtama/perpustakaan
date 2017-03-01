<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        if ($this->session->userdata('logged_in') !== TRUE) {
            redirect(site_url('login/login_error'));
        }
        $this->load->model('user_model');
        $this->load->library(array('image_lib','form_validation'));
        $this->load->helper(array('form','text_helper','date','file','url'));
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if ($this->session->userdata('level') == 'admin') {
            $user = $this->user_model->get_all();

            $data = array(
                'user_data' => $user,
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'User Account',
                'content' => 'user/user_list',
            );

            $this->load->view('template', $data);
        } else {
            show_404();
        }
    }

    public function read($id) 
    {
        $row = $this->user_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'View',
        		'id_user' => $row->id_user,
        		'nama' => $row->nama,
        		'username' => $row->username,
        		'password' => $row->password,
        		'level' => $row->level,
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'User Account',
                'content' => 'user/user_read',
        	    );
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function create() 
    {
        if ($this->session->userdata('level') == 'admin') {
            $data = array(
                'button' => 'Tambah',
                'action' => site_url('user/create_action'),
        	    'id_user' => set_value('id_user'),
        	    'nama' => set_value('nama'),
        	    'username' => set_value('username'),
        	    'password' => set_value('password'),
        	    'level' => set_value('level'),
                'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                'title' => 'User Account',
                'content' => 'user/user_form',
        	);
            $this->load->view('template', $data);
        } else {
            show_404();
        }
    }
    
    public function create_action() 
    {
        if ($this->session->userdata('level') == 'admin') {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
            } else {
                $data = array(
            		'nama' => $this->input->post('nama',TRUE),
            		'username' => $this->input->post('username',TRUE),
            		'password' => md5($this->input->post('password',TRUE)),
            		'level' => $this->input->post('level',TRUE),
            	    );

                $this->user_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('user/create'));
            }
        } else {
            show_404();
        }
    }
    
    public function update($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->user_model->get_by_id($id);

            if ($row) {
                $data = array(
                    'button' => 'Edit',
                    'action' => site_url('user/update_action'),
            		'id_user' => set_value('id_user', $row->id_user),
            		'nama' => set_value('nama', $row->nama),
            		'username' => set_value('username', $row->username),
            		'password' => set_value('password', $row->password),
            		'level' => set_value('level', $row->level),
                    'user'=> $this->user_model->get_by_username($this->session->userdata('username')),
                    'title' => 'User Account',
                    'content' => 'user/user_form',
            	    );
                $this->load->view('template', $data);
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
            }
        } else{
            show_404();
        }
    }
    
    public function update_action() 
    {
        if ($this->session->userdata('level') == 'admin') {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id_user', TRUE));
            } else {
                $row = $this->usermodel->get_by_id($this->input->post('user_id', TRUE));

                if ($this->input->post('password',TRUE) == "") {
                    $password = $row->userpass;
                }else{
                    $password = md5($this->input->post('password',TRUE));
                }

                $data = array(
            		'nama' => $this->input->post('nama',TRUE),
            		'username' => $this->input->post('username',TRUE),
            		'password' => $this->input->post('password',TRUE),
            		'level' => $this->input->post('level',TRUE),
            	    );

                $this->user_model->update($this->input->post('id_user', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('user'));
            }
        } else {
            show_404();
        }
    }
    
    public function delete($id) 
    {
        if ($this->session->userdata('level') == 'admin') {
            $row = $this->user_model->get_by_id($id);

            if ($row) {
                $this->user_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('user'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('user'));
            }
        } else {
            show_404();
        }
    }

    public function _rules() 
    {
    	$this->form_validation->set_rules('nama', ' ', 'trim|required');
    	$this->form_validation->set_rules('username', ' ', 'trim|required');
    	$this->form_validation->set_rules('password', ' ', 'trim|required');
    	$this->form_validation->set_rules('level', ' ', 'trim|required');

    	$this->form_validation->set_rules('id_user', 'id_user', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file user.php */
/* Location: ./application/controllers/user.php */