<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH. '/facebook-sdk-v5/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphUser;
use Facebook\FacebookRedirectLoginHelper;

class Zeanteng extends CI_Controller {
	
	var $datestartmatchtoday;	
	var $dateendmatchtoday;
	
	public function __construct(){
		parent::__construct();
		//$this->load->library('auth');
		//$auth = new auth();
		//$auth->isnot_login();
		$this->load->model('member_model');
		$this->load->model('match_model');
		$this->load->model('teng_model');
		$this->load->model('gameweek_model');
		
		/*if(time()>=strtotime(date('Y-m-d')." 00:00:00") && time()<=strtotime(date('Y-m-d')." 09:00:00")){
			$this->datestartmatchtoday = date("Y-m-d", strtotime("-1 day")).' 09:00:00';
			$this->dateendmatchtoday = date("Y-m-d").' 08:59:59';
		}else{
			$this->datestartmatchtoday = date("Y-m-d").' 09:00:00';
			$this->dateendmatchtoday = date("Y-m-d", strtotime("+1 day")).' 08:59:59';		
		}*/
	}
	
	public function callback(){
		
		$fb = new Facebook\Facebook([
			'app_id' => '1842872169084290',
			'app_secret' => '8078c67b4b7db19449b386fecd716b4b',
			//'app_id' => '629058998373041', //epl1x2test
			//'app_secret' => '793c89ea54d0488fdcdc6d1c3bdf4ea7', //epl1x2test
			'default_graph_version' => 'v2.5',
		]);
		
		$helper = $fb->getRedirectLoginHelper();
		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  $loginUrl = $helper->getLoginUrl(site_url('zeanteng/callback'), array('email'));
		  echo 'Facebook SDK returned an error: ' . $e->getMessage().'   <a href="' . $loginUrl . '">Log in with Facebook!</a>';
		  exit;
		}
		
		if(isset($accessToken)) {
		  // Logged in!
		  $_SESSION['facebook_access_token'] = (string) $accessToken;
		
		  // Now you can redirect to another page and use the
		  // access token from $_SESSION['facebook_access_token']
		
		  $response = $fb->get('/me?fields=id,name,email', $accessToken);
		
		  $user = $response->getGraphUser();
		  //echo'<pre>';
		  //print_r($user['id']);
		  //echo'</pre>';
		  $rs_member = $this->member_model->get_by_fbid($user['id']);
		  if($rs_member->num_rows()>0){
			$row_member = $rs_member->row();
			$data = array(
				'last_login'=>date('Y-m-d H:i:s')
			);
			$this->db->update('fb_members',$data,array('member_id'=>$row_member->member_id));
			$this->session->set_userdata('member_id', $row_member->member_id);	
			$this->session->set_userdata('nickname', $row_member->nickname);
			$this->session->set_userdata('member_shirt', $row_member->club_shirt);
			$this->session->set_userdata('logined', true);
			//redirect(site_url('member/detail'));
			redirect(site_url('zeanteng'));
		  }else{
			$data = array(
				'facebook_id'=>$user['id'],
				'nickname'=>$user['name'],
				'email'=>$user['email'],
				//'gender'=>$user['gender'],
				//'image'=>$user['link'],
				'registerdate'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('fb_members',$data);
			$member_id = $this->db->insert_id();
			$this->session->set_userdata('member_id', $member_id);	
			$this->session->set_userdata('nickname', $user['name']);	
			$this->session->set_userdata('member_shirt', '');
			$this->session->set_userdata('logined', true);				
			//redirect(site_url('member/detail'));
			redirect(site_url('zeanteng'));
		  }
		  		
		} // if(isset($accessToken)) {
	}	
	
