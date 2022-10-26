<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class League_model extends CI_Model{
	
	public function select_league_all(){
		$this->db->select('fb_leagues.*, fb_nationals.national_name');
		$this->db->join('fb_nationals', 'fb_leagues.national_id = fb_nationals.national_id');
		$this->db->where('league_status', 1);
		$this->db->order_by('league_name', 'ASC');
		return $this->db->get('fb_leagues');
	}
	
	public function select_league_id($id=NULL){
		$this->db->select('fb_leagues.*, fb_nationals.national_name');
		$this->db->join('fb_nationals', 'fb_leagues.national_id = fb_nationals.national_id');
		$this->db->where('league_id', $id);
		//$this->db->order_by('league_name', 'ASC');
		return $this->db->get('fb_leagues')->row();
	}
	
	public function select_league_by_national($national_id = NULL){
		$this->db->select('*');
		$this->db->where('league_status', 1);
		$this->db->where('national_id', $national_id);
		$this->db->order_by('league_name', 'ASC');
		return $this->db->get('fb_leagues');
	}
	
	public function select_league_table(){
		$this->db->select('league_id, league_name, league_detail');
		$this->db->where('league_status', 1);
		$this->db->where('league_table', 'y');
		$this->db->order_by('league_order', 'ASC');
		return $this->db->get('fb_leagues');
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}