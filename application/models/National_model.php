<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class National_model extends CI_Model{
	
	public function select_national_all(){
			$this->db->select('*');
			$this->db->where('national_status', 1);
			$this->db->order_by('national_name', 'ASC');
			return $this->db->get('fb_nationals');
	}
	
	public function select_national_id($id=NULL){
			$this->db->select('*');
			$this->db->where('national_id', $id);
			$this->db->where('national_status', 1);
			//$this->db->order_by('national_name', 'ASC');
			return $this->db->get('fb_nationals')->row();
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}