	public function index(){
		
		$fb = new Facebook\Facebook([
			'app_id' => '1842872169084290',
			'app_secret' => '8078c67b4b7db19449b386fecd716b4b',
			//'app_id' => '629058998373041', //epl1x2test
			//'app_secret' => '793c89ea54d0488fdcdc6d1c3bdf4ea7', //epl1x2test
			'default_graph_version' => 'v2.5',
		]);
		
		$helper = $fb->getRedirectLoginHelper();	
		//$permissions = ['email', 'user_photos']; // optional	
		$permissions = ['email']; // optional		
		$Content['loginFacebook'] = $helper->getLoginUrl(site_url('zeanteng/callback'), $permissions);
		
		$row_gameweek = $this->gameweek_model->get_display(); //วีคที่ให้ทำการแสดงเป็นวีคหลัก
		$gw_id = $row_gameweek->gw_id; //วีคที่ให้ทำการแสดงเป็นวีคหลัก
		$member_predict = array();
		
		if($this->session->userdata('logined')){
			$Content['row_score'] = $this->teng_model->get_month_score($this->session->userdata('member_id'));
			
			$this->load->model('club_model');
			$Content['rs_clubshirt'] = $this->club_model->get_club_shirt();
			
			// บอลเต็งวันนี้ของ สมาชิก
			$rs_teng = $this->teng_model->get_teng_today($this->session->userdata('member_id'),NULL,NULL,$gw_id);			
			foreach($rs_teng->result() as $row){
				$member_predict[$row->match_id] = $row->teng_predict;
			}			
		}
		
		$Content['row_gameweek'] = $row_gameweek;
		$Content['member_predict'] = $member_predict; 
		$Content['rs_match'] = $this->match_model->get_by_date(NULL,NULL,$gw_id);
		$Content['rs_teamded'] = $this->teng_model->get_teamded(NULL,NULL,$gw_id);
		$Content['rs_matchalded'] = $this->teng_model->get_matchalded(NULL,NULL,$gw_id);
		$Content['rs_memberranking'] = $this->teng_model->get_ranking(($gw_id-1));
		$data['Content'] = $this->load->view('zeanteng/index', $Content, true);
		$this->load->view('template/temp_zeanteng', $data);
	}	
		
	public function confirm(){
		if(!$this->session->userdata('logined'))redirect(site_url());
		$post = $this->input->post();
		$data = array('error'=>1, 'text'=>'ไม่สำเร็จ');
		if($post){
			extract($post);
			if($method=='confirm'){
				$row_gameweek = $this->gameweek_model->get_by_id($gw_id);
				if($row_gameweek->gw_display=='y'){
					if(time()>strtotime($row_gameweek->gw_datetime)){
						echo json_encode(array('error'=>1, 'text'=>'หมดเวลาร่วมเล่นเกมส์')); die();
					}else{
						
						foreach($predict as $key=>$value){
							$data = array(
								'gw_id'=>$gw_id,
								'member_id'=>$this->session->userdata('member_id'),
								'match_id'=>$key,
								'teng_predict'=>$value,
								'teng_date'=>date('Y-m-d H:i:s'),
								'member_ip'=>$this->input->ip_address(),
								'created'=>date('Y-m-d H:i:s')
							);
							$this->db->insert('fb_teng', $data);
						}
						
						if($this->db->affected_rows() > 0){
							if($club_cheer!=''){
								$data = array(
									'club_cheer'=>$club_cheer
								);
								$this->db->update('fb_members', $data, array('member_id'=>$this->session->userdata('member_id')));			
								$this->load->model('club_model');
								$row_club = $this->club_model->select_club_id($club_cheer);
								$this->session->set_userdata('member_shirt', $row_club->club_shirt);
							}
							$data = array('error'=>0, 'text'=>'ขอขอบคุณที่มาร่วมเล่นเกมส์กับเรา');
						}
					} // End if(time()>strtotime($row_match->match_date)){
				}
			} // End if($method=='confirm'){
		} // End if($post){
		echo json_encode($data);
	}
	
	public function list_teng_month(){
		//if($this->session->userdata('logined')){
			if($this->uri->segment(3)&&is_numeric($this->uri->segment(3))){
				$Content['rs_teng'] = $this->teng_model->get_month_listteng($this->uri->segment(3),$this->uri->segment(4));
				$this->load->view('zeanteng/list-teng-month', $Content);
			}
		//}
	}
	
