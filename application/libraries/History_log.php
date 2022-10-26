<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class History_log {
	
	private $CI;
	private $_log_table_name = 'tb_history';
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
		
	function save($val){
		$data = $val;
		$data['ac_id'] = $this->CI->session->userdata('ac_id');
		$data['ip_address'] = $this->CI->input->ip_address();
		$data['created'] = date('Y-m-d H:i:s');
        $this->CI->db->insert($this->_log_table_name, $data, array('created'=>date('Y-m-d H:i:s')));
	}

}