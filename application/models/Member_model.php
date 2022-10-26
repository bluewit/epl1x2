<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model{
	
	public function get_by_fbid($fbid){
		$this->db->select('fb_members.*,club_shirt');
		$this->db->join('fb_clubs', 'fb_members.club_cheer = fb_clubs.club_id', 'left');
		$this->db->where('facebook_id', $fbid);
		return $this->db->get('fb_members');
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}