	public function list_zean(){	
		$zeanweek = $this->input->get_post('zeanweek', true);
		$row_gameweek = $this->gameweek_model->get_display(); //วีคที่ให้ทำการแสดงหน้าแรก
		$gw_id = $row_gameweek->gw_id; //วีคที่ให้ทำการแสดงหน้าแรก
		$Content['rs_teamded'] = $this->teng_model->get_teamded(NULL,NULL,$gw_id);
		$Content['rs_matchalded'] = $this->teng_model->get_matchalded(NULL,NULL,$gw_id);
		$Content['rs_memberranking'] = $this->teng_model->get_ranking(($gw_id-1));
		$Content['rs_gameweek'] = $this->gameweek_model->get_all();
		$Content['zeanweek'] = ($zeanweek=='')?$gw_id:$zeanweek;
		$data['Content'] = $this->load->view('zeanteng/list-zean', $Content, true);
		$this->load->view('template/temp_zeanteng', $data);
	}
	
	public function list_zean_all($gw_id=NULL){
		/* Array of database columns which should be read and sent back to DataTables. Use a space where
		* you want to insert a non-database field (for example a counter or static image)
		*/
		$aColumns = array(1=>'fb_members.nickname',2=>'SUM(teng_score) AS teng_score', 3=>'fb_teng.member_id',4=>'club_shirt',5=>'SUM(teng_coefficient) AS teng_coefficient');

		// DB table to use
		$sTable = 'fb_members';
		
		$iDisplayStart = $this->input->get_post('iDisplayStart', true);
		$iDisplayLength = $this->input->get_post('iDisplayLength', true);
		$iSortCol_0 = $this->input->get_post('iSortCol_0', true);
		$iSortingCols = $this->input->get_post('iSortingCols', true);
		$sSearch = $this->input->get_post('sSearch', true);
		$sEcho = $this->input->get_post('sEcho', true);

		// Paging
		if(isset($iDisplayStart) && $iDisplayLength != '-1')
		{
			$this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
		}

		// Ordering
		if(isset($iSortCol_0))
		{
			for($i=0; $i<intval($iSortingCols); $i++)
			{
				$iSortCol = $this->input->get_post('iSortCol_'.$i, true);
				$bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
				$sSortDir = $this->input->get_post('sSortDir_'.$i, true);

				if($bSortable == 'true')
				{
					if($aColumns[intval($this->db->escape_str($iSortCol))]=='SUM(teng_score) AS teng_score'){
						$this->db->order_by('teng_score', $this->db->escape_str($sSortDir));
					}else{
						$this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
					}
				}
			}
		}

		/*
		 * Filtering
		 * NOTE this does not match the built-in DataTables filtering which does it
		 * word by word on any field. It's possible to do here, but concerned about efficiency
		 * on very large tables, and MySQL's regex functionality is very limited
		 */
		if(isset($sSearch) && !empty($sSearch)){
			for($i=0; $i<=count($aColumns); $i++)
			{
				$bSearchable = $this->input->get_post('bSearchable_'.$i, true);

				// Individual column filtering
				if(isset($bSearchable) && $bSearchable == 'true'){
					//if($aColumns[$i]=='created'){
						//(preg_match('/^\d{4}-\d{2}-\d{2}$/', $sSearch))? $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch)) : '';
					//}else{
						$like[] = $aColumns[$i]." LIKE '%".$this->db->escape_like_str($sSearch)."%'";
					//}
				}
			}
		}
		if(isset($like) && !empty($like)){
			$where = "(".implode(" OR ", $like).")";
			$this->db->where($where, NULL, FALSE);
		}
		if(isset($gw_id) && !empty($gw_id) && $gw_id!='all'){
			$this->db->where('fb_teng.gw_id', $gw_id);
		}

		// Select Data
		$this->db->join('fb_teng', 'fb_members.member_id = fb_teng.member_id', 'left');
		$this->db->join('fb_clubs', 'fb_clubs.club_id = fb_members.club_cheer','left');
		$this->db->where('teng_result IS NOT NULL');
		//$this->db->where('teng_date BETWEEN "'.date('Y-m-').'01 00:00:00" AND "'.date("Y-m-t", strtotime(date('Y-m-d'))).' 23:59:59"');
		$this->db->group_by('fb_teng.member_id');
		$this->db->order_by('teng_score','desc');
		$this->db->order_by('teng_coefficient','desc');
		$this->db->order_by('fb_members.nickname','asc');
		$this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
		$rResult = $this->db->get($sTable);
		//$x = $this->db->last_query();
		// Data set length after filtering
		$this->db->select('FOUND_ROWS() AS found_rows');
		$iFilteredTotal = $this->db->get()->row()->found_rows;

		// Total data set length
		$iTotal = $this->db->count_all_results($sTable);

		// Output
		$output = array(
			'sEcho' => intval($sEcho),
			'iTotalRecords' => $iTotal,
			'iTotalDisplayRecords' => $iFilteredTotal,
			'aaData' => array()
		);		
		
		foreach($rResult->result() as $aRow){
			$iDisplayStart = $iDisplayStart+1; //+ นำค่าเริ่มต้นการแบ่งหน้า มาบวก 1 เพื่อแสดงจำนวนรายการแต่ละหน้า
			$row = array();
			//$row[0] = '';
			$row[0] = '<img src="'.base_url('images/shirt/'.$aRow->club_shirt).'" height="60"> '.$aRow->nickname;
			$row[1] = floatval($aRow->teng_score);
			$row[2] = $aRow->member_id;
			$row[3] = $aRow->nickname;	
			$output['aaData'][] = $row;			
		}		 
		echo json_encode($output);
	}
	
