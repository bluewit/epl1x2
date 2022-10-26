<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Club_model extends CI_Model{
	
	public function num_row_club($national_id=NULL, $league_id=NULL, $club_name=NULL){
		$this->db->select('fb_clubs.club_id');
		$this->db->join('fb_nationals', 'fb_clubs.national_id = fb_nationals.national_id');
		$this->db->join('fb_leagues', 'fb_clubs.league_id = fb_leagues.league_id');
		$this->db->where('club_status', 1);
		if($club_name)$this->db->like('club_name', $club_name);
		if($national_id)$this->db->where('fb_clubs.national_id', $national_id);
		if($league_id)$this->db->where('fb_clubs.league_id', $league_id);
		return $this->db->get('fb_clubs')->num_rows();
	}
	
	public function select_club_all($per_page, $offset, $national_id=NULL, $league_id=NULL, $club_name=NULL){
		$this->db->select('fb_clubs.*, fb_nationals.national_name, fb_leagues.league_name');
		$this->db->join('fb_nationals', 'fb_clubs.national_id = fb_nationals.national_id');
		$this->db->join('fb_leagues', 'fb_clubs.league_id = fb_leagues.league_id');
		$this->db->where('club_status', 1);
		if($club_name)$this->db->like('club_name', $club_name);
		if($national_id)$this->db->where('fb_clubs.national_id', $national_id);
		if($league_id)$this->db->where('fb_clubs.league_id', $league_id);
		$this->db->limit($per_page, $offset);
		$this->db->order_by('league_name', 'ASC');
		$this->db->order_by('club_name', 'ASC');
		return $this->db->get('fb_clubs');
	}
	
	public function select_club_id($id=NULL){
		$this->db->select('fb_clubs.*, fb_nationals.national_name, fb_leagues.league_name');
		$this->db->join('fb_nationals', 'fb_clubs.national_id = fb_nationals.national_id');
		$this->db->join('fb_leagues', 'fb_clubs.league_id = fb_leagues.league_id');
		$this->db->where('club_id', $id);
		//$this->db->order_by('club_name', 'ASC');
		return $this->db->get('fb_clubs')->row();
	}
	
	public function select_club_search($national_id=NULL, $league_id=NULL, $club_name=NULL){
		$this->db->select('fb_clubs.*, fb_nationals.national_name, fb_leagues.league_name');
		$this->db->join('fb_nationals', 'fb_clubs.national_id = fb_nationals.national_id');
		$this->db->join('fb_leagues', 'fb_clubs.league_id = fb_leagues.league_id');
		$this->db->where('club_status', 1);
		$where = "club_name LIKE '%$club_name%' ";
		if($national_id)$where="fb_clubs.national_id = $national_id AND club_name LIKE '%$club_name%' ";
		if($league_id)$where="fb_clubs.league_id = $league_id AND club_name LIKE '%$club_name%' ";
		$this->db->where($where);
		$this->db->order_by('club_name', 'ASC');
		return $this->db->get('fb_clubs');
	}
	
	public function select_club_by_league($league_id = NULL, $limit=NULL){
		$this->db->select('*');
		$this->db->where('club_status', 1);
		$this->db->where('league_id', $league_id);
		$this->db->order_by('club_order', 'ASC');
		$this->db->order_by('club_name', 'ASC');
		if($limit)$this->db->limit($limit);
		return $this->db->get('fb_clubs');
	}
	
	public function get_club_shirt(){
		$this->db->select('club_id,club_name,club_shirt');
		$this->db->where('club_status', 1);
		$this->db->where('club_shirt IS NOT NULL');
		$this->db->order_by('club_order', 'ASC');
		$this->db->order_by('club_name', 'ASC');
		return $this->db->get('fb_clubs');
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}