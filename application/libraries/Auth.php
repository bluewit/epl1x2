<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Auth {
	
	protected $CI;
	
	function __construct(){
		$this->CI =& get_instance();
	}
		
	function isnot_login(){
		$isnot_logged = $this->CI->session->userdata('login');
		if (!isset($isnot_logged) || $isnot_logged != TRUE ) {
			//$this->CI->session->set_flashdata('message', '<div class="error_message">Try logging in first.</div>');
			redirect(site_url('login'), 'location');
		}
	}
	
	function is_login(){
		$is_logged = $this->CI->session->userdata('login');
		if (isset($is_logged) && $is_logged == TRUE ) {
			//$this->CI->session->set_flashdata('message', '<div class="error_message">Try logging in first.</div>');
			redirect(site_url('home'), 'location');
		}
	}
	
	function isnot_admin(){
		$level = $this->CI->session->userdata('level');	
		if (!isset($level) || $level != 'admin') {
			//$this->CI->session->set_flashdata('message', '<div class="error_message">You are most definitely not an admin.</div>');
			redirect(site_url(), 'location');
		}
	}
	
	function logout() {
		$this->CI->session->sess_destroy();
	}
}
/* End of custom library, Auth.php */