	public function week($gw_show){
		if(is_numeric($gw_show)){
			$row_gameweek = $this->gameweek_model->get_by_id($gw_show); //วีคที่ให้ทำการแสดง
			$gw_id = $row_gameweek->gw_id; //วีคที่ให้ทำการแสดง				
			$Content['row_gameweek'] = $row_gameweek;
			$Content['rs_match'] = $this->match_model->get_by_date(NULL,NULL,$gw_id);
			
			$row_gameweek = $this->gameweek_model->get_display(); //วีคที่ให้ทำการแสดงเป็นวีคหลัก
			$gw_id = $row_gameweek->gw_id; //วีคที่ให้ทำการแสดงเป็นวีคหลัก
			$Content['rs_teamded'] = $this->teng_model->get_teamded(NULL,NULL,$gw_id);
			$Content['rs_matchalded'] = $this->teng_model->get_matchalded(NULL,NULL,$gw_id);
			$Content['rs_memberranking'] = $this->teng_model->get_ranking(($gw_id-1));
			
			$data['Content'] = $this->load->view('zeanteng/week', $Content, true);
			$this->load->view('template/temp_zeanteng', $data);
		}else{
			redirect(site_url('zeanteng'));
		}
	}
	
	public function cheerteam(){
		if(!$this->session->userdata('logined'))redirect(site_url());
		$post = $this->input->post();
		if($post){
			extract($post);			
			$data = array(
				'member_id'=>$this->session->userdata('member_id'),
				'club_cheer'=>$club_id
			);
			$this->db->update('fb_members', $data, array('member_id'=>$this->session->userdata('member_id')));			
			if($this->db->affected_rows() > 0){
				$this->load->model('club_model');
				$row_club = $this->club_model->select_club_id($club_id);
				$this->session->set_userdata('member_shirt', $row_club->club_shirt);
				$this->session->set_flashdata('msg_success','อัพเดทเรียบร้อย !!');
				redirect(site_url('zeanteng'));
			}
		} // End if($post){
	}
	
}
