<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	protected $access = '*';

    function __construct()
    {
        parent::__construct();

        $this->login_check();
    }

    public function login_check()
    {
    	if ($this->access != '*') {
    		if (! $this->permission_check()) {
    			die("<h4>Access denied!</h4>");
    		}

    		if (! $this->session->userdata("logged_in")) {
    			redirect(site_url('login'));
    		}
    	}
    }

    public function permission_check()
    {
    	if ($this->access == '@') {
    		return true;
    	} else {
    		$access = is_array($this->access) ? 
    			$this->access : 
    			explode(",", $this->access);
    		if (in_array($this->session->userdata("level"), array_map("trim", $access))) {
    			return true;
    		}

    		return false;
    	}
    }

}

?>