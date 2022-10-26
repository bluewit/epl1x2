<?php
class Logout extends CI_Controller{
	
	function __construct(){	
		parent::__construct();
	}
	
	function index(){			
		//$this->session->sess_destroy();	
		$this->session->unset_userdata('logined');
		$this->session->unset_userdata('member_id');
		$this->session->unset_userdata('nickname');
		$this->session->unset_userdata('member_img');			
		$this->session->unset_userdata('member_step');
		$this->session->unset_userdata('member_teng');
		$this->session->unset_userdata('team_step');
		$this->session->unset_userdata('team_teng');
		redirect(site_url());	
	}
	
}
?>