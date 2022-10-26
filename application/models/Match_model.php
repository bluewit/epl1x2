<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Match_model extends CI_Model{
	
	public function get_date_cut_2_hour(){
		$date = get_date_cut_2_hour_not_conv(date('Y-m-d H:i:s'));	
		return $date;
	}
		
	public function today_for_match(){
		$today_display_time = time()-(60*60*12);
		$day = date("Y-m-d",$today_display_time);
		return $day;
	}
		
	public function get_by_id($id=NULL){
		$this->db->select('fb_match.*, club_home.club_name AS club_home_name, club_home.club_image AS club_home_image,club_home.club_order AS club_home_order, club_away.club_name AS club_away_name, club_away.club_image AS club_away_image,club_away.club_order AS club_away_order, fb_leagues.league_name, fb_nationals.national_name');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');	
		$this->db->join('fb_leagues', 'fb_leagues.league_id = fb_match.league_id');
		$this->db->join('fb_nationals', 'fb_nationals.national_id = fb_match.national_id');
		$this->db->where('match_id', $id);
		//$this->db->order_by('match_name', 'ASC');
		return $this->db->get('fb_match')->row();
	}
	
	public function get_by_date($startdate=NULL,$enddate=NULL,$gw_id=NULL){
		$this->db->select("fb_match.*, fb_nationals.national_name, fb_leagues.league_name, fb_leagues.league_image, club_home.club_name AS club_home_name, club_home.club_image AS club_home_image, club_away.club_name AS club_away_name, club_away.club_image AS club_away_image, DATE_FORMAT(match_date, '%Y-%m-%d') AS matchdate, DATE_FORMAT(match_date, '%H:%i') AS matchtime", false);
		$this->db->join('fb_nationals', 'fb_nationals.national_id = fb_match.national_id');
		$this->db->join('fb_leagues', 'fb_leagues.league_id = fb_match.league_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');
		$this->db->where('match_status', 1);		
		$this->db->where('club_home.club_status', 1);
		$this->db->where('club_away.club_status', 1);
		if($startdate&&$enddate)$this->db->where('fb_match.match_date BETWEEN "'.$startdate.'" AND "'.$enddate.'"');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		//$this->db->where('fb_match.match_date BETWEEN "'.$date.' 12:00:00" AND "'.$date.' 00:00:00"');
		//if(!$xs){$this->db->where("DATE_FORMAT(match_date, '%Y-%m-%d')=", $date);}
		$this->db->order_by('league_id', 'ASC');
		$this->db->order_by('match_date', 'ASC');
		return $this->db->get('fb_match');
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}