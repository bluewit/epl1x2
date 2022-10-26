<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Loginout_log {
	
	private $CI;
	private $_log_table_name = 'tb_account_loginout';
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
		
	function save_login(){
		$data = array(
            'ac_id' => $this->CI->session->userdata('ac_id'),
            'action' => 'Login',
            'user_agent' => $this->CI->input->user_agent(),
            'ip_address' => $this->CI->input->ip_address(),
            'created' => date('Y-m-d H:i:s')
        );
        $this->CI->db->insert($this->_log_table_name, $data);
	}
	
	function save_logout(){
		$data = array(
            'ac_id' => $this->CI->session->userdata('ac_id'),
            'action' => 'Logout',
            'ip_address' => $this->CI->input->ip_address(),
            'created' => date('Y-m-d H:i:s')
        );
        $this->CI->db->insert($this->_log_table_name, $data);
	}
	
}