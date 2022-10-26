<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Teng_model extends CI_Model{
			
	public function get_teng_today($member_id=NULL,$startdate=NULL,$enddate=NULL,$gw_id=NULL){
		$this->db->select('fb_teng.*,club_home.club_name AS club_home_name,club_away.club_name AS club_away_name');
		$this->db->join('fb_match', 'fb_teng.match_id = fb_match.match_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');		
		$this->db->where('member_id', $member_id);
		if($startdate&&$enddate)$this->db->where('teng_date BETWEEN "'.$startdate.'" AND "'.$enddate.'"');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		return $this->db->get('fb_teng');
	}
	
	//+ ดึงผลคะแนนของสมาชิก แสดงที่หน้าจอ
	public function get_month_score($member_id=NULL){
		$this->db->select('IFNULL(SUM(teng_score), 0) AS score');
		$this->db->where('member_id', $member_id);
		$this->db->where('teng_result IS NOT NULL');
		//$this->db->where('teng_date BETWEEN "'.date('Y-m-').'01 00:00:00" AND "'.date("Y-m-t", strtotime(date('Y-m-d'))).' 23:59:59"');
		return $this->db->get('fb_teng')->row();
	}
	
	//+ ดึงรายการที่เล่นของสมาชิก แสดงที่หน้าจอ
	public function get_month_listteng($member_id=NULL,$gw_id=NULL){
		$this->db->select("fb_teng.*, fb_leagues.league_name, fb_leagues.league_image, club_home.club_name AS club_home_name, fb_match.club_home_score, club_away.club_name AS club_away_name, fb_match.club_away_score,fb_match.match_special, DATE_FORMAT(match_date, '%Y-%m-%d') AS matchdate, DATE_FORMAT(match_date, '%H:%i') AS matchtime, fb_match.match_rate, fb_match.team_handicap, match_score_status");
		$this->db->join('fb_match', 'fb_match.match_id = fb_teng.match_id');
		$this->db->join('fb_leagues', 'fb_leagues.league_id = fb_match.league_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');
		$this->db->where('member_id', $member_id);
		//$this->db->where('match_score_status', 'y');
		//$this->db->where('teng_result IS NOT NULL');
		//$this->db->where('teng_date BETWEEN "'.date('Y-m-').'01 00:00:00" AND "'.date("Y-m-t", strtotime(date('Y-m-d'))).' 23:59:59"');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		$this->db->order_by('fb_match.match_date','DESC');
		//$this->db->limit(20);
		return $this->db->get('fb_teng');		
	}
	
	//+ ดึงทีมเด็ด บอลเต็ง
	public function get_teamded($startdate=NULL,$enddate=NULL,$gw_id=NULL){
		$this->db->select("fb_teng.match_id, CASE WHEN teng_predict='h' THEN club_home_id ELSE club_away_id END AS club_id, CASE WHEN teng_predict='h' THEN club_home.club_name ELSE club_away.club_name END AS club_name, CASE WHEN teng_predict='h' THEN club_home.club_image ELSE club_away.club_image END AS club_image, COUNT(teng_id) AS tengnum");
		$this->db->join('fb_match', 'fb_match.match_id = fb_teng.match_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');
		//$this->db->where('teng_result IS NOT NULL');
		if($startdate&&$enddate)$this->db->where('teng_date BETWEEN "'.$startdate.'" AND "'.$enddate.'"');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		$this->db->where('(teng_predict="h" OR teng_predict="a")');
		$this->db->group_by('club_id');
		$this->db->order_by('tengnum','DESC');
		$this->db->limit(3);
		return $this->db->get('fb_teng');		
	}
	
	//+ ดึงทีมเด็ด คู่เสมอ
	public function get_matchalded($startdate=NULL,$enddate=NULL,$gw_id=NULL){
		$this->db->select("fb_teng.match_id, CONCAT(club_home.club_name, ' vs ', club_away.club_name) AS matchvs, club_home.club_image AS club_home_image, club_away.club_image AS club_away_image, COUNT(teng_id) AS tengnum");
		$this->db->join('fb_match', 'fb_match.match_id = fb_teng.match_id');
		$this->db->join('fb_clubs AS club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs AS club_away', 'club_away.club_id = fb_match.club_away_id');
		//$this->db->where('teng_result IS NOT NULL');
		if($startdate&&$enddate)$this->db->where('teng_date BETWEEN "'.$startdate.'" AND "'.$enddate.'"');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		$this->db->where('teng_predict', 'al');
		$this->db->group_by('match_id');
		$this->db->order_by('tengnum','DESC');
		$this->db->limit(3);
		return $this->db->get('fb_teng');		
	}
	
	//+ ดึงอันดับคะแนน สมาชิก
	public function get_ranking($gw_id=NULL){
		$this->db->select('fb_members.nickname,fb_clubs.club_shirt,fb_match.gw_id,COUNT(fb_teng.match_id) AS teng_match,SUM(teng_score) AS teng_score,SUM(teng_coefficient) AS teng_coefficient');
		$this->db->join('fb_teng', 'fb_teng.member_id = fb_members.member_id');
		$this->db->join('fb_match', 'fb_match.match_id = fb_teng.match_id');
		$this->db->join('fb_clubs', 'fb_clubs.club_id = fb_members.club_cheer');
		$this->db->where('teng_result IS NOT NULL');
		if($gw_id)$this->db->where('fb_match.gw_id', $gw_id);
		$this->db->group_by('fb_members.member_id');
		$this->db->order_by('teng_score','desc');
		$this->db->order_by('teng_coefficient','desc');
		$this->db->order_by('fb_members.nickname','asc');		
		$this->db->limit(3);
		return $this->db->get('fb_members');
			
	}
		
	public function __destruct(){
		$this->db->close();
	}
	
}