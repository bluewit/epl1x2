<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Match_predic_model extends CI_Model{
	
	public function get_date_cut_2_hour(){
		$date = get_date_cut_2_hour_not_conv(date('Y-m-d H:i:s'));	
		return $date;
	}
	
	//+ เลือกข้อมูลไปแสดงในหน้า admin / หน้ารวมคะแนนสมาชิก
	public function num_row_match_predic($name=NULL, $date_start=NULL, $date_end=NULL){
		$this->db->select('fb_members.member_id');
		$this->db->join('fb_members', 'fb_match_predic.member_id = fb_members.member_id');
		//$this->db->where('match_predic_result', 'y');
		$this->db->where('fb_members.member_status', 1);
		$this->db->where('match_predic_score IS NOT NULL');
		$this->db->where('fb_match_predic.created > \'2015-09-01\'');
		if($date_start and $date_end){
			$where="fb_match_predic.match_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'";
			$this->db->where($where);
		}
		if($name)$this->db->like('fb_members.username', $name);
		$this->db->group_by('fb_match_predic.member_id');
		//$this->db->order_by('correct_num', 'DESC');
		//if($limit)$this->db->limit($limit);
		return $this->db->get('fb_match_predic')->num_rows();
	}	
	
	public function select_match_predic_all($perpage, $offset, $name=NULL, $date_start=NULL, $date_end=NULL){
		$this->db->select('fb_members.member_id, fb_members.username, fb_members.member_name, fb_members.member_sname, fb_members.member_email, count(fb_match_predic.member_id)/CASE WHEN (count(DISTINCT extrapoint_id)) = 0 THEN 1 ELSE count(DISTINCT extrapoint_id) END as matchtotal, 
sum(match_predic_score)/CASE WHEN (count(DISTINCT extrapoint_id)) = 0 THEN 1 ELSE count(DISTINCT extrapoint_id) END as score, IFNULL(sum(extrapoint), 0)*CASE WHEN (count(DISTINCT extrapoint_id)) = 0 THEN 1 ELSE count(DISTINCT extrapoint_id) END/count(*) as extrapoint, 
sum(match_predic_score)/CASE WHEN (count(DISTINCT extrapoint_id)) = 0 THEN 1 ELSE count(DISTINCT extrapoint_id) END+IFNULL(sum(extrapoint), 0)*CASE WHEN (count(DISTINCT extrapoint_id)) = 0 THEN 1 ELSE count(DISTINCT extrapoint_id) END/count(*) as scoretotal, euroname, euroflag, copaname, copaflag', FALSE);		
		$this->db->join('fb_members', 'fb_match_predic.member_id = fb_members.member_id', 'left');
		$this->db->join('fb_champions', 'fb_champions.member_id = fb_members.member_id', 'left');
		$this->db->join('fb_extrapoint', 'fb_extrapoint.member_id = fb_members.member_id'.(($date_start and $date_end)?" AND fb_extrapoint.extrapoint_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'":"").'', 'left');
		//$this->db->where('match_predic_result', 'y');
		$this->db->where('fb_members.member_status', 1);
		$this->db->where('match_predic_score IS NOT NULL');
		$this->db->where('fb_match_predic.created > \'2015-09-01\'');
		if($date_start and $date_end){
			$this->db->where("fb_match_predic.match_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'");
		}
		if($name)$this->db->like('fb_members.username', $name);
		$this->db->group_by('fb_match_predic.member_id');
		$this->db->order_by('scoretotal', 'DESC');
		$this->db->order_by('matchtotal', 'DESC');
		$this->db->order_by('username', 'ASC');
		$this->db->limit($perpage, $offset);
		return $this->db->get('fb_match_predic');
	}
	//+ เลือกข้อมูลไปแสดงในหน้า admin
	
	
	public function select_match_predic($match_id=NULL, $predic=NULL){
		$this->db->select('match_predic');
		$this->db->where('match_id', $match_id);
		//$this->db->group_by('match_predic');
		if($predic)$this->db->where('match_predic', $predic);
		return $this->db->get('fb_match_predic');
	}
	
	public function select_max_match_predic($match_id=NULL, $predic=NULL){
		$this->db->select('count(match_predic) AS max_predic');
		if($match_id)$this->db->where('match_id', $match_id);
		//$this->db->group_by('match_predic');
		if($predic)$this->db->where('match_predic', $predic);
		$this->db->group_by('match_predic');
		$this->db->order_by('max_predic', 'DESC');
		$this->db->limit(1);
		return $this->db->get('fb_match_predic')->row();
	}
	
	public function select_predic_member($match_id=NULL, $member_id=NULL){
		$this->db->select('*');
		$this->db->where('match_id', $match_id);
		$this->db->where('member_id', $member_id);
		return $this->db->get('fb_match_predic');
	}
	
	//+ ดึงรายการคะแนนของสมาชิกไปแสดงในหน้าแรก
	public function select_correct_predic($month=NULL, $limit=NULL){
		$this->db->select('count(fb_match_predic.member_id) as correct_num, count(fb_match_predic.member_id) as matchtotal, sum(match_predic_score) as score, IFNULL(sum(match_predic_score),0)+IFNULL(sum(extrapoint),0)*count(DISTINCT extrapoint_id)/count(*) as scoretotal, fb_members.member_id, fb_members.username, fb_members.member_name, fb_members.member_sname');
		$this->db->join('fb_members', 'fb_match_predic.member_id = fb_members.member_id');
		$this->db->join('fb_extrapoint', "fb_extrapoint.member_id = fb_members.member_id AND fb_extrapoint.extrapoint_date BETWEEN '".date('Y')."-".$month."-01 00:00:00' AND ' ".get_last_date_of_month(date('Y')."-".$month."-01")." 23:59:59'", 'left');
		//$this->db->where('match_predic_result', 'y');
		$this->db->where('fb_members.member_status', 1);
		$this->db->where('match_predic_score IS NOT NULL');
		$where="fb_match_predic.match_date BETWEEN '".date('Y')."-".$month."-01 00:00:00' AND '".get_last_date_of_month(date('Y')."-".$month."-01")." 23:59:59'";
		//$where="fb_match_predic.match_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'";
		$this->db->where($where);
		$this->db->group_by('fb_match_predic.member_id');
		$this->db->order_by('scoretotal', 'DESC');
		$this->db->order_by('matchtotal', 'DESC');
		$this->db->order_by('username', 'ASC');
		if($limit)$this->db->limit($limit);
		return $this->db->get('fb_match_predic');
	}
	
	//+ ดึงผลคะแนนทายถูกของสมาชิก เพื่อนำไปสร้าง session แล้วแสดงที่หน้าจอ
	public function select_correct_predic_by_member($member_id=NULL, $predic_result=NULL, $month=NULL){
		$this->db->select('count(fb_match_predic.member_id) as correct_num, sum(match_predic_score) as score');
		if($predic_result){$this->db->where('match_predic_result', $predic_result);}
		$this->db->where('fb_match_predic.member_id', $member_id);
		$this->db->where('fb_match_predic.match_predic_score IS NOT NULL');
		$this->db->where('fb_match_predic.created > \'2015-09-01\'');
		if($month)$this->db->where("fb_match_predic.match_date BETWEEN '".$month."-01 00:00:00' AND '".get_last_date_of_month($month."-01")." 23:59:59'");
		$this->db->group_by('fb_match_predic.member_id');
		return $this->db->get('fb_match_predic');
	}
	
	//+ ดึงเพื่อแสดงรายละเอียดการเล่นเกมส์แต่ละคู่ของสมาชิก
	public function num_all_predic($member_id=NULL, $date_start=NULL, $date_end=NULL){
		$this->db->select('fb_match_predic.match_predic_id');
		//$this->db->where('match_predic_result', 'y');
		$this->db->where('fb_match_predic.member_id', $member_id);
		$this->db->where('fb_match_predic.match_predic_result IS NOT NULL');
		$this->db->where('fb_match_predic.match_predic_score IS NOT NULL');
		$this->db->where('fb_match_predic.created > \'2015-09-01\'');
		if($date_start and $date_end){
			$where="fb_match_predic.match_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'";
			$this->db->where($where);
		}
		return $this->db->get('fb_match_predic')->num_rows();
	}
	
	public function select_predic_by_member($perpage, $offset, $member_id=NULL, $date_start=NULL, $date_end=NULL){	
		$this->db->select('match_predic, match_predic_result, match_predic_score, fb_match.*, fb_nationals.national_name, fb_leagues.league_name, fb_leagues.league_image, fb_channels.channel_name, 
									club_home.club_name AS club_home_name, club_home.club_image AS club_home_image, 
									club_away.club_name AS club_away_name, club_away.club_image AS club_away_image');
		$this->db->join('fb_match', 'fb_match_predic.match_id = fb_match.match_id');
		$this->db->join('fb_nationals', 'fb_nationals.national_id = fb_match.national_id');
		$this->db->join('fb_leagues', 'fb_leagues.league_id = fb_match.league_id');
		$this->db->join('fb_channels', 'fb_channels.channel_id = fb_match.channel_id');
		$this->db->join('fb_clubs  club_home', 'club_home.club_id = fb_match.club_home_id');
		$this->db->join('fb_clubs club_away', 'club_away.club_id = fb_match.club_away_id');		
		//$this->db->where('match_predic_result', 'y');
		$this->db->where('fb_match_predic.member_id', $member_id);
		$this->db->where('fb_match_predic.match_predic_result IS NOT NULL');
		$this->db->where('fb_match_predic.match_predic_score IS NOT NULL');
		$this->db->where('fb_match_predic.created > \'2015-09-01\'');
		if($date_start and $date_end){
			$where="fb_match_predic.match_date BETWEEN '".$date_start." 00:00:00' AND '".$date_end." 23:59:59'";
			$this->db->where($where);
		}
		$this->db->limit($perpage, $offset);
		$this->db->order_by('fb_match_predic.match_id', 'DESC');
		return $this->db->get('fb_match_predic');
	}
	
	public function __destruct(){
		$this->db->close();
	}
	
}