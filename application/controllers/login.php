<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper(array('form','url'));
    }

    public function index()
    {   
        $data = array(
        	'action' => site_url('login/login_proccess'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            );
        $this->load->view('login/login_form', $data);
    }

    public function login_error()
    {   
        $data = array(
        	'action' => site_url('login/login_proccess'),
            'username' => set_value('username'),
            'password' => set_value('password'),
            );
        $this->load->view('login/login_error', $data);
    }

    public function login_proccess()
    { 
        $this->load->model('user_model');
        $this->load->library('session');

        $this->login_rules();

        if ($this->form_validation->run() == FALSE) {
            redirect(site_url('login/login_error'));
        } else {
            $user = $this->input->post('username',TRUE);
            $pass = md5($this->input->post('password',TRUE));

            $row = $this->user_model->login($user, $pass);
            if ($row){
                $sess_data = array(
                        'logged_in' => TRUE,
                        'username'  => $row->username,
                        'level' => $row->level,
                        );
                $this->session->set_userdata($sess_data);

                redirect(site_url('admin'));

            }else{
                redirect(site_url('login/login_error'));
            }
        }  
    }

    function login_rules()
    {
        $this->form_validation->set_rules('username', ' ', 'trim|required');
        $this->form_validation->set_rules('password', ' ', 'trim|required');
    }

};


/* End of file login.php */
/* Location: ./application/controllers/login.php */