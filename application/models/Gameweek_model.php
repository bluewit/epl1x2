<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Gameweek_model extends CI_Model{
	
	public function get_all(){
		$this->db->select('*');
		$this->db->where('gw_id<', 39);
		return $this->db->get('fb_gameweek');
	}
	
	public function get_by_id($id=NULL){
		$this->db->select('*');
		$this->db->where('gw_id', $id);
		//$this->db->where('gw_display', 'y');
		return $this->db->get('fb_gameweek')->row();
	}
	
	public function get_display(){
		$this->db->select('*');
		$this->db->where('gw_display', 'y');
		$this->db->limit(1);
		return $this->db->get('fb_gameweek')->row();
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}